<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use Auth;
use Session;
use Hash;
use DateTime;
use Config;
use Mail;
use App\Models\User;
use App\Models\State;
use App\Models\ContactUs;
use App\Models\City;
use App\Models\Cart;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use App\Services\UserService;

class UserController extends Controller
{
	public function __construct(Guard $auth, UserService $user_service)
	{
		$this->auth = $auth;
		$this->user_service = $user_service;
	}
	
	public function postLogin(Request $request)
		{
			$request_all = $request->all();
			$email = $request_all['email'];
			$password = $request_all['password']; 
			
			$messages = [
			'email.required' => 'The email is required.',
            'email.email' => 'Your email do not have a valid format.',
			'password.required'=> 'Please enter password',
			'password.min'=>' enter minimum 8 character password for security'
			];

			$validator = Validator::make($request_all, [
			'email' => 'required|email|max:255',
			'password' => 'required|min:8' ,       
			], $messages);
		
			if($validator->fails())
			{
				
				return redirect()->back()->withErrors($validator)->withInput();
			}
			else
			{
				$user_details = User::where('email', $email)->get();
				if(count($user_details) > 0)
				{
					$credentials = array('email'=> trim($request_all['email']) , 'password'=> trim($request_all['password']));        
					if ($this->auth->attempt($credentials, $request->has('remember')))
					{					
						Session::put('user_id', $user_details[0]->id);
						Session::put('user_name', $user_details[0]->name);
						session()->save();
						return redirect()->to('/');
					}
					else
					{
						return redirect()->back()->with('success', 'Incorrect password');
					}
				}
				else
				{
					return redirect()->back()->with('success', 'user not found');
				}
			}
		}
	public function getLogout()
	{
		$this->auth->logout();
		Session::forget('user_id');
		Session::forget('user_name');
		return redirect('/'); //Redirect to admin login form
	}
	
	//Add Product
	public function postSignup(Request $request)
	{
		
		
			$request_data = $request->all();
			$validator = $this->user_service->user_rules($request_data);
			
			if($validator->fails())
			{
				return redirect()->back()->withErrors($validator)->withInput();
			}
			else
			{	
                $this->user_service->addUser($request_data);  
				return redirect()->back()->with('success', 'Sign in success'); 
			}
		}
		
		// returns array of cities by state
		public function getCities(Request $request) {
			/*$request_data = $request->all();
			$cities = City::where('state_id', $request_data['state_id'])->get();
			$response = ['cities' => $cities];
			return response()->json($response, 200);*/
			
			$data['cities'] = City::where("state_id",$request->state_id)->get(["name", "id"]);
			return response()->json($data);
		}
		//contactus
	public function postContactus(Request $request)
	{
			$request_data = $request->all();
			
			$validator = $this->user_service->add_contactus_rules($request_data);
			
			if($validator->fails())
			{
				return redirect()->back()->withErrors($validator)->withInput();
			}
			else
			{
				$this->user_service->addContactus($request_data);  

				return redirect()->back()->with('success', 'Thanks for your feedback');
			}
		
		
	}
	public function getProfile(Request $request) 
	{
		$user = Auth::User();
		$states = State::orderBy('id')->get();
		$cities = City::orderBy('id')->get();
		$cart_count = Cart::where('user_id', Auth::User()->id)->count();
		return view('user.editprofile')
		->with('states', $states)
		->with('cities', $cities)
		->with('user', $user)
		->with('cart_count', $cart_count);
	}
	//Edit user 
	public function postEdit(Request $request) {
		Session::put('tab', 'profile');
		$request_data = $request->all();
		$validator = $this->user_service->edit_profile_rules($request_data);

		if($validator->fails()) {
			return redirect()->back()->withErrors($validator)->withInput();
		} else {
			if(Auth::User()->user_type == 0) {
				$user = User::where('email', $request_data['email'])->where('id', '!=', $request_data['user-id'])->get();
				if(count($user) > 0) {
					$error =  array('email' => 'Email id already exist');
				return redirect()->back()->withErrors($error)->withInput();
				}
			}
			$this->user_service->editUser($request_data);
		}
		return redirect()->back()->with('success', 'User profile updated successfully');
	}
}
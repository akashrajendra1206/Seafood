<?php namespace App\Services;

use DB;
use Validator;
use Auth;
use Session;
use Hash;
use App\Models\User;
use App\Models\City;
use App\Models\State;
use App\Models\ContactUs;


class UserService 
{
	//add admin rules
	public function user_rules(array $data)
	{
		$messages = 
		[
		'email.required'                => 'Please enter email',
		'email.unique'                  => 'This email has already been taken. Please register with different email',
		'password.required'             => 'Please enter password',
		'confirm-password.required'     => 'Please confirm password',
		'name.required'                 => 'Please enter your name',
		'contactdd.digits_between' => 'Contact number should be 10-15 digits.',
		'state.required'             => 'Please enter state name',
		'city.required'             => 'Please enter city name',
		'contact.digits_between' => 'pincode should be 6 digits.',
		'address.required'                 => 'Please enter your address'
		];

		$validator = Validator::make($data,
		[
		'email'            => 'required|email|max:255|unique:user',
		'password'         => 'required|min:8',
		'name'             => 'required|min:3|max:100',
		'confirm-password' => 'required|min:8|same:password',         
		'contact'   => 'numeric|digits_between:10,15',
		'state'             => 'required',
		'city'             => 'required',
		'conact'   => 'numeric|digits_between:10,15',
		'address'             => 'required',
		], $messages);

		return $validator;
	}
	

	//add User rules
	public function add_user_rules(array $data)
	{
		$messages =
		[
			'email.required' => 'Please enter email',
			'name.required' => 'Please enter name',
			'password.required' => 'Please enter password',
			'password.regex' => 'The password must contain atleast 1 special character($, @, !, #, %, *, ?, &), 1 uppercase letter and 1 number',
			'confirm-password.regex' => 'The password must contain atleast 1 special character($, @, !, #, %, *, ?, &), 1 uppercase letter and 1 number',
			'confirm-password.required' => 'Please enter confirm password',
			'address.required' => 'Please enter address',
			'state.required' => 'Please select email',
			'city.required' => 'Please select city',
			'accept-tnc.required' => 'Please accept all terms and conditions'			
		];

		$validator = Validator::make($data, 
		[
			'email' => 'required|email|max:255',
			'name' => 'required' ,       
			'password' => 'required|min:8|max:15|same:password|regex:/(?=.[a-z])(?=.[A-Z])(?=.\d)(?=.[$@!#%?&])[A-Za-z\d$@!#%?&]{8,15}/' ,             
			'confirm-password' => 'required|min:8|max:15|same:password|regex:/(?=.[a-z])(?=.[A-Z])(?=.\d)(?=.[$@!#%?&])[A-Za-z\d$@!#%?&]{8,15}/',             
			'address' => 'required',       
			'state' => 'required',        
			'city' => 'required',
			'accept-tnc' => 'required'
		], $messages);

		return $validator;
	}
	
	// add user
	public function addUser(array $request_data) 
	{
		$obj_user = new User;
		$obj_user->name = $request_data['name'];
		$obj_user->email = $request_data['email'];
		$obj_user->password = bcrypt($request_data['password']);
		$obj_user->address = $request_data['address'];
		$obj_user->contact_number = $request_data['contact'];
		$obj_user->state_id = $request_data['state'];
		$obj_user->city_id = $request_data['city'];
		$obj_user->country_id = 1;
		$obj_user->user_type = 1;    //0=Admin, 1=User
		$obj_user->status = 0; 
		$obj_user->save(); 
		
	}

	// add admin
	public function addAdmin(array $request_data)
	{
		$obj_user = new User;
		$obj_user->name = $request_data['name'];
		$obj_user->email = $request_data['email'];
		$obj_user->password = bcrypt($request_data['password']);
		$obj_user->address = $request_data['address'];
		$obj_user->state_id = $request_data['state'];
		$obj_user->city_id = $request_data['city'];
		$obj_user->country_id = 1;
		$obj_user->contact_number = $request_data['contact-number'];
		$obj_user->user_type = 0;    //0=Admin, 1=User
		$obj_user->gender = $request_data['gender'];
		$obj_user->status = $request_data['status'];
		$obj_user->dob = date('Y-m-d H:i:s', strtotime(str_replace('/', '-', '01/01/1980')));    
		$obj_user->image = 'unknown.jpg';
		$obj_user->save(); 
	}
  
	//edit admin rules
	public function edit_admin_rules(array $data) 
	{
		$messages = [
		'email.required'                => 'Please enter email',
		'name.required'                 => 'Please enter your name',
		'contact-number.digits_between' => 'Contact number should be 10-15 digits.',
		];

		$validator = Validator::make($data, [
		'email'            => 'required|email|max:255',
		'name'             => 'required|min:3|max:100',        
		'contact-number'   => 'numeric|digits_between:10,15'
		], $messages);

		return $validator;
	}
  
	//edit profile rules
	public function edit_profile_rules(array $data) 
	{
		$messages = 
		[
		'email.required'                => 'Please enter email',
		'name.required'                 => 'Please enter your name',
		'contact-number.required' => 'Please enter contact number.',
		'contact-number.digits_between' => 'Contact number should be 10-15 digits.',
		];

		$validator = Validator::make($data,
		[
		'email'            => 'required|email|max:255',
		'name'             => 'required|min:3|max:100',        
		'contact-number'   => 'required|numeric|digits_between:10,15'
		], $messages);

		return $validator;
	}
  
	// edit user
	public function editUser(array $request_data) 
	{
		$obj_user = User::find($request_data['user-id']);
		$obj_user->name = $request_data['name'];
		$obj_user->address = $request_data['address'];
		$obj_user->state_id = $request_data['state'];
		$obj_user->city_id = $request_data['city'];
		$obj_user->country_id = 1;
		$obj_user->contact_number = $request_data['contact-number'];
		$obj_user->gender = $request_data['gender'];
		$obj_user->dob = date('Y-m-d', strtotime(str_replace('/', '-', $request_data['dob'])));// only for user type 0 (admin)
		if(Auth::user()->user_type == 0) 
		{
			$obj_user->email = $request_data['email'];
			$obj_user->status = $request_data['status']; 
			$obj_user->image = $request_data['images'];
		}
		$obj_user->save(); 
	}

	//change password rules
	public function user_change_password_rules(array $data)
	{
		$messages = [
		'old-password.required' => 'Please enter old password',
		'password.required'     => 'Please enter new password',
		're-password.required'  => 'Please confirm the password'
		];

		$validator = Validator::make($data, [
		'old-password' => 'required',
		'password'     => 'required|min:8',
		're-password'  => 'required|same:password'
		], $messages);

		return $validator;
	}
  
	//change user password
	public function updatePassword($password, $id)
	{
		$obj_seller = User::find($id);
		$obj_seller->password = $password;
		$obj_seller->save();
	}
	
		//add contactus rules
	public function add_contactus_rules(array $data)
	{
		$messages = [
			'first_name.required' => 'Please enter first name',
			'last_name.required' => 'Please enter last name',
			'phone_number.required' => 'Please enter phone number',			
			'email.required' => 'Please enter Email',			
			'message.required' => 'Please enter message',			
			'phone.digits_between' => 'Contact number should be 10-15 digits.',			
		];

		$validator = Validator::make($data, [
			'first_name' => 'required',
			'last_name' => 'required',
			'phone_number' => 'required|numeric|digits_between:10,15',
			'email' => 'required|email|max:255',
			'message' => 'required'       
		], $messages);

		return $validator;
	}
	
	// add contactus
	public function addContactus(array $request_data) 
	{
		$contact_us = new ContactUs;
		$contact_us->first_name = $request_data['first_name'];
		$contact_us->last_name = $request_data['last_name'];
		$contact_us->phone_number = $request_data['phone_number'];
		$contact_us->email = $request_data['email'];
		$contact_us->message = $request_data['message'];
		$contact_us->save(); 
		return $contact_us;
	}
}
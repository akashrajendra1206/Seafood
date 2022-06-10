<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use Config;
use DB;
use App\Models\Cart;
use App\Models\User;
use App\Models\City;
use App\Models\State;
use App\Models\ContactUs;
use App\Models\Order;
use App\Services\ProductService;
use App\Models\Product;
use App\Models\ProductImage;
class HomeController extends Controller
{
    public function index()
	{
		if(Auth::check() && Session::get('user_id')!="" && Session::get('user_name')!="")
			{
				if(Auth::User()->user_type == 0)
				{
					return redirect()->to('/admin-dashboard');
				}
				else if(Auth::User()->user_type == 1)
				{
					if(Auth::check())
				{
					$cart_count = Cart::where('user_id', Auth::User()->id)->count();
				}else
				{
					$cart_count = 0;
				}
					$shops = DB::table('product')
					->select('product.*', 'product_images.name as image')
					->leftJoin('product_images', 'product.id', '=', 'product_images.product_id')
					->where('product.status', 1) 
					->groupBy('product.id') 
					->get();
					return view('welcome')
					->with('shops', $shops)
					->with('cart_count', $cart_count);
				} 				
			}			
		
		else
		{	
			if(Auth::check())
				{
					$cart_count = Cart::where('user_id', Auth::User()->id)->count();
				}else
				{
					$cart_count = 0;
				}
					$shops = DB::table('product')
					->select('product.*', 'product_images.name as image')
					->leftJoin('product_images', 'product.id', '=', 'product_images.product_id')
					->where('product.status', 1) 
					->groupBy('product.id') 
					->get();
					return view('welcome')
					->with('shops', $shops)
					->with('cart_count', $cart_count);
		}
		
	}
	
	public function getAdmin()
	{
		if(Auth::check())
		{
			$user_count = User::where('user.user_type', 1)->count();
		}
		$contact_count = ContactUs::orderBy('id')->count();
		$order_count = Order::orderBy('id')->count();
		$product_count = Product::orderBy('id')->count();
		return view('admin.dashboard')
		->with('user_count', $user_count)
		->with('contact_count', $contact_count)
		->with('order_count', $order_count)
		->with('product_count', $product_count);
	}
	
	public function getUserLogin()
	{
		if(Auth::check())
				{
					$cart_count = Cart::where('user_id', Auth::User()->id)->count();
				}else{
					$cart_count = 0;
				}
		return view('User.login')
		->with('cart_count', $cart_count);
			
	}
	
	
	public function getUserSignUp()
    {
		$states = State::orderBy('id')->get();
		$cities = City::orderBy('id')->get();
		
        return view('user.sign_up')
		->with('states', $states)
		->with('cities', $cities);
    }
	public function getContactus()
	{
		if(Auth::check())
				{
					$cart_count = Cart::where('user_id', Auth::User()->id)->count();
				}else{
					$cart_count = 0;
				}
		return view('user.contactus')
		->with('cart_count', $cart_count);
	}
	public function getContact()
	{
		$contact_us = DB::table('contact_us')->get();
		return view('admin.contact')
		->with('contact_us', $contact_us);
	}
	public function getUser()
	{
		$user = DB::table('user')
		->select('user.*')
		->where('user.user_type', 1)
		->get();
		return view('admin.userinfo')
		->with('user', $user);
	}
	public function getAbout()
	{
		if(Auth::check())
				{
					$cart_count = Cart::where('user_id', Auth::User()->id)->count();
				}else{
					$cart_count = 0;
				}
		return view('user.About')
		->with('cart_count', $cart_count);
	}
	
	public function getprivacy()
	{
		if(Auth::check())
				{
					$cart_count = Cart::where('user_id', Auth::User()->id)->count();
				}else{
					$cart_count = 0;
				}
		return view('user.privacy')
		->with('cart_count', $cart_count);
	}
	
	public function getViewProduct() 
	{
		$products = DB::table('product')->get();
		return view('admin.product')
		->with('product', $products);
	}
	
	public function getReport(Request $request)
	{
		if(Auth::check() && Auth::User()->user_type == 0)
		{			
			$request_data = $request->all();
			$order_details = DB::table('order')				
            ->leftjoin('order_details', 'order.id', '=', 'order_details.order_id')
            ->leftjoin('product', 'product.id', '=', 'order_details.product_id')
			->leftjoin('user', 'user.id', '=', 'order.user_id')
				->select('order_details.*','user.*','order.*','product.*', 'user.name as user_name', 'product.name as product_name','order.created_at as order_date')
				
            ->get();
			//dd($order_details);
			
			return view('admin.product_report')
			->with('order_details', $order_details);
		}
		else
		{
			return redirect()->to('/');
		}
	} 
	
}
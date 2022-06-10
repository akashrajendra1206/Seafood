<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Auth;
use Session;
use Validator;
use DB;
use App\Models\State;
use App\Models\City;

use App\Models\Product;
use App\Models\User;
use App\Models\Cart;
use App\Models\ProductImage;

use App\Services\CartService;

class CartController extends Controller
{
	public function __construct( Guard $auth,CartService $cart_service){
		$this->auth = $auth;
		$this->cart_service = $cart_service;
	}
	
	//get Add To Cart
	public function getIndex(Request $request)
	{
		if(Auth::check())
		{
			$products = DB::table('cart')
			->select('product.*','cart.*','cart.id as cart_id')
			->join('product', 'product.id', '=', 'cart.product_id')
			->where('cart.user_id', Auth::User()->id)
			->get();
		
			if(Auth::check())
			{
				$cart_count = Cart::where('user_id', Auth::User()->id)->count();
			}else{
				$cart_count = 0;
			}
			return view('user.cart')
			->with('products', $products)
			->with('cart_count', $cart_count);
			
		}else{
			return redirect()->back()->withErrors(array('login-error' => 'Please Login'));
		}
	}
	
	//Add To Cart
	public function getAdd(Request $request)
	{
		if(Auth::check())
		{
			$request_data = $request->all();
			$validator = $this->cart_service->add_cart_rules($request_data);
			
			if($validator->fails())
			{
				return redirect()->back()->withErrors($validator)->withInput();
			}
			else
			{	
				
				$this->cart_service->addCart($request_data); 
				return redirect('/cart');
			}
		}else{
			return redirect()->to('/user-login');
		}
	}
	
	//Edit Cart
	public function getEdit(Request $request)
	{
		if(Auth::check())
		{
			$request_data = $request->all();
			$this->cart_service->editCart($request_data); 
			$response = ['success' => 'success'];
			return response()->json($response, 200);			
		} else {
			return response()->json(array('error' => 'Please Login'), 400);
		}
	}
	
	
	//Delete Cart Product
	public function postDelete(Request $request)
	{
		$request_data = $request->all();
		$cart_id = $request_data['cart-id']; 
		
		$product = DB::table('cart')->where('id', $cart_id)->delete();
		
		return redirect()->back()->with('success', 'Product removed from cart successfully');
	}
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Contracts\Auth\Guard;

use App\Http\Requests;

use Auth;
use Session;
use Validator;
use DB;
use Config;
use Mail;
use Image;

use App\Services\ProductService;
use App\Models\Product;
use App\Models\Cart;
use App\Models\ProductImage;

class ShopController extends Controller
{
	public function getProductImage()
	{
		if(Auth::check())
				{
					$cart_count = Cart::where('user_id', Auth::User()->id)->count();
				}else{
					$cart_count = 0;
				}
		$shops = DB::table('product')
		->select('product.*', 'product_images.name as image')
		->leftJoin('product_images', 'product.id', '=', 'product_images.product_id')
		->where('product.status', 1) 
		->groupBy('product.id') 
		->get();
		
		return view('user.shop')
		->with('shops', $shops)
		->with('cart_count', $cart_count);
	}
	
	public function getProductDetails(Request $request)
	{
		if(Auth::check())
				{
					$cart_count = Cart::where('user_id', Auth::User()->id)->count();
				}else{
					$cart_count = 0;
				}
		
		$request_data = $request->all();
		
		$product = Product::find($request_data['product-id']);
			
		$product_images = ProductImage::where('product_id', $request_data['product-id'])->pluck('name');
		
		return view('user.productdetails')
		->with('product_images', $product_images)
		->with('product', $product)
		->with('cart_count', $cart_count);
		
	}
	
	
}
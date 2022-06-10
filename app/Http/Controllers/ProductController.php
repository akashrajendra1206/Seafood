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

class ProductController extends Controller
{
	public function __construct( Guard $auth, ProductService $product_service){
		$this->auth = $auth;
		$this->product_service = $product_service;
	}
	
    public function getAdd()
	{
		return view('admin.addproduct');
	}
	
	
	//Add Product
	public function postAdd(Request $request)
	{
		if(Auth::check() && Auth::User()->user_type == 0)
		{
			$request_data = $request->all();
			
			$validator = $this->product_service->add_product_rules($request_data);
			
			if($validator->fails())
			{
				return redirect()->back()->withErrors($validator)->withInput();
			}
			else
			{
				$this->product_service->addProduct($request_data);  

				return redirect()->back()->with('success', 'Product added successfully');
			}
		}
		else
		{
			return redirect()->to('/');
		}
	}
	
	//View all Product
	public function getProducts() 
	{
		
			$products = DB::table('product')->get();
			
			return view('admin.viewproduct')
			->with('product', $products);
		
	}
	
	//Upload image
	public function anyUpload(Request $request)
	{
		
		if($request->ajax()){
    		$data = $request->file('file');
           $extension = $data->getClientOriginalExtension();
           $filename = rand() . '.' . $data->getClientOriginalExtension(); // renameing image
        
          // $usersImage = public_path("/uploads/{$filename}"); // get previous image from folder

			//$destinationPath = public_path('/../../public_html/uploads/');  //for server
			$destinationPath = public_path('/uploads/');
			
			$data->move($destinationPath, $filename);
			
           return response()->json([
               'success' => 'done',
               'valueimg'=>$filename
           ]);
    	}	
	} 
	//Get edit Product
	public function getEdit(Request $request)
	{
		if(Auth::check() && Auth::User()->user_type == 0)
		{
			Session::forget('menu');
			$request_data = $request->all();
			$product = DB::table('product')				
            ->leftjoin('product_images', 'product.id', '=', 'product_images.product_id')
            ->leftjoin('product_videos', 'product.id', '=', 'product_videos.product_id')
				->select('product.*', 'product_images.name as image', 'product_images.id as image_id','product_videos.link as video_url')
				->where('product.id', $request_data['product-id'])
            ->get();
			return view('admin.edit')
			->with('product', $product)
			->with('menu', 'product');
		}
		
	} 
  
	//Edit Product 
	public function postEdit(Request $request)
	{
		$request_data = $request->all();
		$validator = $this->product_service->edit_product_rules($request_data);

		if($validator->fails())
		{
			return redirect()->back()->withErrors($validator)->withInput();
		}
		else
		{
			if($request_data['set_as_banner'] && $request_data['banner_image'] == ""){
				$error = array('banner_image' => 'Please select banner image');
				return redirect()->back()->withErrors($error)->withInput();
			}
			$this->product_service->editProduct($request_data);  
		}
		return redirect()->back()->with('success', 'Product updated successfully');    
	}  
	
	//Delete Product Image
	public function postDeleteImage(Request $request)
	{	 
		$request_data = $request->all();
		$image_id = $request_data['image-id']; 
		$product_images = DB::table('product_images')
		->where('id', $image_id)
		->delete();
	
		return redirect()->back()->with('success', 'Product image deleted successfully');
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
	
}
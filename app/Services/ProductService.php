<?php namespace App\Services;

use Validator;
use Auth;

use App\Models\Product;
use App\Models\ProductImage;



class ProductService 
{
	//add Product rules
	public function add_product_rules(array $data){
		$messages = [
			'name.required' => 'Please enter product name.',
			'name.unique' => 'Product name must be unique',
			'price.required' => 'Please enter product price.',
			'quantity.required' => 'Please enter product quantity.',
			'display_image.required' => 'Please select product display image.',
			'banner_image.required_if' => 'Please select product banner image.'
		];

		$validator = Validator::make($data, [
			'name' => 'required|min:2|max:500|unique:product',
			'description' => 'min:2|max:5000',
			'price' => 'required|numeric|min:0',
			'quantity' => 'required|numeric|min:0',
			'display_image' => 'required',
			'banner_image' => 'required_if:set-as-banner, ==, 1'
		], $messages);

		return $validator;
	}
	
	// add Product
	public function addProduct(array $request_data) {	
		$obj_product = new Product;
		$obj_product->name = $request_data['name'];
		$obj_product->description = $request_data['description'];
		$obj_product->price = $request_data['price'];
		$obj_product->quantity = $request_data['quantity'];
		$obj_product->banner_image = $request_data['banner_image'];
		$obj_product->set_as_banner = $request_data['set_as_banner'];
		$obj_product->display_image = $request_data['display_image'];
		$obj_product->status = $request_data['status'];
		$obj_product->save(); 
		
		if(isset($request_data['images'])){
			$images = $request_data['images'];
			foreach($images as $product_image){
				if($product_image!=""){
					$obj_product_image = new ProductImage;
					$obj_product_image->product_id = $obj_product->id;
					$obj_product_image->name = $product_image;		
					$obj_product_image->save(); 
				}
			}
		}
	}
	
	// edit Product rules
	public function edit_product_rules(array $data){
		$messages = [
			'name.required' => 'Please enter product name.',
			'price.required' => 'Please enter product price.',
			'quantity.required' => 'Please enter product quantity.',
			'display_image.required' => 'Please select product display image.',
			'banner_image.required_if' => 'Please select product banner image.'
		];
    
		$validator = Validator::make($data, [
			'name' => 'required|min:2|max:50|unique:product,name,'.$data['product-id'],
			'description' => 'min:2|max:1000',
			'price' => 'required|numeric|min:0',
			'quantity' => 'required|numeric|min:0',
			'display_image' => 'required',
			'banner_image' => 'required_if:set_as_banner, ==, 1'
		], $messages);
    
		return $validator;
	}
  
	// edit Product
	public function editProduct(array $request_data) 
	{
		
		$obj_product = Product::find($request_data['product-id']);		
		$obj_product->name = $request_data['name'];			 
		$obj_product->description = $request_data['description'];
		$obj_product->price = $request_data['price'];
		$obj_product->quantity = $request_data['quantity'];
		$obj_product->set_as_banner = $request_data['set_as_banner'];
		$banner_image=($request_data['set_as_banner']) ? $request_data['banner_image']:'';
		$obj_product->banner_image = $banner_image;
		$obj_product->display_image = $request_data['display_image'];
		$obj_product->status = $request_data['status'];

		$obj_product->save();

		if(isset($request_data['images']))
		{
			$images = $request_data['images'];
			ProductImage::where('product_id', $request_data['product-id'])->delete();
			foreach($images as $product_image)
			{
				if($product_image!="")
				{
					$obj_product_image = new ProductImage;
					$obj_product_image->product_id = $request_data['product-id'];
					$obj_product_image->name = $product_image;		
					$obj_product_image->save(); 
				}
			}
		}		
	}
}
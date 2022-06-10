<?php namespace App\Services;

use Validator;

use App\Models\Cart;

class CartService 
{
	// Add cart Product rules
	public function add_cart_rules(array $data){
		$messages = [
			
		];
    
		$validator = Validator::make($data, [
		], $messages);
    
		return $validator;
	}
	
	
	// Add cart Product
	public function AddCart(array $request_data) {
		
		   $cart_details = Cart::where(['product_id'=>$request_data['product-id'], 'user_id'=>$request_data['user-id']])->get();
		
	
		if(count($cart_details) > 0)
		{
			$cart_details[0]->product_quantity = $cart_details[0]->product_quantity+$request_data['quantity'];
			$cart_details[0]->save(); 
		}
		else
		{
			$obj_cart = new Cart;
			$obj_cart->product_id = $request_data['product-id'];
			$obj_cart->user_id = $request_data['user-id'];
			$obj_cart->product_quantity = $request_data['quantity'];
			$obj_cart->save(); 
		}		
	}
	
	// Edit cart Product
	public function EditCart(array $request_data) {		
		$obj_cart = Cart::find($request_data['cart-id']);
		$obj_cart->product_quantity = $request_data['quantity'];
		$obj_cart->save(); 
	}
}
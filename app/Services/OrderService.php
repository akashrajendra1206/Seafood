<?php namespace App\Services;

use Validator;
use DB;

use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use \PDF;
class OrderService 
{
	// Add order rules
	public function add_order_rules(array $data){
		$messages = [
			'shipping-address.required' => 'Please enter shipping address.',
			'shipping-locality.required' => 'Please enter shipping locality.',
			'shipping-state.required' => 'Please select shipping city.',
			'shipping-city.required' => 'Please select shipping city.',
			'shipping-contact.required' => 'Please enter shipping contact.',
			'shipping-contact.numeric' => 'Contact should be numeric.',
			'shipping-pincode.required' => 'Please enter shipping pincode.',
			'shipping-pincode.numeric' => 'Pincode should be numeric.',
			'same-as-address.required' => 'Please select same as shipping address.',
			'billing-address.required' => 'Please enter billing address.',
			'billing-locality.required' => 'Please enter shipping locality.',
			'billing-state.required' => 'Please select billing city.',
			'billing-city.required' => 'Please select billing city.',
			'billing-contact.required' => 'Please enter billing contact.',
			'billing-contact.numeric' => 'Contact should be numeric.',
			'billing-pincode.required' => 'Please enter billing pincode.',
			'billing-pincode.numeric' => 'Pincode should be numeric.'
		];
    
		$validator = Validator::make($data, [
			'shipping-address' => 'required|min:2|max:850',
			'shipping-locality' => 'required|min:2|max:50',
			'shipping-area' => 'min:2|max:50',
			'shipping-state' => 'required',
			'shipping-city' => 'required',
			'shipping-pincode' => 'required|numeric|min:0',
			'shipping-contact' => 'required|numeric|min:0',
			'same-as-address' => 'required',
			'billing-address' => 'required|min:2|max:850',
			'billing-locality' => 'required|min:2|max:50',
			'billing-area' => 'min:2|max:50',
			'billing-state' => 'required',
			'billing-city' => 'required',
			'billing-contact' => 'required|numeric|min:0',
			'billing-pincode' => 'required|numeric|min:0'
		], $messages);
    
		return $validator;
	}
	
	
	// Add Order
	public function AddOrder($obj_order_data) {
		$obj_order = new Order;
		$obj_order->user_id = $obj_order_data->user_id;
		$obj_order->discount = $obj_order_data->discount;
		$obj_order->total_amount = $obj_order_data->total_amount ;
		$obj_order->cgst_rate = $obj_order_data->cgst_rate;
		$obj_order->cgst_amount = $obj_order_data->cgst_amount;
		$obj_order->sgst_rate = $obj_order_data->sgst_rate;
		$obj_order->sgst_amount = $obj_order_data->sgst_amount;
		$obj_order->igst_rate = $obj_order_data->igst_rate;
		$obj_order->igst_amount = $obj_order_data->igst_amount;
		$obj_order->shipping_address = $obj_order_data->shipping_address;
		$obj_order->shipping_locality = $obj_order_data->shipping_locality;
		$obj_order->shipping_area = $obj_order_data->shipping_area;
		$obj_order->shipping_country_id = $obj_order_data->shipping_country_id;
		$obj_order->shipping_city_id = $obj_order_data->shipping_city_id;
		$obj_order->shipping_state_id = $obj_order_data->shipping_state_id;
		$obj_order->shipping_contact = $obj_order_data->shipping_contact;
		$obj_order->shipping_pincode = $obj_order_data->shipping_pincode;
		$obj_order->billing_address = $obj_order_data->billing_address;
		$obj_order->billing_locality = $obj_order_data->billing_locality;
		$obj_order->billing_area = $obj_order_data->billing_area;
		$obj_order->billing_country_id = $obj_order_data->billing_country_id;
		$obj_order->billing_city_id = $obj_order_data->billing_city_id;
		$obj_order->billing_state_id = $obj_order_data->billing_state_id;
		$obj_order->billing_contact = $obj_order_data->billing_contact;
		$obj_order->billing_pincode = $obj_order_data->billing_pincode;
		$obj_order->save(); 
		return $obj_order;
	}
	
	// Add Order Details
	public function AddOrderDetails($obj_order_id,array $order_details) {
		foreach($order_details as $order)
		{
			$obj_order_details = new OrderDetails;
			$obj_order_details->order_id = $obj_order_id;
			$obj_order_details->product_id = $order->product_id ;
			$obj_order_details->tracking_id = $order->tracking_id;
			$obj_order_details->tracking_status = $order->tracking_status;
			$obj_order_details->unit_price = $order->unit_price;
			$obj_order_details->product_quantity = $order->product_quantity;
			$obj_order_details->product_amount = $order->product_amount ;
			$obj_order_details->discount = $order->discount ;
			$obj_order_details->total = $order->total;	
			$obj_order_details->order_status = $order->order_status;
			$obj_order_details->save(); 		
		}		
	}
}
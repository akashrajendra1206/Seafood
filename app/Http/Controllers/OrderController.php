<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Contracts\Auth\Guard;

use Auth;
use Session;
use Validator;
use DB;
use Config;
use View;
use Redirect;
use Mail;
use PDF;

use App\Models\State;
use App\Models\City;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\User;
use App\Models\ProductImage;


use App\Services\OrderService;

class OrderController extends Controller
{
	public function __construct( Guard $auth,OrderService $order_service){
		$this->auth = $auth;
		$this->order_service = $order_service;
	}
	
	public function getAddress() 
	{
		$states = State::orderBy('id')->get();
		$cities = City::orderBy('id')->get();
		$cart_count = Cart::where('user_id', Auth::User()->id)->count();

		return view('user.address')
		->with('states', $states)
		->with('cities', $cities)
		->with('cart_count', $cart_count);
	}
	
	//Add Product
	public function postAdd(Request $request)
	{
		if(Auth::check())
		{
			$request_data = $request->all();
	
			$validator = $this->order_service->add_order_rules($request_data);
			
			if($validator->fails())
			{
				return redirect()->back()->withErrors($validator)->withInput();
			}
			else
			{
				$obj_carts = DB::table('cart')->where('user_id', '=', Auth::User()->id)->get();

				$product = Product::where ('status',1)->get()->keyBy('id');
				$total = 0;
				$order_details_array = array();
				$product_original_quantity_array = array();
				$product_change_quantity_array = array();
				$product_ids = array();
				foreach($obj_carts as $obj_cart)
				{
					$obj_order_details = new OrderDetail();
					$obj_order_details->cart_id = $obj_cart->id;
					$obj_order_details->product_id = $obj_cart->product_id;
					$trackingNumber = random_int(100000, 999999);
					//dd($trackingNumber);
					$obj_order_details->tracking_id = $trackingNumber;
					$obj_order_details->tracking_status = 0;
					$obj_order_details->order_status = 0;
					$product_quantity = $obj_cart->product_quantity;
					$obj_order_details->product_quantity = $product_quantity;
					$obj_order_details->unit_price = $product[$obj_cart->product_id]->price;
					$obj_order_details->reorder_level = $product[$obj_cart->product_id]->reorder_level;
					$product_amount = $product_quantity * $product[$obj_cart->product_id]->price;
					$obj_order_details->product_amount = $product_amount;
					$obj_order_details->total = $product_amount;
					$obj_order_details->discount = 0;
					$product_ids[] = $obj_cart->product_id;
					$product_original_quantity_array[$obj_cart->product_id] = $product[$obj_cart->product_id]->quantity;
					if(isset($product_change_quantity_array[$obj_cart->product_id])) {
						$product_quantity = $product_quantity + $product_change_quantity_array[$obj_cart->product_id];
					}
					$product_change_quantity_array[$obj_cart->product_id] = $product_quantity;
					$total = $total + $product_amount;
					$order_details_array[] = $obj_order_details;					
				}
				//print_r($product_original_quantity_array);
				//dd($product_change_quantity_array);
				$product_ids = array_unique($product_ids);
				$obj_order = new ProductOrder();
				$obj_order->user_id = Auth::User()->id;
				$obj_order->total_amount = $total;
				$obj_order->discount = 0;
				$obj_order->cgst_rate = 0;
				$obj_order->cgst_amount = 0;
				$obj_order->sgst_rate = 0;
				$obj_order->sgst_amount = 0;
				$obj_order->igst_rate = 0;
				$obj_order->igst_amount = 0;
				$obj_order->shipping_address = $request_data['shipping-address'];
				$obj_order->shipping_locality = $request_data['shipping-locality'];
				$obj_order->shipping_area = $request_data['shipping-area'];
				$obj_order->shipping_country_id = 1;
				$obj_order->shipping_city_id = $request_data['shipping-city'];
				$obj_order->shipping_state_id = $request_data['shipping-state'];
				$obj_order->shipping_contact = $request_data['shipping-contact'];
				$obj_order->shipping_pincode = $request_data['shipping-pincode'];
				$obj_order->billing_address = $request_data['billing-address'];
				$obj_order->billing_locality = $request_data['billing-locality'];
				$obj_order->billing_area = $request_data['billing-area'];
				$obj_order->billing_country_id = 1;
				$obj_order->billing_city_id = $request_data['billing-city'];
				$obj_order->billing_state_id = $request_data['billing-state'];
				$obj_order->billing_contact = $request_data['billing-contact'];
				$obj_order->billing_pincode = $request_data['billing-pincode'];				
				$obj_order->transaction_status = 0;
				$obj_order->transaction_id = 0;
				$obj_order->transaction_date = 0;
				
				$obj_order = $this->order_service->addOrder($obj_order); 
				$order_id=$obj_order->id;
				
				$ch = curl_init();

				// For Live Payment change CURLOPT_URL to https://www.instamojo.com/api/1.1/payment-requests/
				
				curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/api/1.1/payment-requests/');
				curl_setopt($ch, CURLOPT_HEADER, FALSE);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
				curl_setopt($ch, CURLOPT_HTTPHEADER,
					array("X-Api-Key:test_f55c9ef20d1969390114f344d32",
						"X-Auth-Token:test_48976b2055413ae25c9eb1a2b29"));
				$payload = Array(
					'purpose' => 'Seafood shop payment',
					'amount' => $total,
					'phone' => $obj_order->shipping_contact,
					'buyer_name' => Auth::User()->name,
					'redirect_url' => url('/order/returnurl',$order_id),
					'send_email' => false,
					'webhook' => 'http://instamojo.com/webhook/',
					'send_sms' => true,
					'email' => Auth::User()->email,
					'allow_repeated_payments' => false
				);
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
				$response = curl_exec($ch);
				$err = curl_error($ch);
				
				curl_close($ch); 

				if ($err) {
					Session::put('error','Payment Failed, Try Again!!');
					return redirect()->back();
				} else {
					$data = json_decode($response);
				}
				if($data->success == true) {					
					return redirect($data->payment_request->longurl);
				} else { 
					Session::put('error','Payment Failed, Try Again!!');
					return redirect()->back();
				}			
			} 	
		}
		else {
			return redirect()->back()->withErrors(array('login-error' => 'Please Login'));
		}
	}
	
	public function returnurl(Request $request,$orderid)
    {
		$request_data = $request->all();
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/api/1.1/payments/'.$request->get('payment_id'));
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER,
           array("X-Api-Key:test_f55c9ef20d1969390114f344d32",
					"X-Auth-Token:test_48976b2055413ae25c9eb1a2b29"));
		
        $response = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch); 
	
        if ($err) {
            Session::put('error','Payment Failed, Try Again!!');
            $cart_count = Cart::where('user_id', Auth::User()->id)->count();
			
			return view('order_completed')
			->with('cart_count', $cart_count);
        } else {
            $data = json_decode($response);			
        }
        
        if($data->success == true) {
            if($data->payment->status == 'Credit') {
				$obj_order = Order::find($orderid);
				
				$obj_order->transaction_status = 1;
				$obj_order->payment_mode = 0;
				$obj_order->payment_method = $data->payment->instrument_type;
				$obj_order->transaction_id = $data->payment->payment_id;
				$obj_order->transaction_date = $data->payment->created_at;
								
				$obj_order->save();
				
				$obj_carts = DB::table('cart')->where('user_id', '=', Auth::User()->id)->get();

				$product = Product::where ('status',1)->get()->keyBy('id');
				$total = 0;
				$order_details_array = array();
				$product_original_quantity_array = array();
				$product_change_quantity_array = array();
				$product_ids = array();
				foreach($obj_carts as $obj_cart)
				{
					$obj_order_details = new OrderDetail();
					$obj_order_details->cart_id = $obj_cart->id;
					$obj_order_details->product_id = $obj_cart->product_id;
					$trackingNumber = random_int(100000, 999999);
					$obj_order_details->tracking_id = $trackingNumber;
					$obj_order_details->tracking_status = 0;
					$obj_order_details->order_status = 0;
					$product_quantity = $obj_cart->product_quantity;
					$obj_order_details->product_quantity = $product_quantity;
					$obj_order_details->unit_price = $product[$obj_cart->product_id]->price;
					$obj_order_details->reorder_level = $product[$obj_cart->product_id]->reorder_level;
					$product_amount = $product_quantity * $product[$obj_cart->product_id]->price;
					$obj_order_details->product_amount = $product_amount;
					$obj_order_details->total = $product_amount;
					$obj_order_details->discount = 0;
					$product_ids[] = $obj_cart->product_id;
					$product_original_quantity_array[$obj_cart->product_id] = $product[$obj_cart->product_id]->quantity;
					if(isset($product_change_quantity_array[$obj_cart->product_id])) {
						$product_quantity = $product_quantity + $product_change_quantity_array[$obj_cart->product_id];
					}
					$product_change_quantity_array[$obj_cart->product_id] = $product_quantity;
					$total = $total + $product_amount;
					$order_details_array[] = $obj_order_details;					
				}
				
				$this->order_service->addOrderDetails($obj_order->id, $order_details_array);
				
				// delete entries from cart
				$cart_product = DB::table('cart')->where('user_id', Auth::User()->id)->delete();
					
				// Deduct product quantity
				foreach($product_change_quantity_array as $product_id => $quantity)
				{
					$product = Product::find($product_id);
					$product->quantity = $product_original_quantity_array[$product_id] - $quantity;	
					$product->save();
				}
				
				// From here you can save respose data in database from $data	
				Session::put('success','Your payment has been pay successfully, Enjoy!!');
				$states = State::orderBy('id')->get();
				$cities = City::orderBy('id')->get();
				$cart_count = Cart::where('user_id', Auth::User()->id)->count();
				
				return view('order_completed')
				->with('states', $states)
				->with('cities', $cities)
				->with('cart_count', $cart_count);				
            } else {
				$obj_order = Order::find($orderid);					
				$obj_order->transaction_status = 2;
				$obj_order->payment_mode = 0;
				$obj_order->payment_method = $data->payment->instrument_type;
				//$obj_order->payment_failure_reason = $data->payment->failure;
				$obj_order->transaction_id = $data->payment->payment_id;
				$obj_order->transaction_date = $data->payment->created_at;
				
				$obj_order->save();
			
				// delete entries from cart
				$cart_product = DB::table('cart')->where('user_id', Auth::User()->id)->delete();		

                $states = State::orderBy('id')->get();
				$cities = City::orderBy('id')->get();
				$cart_count = Cart::where('user_id', Auth::User()->id)->count();
				
				Session::put('error','Payment Failed, Try Again!!'); 
				
				return view('order_completed')
				->with('states', $states)
				->with('cities', $cities)
				->with('cart_count', $cart_count);
            }
        } else {
			$obj_order = Order::find($orderid);					
			$obj_order->transaction_status = 2;
			$obj_order->payment_mode = 0;
			$obj_order->payment_method = $data->payment->instrument_type;
			$obj_order->payment_failure_reason = $data->payment->failure;
			$obj_order->transaction_id = $data->payment->payment_id;
			$obj_order->transaction_date = $data->payment->created_at;
			
			$obj_order->save();
		
			// delete entries from cart
			$cart_product = DB::table('cart')->where('user_id', Auth::User()->id)->delete();
				
	
			
            $states = State::orderBy('id')->get();
			$cities = City::orderBy('id')->get();
			$cart_count = Cart::where('user_id', Auth::User()->id)->count();
			
			Session::put('error','Payment Failed, Try Again!!');
			return view('order_completed')
			->with('states', $states)
			->with('cities', $cities)
			->with('cart_count', $cart_count);
        }
    }
	
	public function getMyOrder()
	{		
		
		$orders = DB::table('order_details')
			->leftjoin('order', 'order.id', '=', 'order_details.order_id')
			->leftjoin('product', 'product.id', '=', 'order_details.product_id')
			->leftjoin('user', 'user.id', '=', 'order.user_id')
			->select('order_details.*','user.*','order.*','product.*', 'user.name as user_name', 'product.name as product_name','order.created_at as order_date','order_details.updated_at as delivery_date','order_details.id as order_details_id')	
			->where('order.user_id', Auth::User()->id)
			->orWhere('order.transaction_status', 2)		
			->groupBy('order_details.id')
			->get();
		//dd($orders);
		
		$states = State::orderBy('id')->get();
		$cities = City::orderBy('id')->get();
		$cart_count = Cart::where('user_id', Auth::User()->id)->count();
		
		return view('user.myorder')
		->with('orders', $orders)
		->with('states', $states)
		->with('cities', $cities)
		->with('cart_count', $cart_count);
	}
	
	public function getMyOrderDetails(Request $request)
	{		
			
		$request_data = $request->all();
		$order_details = DB::table('order_details')
		->leftjoin('order', 'order.id', '=', 'order_details.order_id')
		->leftjoin('product', 'product.id', '=', 'order_details.product_id')
		->leftjoin('user', 'user.id', '=', 'order.user_id')
		->leftjoin('city', 'city.id', '=', 'order.shipping_city_id')
		->leftjoin('state', 'state.id', '=', 'order.shipping_state_id')
		//->leftjoin('state', 'state.id', '=', 'order.billing_state_id')
		//->leftjoin('city', 'state.id', '=', 'order.billing_city_id')
			->select('order_details.*','user.*','order.*','product.*','city.*','state.*', 'user.name as user_name', 'product.name as product_name','order.created_at as order_date','city.name as city_name','state.name as state_name','order_details.updated_at as delivery_date','order_details.id as order_details_id')			
			->where('order_details.id', $request_data['order-details-id'])			
			->get();
		
		//dd($order_details);
		
		$states = State::orderBy('id')->get();
		$cities = City::orderBy('id')->get();
		$cart_count = Cart::where('user_id', Auth::User()->id)->count();
		
		return view('user.my_order_details')
		->with('order_details', $order_details)
		->with('states', $states)
		->with('cities', $cities)
		->with('cart_count', $cart_count);
	}
	
	public function getInvoice(Request $request)
	{		
			
		$request_data = $request->all();
		$order_details = DB::table('order_details')
		->leftjoin('order', 'order.id', '=', 'order_details.order_id')
		->leftjoin('product', 'product.id', '=', 'order_details.product_id')
		->leftjoin('user', 'user.id', '=', 'order.user_id')
		->leftjoin('city', 'city.id', '=', 'order.shipping_city_id')
		->leftjoin('state', 'state.id', '=', 'order.shipping_state_id')
		//->leftjoin('state', 'state.id', '=', 'order.billing_state_id')
		//->leftjoin('city', 'state.id', '=', 'order.billing_city_id')
			->select('order_details.*','user.*','order.*','product.*','city.*','state.*', 'user.name as user_name', 'product.name as product_name','order.created_at as order_date','city.name as city_name','state.name as state_name','order_details.updated_at as delivery_date')			
			->where('order_details.id', $request_data['order-details-id'])			
			->get();
		
		//dd($order_details);
		
		$states = State::orderBy('id')->get();
		$cities = City::orderBy('id')->get();
		$cart_count = Cart::where('user_id', Auth::User()->id)->count();
		
		/*return view('user.invoice')
		->with('order_details', $order_details)
		->with('states', $states)
		->with('cities', $cities)
		->with('cart_count', $cart_count);*/
		 
		$data = [
			'order_details'  => $order_details,
			'states'   => $states,
			'cities' => $cities,
			'cart_count' => $cart_count
		];

		$pdf_doc = PDF::loadView('user.invoice', $data);

        return $pdf_doc->download('invoice.pdf');
	}
	
	public function getOrders()
	{
		$orders = DB::table('order')
		->join('order_details', 'order.id', '=', 'order_details.order_id')
		->join('user', 'user.id', '=', 'order.user_id')
		->join('product', 'product.id', '=', 'order_details.product_id')
		->select('product.*','user.*','order.*','order_details.*', 'product.name as product_name')
		->groupBy('order.id')			
		->get();
		
		return view('admin.vieworder')
		->with('orders', $orders);
	}
	
	public function getTrackingOrders()
	{
		$tracking_orders = DB::table('order_details')
		->leftjoin('order', 'order.id', '=', 'order_details.order_id')
		->leftjoin('product', 'product.id', '=', 'order_details.product_id')
		->leftjoin('user', 'user.id', '=', 'order.user_id')
		->select('order_details.*','user.*','order.*','product.*', 'user.name as user_name', 'product.name as product_name','order.created_at as order_date','order_details.id as order_details_id')				
		->groupBy('order_details.id')
		->get();
		//dd($tracking_orders);
		return view('admin.view_tracking_order')
		->with('tracking_orders', $tracking_orders);
	}
	
	public function getTrackingorderDetails(Request $request)
	{
		if(Auth::check() && Auth::User()->user_type == 0)
		{			
			$request_data = $request->all();
			$tracking_order_details = DB::table('order')				
            ->leftjoin('order_details', 'order.id', '=', 'order_details.order_id')
            ->leftjoin('product', 'product.id', '=', 'order_details.product_id')
			->leftjoin('user', 'user.id', '=', 'order.user_id')
				->select('order_details.*','user.*','order.*','product.*', 'user.name as user_name', 'product.name as product_name','order.created_at as order_date','order_details.id as order_details_id')
				->where('order_details.tracking_id', $request_data['tracking-id'])
            ->get();
			//dd($tracking_order_details);
			
			return view('admin.order_tracking')
			->with('tracking_order_details', $tracking_order_details);
		}
		else
		{
			return redirect()->to('/');
		}
	} 
	
	//Update Tracking Status
	public function postUpdateTrackingStatus(Request $request)
	{
		if(Auth::check() && Auth::User()->user_type == 0)
		{	
			$request_data = $request->all();
			$tracking_status=  $request_data['tracking_msg'];
			$order_details_id=  $request_data['order_details_id'];
			
			$tracking_order_details = OrderDetails::find($order_details_id);
		
			$tracking_order_details->tracking_status = $tracking_status;
				
			$tracking_order_details->save();
			
			return redirect()->back()->with('success', 'Tracking status updated successfully');
		}
		else
		{
			return redirect()->to('/');
		}
	}
	
	//Update Order Status
	public function postUpdateOrderStatus(Request $request)
	{
		if(Auth::check() && Auth::User()->user_type == 0)
		{	
			$request_data = $request->all();
			$order_status=  $request_data['order_msg'];
			$order_details_id=  $request_data['order_details_id'];
			
			$tracking_order_details = OrderDetails::find($order_details_id);
		
			$tracking_order_details->order_status = $order_status;
				
			$tracking_order_details->save();
			
			return redirect()->back()->with('success', 'Order status updated successfully');
		}
		else
		{
			return redirect()->to('/');
		}
	}
	
	public function getOrderDetails(Request $request)
	{
		if(Auth::check() && Auth::User()->user_type == 0)
		{			
			$request_data = $request->all();
			$order_details = DB::table('order')				
            ->leftjoin('order_details', 'order.id', '=', 'order_details.order_id')
            ->leftjoin('product', 'product.id', '=', 'order_details.product_id')
			->leftjoin('user', 'user.id', '=', 'order.user_id')
				->select('order_details.*','user.*','order.*','product.*', 'user.name as user_name', 'product.name as product_name','order.created_at as order_date')
				->where('order_details.order_id', $request_data['order-id'])
            ->get();
			//dd($order_details);
			
			return view('admin.view_order_details')
			->with('order_details', $order_details);
		}
		else
		{
			return redirect()->to('/');
		}
	} 
}
	class ProductOrder{};
	class OrderDetail{};
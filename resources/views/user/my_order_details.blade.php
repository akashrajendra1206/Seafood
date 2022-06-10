@extends('header.header')
@section('content')
	
<section class="section" id="chefs">
        <div class="container">
			<div class="row">
				<div class="col-12">
					@if(Session::has('success'))
					<div class="alert alert-success alert-dismissable alert-box">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					  {{ Session::get('success') }}
					</div>
					@endif
					@if(Session::has('error'))
					<div class="alert alert-danger alert-dismissable alert-box">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					  {{ Session::get('error') }}	
					</div>
					@endif
				</div>	
			</div>
			
            <div class=" text-center">
				<div class="section-heading">
					<h3>Order Details</h3> 
					<hr>
				</div>
            </div>
           
			@if(count($order_details) > 0)
			<div class="row my-order-details">
				@foreach($order_details as $order_detail)	
				<div class="col-lg-12">
					Order ID :#{{ $order_detail->order_id }} &nbsp;&nbsp;Placed on  {{ date('d M, Y', strtotime($order_detail->order_date)) }}</br>
				</div>
				<div class="col-lg-12">
					<div class="card bg-light border-dark mb-3">					
						<div class="card-body " id="paymentinfo">
							<div class="row ">
								<div class="col-lg-4 col-sm-4 col-4">
									<span>Customer Information </span>									
								</div>
								<div class="col-lg-4 col-sm-3 col-3">
									<span>Payment Method</span>						
								</div>																																					
								<div class="col-lg-2 col-sm-3 col-3">
									<span>Quantity:</span>									
								</div>
								<div class="col-lg-2 col-sm-2 col-2">
									<span>{{ $order_detail->product_quantity }}</span>
								</div>					
							</div>		
							<div class="row ">
								<div class="col-lg-4 col-sm-4 col-4">
									<span>Name: {{ $order_detail->user_name }}</span>									
								</div>
								<div class="col-lg-4 col-sm-3 col-3 ">
									@if($order_detail->payment_mode == 0)								
										<span> Online </span>							
									@else
										<span> Cash On Delivery </span>
									@endif
								</div>																																					
								<div class="col-lg-2 col-sm-3 col-3 ">
									<span>Unit Price:</span>									
								</div>
								<div class="col-lg-2 col-sm-2 col-2 ">
									<b><i class="fa fa-inr" aria-hidden="true"></i>&nbsp;<span>{{ $order_detail->unit_price }}</span><br></b>									
								</div>					
							</div>		
							<div class="row ">
								<div class="col-lg-4 col-sm-4 col-4">
																	
								</div>
								<div class="col-lg-4 col-sm-3 col-3 ">
											
								</div>																																					
								<div class="col-lg-2 col-sm-3 col-3 ">
									<span>Delivery Charges:</span>									
								</div>
								<div class="col-lg-2 col-sm-2 col-2 ">
									<b><span>Free</b>									
								</div>					
							</div>		
							<div class="row ">
								<div class="col-lg-4 col-sm-4 col-4">
																	
								</div>
								<div class="col-lg-4 col-sm-3 col-3 ">
											
								</div>																																					
								<div class="col-lg-3 col-sm-5 col-5 ">
									<hr>								
								</div>												
							</div>	
							<div class="row ">
								<div class="col-lg-4 col-sm-4 col-4">
																	
								</div>
								<div class="col-lg-4 col-sm-3 col-3">
											
								</div>																																					
								<div class="col-lg-2 col-sm-3 col-3">
									<span><b>Payble Amount:</b></span>									
								</div>
								<div class="col-lg-2 col-sm-2 col-2">
									<b><i class="fa fa-inr" aria-hidden="true"></i>&nbsp;<span>{{ $order_detail->total }}</span></b>									
								</div>					
							</div>								
						</div>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="card border-dark mb-3" >									
						<div class="card-body text-dark">
							<div class="row">
								<div class="col-lg-4 col-12">
									<img class="order-img" src="/uploads/{{ $order_detail->display_image }}"></img>
								</div>
								<div class="col-lg-8 col-12 ">
									<div class="row">
										<div class="col-lg-12 col-12">
											<h4 id="order-product-name">{{ $order_detail->product_name }}</h4>
											<h6 id="order-product-name">{{ $order_detail->description }}</h6>
										</div>										
									</div>
										
								</div>
							</div>
							<div class="row status-delivered">
								<div class="col-lg-6 col-sm-6 col-6">
									@if($order_detail->tracking_status == 0)								
										<span>Status: Order Placed</span>
									@elseif($order_detail->tracking_status == 1)
										<span >Status: Confirmed</span>
									@elseif($order_detail->tracking_status == 2)
										<span >Status: Packed</span>
									@elseif($order_detail->tracking_status == 3)
										<span >Status: Shipped</span>
									@elseif($order_detail->tracking_status == 4)
										<span >Status: On the way</span>
									@else
										<span>Status: Delivered</span>
									@endif				
								</div>
							</div>
							<div class="row ">
								<div class="col-lg-12">
									<hr style=" color:grey; border-top: dotted 1px;" />
								</div>									
							</div>
							<div class="row ">
								<div class="col-lg-12">
									@if($order_detail->tracking_status == 0)
										@include('steps.order_placed')
									@elseif($order_detail->tracking_status == 1)
										@include('steps.order_confirmed')
									@elseif($order_detail->tracking_status == 2)
										@include('steps.order_packed')
									@elseif($order_detail->tracking_status == 3)
										@include('steps.order_shipped')
									@elseif($order_detail->tracking_status == 4)
										@include('steps.order_on_the_way')
									@else
										@include('steps.order_delivered')
									@endif
									
								</div>
							</div>			
							<div class="row ">
								<div class="col-lg-6">									
									<div class="card bg-light mb-3">					
										<div class="card-body">
											<div class="row">													
												<div class="col-lg-12">
													<b>SHIPPING INFORMATION</b></br>
													{{ $order_detail->user_name }}<br>
													{{ $order_detail->shipping_address }}<br>
													{{ $order_detail->city_name }}<br>
													{{ $order_detail->state_name }}-
													{{ $order_detail->shipping_pincode }}<br><br>
													Mobile No: {{ $order_detail->shipping_contact }}
												</div>																		
											</div>					
										</div>
									</div>									
								</div>	
								<div class="col-lg-6">									
									<div class="card bg-light mb-3">					
										<div class="card-body">
											<div class="row">													
												<div class="col-lg-12 ">
													<b>BILLING INFORMATION</b></br>
													{{ $order_detail->user_name }}<br>
													{{ $order_detail->billing_address }}<br>
													{{ $order_detail->city_name }}<br>
													{{ $order_detail->state_name }}-
													{{ $order_detail->billing_pincode }}<br><br>
													Mobile No: {{ $order_detail->billing_contact }}
												</div>																		
											</div>					
										</div>
									</div>									
								</div>									
							</div>
						</div>
					</div>
				</div>
				@endforeach
			</div>
			@endif
        </div>
    </section>
		

	<script>
		$(function(){
			
		});
	</script>
	

@endsection

	


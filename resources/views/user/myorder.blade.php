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
					<h3>My Order</h3> 
					<hr>
				</div>
			</div>
			
			<div class="row myorder">
				@if(count($orders) > 0)
				<div class="col-lg-12 col-sm-12">
					@foreach($orders as $order)	
					<div class="card border-dark mb-3" >
						<div class="card-header">
							<div class="row">
								<input type="hidden" name="tracking_status" id="tracking_status" value="{{ $order->tracking_status }}"> 														 																	
								<div class="col-lg-3 col-sm-3 col-12">
									<span> Order ID :#{{ $order->order_id }} (1 Item)	</span>									
								</div>
								<div class="col-lg-3 col-sm-3 col-12">
									<span>	Placed On {{ date('d M, Y', strtotime($order->order_date)) }}</span>											
								</div>
								<div class="col-lg-4 col-sm-4 col-12 estimated-delivery">
									<span>	 Estimated Delivery {{ date('d M', strtotime($order->order_date)) }} - {{ date('d M, Y', strtotime($order->order_date. ' + 7 days')) }}	</span>										
								</div>
								<div class="col-lg-2 col-sm-2 col-2 text-right btn-order-details">										
									<a href="/orderdetails?order-details-id={{ $order->order_details_id }}"><button type="button" class="btn btn-danger mt-3"> Details</button></a>
								</div>
							</div>								
						</div>
						<div class="card-body text-dark">
							<div class="row">
								<div class="col-lg-4 col-12">
									<img class="order-img" src="/uploads/{{ $order->display_image }}"></img>
								</div>
								<div class="col-lg-8 col-12 ">
									<div class="row">
										<div class="col-lg-12 col-12">
											<h4 id="order-product-name">{{ $order->product_name }}</h4>
											<h6 id="order-product-name">{{ $order->description }}</h6>
										</div>	
										<div class="row invoice-need-help">
										<div class="col-lg-4 col-6">																						
											<a href="/order/invoice?order-details-id={{ $order->order_details_id }}">
												<button type="button" id="btn-invoice" class="btn btn-outline-danger">Invoice</button>
											</a>
										</div>									
									</div>	
									</div>
								</div>
							</div>
						
							<div class="row status-delivered">
								<div class="col-lg-6 col-sm-6 col-6">
									@if($order->tracking_status == 0)								
										<span>Status: Order Placed</span>
									@elseif($order->tracking_status == 1)
										<span >Status: Confirmed</span>
									@elseif($order->tracking_status == 2)
										<span >Status: Packed</span>
									@elseif($order->tracking_status == 3)
										<span >Status: Shipped</span>
									@elseif($order->tracking_status == 4)
										<span >Status: On the way</span>
									@else
										<span>Status: Delivered</span>
									@endif				
								</div>
								<div class="col-lg-6 col-sm-6 col-6 delivered">
									@if($order->tracking_status == 0)								
										<span> Estimated Delivery on: {{ date('d M, Y', strtotime($order->order_date. ' + 7 days')) }} </span>
									@elseif($order->tracking_status == 1)
										<span> Estimated Delivery on: {{ date('d M, Y', strtotime($order->order_date. ' + 7 days')) }} </span>
									@elseif($order->tracking_status == 2)
										<span> Estimated Delivery on: {{ date('d M, Y', strtotime($order->order_date. ' + 7 days')) }} </span>
									@elseif($order->tracking_status == 3)
										<span> Estimated Delivery on: {{ date('d M, Y', strtotime($order->order_date. ' + 7 days')) }} </span>
									@elseif($order->tracking_status == 4)
										<span> Estimated Delivery on: {{ date('d M, Y', strtotime($order->order_date. ' + 7 days')) }} </span>
									@else
										<span> Delivered: {{ date('d M, Y', strtotime($order->delivery_date)) }} </span>
									@endif											
								</div>
							</div>
							<div class="row ">
								<div class="col-lg-12">
									<hr style=" color:grey; border-top: dotted 1px;" />
								</div>									
							</div>
							<div class="row ">
								<div  class="col-lg-12">
									@if($order->tracking_status == 0)
										@include('steps.order_placed')
									@elseif($order->tracking_status == 1)
										@include('steps.order_confirmed')
									@elseif($order->tracking_status == 2)
										@include('steps.order_packed')
									@elseif($order->tracking_status == 3)
										@include('steps.order_shipped')
									@elseif($order->tracking_status == 4)
										@include('steps.order_on_the_way')
									@else
										@include('steps.order_delivered')
									@endif
									
								</div>
							</div>
															
						</div>
					</div>
					@endforeach		
				</div>
				@else
					<div class="col-lg-12 text-center">					
						<span >Your order is empty<span>
					</div>
				@endif	
			</div>				
        </div>
    </section>
		
	<script>
		$(window).on('load', function() {
			var tracking_status = $("#tracking_status").val();
			console.log(tracking_status);
			if(tracking_status == 0)
			{
				$('#order-placed').addClass('active');
			}
		});
	</script>
	
	

@endsection
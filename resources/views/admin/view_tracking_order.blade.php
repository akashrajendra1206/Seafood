@extends('header.Admin_header')
@section('content')
	<!--main content start-->
    <section id="main-content">
		<section class="wrapper">
			<div class="row">
			  <div class="col-lg-12">
				<h3 class="page-header"><i class="fa fa-files-o"></i>Tracking Details</h3>
				<ol class="breadcrumb">
				  <li><i class="fa fa-home"></i><a href="/admin-dashboard">Home</a></li>
				  <li><i class="fa fa-table"></i>Order</li>
				  <li><i class="fa fa-th-list"></i>View Tracking Order</li>
				</ol>
			  </div>
			</div>
				<div class="row">
					<div class="col-lg-12 grid-margin stretch-card">
						<section class="panel">
							<header class="panel-heading">
								<b><h3>View Tracking Order</h3></b>
							</header>
								<div class="container-fluid">
									<div class="col-lg-12">
										@if( $tracking_orders->count()>0)
										<div class="card">			
											<div class="card-body">
												<div class="table-responsive">						
													<table id="example" class="table table-striped table-bordered" style="width:100%">
														<thead align="center">
															<tr>
																<th>Sr.No.</th>
																<th>Order ID</th>																				
																<th>Tracking ID</th>
																<th>Customer Name</th>																				
																<th>Phone</th>
																<th>Tracking Status</th>										
																<th>Order Status</th>										
																<th width="10%" class="text-center">View</th>
																<th width="10%" class="text-center">Proceed</th>
															</tr>
														</thead>
														<tbody>
															<?php $i = 1; ?>
															@foreach($tracking_orders as $order)
															<tr>
																<td class="text-center">{{ $i++ }}</td>
																<td># {{ $order->order_id }}</td>																																									
																<td>{{ $order->tracking_id }}</td>
																<td>{{ $order->user_name }}</td>	
																<td>{{ $order->shipping_contact}}</td>
																@if($order->tracking_status == 0)								
																	<td>No status updated</td>
																@elseif($order->tracking_status == 1)
																	<td >Confirmed</td>
																@elseif($order->tracking_status == 2)
																	<td >Packed</td>
																@elseif($order->tracking_status == 3)
																	<td >Shipped</td>
																@elseif($order->tracking_status == 4)
																	<td >On the way</td>
																@else
																	<td>Delivered</td>
																@endif				
																@if($order->order_status == 0)								
																	<td><span style="background-color:orange; color:white; padding:2px;">Pending</span></td>
																@elseif($order->order_status == 1)
																	<td ><span style="background-color:green; color:white; padding:2px;">Completed</span></td>
																@else
																	<td><span style="background-color:red; color:white; padding:2px;">Canceled</span></td>
																@endif									
																<td width="10%" class="text-center">
																	<a href="/order/view_order_details?order-id={{ $order->order_id }}" type="button" class="btn btn-primary">View</a>
																</td>   
																<td width="10%" class="text-center">
																	<a href="/order/order_tracking?tracking-id={{ $order->tracking_id }}" type="button" class="btn btn-primary">Proceed</a>
																</td>    										
															</tr>
															@endforeach
														</tbody>
													</table>							
												</div>
											</div>					
										</div>				
										@else
										<div class="empty-message">
											<div>
												<span>Tracking order details is empty<span>
											</div>
										</div>					
										@endif							
									</div>
								</div>
						</section>
					</div>
				</div>
		</section>
	</section>
	@endsection
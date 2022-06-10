@extends('header.admin_header')
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
				  <li><i class="fa fa-th-list"></i> Tracking Order</li>
				</ol>
			  </div>
			</div>
				<div class="row">
					<div class="col-lg-12 grid-margin stretch-card">
						<section class="panel">
							<header class="panel-heading">
								<b><h3> Tracking Order</h3></b>
							</header>
							<section class="forms product-container">
								<div class="container-fluid">
									<div class="card-body">	
										<div class="card-header track-header">
											<div class="row">
												<div class="col-md-4 col-4">
													<span id="order">Order Details : </span>
												</div> 
												<div class="col-md-8 col-8 " id="tracking-id">
													<input type="hidden" name="tracking_status" id="tracking_status" value="{{ $tracking_order_details[0]->tracking_status }}"> 														 										
													<span style="background-color:#146418; color:white; padding:5px;" >Tracking ID - {{ $tracking_order_details[0]->tracking_id }}</span>
												</div>
											</div>
										</div>	
										<div class="table-responsive">						
											<table id="example" class="table table-striped table-bordered" style="width:100%">
												<thead align="center">										
													<tr>
														<th>Tracking Status</th>
														<th>Order Status</th>
														<th>Payment Method</th>
														<th>Payment Status</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														@if($tracking_order_details[0]->tracking_status == 0)								
															<td>No status updated</td>
														@elseif($tracking_order_details[0]->tracking_status == 1)
															<td >Confirmed</td>
														@elseif($tracking_order_details[0]->tracking_status == 2)
															<td >Packed</td>
														@elseif($tracking_order_details[0]->tracking_status == 3)
															<td >Shipped</td>
														@elseif($tracking_order_details[0]->tracking_status == 4)
															<td >On the way</td>
														@else
															<td>Delivered</td>
														@endif
														 
														 
														@if($tracking_order_details[0]->order_status == 0)								
															<td>Pending</td>
														@elseif($tracking_order_details[0]->order_status == 1)
															<td>Completed</td>
														@else
															<td>Canceled</td>
														@endif
														 
														 
														@if($tracking_order_details[0]->payment_mode == 0)								
															<td>Online</td>							
														@else
															<td>Cash On Delivery</td>
														@endif
														
													 
														@if($tracking_order_details[0]->transaction_status == 0)								
															<td>Pending</td>
														@elseif($tracking_order_details[0]->transaction_status == 1)
															<td>Completed</td>
														@else
															<td>Failed</td>
														@endif
													</tr>
												</tbody>
											</table>
										</div>
									</div>
										
									<div class="row">
										<div class="col-md-6 col-12 ">
											<div class="card">	
												<div class="card-header track-header">
													<div class="row">
														<div class="col-md-12 col-12">
															<span id="tracking_status">Tracking Status Update</span>
														</div> 									
													</div>
												</div>
												<form id="form-tracking-status" role="form" method="POST" action="/order/update-tracking-status"> 
													<input type="hidden" name="_token" value="{{ csrf_token() }}"> 										
													<input type="hidden" name="tracking_id" value="{{ $tracking_order_details[0]->tracking_id }}"> 														 							
													<input type="hidden" name="order_details_id" value="{{ $tracking_order_details[0]->order_details_id }}"> 														 							
													<div class="card-body">	
														<div class="row">										
															@if($tracking_order_details[0]->order_status == 1)
																<div class="col-md-12 col-12 text-center">
																	@if($tracking_order_details[0]->tracking_status == 0)								
																		<span>No status updated</span>
																	@elseif($tracking_order_details[0]->tracking_status == 1)
																		<span >Confirmed</span>
																	@elseif($tracking_order_details[0]->tracking_status == 2)
																		<span >Packed</span>
																	@elseif($tracking_order_details[0]->tracking_status == 3)
																		<span >Shipped</span>
																	@elseif($tracking_order_details[0]->tracking_status == 4)
																		<span >On the way</span>
																	@else
																		<span>Delivered</span>
																	@endif	
																</div>
															@elseif($tracking_order_details[0]->order_status == 2)
																<div class="col-md-12 col-12 text-center">
																	@if($tracking_order_details[0]->tracking_status == 0)								
																		<span>No status updated</span>
																	@elseif($tracking_order_details[0]->tracking_status == 1)
																		<span >Confirmed</span>
																	@elseif($tracking_order_details[0]->tracking_status == 2)
																		<span >Packed</span>
																	@elseif($tracking_order_details[0]->tracking_status == 3)
																		<span >Shipped</span>
																	@elseif($tracking_order_details[0]->tracking_status == 4)
																		<span >On the way</span>
																	@else
																		<span>Delivered</span>
																	@endif	
																</div>
															@else									
																@if($tracking_order_details[0]->tracking_status == "5")
																	<div class="col-md-12 col-12 text-center">																				
																		<span >Delivered</span>
																	</div>
																@else
																	<div class="col-md-8 col-8">									
																		<select name="tracking_msg" id="tracking_msg" class="custom-select">
																			<option value="">-- Select --</option>
																			<option value="1"  {{ $tracking_order_details[0]->tracking_status == "1" ? 'selected' : '' }}>Confirmed</option>
																			<option value="2" {{ $tracking_order_details[0]->tracking_status == "2" ? 'selected' : '' }}>Packed</option>
																			<option value="3" {{ $tracking_order_details[0]->tracking_status == "3" ? 'selected' : '' }}>Shipped</option>
																			<option value="4" {{ $tracking_order_details[0]->tracking_status == "4" ? 'selected' : '' }}>On the way</option>
																			<option value="5" {{ $tracking_order_details[0]->tracking_status == "5" ? 'selected' : '' }}>Delivered</option>		
																		</select>																		
																	</div> 		
																	<div class="col-md-4 col-4">
																		<button type="submit" id="update" class="btn btn-primary">Update</button>
																	</div>
																@endif
															@endif	
														</div>
													</div>
												</form>
											</div>
										</div>
										
										<div class="col-md-6 col-12 ">
											<div class="card">	
												<div class="card-header track-header">
													<div class="row">
														<div class="col-md-12 col-12">
															<span id="order_status">Order Status Update</span>
														</div> 									
													</div>
												</div>	
												<form id="form-order-status" role="form" method="POST" action="/order/update-order-status"> 
													<input type="hidden" name="_token" value="{{ csrf_token() }}"> 
													<input type="hidden" name="tracking_id" value="{{ $tracking_order_details[0]->tracking_id }}"> 														 							
													<input type="hidden" name="order_details_id" value="{{ $tracking_order_details[0]->order_details_id }}"> 														 																						
													<div class="card-body">												
														<div class="row">
															@if($tracking_order_details[0]->order_status == "1" || $tracking_order_details[0]->order_status == "2")
																<div class="col-md-12 col-12 text-center">																				
																	@if($tracking_order_details[0]->order_status == 0)								
																		<span>Pending</span>
																	@elseif($tracking_order_details[0]->order_status == 1)
																		<span>Completed</span>
																	@else
																		<span>Canceled</span>
																	@endif
																</div>
															@else
																<div class="col-md-8 col-8">
																	<select name="order_msg" id="order_msg" class="custom-select">
																		<option value="">-- Select --</option>
																		<option value="0">Pending</option>
																		<option value="1">Completed</option>
																		<option value="2">Canceled</option>											
																	</select>
																</div> 		
																<div class="col-md-4 col-4">
																	<button type="submit" id="update" class="btn btn-primary">Update</button>
																</div> 	
															@endif
														</div>								
													</div>
												</form>
											</div>
										</div>
									</div>							
								</div>	
							</section>
						</section>
					</div>
				</div>
		</section>
	</section>
	<script>
		$(window).on('load', function() {
			 var tracking_status = $("#tracking_status").val();
			 
			 if(tracking_status == 0)
			 {				 
				$("#tracking_msg").children('option[value^="2"]').hide();
				$("#tracking_msg").children('option[value^="3"]').hide();
				$("#tracking_msg").children('option[value^="4"]').hide();
				$("#tracking_msg").children('option[value^="5"]').hide();
				$("#order_msg").children('option[value^="0"]').show();			
				$("#order_msg").children('option[value^="1"]').hide();			
				$("#order_msg").children('option[value^="2"]').show();					
			 } 
			 if(tracking_status == 1)
			 {				 
				$("#tracking_msg").children('option[value^="1"]').hide();
				$("#tracking_msg").children('option[value^="2"]').show();
				$("#tracking_msg").children('option[value^="3"]').show();
				$("#tracking_msg").children('option[value^="4"]').show();
				$("#tracking_msg").children('option[value^="5"]').show();
				$("#order_msg").children('option[value^="0"]').show();			
				$("#order_msg").children('option[value^="1"]').hide();			
				$("#order_msg").children('option[value^="2"]').show();				
			 }
			 else if(tracking_status == 2)
			 {			  
				$("#tracking_msg").children('option[value^="1"]').hide();
				$("#tracking_msg").children('option[value^="2"]').hide();
				$("#tracking_msg").children('option[value^="3"]').show();
				$("#tracking_msg").children('option[value^="4"]').show();
				$("#tracking_msg").children('option[value^="5"]').show();
				$("#order_msg").children('option[value^="0"]').show();			
				$("#order_msg").children('option[value^="1"]').hide();			
				$("#order_msg").children('option[value^="2"]').show();				
			 } 
			 else if(tracking_status == 3)
			 {			  
				$("#tracking_msg").children('option[value^="1"]').hide();
				$("#tracking_msg").children('option[value^="2"]').hide();
				$("#tracking_msg").children('option[value^="3"]').hide();
				$("#tracking_msg").children('option[value^="4"]').show();
				$("#tracking_msg").children('option[value^="5"]').show();
				$("#order_msg").children('option[value^="0"]').show();			
				$("#order_msg").children('option[value^="1"]').hide();			
				$("#order_msg").children('option[value^="2"]').show();				
			 }
			 else if(tracking_status == 4)
			 {			 
				$("#tracking_msg").children('option[value^="1"]').hide();
				$("#tracking_msg").children('option[value^="2"]').hide();
				$("#tracking_msg").children('option[value^="3"]').hide();
				$("#tracking_msg").children('option[value^="4"]').hide();
				$("#tracking_msg").children('option[value^="5"]').show();
				$("#order_msg").children('option[value^="0"]').show();			
				$("#order_msg").children('option[value^="1"]').hide();			
				$("#order_msg").children('option[value^="2"]').show();				
			 }else{
				$("#order_msg").children('option[value^="0"]').hide();			
				$("#order_msg").children('option[value^="1"]').show();			
				$("#order_msg").children('option[value^="2"]').hide();	
			 }
		});
		
	</script>
	
@endsection
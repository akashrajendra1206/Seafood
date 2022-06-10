<html>
	<head>
		
		<title>Seafood Shop</title>
		<!--
			
		TemplateMo 558 Klassy Cafe

		https://templatemo.com/tm-558-klassy-cafe

		-->
		<!-- Additional CSS Files -->
		<link rel="stylesheet" type="text/css" href="{{ asset('/user/css/bootstrap.min.css') }}">

		<link rel="stylesheet" type="text/css" href="{{ asset('/user/css/font-awesome.css') }}">

		<!-- jQuery -->
		<script src="{{ asset('/user/js/jquery-2.1.0.min.js') }}"></script>
		<style type="text/css">
			.my-invoice {
				margin-top: 30px;
			}
			
			.invoice-header .card-header {
				height: 110px;
				background-color: #1ba8c2;				
			}
			
			.table-heading {
				margin: 20px;
			}

			.table-heading td, .table-heading th {
				padding: 3px;
				vertical-align: bottom;
				border-top: 0px solid #dee2e6;
				color: white;				
			}
			
			.text-invoice{
				font-size: 30px;
				font-weight: bold;				
			}
			
			.text-td{
				font-size: 10px;					
			}
			
			.table-address td, .table-address th {
				padding: 5px;
				vertical-align: bottom;
				border-top: 0px solid #dee2e6;
				font-size: 10px;
			}
			
			.table-address {
				margin: 20px;
			}
			
			.my-invoice hr {
				border-top: 3px solid #1ba8c2!important;
			}
			
			td.td_total {
				text-align: right;				
				font-weight: 700;
			}
			
			.my-invoice dl, .my-invoice ol,  .my-invoice ul {				
				margin-bottom: 0PX;
			}
			
			.order-info .table {
				font-size: 12px;
			}
		
		</style>
	</head>
	<body>
		<section class="section" id="chefs">
			<div class="container my-invoice">
				@if(count($order_details) > 0)
					@foreach($order_details as $order_detail)	
						<div class="row invoice-header">
							<div class="col-lg-12 col-12">
								<div class="card border-light mb-3">
									<div class="card-header">
										<div class="row">
											<table class="table table-heading">											
												<tbody>
													<tr>														
														<td  rowspan="3" ><span class="text-invoice " >INVOICE</span></td>
														<td class="text-td" >+91 8275353923	</td>
														<td class="text-td text-padding" >Seafood Shop</td>
														
													</tr>															
													<tr>												
														<td class="text-td" >seafoodshop@gmail.com	</td>
														<td class="text-td text-padding" >457 sai apartment jamsande, devgad</td>
													</tr>	
													<tr>														
														<td class="text-td" >www.electronicsshop.com	</td>
														<td class="text-td text-padding" >Pin - 416612</td>
													</tr>																																				
												</tbody>
											</table>
										</div>
									</div>						
								</div>
							</div>
						</div>
						<div class="row invoice-address">						
							<table class="table table-address">											
								<tbody>
									<tr>																				
										<td><strong><span>Billed To:</span></strong>	</td>
										<td><strong><span>Shipped To:</span></strong></td>
										<td ><span><strong>Invoice No. :  </strong># {{ $order_detail->order_id }}</span></td>
									</tr>
									<tr>																				
										<td><span>{{ $order_detail->user_name }}</span></td>
										<td><span>{{ $order_detail->user_name }}</span></td>
										<td> </td>
									</tr>
									<tr>																				
										<td><span>{{ $order_detail->billing_address }}</span></td>
										<td><span>{{ $order_detail->shipping_address }}</span></td>
										<td><span><strong>Order No. :  </strong># {{ $order_detail->order_id }}</span></td>
									</tr>
									<tr>																				
										<td><span>{{ $order_detail->city_name }}</span></td>
										<td><span>{{ $order_detail->city_name }}</span></td>
										<td> </td>
									</tr>
									<tr>																				
										<td ><span>{{ $order_detail->state_name }}-
											{{ $order_detail->billing_pincode }}</span></td>
										<td><span>{{ $order_detail->state_name }}-
											{{ $order_detail->shipping_pincode }}</span>
										</td>
										<td><span><strong>Due Date. :  </strong></span></td>									
									</tr>	
									<tr>																				
										<td> </td>
										<td> </td>
										<td>{{ date('d M, Y', strtotime($order_detail->order_date)) }} </td>
									</tr>	
									<tr>																				
										<td><span>Mobile No: {{ $order_detail->billing_contact }}</span></td>
										<td><span>Mobile No: {{ $order_detail->shipping_contact }}	</span>	
										</td>
									</tr>																																																												
								</tbody>
							</table>
						</div>
						<div class="row">						
							<div class="col-lg-12 col-12">
								<hr>
							</div>
						</div>
						<div class="row order-info">						
							<div class="col-lg-12 col-12">
								<table class="table">
								  <thead>
									<tr>
										<th >Sr.No.</th>
										<th >Product Name</th>										
										<th >Unit Price</th>
										<th >Quantity</th>
										<th >Product Amount</th>								
									</tr>
								  </thead>
								  <tbody>
										<tr>
											<td >1</td>
											<td >{{ $order_detail->product_name }}</td>																
											<td ><i class="fa fa-inr" aria-hidden="true"></i> {{ $order_detail->unit_price }}</td>											
											<td >{{ $order_detail->product_quantity }}</td>
											<td ><i class="fa fa-inr" aria-hidden="true"></i> {{ $order_detail->product_amount }}</td>																											
										</tr>																							
										<tr>											
											<td colspan="4" class="td_total">Total</td>
											<td ><strong> <i class="fa fa-inr" aria-hidden="true"></i> {{ $order_detail->total }}</strong></td>	
										</tr>
								  </tbody>
								</table>
							</div>
						</div>
						<div class="row">						
							<div class="col-lg-12 col-12">
								<hr>
							</div>
						</div>
						<div class="row">						
							<div class="col-lg-12 col-12">
								<table class="table table-address">											
									<tbody>
										<tr>														
											<td><strong>REMINDERS : </strong></td>											
										</tr>
										
										<tr>														
											<td>
												<ul>
													<li>Kindly review the autoresponder email that you recieve to make sure that the order is correct</li>
												</ul> 
											</td>											
										</tr>
										<tr>														
											<td>
												<ul>
													<li>These supplies will be delevered using boxes</li>
												</ul> 
											</td>											
										</tr>
										<tr>														
											<td>
												<ul>
													<li>If you have any questions, please contact us +91 9765211381 or email us at suraj@gmail.com</li>
												</ul> 
											</td>											
										</tr>																																																										
									</tbody>
								</table>
							</div>
						</div>
					@endforeach
				@endif
			</div>
		</section>
		    
		<!-- Bootstrap -->
		<script src="{{ asset('/user/js/popper.js') }}"></script>
		<script src="{{ asset('/user/js/bootstrap.min.js') }}"></script>

		<script>
			$(function(){
				
			});
		</script>
	</body>
</html>

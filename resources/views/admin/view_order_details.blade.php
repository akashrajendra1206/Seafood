@extends('header.admin_header')
@section('content')
	<!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-files-o"></i>Order Details</h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="/admin-dashboard">Home</a></li>
              <li><i class="fa fa-table"></i>Order</li>
              <li><i class="fa fa-th-list"></i>View Order</li>
            </ol>
          </div>
        </div>
        <!-- Form validations -->
		<div class="row">
			<div class="col-lg-12">
				<section class="panel">
					<header class="panel-heading">
					<b><h3>View Order Details</h3></b>
					</header>
					<div class="panel-body">
						<form id="form-add-product" role="form" method="POST" action="{{ url('/order/edit') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="card">
							<div class="card-body">
								<div class="row">
									<div class="col-md-6">
										<h5>Order ID- {{ $order_details[0]->order_id }}</h5>
									</div>
									<div class="col-md-6 text-right">
										<h5>Order Date- {{ date('d/m/Y', strtotime($order_details[0]->order_date)) }}</h5>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<h5>Order Status- 
											@if($order_details[0]->order_status == 0)								
												Initiated
											@elseif($order_details[0]->order_status == 1)
												Completed
											@else
												Pending
											@endif
										</h5>
									</div>
									<div class="col-md-6 text-right">
										<h5>Transaction ID- {{ $order_details[0]->transaction_id }}</h5>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<h5>Customer Name- {{ $order_details[0]->user_name }}</h5>
									</div>
									<div class="col-md-6 text-right">
										<h5>Transaction Status- 
											@if($order_details[0]->transaction_status == 0)								
												Initiated
											@elseif($order_details[0]->transaction_status == 1)
												Completed
											@else
												Pending
											@endif
										</h5>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12 text-center">
										<div class="table-responsive">
											@if( $order_details->count()>0)
											<table id="example" class="table table-striped table-bordered" style="width:100%">
												<thead align="center">
													<tr>
														<th>Sr.No.</th>
														<th>Product Name</th>										
														<th>Unit Price</th>
														<th>Quantity</th>
														<th>Product Amount</th>
														<th>Total Amount</th>
													</tr>
												</thead>
												<tbody>
													<?php $i = 1; ?>
													@foreach($order_details as $order_detail)
													<tr>
														<td class="text-center">{{ $i++ }}</td>
														<td width="300px">{{ $order_detail->product_name }}</td>																
														<td><i class="fa fa-inr" aria-hidden="true"></i> {{ $order_detail->unit_price }}</td>											
														<td>{{ $order_detail->product_quantity }}</td>
														<td><i class="fa fa-inr" aria-hidden="true"></i> {{ $order_detail->product_amount }}</td>
														<td><i class="fa fa-inr" aria-hidden="true"></i> {{ $order_detail->total }}</td>																		
													</tr>										
													@endforeach	
													<tr>											
														<td colspan="5" class="td_total">Total</td>
														<td><i class="fa fa-inr" aria-hidden="true"></i> {{ $order_detail->total_amount }}</td>	
													</tr>
												</tbody>									
											</table>
											@endif
										</div>
									</div>
								</div>
							</div>
						</div>
					</form>
					</div>	
				</section>
			</div>
		</div>
	  </section>
	</section>
		
	
	<script>
	
	</script>
	

  @endsection
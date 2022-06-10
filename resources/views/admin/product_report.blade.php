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
              <li><i class="fa fa-table"></i>Report</li>
              <li><i class="fa fa-th-list"></i>Product Report</li>
            </ol>
          </div>
        </div>
        <!-- Form validations -->
		<div class="row">
			<div class="col-lg-12">
				<section class="panel">
					<header class="panel-heading">
					<b><h3>View Product Report</h3></b>
					</header>
					<div class="panel-body">
						<div class="card">
							<div class="card-body">
								<div class="row">
									<div class="col-md-12 text-center">
										<div class="table-responsive">
											@if( $order_details->count()>0)
											<table id="example" class="table table-striped table-bordered" style="width:100%">
												<thead align="center">
													<tr>
														<th>Sr.No.</th>								
														<th>Product Name</th>									
														<th>Quantity</th>
														<th>Order Date</th>
														<th>Unit Price</th>
														<th>Total Amount</th>
													</tr>
												</thead>
												<tbody>
													<?php $i = 1; ?>
													@foreach($order_details as $order_detail)
													<tr>
														<td class="text-center">{{ $i++ }}</td>																										
														<td width="300px">{{ $order_detail->product_name }}</td>																										
														<td>{{ $order_detail->product_quantity }}</td>
														<td>{{ date('d/m/Y', strtotime($order_detail->transaction_date)) }}</td>
														<td><i class="fa fa-inr" aria-hidden="true"></i> {{ $order_detail->unit_price }}</td>	
														<td><i class="fa fa-inr" aria-hidden="true"></i> {{ $order_detail->total }}</td>																		
													</tr>										
													@endforeach	
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
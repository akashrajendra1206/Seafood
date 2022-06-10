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
        
		  <!-- Breadcrumb-->
		<div class="row">
			<div class="col-lg-12 grid-margin stretch-card">
				<section class="panel">
					<header class="panel-heading">
					<b><h3>View Order</h3></b>
					</header>
					@if( $orders->count()>0)			
						<div class="card-body">
							<div class="table-responsive">						
								<table id="example" class="table table-striped table-bordered" style="width:100%">
									<thead align="center">
										<tr>
											<th>Sr.No.</th>
											<th>Order ID</th>																				
											<th>Order Amount</th>
											<th>Order Shipped To</th>																				
											<th>Order Date</th>
											<th>Order Status</th>										
											<th width="10%" class="text-center">View</th>
										</tr>
									</thead>
									<tbody>
										<?php $i = 1; ?>
										@foreach($orders as $order)
										<tr>
											<td class="text-center">{{ $i++ }}</td>
											<td>{{ $order->order_id }}</td>																																									
											<td>{{ $order->total_amount }}</td>
											<td width="200px">{{ $order->name }}</td>	
											<td>{{ date('d/m/Y', strtotime($order->created_at)) }}</td>
											@if($order->order_status == 0)								
												<td><span style="background-color:orange; color:white; padding:2px;">Initiated</span></td>
											@elseif($order->order_status == 1)
												<td ><span style="background-color:green; color:white; padding:2px;">Completed</span></td>
											@else
												<td><span style="background-color:red; color:white; padding:2px;">Pending</span></td>
											@endif									
											<td width="10%" class="text-center">
												<a href="/order/view_order_details?order-id={{ $order->order_id }}" type="button" class="btn btn-primary">View</a>
											</td>    										
										</tr>
										@endforeach
									</tbody>
								</table>							
							</div>
						</div>								
						@else
						<div class="empty-message">
							<div>
								<span>Order details is empty<span>
							</div>
						</div>					
						@endif	
				</section>
			</div>		
		</div>		
	   </section>
	</section>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#example').DataTable();
		} );
	</script>
   
 


  @endsection
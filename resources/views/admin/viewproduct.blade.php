@extends('header.admin_header')
@section('content')

    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-files-o"></i>Product Details</h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="/admin-dashboard">Home</a></li>
              <li><i class="fa fa-table"></i>Product</li>
              <li><i class="fa fa-th-list"></i>View Product</li>
            </ol>
          </div>
        </div>
        <!-- Form validations -->
        <div class="row">
			<div class="col-lg-12 grid-margin stretch-card">
				<section class="panel">
					<header class="panel-heading">
					<b><h3>View Product</h3></b>
					</header>
						<div class="panel-body">
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
							
							<div class="table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th scope="col">No.</th>
										<th scope="col">Product Name</th>
										<th scope="col">Price</th>
										<th scope="col">Description</th>
										<th scope="col">Quantity</th>
										<th scope="col">Edit</th>
									</tr>
								</thead>
								
								<tbody>
									<?php $i = 1; ?>
									@foreach($product as $products)
									<tr>
										<td class="text-center">{{ $i++ }}</td>
										<td>{{ $products->name }}</td>									
										<td>{{ $products->price }}</td>									
										<td>{{ $products->description }}</td>									
										<td>{{ $products->quantity }}</td>																		
										<td width="10%" class="text-center">
										<a href="/product/edit?product-id={{ $products->id }}" type="button" class="btn btn-primary">Edit</a>
										</td>             
									</tr>
									@endforeach	
								</tbody>
							</table>
							</div>
						</div>
				</section>
			</div>
		</div>
       <!-- End row>
        <!-- page end-->
      </section>
    </section>
    <!--main content end-->
   
  </section>
  <!-- container section end -->

  @endsection
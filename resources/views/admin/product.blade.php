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
            </ol>
          </div>
        </div>
        <!-- Form validations -->
        <div class="row">
			<div class="col-lg-12 ">
				<section class="panel">
					<header class="panel-heading no-border">
					<b><h3>View Product</h3></b>
					</header>
						
						<div class="table-responsive">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th scope="col">No.</th>
										<th scope="col">Product Name</th>
										<th scope="col">Price</th>
										<th scope="col">Description</th>
										<th scope="col">Quantity</th>
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
									</tr>
									@endforeach	
								</tbody>
							</table>
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

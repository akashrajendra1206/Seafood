@extends('header.admin_header')
@section('content')

    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-files-o"></i>User Details</h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="/admin-dashboard">Home</a></li>
              <li><i class="fa fa-address-book-o" aria-hidden="true"></i>Contacts</li>
              <li><i class="fa fa-address-book-o" aria-hidden="true"></i>User Contact</li>
            </ol>
          </div>
        </div>
        <!-- Form validations -->
        <div class="row">
			<div class="col-lg-12 grid-margin stretch-card">
				<section class="panel">
					<header class="panel-heading">
					<b><h3>User Details</h3></b>
					</header>
						<div class="panel-body"> 
							<div class="table-responsive">
							<table class="table text-center">
								<thead>
									<tr>
										<th scope="col">No.</th>
										<th scope="col">User Name</th>
										<th scope="col">Email ID</th>
										<th scope="col">Password</th>
										<th scope="col">contact Number</th>
										<th scope="col">address</th>
									</tr>
								</thead>
								
								<tbody>
									<?php $i = 1; ?>
									@foreach($user as $users)
									<tr>
										<td class="text-center">{{ $i++ }}</td>
										<td>{{ $users->name }}</td>																										
										<td>{{ $users->email }}</td>																		            
										<td>{{ $users->password }}</td>																		            
										<td>{{ $users->contact_number }}</td>																		            
										<td>{{ $users->address }}</td>																		            
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
@extends('header.admin_header')
@section('content')

    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-files-o"></i>Contact Details</h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="/admin-dashboard">Home</a></li>
              <li><i class="fa fa-address-book-o" aria-hidden="true"></i>Contact Us</li>
            </ol>
          </div>
        </div>
        <!-- Form validations -->
        <div class="row">
			<div class="col-lg-12 grid-margin stretch-card">
				<section class="panel">
					<header class="panel-heading">
					<b><h3>Contact Us</h3></b>
					</header>
						<div class="panel-body"> 
							<div class="table-responsive">
							<table class="table text-center">
								<thead>
									<tr>
										<th scope="col">No.</th>
										<th scope="col">First Name</th>
										<th scope="col">Last Name</th>
										<th scope="col">Phone Number</th>
										<th scope="col">Email ID</th>
										<th scope="col">Message</th>
										<th scope="col">Message Date</th>
									</tr>
								</thead>
								
								<tbody>
									<?php $i = 1; ?>
									@foreach($contact_us as $contact)
									<tr>
										<td class="text-center">{{ $i++ }}</td>
										<td>{{ $contact->first_name }}</td>									
										<td>{{ $contact->last_name }}</td>									
										<td>{{ $contact->phone_number }}</td>									
										<td>{{ $contact->email }}</td>																		            
										<td>{{ $contact->message }}</td>																		            
										<td>{{ $contact->updated_at }}</td>																		            
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

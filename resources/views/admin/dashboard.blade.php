	@extends('header.admin_header')
@section('content')
 

    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <!--overview start-->
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-laptop"></i> Dashboard</h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="/">Home</a></li>
              <li><i class="fa fa-laptop"></i>Dashboard</li>
            </ol>
          </div>
        </div>
		<div class="row">
				<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
					<div class="info-box blue-bg">
                        <i class="fa fa-cubes"></i>
						@if (Auth::check())
						<a class="nav-link" href="/users/userinfo"><span class="badge badge-light">{{ $user_count }}</span></a>
						@endif
						<div class="title" ><a id="ucount" href="/users/userinfo">Total Users</a></div>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
					<div class="info-box brown-bg">
						<i class="fa fa-cubes"></i>
						@if (Auth::check())
						<a class="nav-link" href="/admin/contact"><span class="badge badge-light">{{ $contact_count }}</span></a>
						@endif
						<div class="title" ><a id="ucount" href="/admin/contact">Total Feedback</a></div>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
					<div class="info-box dark-bg">
						<i class="fa fa-thumbs-o-up"></i>
						@if (Auth::check())
						<a class="nav-link" href="/order/view"><span class="badge badge-light">{{ $order_count }}</span></a>
						@endif
						<div class="title" ><a id="ucount" href="/order/view">Order</a></div>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
					<div class="info-box green-bg">
						<i class="fa fa-shopping-cart"></i>
						@if (Auth::check())
						<a class="nav-link" href="/report/product"><span class="badge badge-light">{{ $product_count }}</span></a>
						@endif
						<div class="title" ><a id="ucount" href="/report/product">Product</a></div>
					</div>
				 </div>
			</div>
		</section>
	</section>

        
        <!--/.row-->
                      
@endsection
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
  <meta name="author" content="GeeksLabs">
  <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
  <meta name="csrf_token" content="{{csrf_token()}}">
  <link rel="shortcut icon" href="{{ asset('/admin/img/favicon.png') }}">

  <title>Admin Seafood</title>


  <!-- Bootstrap CSS -->
  <link href="{{ asset('/admin/css/bootstrap.min.css') }}" rel="stylesheet">
  <!-- bootstrap theme -->
  <link href="{{ asset('/admin/css/bootstrap-theme.css') }}" rel="stylesheet">
  <!--external css-->
  <!-- font icon -->
  <link href="{{ asset('/admin/css/elegant-icons-style.css') }}" rel="stylesheet" />
  <link href="{{ asset('/admin/css/font-awesome.min.css') }}" rel="stylesheet" />
  <!-- full calendar css-->
  <link href="{{ asset('/admin/assets/fullcalendar/fullcalendar/bootstrap-fullcalendar.css') }}" rel="stylesheet" />
  <link href="{{ asset('/admin/assets/fullcalendar/fullcalendar/fullcalendar.css') }}" rel="stylesheet" />
  <!-- easy pie chart-->
  <link href="{{ asset('/admin/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css') }}" rel="stylesheet" type="text/css" media="screen" />
  <!-- owl carousel -->
  <link rel="stylesheet" href="{{ asset('/admin/css/owl.carousel.css') }}" type="text/css">
  <link href="{{ asset('/admin/css/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet">
  <!-- Custom styles -->
  <link rel="stylesheet" href="{{ asset('/admin/css/fullcalendar.css') }}">
  <link href="{{ asset('/admin/css/widgets.css') }}" rel="stylesheet">
  <link href="{{ asset('/admin/css/style.css') }}" rel="stylesheet">
  <link href="{{ asset('/admin/css/style-responsive.css') }}" rel="stylesheet" />
  <link href="{{ asset('/admin/css/xcharts.min.css') }}" rel=" stylesheet">
  <link href="{{ asset('/admin/css/jquery-ui-1.10.4.min.css') }}" rel="stylesheet">
  <link href="{{ asset('/admin/css/adminstyle.css') }}" rel="stylesheet">
  <link href="{{ asset('/admin/css/mystyle.css') }}" rel="stylesheet">
  
  
  <link rel="stylesheet" href="{{ asset('/admin/css/mystyle.css') }}">
  <script src="{{ asset('/admin/js/jquery.js') }}"></script>
	<script src="{{ asset('/admin/js/jquery-ui-1.10.4.min.js') }}"></script>
	<script src="{{ asset('/admin/js/jquery-1.8.3.min.js') }}"></script>
  <!-- =======================================================
    Theme Name: NiceAdmin
    Theme URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
    Author: BootstrapMade
    Author URL: https://bootstrapmade.com
  ======================================================= -->
</head>

<body>
  <!-- container section start -->
  <section id="container" class="">
	<header class="header dark-bg">
      <div class="toggle-nav">
        <div class="icon-reorder tooltips" data-original-title="Menu" data-placement="bottom"><i class="icon_menu"></i></div>
      </div>

      <!--logo start-->
      <a href="/" class="logo"><img src="{{ asset('/admin/img/logo.png ') }}" class="logo" /></a>
      <!--logo end-->
	  <div class="nav search-row" id="top_menu">
      </div>

      <div class="top-nav notification-row">
        <!-- notificatoin dropdown start-->
        <ul class="nav pull-right top-menu">
		<!-- user login dropdown start-->
          <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <span class="profile-ava">
                    <img alt="" src="{{ asset('/admin/img/avatar1_small.jpg') }}">
                </span>
                <span class="username">LOGOUT</span>
                     <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
              <div class="log-arrow-up"></div>            
              <li>
                <a href="/user/logout"><i class="icon_key_alt"></i> LogOut</a>
              </li>
            </ul>
		  </li>
          <!-- user login dropdown end -->
        </ul>
        <!-- notificatoin dropdown end-->
      </div>
    </header>
    <!--header end-->
	
	<!--sidebar start-->
    <aside>
		<div id="sidebar" class="nav-collapse ">
			<!-- sidebar menu start-->
			<ul class="sidebar-menu">
				<li class="active">
					<a class="" href="/admin-dashboard">
						<i class="icon_house_alt"></i>
						<span>Dashboard</span>
					</a>
				</li>
				<li class="sub-menu">
					<a href="javascript:;" class="">
						<i class="icon_document_alt"></i>
						<span>Product</span>
						<span class="menu-arrow arrow_carrot-right"></span>
					</a>
					<ul class="sub">
					  <li><a class="" href="/admin/addproduct">Add Product</a></li>
					  <li><a class="" href="/product/viewproduct">View Product</a></li>
					</ul>
				</li>
				<li class="sub-menu">
					<a href="javascript:;" class="">
						<i class="icon_document_alt"></i>
						<span>Order</span>
						<span class="menu-arrow arrow_carrot-right"></span>
					</a>
					<ul class="sub">
					  <li><a class="" href="/order/view">View order</a></li>
					  <li><a class="" href="/order/view_tracking_order">Tracking order</a></li>
					</ul>
				</li>
				<li class="sub-menu">
					<a href="javascript:;" class="">
						<i class="icon_document_alt"></i>
						<span>Report</span>
						<span class="menu-arrow arrow_carrot-right"></span>
					</a>
					<ul class="sub">
					  <li><a class="" href="/admin/contact">Message Report</a></li>
					  <li><a class="" href="/users/userinfo">User Report</a></li>
					  <li><a class="" href="/report/order">Product Report</a></li>
					</ul>
					
				</li>
				
			</ul>
        </div> 
    </aside>
    <!--sidebar end-->

   @yield('content')
    <!--main content end-->
  </section>
  <!-- container section start -->

  <!-- javascripts -->
  <script src="{{ asset('/admin/js/jquery.js') }}"></script>
  <script src="{{ asset('/admin/js/jquery-ui-1.10.4.min.js') }}"></script>
  <script src="{{ asset('/admin/js/jquery-1.8.3.min.jsv') }}"></script>
  <script type="text/javascript" src="{{ asset('/admin/js/jquery-ui-1.9.2.custom.min.js') }}"></script>
  <!-- bootstrap -->
  <script src="{{ asset('/admin/js/bootstrap.min.js') }}"></script>
  <!-- nice scroll -->
  <script src="{{ asset('/admin/js/jquery.scrollTo.min.js') }}"></script>
  <script src="{{ asset('/admin/js/jquery.nicescroll.js') }}" type="text/javascript"></script>
  <!-- charts scripts -->
  <script src="{{ asset('/admin/assets/jquery-knob/js/jquery.knob.js') }}"></script>
  <script src="{{ asset('/admin/js/jquery.sparkline.js') }}" type="text/javascript"></script>
  <script src="{{ asset('/admin/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js') }}"></script>
  <script src="{{ asset('/admin/js/owl.carousel.js') }}"></script>
  <!-- jQuery full calendar -->
  <script src="{{ asset('/admin/js/fullcalendar.min.js') }}"></script>
    <!-- Full Google Calendar - Calendar -->
    <script src="{{ asset('/admin/assets/fullcalendar/fullcalendar/fullcalendar.js') }}"></script>
    <!--script for this page only-->
    <script src="{{ asset('/admin/js/calendar-custom.js') }}"></script>
    <script src="{{ asset('/admin/js/jquery.rateit.min.js') }}"></script>
    <!-- custom select -->
    <script src="{{ asset('/admin/js/jquery.customSelect.min.js') }}"></script>
    <script src="{{ asset('/admin/assets/chart-master/Chart.js') }}"></script>

    <!--custome script for all page-->
    <script src="{{ asset('/admin/js/scripts.js') }}"></script>
    <!-- custom script for this page-->
    <script src="{{ asset('/admin/js/sparkline-chart.js') }}"></script>
    <script src="{{ asset('/admin/js/easy-pie-chart.js') }}"></script>
    <script src="{{ asset('/admin/js/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('/admin/js/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ asset('/admin/js/xcharts.min.js') }}"></script>
    <script src="{{ asset('/admin/js/jquery.autosize.min.js') }}"></script>
    <script src="{{ asset('/admin/js/jquery.placeholder.min.js') }}"></script>
    <script src="{{ asset('/admin/js/gdp-data.js') }}"></script>
    <script src="{{ asset('/admin/js/morris.min.js') }}"></script>
    <script src="{{ asset('/admin/js/sparklines.js') }}"></script>
    <script src="{{ asset('/admin/js/charts.js') }}"></script>
    <script src="{{ asset('/admin/js/jquery.slimscroll.min.js') }}"></script>
    

</body>

</html>

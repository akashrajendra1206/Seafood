@extends('header.header')
@section('content')
	<div class="row">
		<div class="col-12">
			
		</div>	
	</div>
	<!-- Slider -->
	<div class="order-status" >
		<div class="row ">
			<div class="col-md-12 col-sm-12 text-center content-status">
				@if($message = Session::get('error'))
					<strong>{{ $message }}</strong> 
				@endif
				{!! Session::forget('error') !!}
				@if($message = Session::get('success'))
					<strong>{{ $message }}</strong> Please <a href="/my-order">click here </a> to check order
				@endif
				{!! Session::forget('success') !!}
			</div>
		</div>			
	</div> 	
	<!--  End Slider -->	
@endsection
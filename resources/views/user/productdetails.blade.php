@extends('header.header')
@section('content')
	
	<!-- single product -->
	<div class="single-product mt-150 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-12">
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
				</div>	
			</div>
			<form id="form-add-to-cart" role="form" method="GET" action="/cart/add">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="hidden" name="user-id" value="<?php if(Auth::check()){echo Auth::User()->id;} ?>">	
				<input type="hidden" name="product-id" value="{{ $product->id }}">
					<div class="container">
						<div class="card">
							<div class="container-fliud">
								<div class="wrapper row">
									<div class="preview col-md-6">
										<div id="carouselProductIndicators" class="carousel slide" data-ride="carousel">
										  <ol class="carousel-indicators">
											@foreach($product_images as $id => $product_image)
												<li data-target="#carouselProductIndicators" data-slide-to="{{$id}}" class="{{$id == 0 ? 'active' : '' }}"></li>									
											@endforeach		
										  </ol>
										  <div class="carousel-inner">
											
											@foreach($product_images as $id => $product_image)
												<div class="carousel-item {{$id == 0 ? 'active' : '' }}">
												  <img class="d-block w-100" src="/uploads/{{ $product_image }}" alt="First slide">
												</div>
											@endforeach	
										  </div>
										</div>
									</div>
									<div class="details col-md-6">
										<h3 class="product-title">{{ $product->name }}</h3>
										<p class="product-description">{{ $product->description }}</p>
										<p class="single-product-pricing"><span>Price:</span> <span id="total-price" name="total-price">Rs. {{ $product->price }}</span></p>
										<div class="single-product-form">
											<input type="number" id="quantity" placeholder="Enter product quantity" name="quantity" min="1" value="1">
											<input type="hidden" id="price" name="price" value="{{ $product->price}}">
											<input type="hidden" id="amount" name="amount" value="{{ $product->price}}">
											<input type="submit" value="Add To Cart"/>	
										</div>	
									</div>
								</div>
							</div>
						</div>
					</div>
			</form>
		</div>
	</div>

    <script>
		$(function(){
			$('.carousel-inner .carousel-item:first').addClass('active');
			$('.carousel-indicators li:first').addClass('active');
			
			$(document).on('change', '#quantity', function(ev) {
				ev.preventDefault();	
				var quantity = $(this).val();
				var price = parseFloat($('#price').val());
			
				if(quantity != ''){
					
					var total = quantity * price;
					$('#total-price').html('Rs. &nbsp; '+ total);
					$('#amount').val(total);
				}else {
					$('#total-price').html('Rs. &nbsp; 0');
					$('#amount').val('0');
					
				}
			}); 
		});
		
	</script>

@endsection
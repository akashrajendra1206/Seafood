@extends('header.header')
@section('content')
	<!-- products -->
	<div class="product-section mt-150 mb-150">
		<div class="container card bg-light ">
			<div class="row">
				<div class="col-12">
					@if($message = Session::get('error'))
					<div class="alert alert-danger alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
						<strong>Error Alert!</strong> {{ $message }}
					</div>
					@endif
					{!! Session::forget('error') !!}
					@if($message = Session::get('success'))
					<div class="alert alert-success alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
						<strong>Success Alert!</strong> {{ $message }}
					</div>
					@endif
					{!! Session::forget('success') !!}
				</div>	
			</div>
				<div class="text-center">
				<b><h2>SHIPPING ADDRESS</h2></b>
				</div>
				<form id="form-buy-now" role="form" method="POST" action="/order/add"> 
					<input type="hidden" name="_token" value="{{ csrf_token() }}"> 
					<div class="row justify-content-center">
						<div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-8">
							<div class="form-group">
								<label for="shipping-address">Address</label>
								<textarea class="form-control" id="shipping-address" placeholder="Address" name="shipping-address"value="{{ Auth::User()->address }}">{{ Auth::User()->address }}</textarea>
								<span class="error-font text-danger">{{ $errors->first('shipping-address')}}</span>
							</div>
						</div>
					</div>				
					<div class="row justify-content-center">
						<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
							<div class="form-group">
								<label for="shipping-locality">Locality</label>
								<input type="text" class="form-control" id="shipping-locality" placeholder="Locality" name="shipping-locality" value="{{ old('shipping_locality') }}">
								<span class="error-font text-danger">{{ $errors->first('shipping-locality')}}</span>
							</div>
						</div>
						<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
							<div class="form-group">
								<label for="shipping-area">Area</label>
								<input type="text" class="form-control" id="shipping-area" placeholder="Area" name="shipping-area" value="{{ old('shipping-area') }}">
								<span class="error-font text-danger">{{ $errors->first('shipping-area')}}</span>
							</div>
						</div>
					</div>	
					<div class="row justify-content-center">
						<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
							<div class="form-group">
								<label for="city">State</label>
								<select class="form-control" id="shipping-state" name="shipping-state">
									@foreach($states as $state)
										@if(old('state') == $state->id)
											<option value="{{$state->id}}" selected>{{$state->name}}</option>
										@else
											<option value="{{$state->id}}" <?php if( $state->id == Auth::User()->state_id){echo "selected";} ?>>{{$state->name}}</option>
										@endif
									@endforeach
								</select>
								<span class="error-font text-danger">{{ $errors->first('shipping-state')}}</span>
							</div>
						</div>
						<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
							<div class="form-group">
								<label for="city">City</label>
								<select class="form-control" id="shipping-city" name="shipping-city">
									@foreach($cities as $city)
										@if(old('city') == $city->id)
											<option value="{{$city->id}}" selected>{{$city->name}}</option>
										@else
											<option value="{{$city->id}}" <?php if( $city->id == Auth::User()->city_id){echo "selected";} ?>>{{$city->name}}</option>
										@endif
									@endforeach
								</select>
								<span class="error-font text-danger">{{ $errors->first('shipping-city')}}</span>
							</div>
						</div>
					</div>
					<div class="row justify-content-center">
						<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
							<div class="form-group">
								<label for="shipping-contact">Contact</label>
								<input type="text" class="form-control" id="shipping-contact" placeholder="Contact" name="shipping-contact" value="{{ Auth::User()->contact_number }}">
								<span class="error-font text-danger">{{ $errors->first('shipping-contact')}}</span>
							</div>
						</div>
						<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
							<div class="form-group">
								<label for="shipping-pincode">Pincode</label>
								<input type="text" class="form-control" id="shipping-pincode" placeholder="Pincode" name="shipping-pincode" value="{{ old('shipping-pincode') }}">
								<span class="error-font text-danger">{{ $errors->first('shipping-pincode')}}</span>
							</div>
						</div>
					</div>	
					<div class="row justify-content-center">
						<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4 billing-address-title">
							<h4>BILLING ADDRESS</h4>
						</div>
						<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4 same-as-address">
							<label><input type="checkbox" id="same-as-address" name="same-as-address" value="true">&nbsp;&nbsp;&nbsp;Same as shipping address</label><br>
							<span class="error-font text-danger">{{ $errors->first('same-as-address')}}</span>
						</div>
					</div>
					<div class="billing-address">
						<div class="row justify-content-center">
							<div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-8">
								<div class="form-group">
									<label for="billing-address">Address</label>
									<textarea class="form-control" placeholder="Address" id="billing-address" name="billing-address" value="{{ old('billing-address') }}"></textarea>
									<span class="error-font text-danger">{{ $errors->first('billing-address')}}</span>
								</div>
							</div>
						</div>
						<div class="row justify-content-center">
							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
								<div class="form-group">
									<label for="billing-locality">Locality</label>
									<input type="text" class="form-control" id="billing-locality" placeholder="Locality" name="billing-locality" value="{{ old('billing-locality') }}">
									<span class="error-font text-danger">{{ $errors->first('billing-locality')}}</span>
								</div>
							</div>
							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
								<div class="form-group">
									<label for="billing-area">Area</label>
									<input type="text" class="form-control" id="billing-area" placeholder="Area" name="billing-area" value="{{ old('billing-area') }}">
									<span class="error-font text-danger">{{ $errors->first('billing-area')}}</span>
								</div>
							</div>
						</div>	
						<div class="row justify-content-center">
							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
								<div class="form-group">
									<label for="city">State</label>
									<select class="form-control" id="billing-state" name="billing-state">
										@foreach($states as $state)
											@if(old('state') == $state->id)
												<option value="{{$state->id}}" selected>{{$state->name}}</option>
											@else
												<option value="{{$state->id}}" <?php if( $state->id == Auth::User()->state_id){echo "selected";} ?>>{{$state->name}}</option>
											@endif
										@endforeach
									</select>
									<span class="error-font text-danger">{{ $errors->first('billing-state')}}</span>
								</div>
							</div>
							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
								<div class="form-group">
									<label for="city">City</label>
									<select class="form-control" id="billing-city" name="billing-city">
										@foreach($cities as $city)
											@if(old('city') == $city->id)
												<option value="{{$city->id}}" selected>{{$city->name}}</option>
											@else
												<option value="{{$city->id}}" <?php if( $city->id == Auth::User()->city_id){echo "selected";} ?>>{{$city->name}}</option>
											@endif
										@endforeach
									</select>
									<span class="error-font text-danger">{{ $errors->first('billing-city')}}</span>
								</div>
							</div>
						</div>
						<div class="row justify-content-center">
							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
								<div class="form-group">
									<label for="billing-contact">Contact</label>
									<input type="text" class="form-control" id="billing-contact" placeholder="Contact" name="billing-contact" value="{{ old('billing-contact') }}">
									<span class="error-font text-danger">{{ $errors->first('billing-contact')}}</span>
								</div>
							</div>
							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
								<div class="form-group">
									<label for="billing-pincode">Pincode</label>
									<input type="text" class="form-control" id="billing-pincode" placeholder="Pincode" name="billing-pincode" value="{{ old('billing-pincode') }}">
									<span class="error-font text-danger">{{ $errors->first('billing-pincode')}}</span>
								</div>
							</div>
						</div>						
					</div>
					<div class="row">
						<div class="col-md-12 text-center">
							<a href="/cart" class="boxed-btn black">Back</a>
							<input  type="submit" value="Buy Now"/>
						</div>
					</div>
				</form>
		
		</div>
	</div>

	<!-- end products -->
	
	<script>
    $(function() {  
		$("#shipping-state").on("change", function() {
			var stateId = $(this).val();
			$.ajax({
				url: "/user/cities?state-id="+stateId,
				type: "GET",
				success: function(response) {
					var cities = response.cities;
					console.log(cities);
					var options = "";
					for(var i = 0; i < cities.length; i++) {
						options += '<option value="'+cities[i].id+'">'+cities[i].name+'</option>'
					}
					$("#shipping-city").html(options);
				},
				error: function(err) {
					console.log(err)
				}
			}); 
		});
		
		$("#billing-state").on("change", function() {
			var stateId = $(this).val();
			$.ajax({
				url: "/user/cities?state-id="+stateId,
				type: "GET",
				success: function(response) {
					var cities = response.cities;
					console.log(cities);
					var options = "";
					for(var i = 0; i < cities.length; i++) {
						options += '<option value="'+cities[i].id+'">'+cities[i].name+'</option>'
					}
					$("#billing-city").html(options);
				},
				error: function(err) {
					console.log(err)
				}
			}); 
		});	 
		$("#same-as-address").on("change", function(){
			if($(this).is(":checked")){
				$('#billing-address').val($('#shipping-address').val());
				$('#billing-area').val($('#shipping-area').val());
				$('#billing-locality').val($('#shipping-locality').val());
				$('#billing-state').val($('#shipping-state').val());
				$('#billing-city').val($('#shipping-city').val());
				$('#billing-contact').val($('#shipping-contact').val());
				$('#billing-pincode').val($('#shipping-pincode').val());
			}
			else if($(this).is(":not(:checked)")){
				$('#billing-address').val('');
				$('#billing-area').val('');
				$('#billing-locality').val('');
				$('#billing-state').val('');
				$('#billing-city').val('');
				$('#billing-contact').val('');
				$('#billing-pincode').val('');
			}
		});
    });
  </script>

@endsection
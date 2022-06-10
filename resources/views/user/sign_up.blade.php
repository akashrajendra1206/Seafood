@extends('header.header')
@section('content')
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">Register your Account</h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-7 col-lg-5">
					<div class="wrap">
						<div class="img" style="background-image: url(/login/images/bg-1.jpg);"></div>
						<div class="login-wrap p-4 p-md-5">
							<div class="d-flex">
								<div class="w-100">
									<h3 class="mb-4">Sign up</h3>
								</div>								
							</div>					
						</div>
						<form id="form-sign-up" role="form" method="POST" action="{{ url('/user/signup') }}" novalidate> 
							<input type="hidden" name="_token" value="{{ csrf_token() }}"> 
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
							<div class="row justify-content-center">
								<div class="col-xl-10 col-lg-10 col-md-10 col-sm-10 col-10">
									<div class="form-group">
										<input type="text" class="form-control" id="name" placeholder="Name" name="name" value="{{ old('name') }}">
										<span class="error-msgs text-center text-danger">{{ $errors->first('name')}}</span>
									</div>
								</div>
							</div>
							<div class="row justify-content-center">
								<div class="col-xl-10 col-lg-10 col-md-10 col-sm-10 col-10">
									<div class="form-group">
										<input type="email" class="form-control" id="email" placeholder="Email Address" name="email" value="{{ old('email') }}">
										<span class="error-msgs text-center text-danger">{{ $errors->first('email')}}</span>
									</div>
								</div>
							</div>
							<div class="row justify-content-center">
								<div class="col-xl-10 col-lg-10 col-md-10 col-sm-10 col-10">
									<div class="form-group">
										<input class="form-control" id="contact" placeholder="Contact Number" name="contact" value="{{ old('contact') }}">
										<span class="error-msgs text-center text-danger">{{ $errors->first('contact')}}</span>
									</div>
								</div>
							</div>
							<div class="row justify-content-center">
								<div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-5">
									<div class="form-group">										
										<input type="password" class="form-control" id="password" placeholder="Password" name="password" value="{{ old('password') }}">
										<span class="error-msgs text-center text-danger">{{ $errors->first('password')}}</span>
									</div>
								</div>
								<div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-5">
									<div class="form-group">
										<input type="password" class="form-control" id="confirm-password" placeholder="Confirm Password" name="confirm-password" value="{{ old('password') }}">
										<span<span class="error-msgs text-center text-danger">{{ $errors->first('Confirm Password')}}</span>
									</div>
								</div>
							</div>
							<div class="row justify-content-center">
								<div class="col-xl-10 col-lg-10 col-md-10 col-sm-10 col-10">
									<div class="form-group">
										<label for="address">Address</label>
										<textarea class="form-control" id="address" name="address"value="{{ old('address') }}"></textarea>
										<span class="error-msgs text-center text-danger">{{ $errors->first('address')}}</span>
									</div>
								</div>
							</div>
							<div class="row justify-content-center">
								<div class="col-xl-10 col-lg-10 col-md-10 col-sm-10 col-10">
									<div class="form-group">
										<label for="state">State</label>
										<select class="form-control" id="state" name="state">
											@foreach($states as $state)
												@if(old('state') == $state->id)
													<option value="{{$state->id}}" selected>{{$state->name}}</option>
												@else
													<option value="{{$state->id}}">{{$state->name}}</option>
												@endif
											@endforeach
										</select>
									</div>
								</div>
							</div>
							<div class="row justify-content-center">
								<div class="col-xl-10 col-lg-10 col-md-10 col-sm-10 col-10">
									<div class="form-group">
										<label for="city">City</label>
										<select class="form-control" id="city" name="city">
											@foreach($cities as $city)
												@if(old('city') == $city->id)
													<option value="{{$city->id}}" selected>{{$city->name}}</option>
												@else
													<option value="{{$city->id}}">{{$city->name}}</option>
												@endif
											@endforeach
										</select>
									</div>
								</div>
							</div>
							<div class="row justify-content-center">
								<div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-8">
									<button class="btn btn-default btn-block sign-up-button" type="submit">SIGN UP</button>
									<div class="text-center"><span id="sign-up-loading" style="display:none;"><img src="{{ asset('/images/loading.gif') }}" alt="" /></div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<script>
		$(function(){
			$("#state").on("change", function() {
				var stateId = $(this).val();
				$.ajax({
					url: "/user/cities?state-id="+stateId,
					type: "GET",
					success: function(response) {
						var cities = response.cities;
						var options = "";
						for(var i = 0; i < cities.length; i++) {
							options += '<option value="'+cities[i].id+'">'+cities[i].name+'</option>'
						}
						$("#city").html(options);
					},
					error: function(err) {
						console.log(err)
					}
				}); 
			});
			$("#state").change();	
		});

	</script>

@endsection
@extends('header.header')
@section('content')
<section class="ftco-section">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-6 text-center mb-5">
			<h2 class="heading-section">Sign in to account</h2>
			</div>
		</div>
			<div class="row justify-content-center">
				<div class="col-md-7 col-lg-5">
					<div class="wrap">
						<div class="img" style="background-image: url(/login/images/bg-1.jpg);"></div>
						<div class="login-wrap p-4 p-md-5">
							<div class="w-100">
								<h3 class="mb-4">Sign In</h3>
							</div>
							<form action="{{ url('/user/login') }}" class="signin-form" id="form-login" role="form" method="POST" >
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<div class="form-group mt-3">									
									@if (Session::has('success'))
									<div class="alert alert-danger">
									<ul>
									<li>{{ Session::get('success') }}</li>
									</ul>
									</div>
									@endif
									<div class="w-100">
									</div>
								</div>
								<div class="form-group mt-3">
									<label class="form-control-placeholder" for="email" name="email">Email</label>
									<input type="text" class="form-control" name="email">
									<span class="error-msgs text-center text-danger">{{ $errors->first('email')}}</span>
								</div>
								<div class="form-group">
									<label class="form-control-placeholder" for="password" name="password">Password</label>
									<input id="password-field" type="password" class="form-control"  name="password" >								
									<span class="error-msgs text-center text-danger">{{ $errors->first('password')}}</span>
								</div>
								<div class="form-group">
									<button type="submit" class="form-control btn btn-primary rounded submit px-3">Sign In</button>
								</div>
							</form>
							<p class="text-center">Not a member? <a href="/user-sign_up">Sign Up</a></p>
						</div>
					</div>
				</div>
			</div>
	</div>
</section>

@endsection
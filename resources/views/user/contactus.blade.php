@extends('header.header')
@section('content')

	<!-- Contact Form Begin -->
    <div class="contact-form spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="contact__form__title">
                        <h2>Leave Message</h2>
                    </div>
                </div>
            </div>
            <form action="{{ url('/user/contactus') }}" class="contactus-form" id="form_contactus" role="form" method="POST">
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
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <input type="text" name="first_name" placeholder="first name">
						<span class="error-msgs text-center text-danger">{{ $errors->first('first_name')}}</span>
						
                    </div>
					<div class="col-lg-6 col-md-6">
                        <input type="text" name="last_name" placeholder="last name">
						<span class="error-msgs text-center text-danger">{{ $errors->first('last_name')}}</span>
					</div>
					<div class="col-lg-6 col-md-6">
                        <input type="text" name="phone_number" placeholder="phone_number">
						<span class="error-msgs text-center text-danger">{{ $errors->first('phone_number')}}</span>
						
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <input type="text" name="email" placeholder="Your Email">
						<span class="error-msgs text-center text-danger">{{ $errors->first('email')}}</span>

                    </div>
                    <div class="col-lg-12 text-center">
                        <textarea placeholder="Your message" name="message"></textarea>
						<span class="error-msgs text-center text-danger">{{ $errors->first('message')}}</span>

						
                        <button type="submit" class="site-btn">SEND MESSAGE</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Contact Form End -->
	@endsection
	
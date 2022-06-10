@extends('header.header')
@section('content')
	
	 <div class="product-section mt-150 mb-150">
		<div class="container card bg-light border-dark mb-3 ">
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
			<div class="row justify-content-center">
				<div class="col-12 product-title text-center">
					<h2>My Profile</h2>
				</div>	
			</div>
			<div class="row justify-content-center">
				<div class="col-6 separator">
					<hr>
				</div>
			</div>
			<div class="details">
        <form id="form-edit-profile" role="form" method="POST" action="{{ url('/user/edit') }}">
          <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
          <div class="box-body">
            <div class="row">
              <div class="col-md-6 offset-md-3">
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="hidden" id="user-id" name="user-id" value="{{ Auth::user()->id }}">
                  <input type="text" class="form-control" id="profile-name" name="name" value="{{ Auth::user()->name }}">
                  <span class="error-font text-danger">{{ $errors->first('name')}}</span>
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="text" class="form-control" id="profile-email" name="email" value="{{ Auth::user()->email }}" readonly>
                  <span class="error-font text-danger">{{ $errors->first('email')}}</span>
                </div>
              </div>
            </div>   
            <div class="row">  
              <div class="col-md-3 offset-md-3">
                <div class="form-group">
                  <label for="end-date">Date of Birth</label>
                  <input type="text" class="form-control" id="dob" placeholder="Date of Birth" name="dob" value="{{ date('d-m-Y', strtotime(Auth::user()->dob)) }}">
                </div>
              </div>     
              <div class="col-md-3">
                <div class="form-group">
                  <label for="gender">Gender</label><br/>
                  <label class="radio-inline">
                    <input id="male" type="radio" name="gender" value="0" <?php if(Auth::user()->gender == 0){echo "checked";}?>> Male
                  </label> &nbsp;&nbsp;&nbsp;
                  <label class="radio-inline">
                    <input id="female" type="radio" name="gender" value="1" <?php if(Auth::user()->gender == 1){echo "checked";}?>> Female
                  </label> 
                </div>
              </div>
            </div>   
            <div class="row">
              <div class="col-md-6 offset-md-3">
                <div class="form-group">
                  <label for="address">Address</label>
                  <textarea class="form-control" id="profile-address" name="address">{{ Auth::user()->address }}</textarea>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-3 offset-md-3">
                <label for="city">State</label>
                <select class="form-control" id="profile-state" name="state">
                  @foreach($states as $state)
                    @if(Auth::user()->state_id == $state->id)
                    <option value="{{$state->id}}" selected>{{$state->name}}</option>
                    @else
                    <option value="{{$state->id}}">{{$state->name}}</option>
                    @endif
                  @endforeach
                </select>
              </div>
              <div class="form-group col-md-3">
                <label for="city">City</label>
                <select class="form-control" id="profile-city" name="city">
                  @foreach($cities as $city)
                      <option value="{{$city->id}}"  @if(Auth::user()->city_id == $city->id) selected
                      @endif >{{$city->name}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="row"> 
              <div class="col-md-6 offset-md-3">
                <div class="form-group">
                  <label for="contact-number">Contact Number</label>
                  <input type="text" class="form-control" id="contact-number" name="contact-number" value="{{Auth::user()->contact_number }}">
                  <span class="error-font text-danger">{{ $errors->first('contact-number')}}</span>
                </div>
              </div>
            </div>           
          </div>           
          <div class="box-footer text-center">
            <button type="submit" class="btn btn-primary user-submit-button">Submit</button>
          </div>
        </form>  
      </div>
		</div>
	</div>
  
  <script>
    $(function() {      
      //Date picker
      $('#dob').datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true,
        endDate: '0d'
      });
      
      $("#profile-state").on("change", function() {
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
            $("#profile-city").html(options);
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
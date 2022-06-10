@extends('header.Admin_header')
@section('content')
 <!--main content start-->
    <section id="main-content">
		<section class="wrapper">
			<div class="row">
				<div class="col-lg-12">
					<h3 class="page-header"><i class="fa fa-files-o"></i>Product Details</h3>
					<ol class="breadcrumb">
					<li><i class="fa fa-home"></i><a href="/admin-dashboard">Home</a></li>
					<li><i class="icon_document_alt"></i>Product</li>
					<li><i class="fa fa-files-o"></i>Add Product</li>
					</ol>
				</div>
			</div>
        <!-- Form validations -->
			<div class="row">
				<div class="col-lg-12">
					<section class="panel">
						<header class="panel-heading">
						<b><h3>Add New Product</h3></b>
						</header>
						<div class="panel-body">
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
								<div class="form">
									<form class="forms-sample" method="post" action="{{ url('/product/add') }}">
										<input type="hidden" name="_token" value="{{ csrf_token() }}">
											<div class="container">
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label" for="name">PRODUCT NAME</label>
															<input id="product_name" name="name" placeholder="Enter Product Name" class="form-control input-md"  type="text" value="{{ old('name') }}">
															<span class="error-font text-danger">{{ $errors->first('name')}}</span>
														</div>
														
														<div class="form-group">
															<label class="control-label" for="description">PRODUCT DESCRIPTION</label>
															<textarea class="form-control" id="description" name="description" placeholder="Enter Product Description " >{{ old('description') }}</textarea>
															<span class="error-font text-danger">{{ $errors->first('description')}}</span>
														</div>
														
														<div class="form-group col-md-12"> <br>         
															<label for="set_as_banner">Set banner image&nbsp;&nbsp;&nbsp;</label><br>
															<label class="radio-inline">
															<input id="set_as_banner_1" type="radio" class="minimal status" name="set_as_banner" value="0" checked="checked" >&nbsp;No
															</label>
															<label class="radio-inline">
															<input id="set_as_banner_2" type="radio" class="minimal status" name="set_as_banner" value="1" >&nbsp;Yes
															</label>
														</div>	
														
														<div class="form-group col-md-12"> <br>         
															<label for="status">Status&nbsp;&nbsp;&nbsp;</label><br>
															<label class="radio-inline">
															<input id="status_1" type="radio" class="minimal status" name="status" value="0")>&nbsp;Inactive
															</label>
															<label class="radio-inline">
															<input id="status_2" type="radio" class="minimal status" name="status" value="1" checked="checked")>&nbsp;Active
															</label>
														</div>	
													</div>
												
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label" for="price">PRICE</label>
															<input id="price" name="price" placeholder="Enter Price" class="form-control input-md"  type="text" value="{{ old('price') }}">
															<span class="error-font text-danger">{{ $errors->first('price')}}</span>
														</div>
														
														<div class="form-group">
															<label class="control-label" for="price">QUANTITY</label>
															<input id="quantity" name="quantity" placeholder="Enter Product Quantity" class="form-control input-md" type="text" value="{{ old('quantity') }}">
															<span class="error-font text-danger">{{ $errors->first('quantity')}}</span>
														</div>
														
														<div class="col-md-12 col-sm-12  banner-image-div" >									
															<label for="image">Banner Image &nbsp;<span class="text-danger">(Recommended size: 860 x 400 px or same aspect ratio)</span></label>							
															<div class="form-group file-upload file-uploader">
																<img id="img_prv"  class="preview-1" src="{{url('/admin/img/back_icon.png')}}">
																<input type="file" name="files[]" id="img_file_upid" class="upload-field-1" multiple>
																<input id="image-1" type="hidden" name="banner_image">
																<span class="error-font text-danger">{{ $errors->first('banner_image')}}</span>
															</div>
														</div> 	
													</div>
												</div>
											</div>
								</div>
						</div>
					</section>
				</div>
			</div>
		   <!-- End Form validations -->
										   <!-- Display Image Start-->
											<div class="row">
												<div class="col-lg-12">
													<section class="panel">
															<header class="panel-heading">
															<b><h3>Display Image</h3></b>
															</header>
															<div class="panel-body">
																<div class="col text-center">	
																	<div class="form-group display-image-container file-uploader">
																		<label id="image-box-2" class="button image-box file-upload-image">
																			<img id="display_img_prv"  class="preview-2" src="{{url('/admin/img/back_icon.png')}}">
																			<input type="file" name="file_img" id="display_img_file_upid" class="upload-field-2" multiple>
																			<input id="image-2" type="hidden" name="display_image">
																		</label>
																		<div>
																			<span class="error-font text-danger">{{ $errors->first('display_image')}}</span>
																		</div>
																	</div>  
																</div>	
															</div>
													</section>
												</div>
											</div>
											<!-- Display Image End-->
											<!-- Product Image Start-->
											<div class="row">
												<div class="col-lg-12">
													<section class="panel">
														<header class="panel-heading">
														<b><h3>Product Image</h3></b>
														</header>
															<div class="panel-body">
																<div class="row">
																	<div class="col-md-3">
																		<div class="form-group display-image-container file-uploader">
																			<label id="image-box-2" class="button image-box file-upload-image">
																				<img id="display_img_prv"  class="preview-3" src="{{url('/admin/img/back_icon.png')}}">
																				<input type="file" name="file_img" id="display_img_file_upid" class="upload-field-3" multiple>
																				<input id="image-3" type="hidden" name="images[]">
																			</label>
																			<div>
																				<span class="error-font text-danger">{{ $errors->first('display_image')}}</span>
																			</div>
																		</div>  
																	</div>
																	
																	<div class="col-md-3">
																		<div class="form-group display-image-container file-uploader">
																			<label id="image-box-2" class="button image-box file-upload-image">
																				<img id="display_img_prv"  class="preview-4" src="{{url('/admin/img/back_icon.png')}}">
																				<input type="file" name="file_img" id="display_img_file_upid" class="upload-field-4" multiple>
																				<input id="image-4" type="hidden" name="images[]">
																			</label>
																			<div>
																				<span class="error-font text-danger">{{ $errors->first('display_image')}}</span>
																			</div>
																		</div>  
																	</div>
																	
																	<div class="col-md-3">
																		<div class="form-group display-image-container file-uploader">
																			<label id="image-box-2" class="button image-box file-upload-image">
																				<img id="display_img_prv"  class="preview-5" src="{{url('/admin/img/back_icon.png')}}">
																				<input type="file" name="file_img" id="display_img_file_upid" class="upload-field-5" multiple>
																				<input id="image-5" type="hidden" name="images[]">
																			</label>
																			<div>
																				<span class="error-font text-danger">{{ $errors->first('display_image')}}</span>
																			</div>
																		</div>  
																	</div>
																	
																	<div class="col-md-3">
																		<div class="form-group display-image-container file-uploader">
																			<label id="image-box-2" class="button image-box file-upload-image">
																				<img id="display_img_prv"  class="preview-6" src="{{url('/admin/img/back_icon.png')}}">
																				<input type="file" name="file_img" id="display_img_file_upid" class="upload-field-6" multiple>
																				<input id="image-6" type="hidden" name="images[]">
																			</label>
																			<div>
																				<span class="error-font text-danger">{{ $errors->first('display_image')}}</span>
																			</div>
																		</div>  
																	</div>
																</div>	
																
																	<div class="row">
																		<div class="col-md-12 text-center">
																			<button type="submit" class="btn btn-primary mr-2">Submit</button>
																			<button type="reset" class="btn btn-light">Cancel</button>
																		</div>
																	</div>
															</div>
													</section>
												</div>
											</div>
											<!-- Product Image End-->
									</form>
		</section>
    </section>
    <!--main content end-->
  <!-- container section end -->

	<script>
		function readURL(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();            
				reader.onload = function (e) {
					
					var postData=new FormData();
					postData.append('file',input.files[0]);
			 
					var url="{{url('/product/upload')}}";
			 
					$.ajax({
					headers:{'X-CSRF-Token':$('meta[name=csrf_token]').attr('content')},
					async:true,
					type:"post",
					contentType:false,
					url:url,
					data:postData,
					processData:false,
					success:function(data){
					  console.log("success");
					  console.log(data.valueimg);
					  var num = $(input).attr('class').split('-')[2];
					  
						console.log(num);
						$('.file-uploader .preview-'+num).attr('src',"{{asset('/uploads')}}/" + data.valueimg).css('width', '100%').css('height', '100%').css('margin-top', '0px');
						$("#image-"+num).val(data.valueimg);
					}
					});
				}
				reader.readAsDataURL(input.files[0]);
			}
		} 
		$("[class^=upload-field-]").change(function(){
			readURL(this);
			console.log("here");
		});	
		
		$(function () {	
			$(".banner-image-div").hide();
			$('input[name="set_as_banner"').click(function () {
				if(this.value == 1) {
					console.log(1);
					$(".banner-image-div").show();
				} else {
					console.log(0);
					$(".banner-image-div").hide();
				}
			});
		});
	</script>
	
			
@endsection
@extends('header.admin_header')
@section('content')

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
								<form id="form-add-product" role="form" method="POST" action="{{ url('/product/edit') }}">
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
										<div class="container">
											<div class="row">
												<div class="col-md-6">
													<div class="form-group col-md-12">
														<input type="hidden" name="product-id" value="{{ $product[0]->id }}">
														<label class="control-label" for="product">Product Name</label>
														<input type="text" class="form-control" id="name" placeholder="Enter product name" name="name" value="{{ $product[0]->name }}">
														<span class="error-font text-danger">{{ $errors->first('name')}}</span>
													</div>
													
													<div class="form-group col-md-12">
														<label class="control-label" for="description">Description</label>
														<textarea name="description" class="form-control" rows="5" placeholder="Enter Description In Short">{{ $product[0]->description }}</textarea>
														<span class="error-font text-danger">{{ $errors->first('description')}}</span>
													</div> 
													
													<div class="form-group col-md-12"> <br>         
														<label class="control-label" for="set_as_banner">Set banner image&nbsp;&nbsp;&nbsp;</label><br>
														<label class="radio-inline">
															<input id="set_as_banner_1" type="radio" class="minimal" name="set_as_banner" value="0"
															<?php 
															if(old('set_as_banner') != null && old('set_as_banner')== 0){
																echo 'checked';
															} else { 
																if($product[0]->set_as_banner == "0") {
																	echo "checked";
																}
															}?>>&nbsp;No
														</label>
														<label class="radio-inline">
															<input id="set_as_banner_2" type="radio" class="minimal" name="set_as_banner" value="1"
															<?php 
															if(old('set_as_banner') != null && old('set_as_banner')== 1){
																echo 'checked';
															} else { 
																if($product[0]->set_as_banner == "1") {
																	echo "checked";
																}
															}?>>&nbsp;Yes
														</label>
													</div>	
													
													<div class="form-group col-md-12"> <br>         
														<label class="control-label" for="status">Status&nbsp;&nbsp;&nbsp;</label><br>
														<label class="radio-inline">
														<input id="status_1" type="radio" class="minimal status" name="status" value="0"<?php if($product[0]->status == "0") {echo "checked";}?>>&nbsp;Inactive
														</label>
														<label class="radio-inline">
														<input id="status_2" type="radio" class="minimal status" name="status" value="1"<?php if($product[0]->status == "1") {echo "checked";}?>>&nbsp;Active
														</label>
													</div>	
												</div>
												
												<div class="col-md-6">
													<div class="form-group col-md-12">
														<label class="control-label" for="price">Price</label>
														<input type="text" class="form-control" id="price" placeholder="Enter price" name="price" min="0" value="{{ $product[0]->price }}">
														<span class="error-font text-danger">{{ $errors->first('price')}}</span>
													</div>
													
													<div class="form-group col-md-12">
														<label class="control-label" for="quantity">QUANTITY</label>
														<input id="quantity" name="quantity" placeholder="Enter Quantity" class="form-control input-md" type="text"  min="0" value="{{ $product[0]->quantity }}">
														<span class="error-font text-danger">{{ $errors->first('quantity')}}</span>
													</div>
													<div class="col-md-12 col-sm-12  banner-image-div" >									
														<div class="col-md-12 col-sm-12  banner-image-div" >									
															<label class="control-label" for="image">Banner Image &nbsp;<span class="text-danger">(Recommended size: 860 x 400 px or same aspect ratio)</span></label>							
															<div class="form-group file-upload file-uploader edit-img">	
																@if($product[0]->banner_image !="" && $product[0]->banner_image !="NULL")
																	<img id="img_prv1"  class="preview-1 "  src="{{asset('/uploads/').'/'.$product[0]->banner_image}}" />											
																@else
																	<img id="img_prv"  class="preview-1"  src="{{asset('/Images/back_icon.png')}}" />
																@endif											
																<input type="file" name="files[]" id="img_file_upid" class="upload-field-1" multiple>
																<input id="image-1" type="hidden" name="banner_image" value="{{$product[0]->banner_image}}">
																<span class="error-font text-danger">{{ $errors->first('banner_image')}}</span>
															</div>
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
				<!-- Display Image-->
				<div class="row">
					<div class="col-lg-12">
						<section class="panel">
							<header class="panel-heading">
							<b><h3>Display Image &nbsp;<span class="text-danger">(Recommended size: 220 x 240 px or same aspect ratio)</span></h3></b>
							</header>
							<div class="panel-body">
								<div class="card-body text-center">
									<div class="form-group row text-center">
										<div class="container">
											<div class="row">
												<div class="col">
													
												</div>
												<div class="col">
													<label for="image">Display Image </label>	
													<div class="form-group display-image-container file-uploader">
														<label id="image-box-2" class="button image-box file-upload-image edit-img">
															@if($product[0]->display_image !="" && $product[0]->display_image !="NULL")
																<img id="img_prv1" class="preview-2 " src="{{asset('/uploads/').'/'.$product[0]->display_image}}" height="100%" />
															@endif									
															<input type="file" name="file_img" id="display_img_file_upid" class="upload-field-2" multiple>
															<input id="image-2" type="hidden" name="display_image" value="{{$product[0]->display_image}}">
														</label>
														<div>
															<span class="error-font text-danger">{{ $errors->first('display_image')}}</span>
														</div>
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
				<!-- Product Images-->
				<div class="row">
					<div class="col-lg-12">
						<section class="panel">
							<header class="panel-heading">
							<b><h3>Product Image &nbsp;<span class="text-danger">(Recommended size: 445 x 350 px or same aspect ratio)</span></h3></b>
							</header>
								<div class="panel-body">
									<div class="card-body text-center">
										<div class="form-group row text-center">
											<div class="container">
												<div class="row">
													<?php $index=0; ?>
													@for($i=3; $i<7; $i++)
													<div class="col-md-3">
														<div class="form-group display-image-container file-uploader">
															<label id="image-box-2" class="button image-box file-upload-image">
																<?php if(count($product)>0 && isset($product[$index]) && $product[$index]->image !="") {
																	echo '
																		<img id="img_prv1" class="preview-'.$i.'" src="/uploads/'.$product[$index]->image.'" height="100%" />
																		<a id="delete-image-modal-link-'.$i.'" class="delete-image" href="#delete-image-modal" data-toggle="modal" data-dismiss="modal"  data-target="#delete-image-modal" data-image-id="'.$product[$index]->image_id.'"></a>									
																		';																;
																	}
																else{?>
																	<img id="img_prv"  class="preview-{{$i}}"  src="{{ asset('/images/back_icon.png') }}" />
																<?php	}
																?>									
																<input type="file" name="file_img" id="product_img_file_upid" class="upload-field-{{$i}}" multiple>
																<input id="image-{{$i}}" type="hidden" name="images[]" value="<?php if(isset($product[$index])) { echo $product[$index]->image; } ?>">
															</label>
															<div>
																<span class="error-font text-danger">{{ $errors->first('display-image')}}</span>
															</div>
														</div>  
													</div>
													<?php $index++; ?>
													@endfor
												</div>
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-12 text-center">
											<button type="submit" class="btn btn-primary mr-2">Submit</button>
										</div>
									</div>
								</div>
						</section>
					</div>
				</div>
			</form>
								
			<!-- ========== DELETE IMAGE ========== -->
			<div class="modal fade ge-modal" id="delete-image-modal" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content"> 
						<form id="form-delete-image" role="form" method="POST" action="/photos/delete-image" novalidate>
						 <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
						 <div class="modal-header">
							<h4>Delete image</h4>
						 </div>
						 <div class="modal-body">
							<div class="row">            
							  <div class="col-md-12 text-center">
								 <h3>Are you sure?</h3>
								 <input id="delete-image-id" type="hidden" name="image-id" value="">                 
							  </div> 
							</div>
						 </div>  
						 <div class="modal-footer">
							<div class="row">
							  <div class="col-md-12">
								 <button class="btn btn-md btn-danger" type="submit">Yes</button>  
								 <button type="button" class="btn btn-md btn-default" data-dismiss="modal">Close</button>           
							  </div>
							</div>
						 </div>
						</form>      
					</div>            
				</div>
			</div>
			<!-- ========== DELETE IMAGE END ========== -->
		</section>
	</section>
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
		//$(".banner-image-div").hide();
		$('input[name="set-as-banner"').click(function () {
			if(this.value == 1) {
				console.log(1);
				$(".banner-image-div").show();
			} else {
				console.log(0);
				$(".banner-image-div").hide();
			}
		});
	});
	
	$(document).on('click', '.delete-image', function(e){		
				e.preventDefault();
				var image_id = $(this).data('image-id');
				console.log(image_id);
				if(image_id > 0)
				{
				  $('#delete-image-id').val(image_id);
				  console.log();
				}else{
					//alert($(this).data('index'));
					$('#image-'+$(this).data('index')).val(''); 
					$('#image-box-'+$(this).data('index')).css('background-image', 'none');
					$('.dummy-image-'+$(this).data('index')).removeClass('hide');
					$('#delete-image-modal-link-'+$(this).data('index')).addClass('hide');	
				}
			});
	</script>
	
 
  @endsection
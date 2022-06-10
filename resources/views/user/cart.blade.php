@extends('header.header')
@section('content')

	
	<div class="text-center">
		<h1>Cart</h1>
	</div>
	<!-- cart -->
	<div class="cart-section mt-150 mb-150">
		<div class="container product_details">
		<div class="row justify-content-center">					
					<span id="cart-empty-msg">Your cart is empty<span>
				</div>
				<div class="row details">
					<div class="col-md-12 col-sm-12">			
						<table id="table-product" class="table table-bordered table-striped">
							<thead>
								<tr>
								<th width="5%" class="text-center">No.</th>
								<th width="20%">Product Image</th>
								<th width="50%">Name</th>									
								<th width="10%" class="text-center">Quantity</th>
								<th width="40%" class="text-center">Price</th>
								<th width="10%" class="text-center">Edit</th>
								<th width="10%" class="text-center">Remove</th>
							</tr>
							</thead>
							<tbody>
								<input type="hidden" id = "cart-count" name="cart-count" value="{{ $cart_count }}">
								<?php 
									$i = 1; 
									$total=0;
								?>
								@foreach($products as $product)
									@php									
										$total=$total+$product->price*$product->product_quantity;
									@endphp
									<tr>
										<td class="text-center number  ">{{ $i++ }}</td>
										<td>
                                        <a>
											<img  id="jiu" src="{{ asset('/Uploads') }}/{{$product->display_image }}">
										</a>
                                    </td>
										<td>
											<span class="product-name product" name="name"> {{ $product->name }}</span>
										</td>	
										<td width="10%" class="text-center">
											<form id="frm-edit-cart-{{ $i }}" class="hide">
												<input type="number" class="form-control quantity" name="quantity" min="1" id="quantity-{{ $i }}" value="{{ $product->product_quantity }}" data-id="{{ $i }}">
												<input type="hidden" id="cart-id-{{ $i }}" name="cart-id-{{ $i }}" value="{{ $product->cart_id}}">
												<input type="hidden" id="price-{{ $i }}" name="price" value="{{ $product->price}}">
												
											</form>
											<span id="span-quantity-{{ $i }}" class="product">{{ $product->product_quantity }}</span>
										</td>							
										<td class="text-center">
											<span id="total-price-{{ $i }}" name="total-price" class="product"><i class="fa fa-inr" aria-hidden="true"></i> {{ $product->price*$product->product_quantity }}</span>
										</td>									
										<td width="10%" class="text-center">
											<button class="btn btn-warning edit-cart" data-id="{{ $i }}">Edit</button>
											<button class="btn btn-info hide edit-cart-ok" data-id="{{ $i }}">OK</button>										
										</td>             
										<td width="10%" class="text-center">  
											<button class="btn btn-danger delete-cart-link" data-cart-id="{{ $product->cart_id }}">Remove</button>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table> 
					</div>
				</div>
				<div class="row">
					<div class="form-group col-md-12 col-sm-12 text-right total">
						<input type="hidden" id="total-amt" name="total-amt" value="<?php  echo $total;?>">
						<strong>Total :&nbsp;&nbsp;</strong><i class="fa fa-inr" aria-hidden="true"></i><span id="total-amt-display"> @php echo $total; @endphp</span>	
					</div>
				</div>
				<div class="row proceed">
					<div class="form-group col-md-12 col-sm-12 text-right">						
						<a href="/order/address"><button id="checkout" type="submit" class="btn proceed-to-checkout">PROCEED TO CHECKOUT</button></a>
					</div>
				</div>
		</div>
	</div>
	<!-- end cart -->
	<!-- ========== DELETE MODEL START ========== -->  
			
			<div class="modal delete-modal" id="delete-cart-modal" tabindex="-1" role="dialog">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<form id="form-delete-cart" role="form" method="POST" action="{{ url('/cart/delete') }}" novalidate>
							<div class="modal-header">
								<h3 class="modal-title">Product</h3>
							</div>
							<div class="modal-body">
								<input type="hidden" name="_token" value="{{ csrf_token() }}"> 
								<input type="hidden" id="cart-id" name="cart-id" value="">
								<h4>Are you sure to remove this product?</h4>
							</div>
							<div class="modal-footer">		
								<input type="submit" class="btn btn-default" value="Yes">
								<button href="/cart/cart" class="btn btn-light" data-dismiss="modal">No</button> 
							</div>
						</form>
					</div>
			  </div>
			</div>
		<!-- ========== DELETE MODEL END ========== -->

		<script>
			$(function(){
				$(document).on('change', '.quantity', function() {
					var id = $(this).data('id');
					var quantity = $(this).val();
					console.log(quantity)
					$('#span-quantity-'+id).text(quantity);
					var price = parseFloat($('#price-'+id).val());
					var total_amt = parseFloat($('#total-amt').val());
					var ta=0;
					console.log(quantity);
					console.log(price);
					console.log(total_amt);
					if(quantity != ''){					
						var total = quantity * price;
						var total_amt_display =quantity * price;
						$('#total-price-'+id).html('<i class="fa fa-inr" aria-hidden="true"></i> ' + total);
						$('#total-amt-display').html( total_amt_display);
					} else {
						$('#total-price-'+id).html('<i class="fa fa-inr" aria-hidden="true"></i> 0');
					}
				}); 
				
				//Delete product   
				$(document).on('click', '.delete-cart-link', function(ev) {
				ev.preventDefault();	
				var cart_id = $(this).data('cart-id'); 
					$('#cart-id').val(cart_id);
					$('#delete-cart-modal').modal('show');
				}); 
				
				$(document).on('click', '.edit-cart', function(ev) {
					var id = $(this).data('id');
					$('#frm-edit-cart-'+id).removeClass('hide');
					$('.edit-cart[data-id="'+id+'"]').addClass('hide');
					$('.edit-cart-ok[data-id="'+id+'"]').removeClass('hide');
					$('#span-quantity-'+id).addClass('hide');
				});
							
				$(document).on('click', '.edit-cart-ok', function(ev) {
					var id = $(this).data('id');
					$('#frm-edit-cart-'+id).addClass('hide');
					$('.edit-cart[data-id="'+id+'"]').removeClass('hide');
					$('.edit-cart-ok[data-id="'+id+'"]').addClass('hide');
					$('#span-quantity-'+id).removeClass('hide');
					var postData = $("#frm-edit-cart").serializeArray(); 
					var quantity = $('#quantity-'+id).val();
					var cart_id = $('#cart-id-'+id).val();
					console.log(quantity);
					console.log(cart_id);
					$.ajax({
						url: '/cart/edit?cart-id='+cart_id+'&quantity='+quantity,
						type: 'GET',
						success: function(data, textStatus, jqXHR){      
							console.log('success');
						},
						error: function(jqXHR, textStatus, errorThrown){
							console.log('error');
						}
					});
				});
				
				var cart_count = $('#cart-count').val();
				console.log('cart'+cart_count);
				if(cart_count == 0)
				{
					console.log('dis');
					$('.details').addClass('hide');
					$('.total').addClass('hide');
					$('.proceed').addClass('hide');
					$('#cart-empty-msg').removeClass('hide');
					$('.proceed-to-checkout').prop("disabled", true);
				}else{
					console.log('en');
					$('.details').removeClass('hide');
					$('.total').removeClass('hide');
					$('.proceed').removeClass('hide');
					$('#cart-empty-msg').addClass('hide');
					$('.proceed-to-checkout').prop("disabled", false);
				}
			});
		</script>
	@endsection
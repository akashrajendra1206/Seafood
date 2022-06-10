	
@extends('header.header')
@section('content')
	<section class="featured spad">
		<div class="container">
			<div class="row featured__filter">
			@foreach($shops as $shop)
                <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">
                    <div class="featured__item">
					<a href="/product/details?product-id={{ $shop->id }}" class="image">
                        <div class="featured__item__pic set-bg" data-setbg="{{ asset('/Uploads') }}/{{$shop->display_image }}">
                            
                        </div>
					</a>
                        <div class="featured__item__text">
                            <h6><a href="#">{{ $shop->name }}</a></h6>
                            <h5>₹{{ $shop->price }}</h5>
                        </div>
                    </div>
                </div>
				@endforeach
            </div>
		</div >
	</div>

@endsection
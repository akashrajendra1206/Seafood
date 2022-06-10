@extends('header.header')
@section('content')
 <!-- Hero Section Begin -->
    <section class="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="hero__item set-bg" data-setbg="{{asset('/user/img/hero/banner.jpg') }}">
                        <div class="hero__text">
                            <span>Seafood FRESH</span>
                            <h2>Seafood <br />100% Fresh</h2>
                            <p>Free Pickup and Delivery Available</p>
                            <a href="/product/shop" class="primary-btn">SHOP NOW</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Categories Section Begin -->
    <section class="categories">
        <div class="container">
            <div class="row">
                <div class="categories__slider owl-carousel">
				@foreach($shops as $shop)
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="{{ asset('/Uploads') }}/{{$shop->display_image }}">
                            <h5><a href="/product/details?product-id={{ $shop->id }}">{{ $shop->name }}</a></h5>
                        </div>
                    </div>
				@endforeach
                </div>
            </div>
    </section>
    <!-- Categories Section End -->
    <!-- Blog Section Begin -->
    <section class="from-blog spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title from-blog__title">
                        <h2>From The Blog</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="{{asset('/user/img/blog/blog-1.jpg') }}" alt="">
                        </div>
                        <div class="blog__item__text">
                            
                            <h5><a href="#">HOW TO INTRODUCE SEAFOOD TO KIDS</a></h5>
                            <p>1. Start with the freshest fish<br>
								2. Start them early.<br>
								3. Make seafood a consistent part of the weekly menu.<br>
								4. Start them off with a mild fish.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="{{asset('/user/img/blog/blog-2.jpg') }}" alt="">
                        </div>
                        <div class="blog__item__text">
                            
                            <h5><a href="#">SEAFOOD STORAGE & HANDLING INSTRUCTIONS<br></a></h5>
                            <p> 1. Always keep seafood in the coldest part of your refrigerator.<br>
								2. Keep in original packaging when possible.<br>
								3. These guidelines are for uncooked seafood. </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="{{asset('/user/img/blog/blog-3.jpg') }}" alt="">
                        </div>
                        <div class="blog__item__text">
                            
                            <h5><a href="#">How to Cook Whole Fish</a></h5>
                            <p>It looks impressive, but one of the easiest and quickest ways to enjoy seafood is to cook whole fish. Moist and flaky, it’s a guaranteed method for getting tons of flavor out of your fish, and you don’t have to be a professional chef to do it. </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Section End -->
	@endsection

   
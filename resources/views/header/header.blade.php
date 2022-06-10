<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Seafood Market</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{asset('/user/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{asset('/user/css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{asset('/user/css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{asset('/user/css/nice-select.css') }}" type="text/css">
    <link rel="stylesheet" href="{{asset('/user/css/jquery-ui.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{asset('/user/css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{asset('/user/css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{asset('/user/css/style.css') }}" type="text/css">
	<link rel="stylesheet" href="{{asset('/user/css/mystyle.css') }}" type="text/css">
	<script src="{{asset('/user/js/jquery-3.3.1.min.js') }}"></script>
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="{{asset('/user/img/logo.png')}}"> alt=""></a>
        </div>
        <div class="humberger__menu__cart">
            <ul>
                <li><a href="#"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>
            </ul>
            <div class="header__cart__price">item: <span>₹150.00</span></div>
        </div>
        <div class="humberger__menu__widget">
            <div class="header__top__right__auth">
                <a href="/user-login"><i class="fa fa-user"></i> Login</a>
            </div>
        </div>
        
        <div id="mobile-menu-wrap"></div>
        <div class="header__top__right__social">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-linkedin"></i></a>
            <a href="#"><i class="fa fa-pinterest-p"></i></a>
        </div>
        <div class="humberger__menu__contact">
            <ul>
                <li><i class="fa fa-envelope"></i>seafoodshop@gmail.com</li>
                <li>Free Shipping</li>
            </ul>
        </div>
    </div>
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__left">
                            <ul>
                                <li><i class="fa fa-envelope"></i>seafoodshop@gmail.com</li>
                                <li>Free Shipping  </li>
                            </ul>
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="/"><img src="{{asset('/user/img/logo.png') }}" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav class="header__menu">
                        <ul>
                            <li class="active"><a href="/">Home</a></li>
                            <li><a href="/product/shop">Shop</a></li>
							 <li><a href="/user/about">About</a></li>
							<li><a href="/user/contactus">Contact</a></li>
							@if(Session::has('user_name'))
								<li><a href="">{{ Session::get('user_name') }}</a>
									<ul class="header__menu__dropdown">
										<li><a href="/user/profile">My Profile</a></li>
										<li><a href="/user/logout">Logout</a></li>
										<li><a href="/user/myorder">My order</a></li>
									</ul>
								</li>
							@else
								<li><a href="/user-login">Login</a></li>	
							@endif
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__cart">
                        <ul>
							<li>
								@if (Auth::check())
									<a href="/cart"><i class="fa fa-shopping-bag"></i> <span>{{ $cart_count }}</span></a>
								@endif
							</li>`
                        </ul>
                    </div>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->
	@yield('content')
	 <!-- Footer Section Begin -->
    <footer class="footer spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__about__logo">
                            <a href="/"><img src="{{asset('/user/img/logo.png') }}" alt=""></a>
                        </div>
                        <ul>
                            <li>Address: 457 sai apartment jamsande, devgad</li>
                            <li>Phone: 8275353923</li>
                            <li>seafoodshop@gmail.com</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                    <div class="footer__widget">
                        <h6>Useful Links</h6>
                        <ul>
                            <li><a href="/user/about">About Us</a></li>
                            <li><a href="/user/contactus">About Our Shop</a></li>
                            <li><a href="/user/privacy">Secure Shopping</a></li>
                            <li><a href="#">Delivery infomation</a></li>
                            <li><a href="/user/privacy">Privacy Policy</a></li>
                            <li><a target = '_blank' href="https://goo.gl/maps/yohp5cQrtiVyuepG7">Our Sitemap</a></li>
                        </ul>
                        
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="footer__widget">
                        <h6>Visit daily for newest stock and fresh seafood</h6>
                        <div class="footer__widget__social">
                            <a target = '_blank' href="https://www.facebook.com/aakashrajendra.dhekane"><i class="fa fa-facebook"></i></a>
                            <a target = '_blank' href="https://instagram.com/akash_dhekane?utm_medium=copy_link"><i class="fa fa-instagram"></i></a>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                   
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    
    <script src="{{asset('/user/js/bootstrap.min.js') }}"></script>
    <script src="{{asset('/user/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{asset('/user/js/jquery-ui.min.js') }}"></script>
    <script src="{{asset('/user/js/jquery.slicknav.js') }}"></script>
    <script src="{{asset('/user/js/mixitup.min.js') }}"></script>
    <script src="{{asset('/user/js/owl.carousel.min.js') }}"></script>
    <script src="{{asset('/user/js/main.js') }}"></script>



</body>

</html>
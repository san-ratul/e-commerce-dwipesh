<?php
    $cart['total_items'] = count(\Cart::getContent());
    $cart['subtotal'] = \Cart::getSubTotal();
    $cart_products = \Cart::getContent();
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> Easy Bazar</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('frontend/img/favicon.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('frontend/img/favicon.png')}}">
    <!-- all css here -->
    <link rel="stylesheet" href="{{asset('frontend/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/owl.carousel.min.cs')}}s">
    <link rel="stylesheet" href="{{asset('frontend/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/pe-icon-7-stroke.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/icofont.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/meanmenu.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/easyzoom.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/bundle.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/responsive.css')}}">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <script src="{{asset('frontend/js/vendor/modernizr-2.8.3.min.js')}}"></script>
    <style>
        .invalid-feedback{
            display: block;
        }
    </style>
</head>
</body>

<header>
    <div class="header-top-furniture wrapper-padding-2 res-header-sm">
        <div class="container-fluid">
            <div class="header-bottom-wrapper">
                <div class="logo-2 furniture-logo ptb-30">
                    <a href="{{url('/')}}">
                        <h2 style="font-weight:bold;">Easy Bazar</h2>
                    </a>
                </div>
                <div class="menu-style-2 furniture-menu menu-hover">
                    <nav>
                        <ul>
                            <li>
                                @guest
                                <a href="{{url('/')}}">home</a>
                                @elseif(auth()->user()->is_admin)
                                <a href="{{route('admin.index')}}">dashboard</a>
                                @elseif(auth()->user()->is_seller)
                                <a href="{{route('seller.index')}}">dashboard</a>
                                @elseif(auth()->user())
                                <a href="{{route('home')}}">dashboard</a>
                                @endguest
                            </li>
                            <li><a href="#">pages</a>
                            </li>
                            <li><a href="{{route('shop')}}">shop</a>
                            </li>
                            <li><a href="blog.html">About Us</a>
                            </li>
                            <li><a href="contact.html">contact</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="header-cart">
                    <a class="icon-cart-furniture" href="{{route('cart.show')}}">
                        <i class="ti-shopping-cart"></i>
                        <span class="shop-count-furniture green">{{$cart['total_items']}} </span>
                    </a>
                    <ul class="cart-dropdown">
                        @foreach($cart_products as $cartProduct)
                        <li class="single-product-cart">
                            <div class="cart-title">
                                <h5><a href="{{route('product.details',$cartProduct->id)}}"> {{$cartProduct->name}}</a>
                                </h5>
                                <h6>Spec: {{$cartProduct->attributes['color'] ?? 'N/A'}}</h6>
                                <span>{{$cartProduct->price}} x {{$cartProduct->quantity}} BDT</span>
                            </div>
                            <div class="cart-delete">
                                <form id="cart-delete-form" action="{{ route('cart.delete',$cartProduct->id) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        style="padding:0px;background:transparent;border:none;cursor:pointer; margin-top:10px; font-size:20px"><i
                                            class="ti-trash"></i></button>
                                </form>
                            </div>
                        </li>
                        @endforeach
                        <li class="cart-space">
                            <div class="cart-sub">
                                <h4>Subtotal</h4>
                            </div>
                            <div class="cart-price">
                                <h4>BDT {{$cart['subtotal']}}</h4>
                            </div>
                        </li>
                        <li class="cart-btn-wrapper">
                            <a class="cart-btn btn-hover" href="{{route('cart.show')}}">view cart</a>
                            <a class="cart-btn btn-hover" href="#">checkout</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="mobile-menu-area d-md-block col-md-12 col-lg-12 col-12 d-lg-none d-xl-none">
                    <div class="mobile-menu">
                        <nav id="mobile-menu-active">
                            <ul class="menu-overflow">
                                <li><a href="#">HOME</a>

                                </li>
                                <li><a href="#">pages</a>

                                </li>
                                <li><a href="#">shop</a>

                                </li>
                                <li><a href="#">BLOG</a>

                                </li>
                                <li><a href="contact.html"> Contact </a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-bottom-furniture wrapper-padding-2 border-top-3">
        <div class="container-fluid">
            <div class="furniture-bottom-wrapper">
                <div class="furniture-login">
                    <ul>
                        @guest
                        <li>Get Access: <a href="{{route('login')}}">Login </a></li>
                        <li><a href="{{route('register')}}">Reg </a></li>
                        @else
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                  document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out"></i> Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                        @endguest
                    </ul>
                </div>
                <div class="furniture-search">
                    <form action="#">
                        <input placeholder="I am Searching for . . ." type="text">
                        <button>
                            <i class="ti-search"></i>
                        </button>
                    </form>
                </div>
                <div class="furniture-wishlist">
                </div>
            </div>
        </div>
    </div>
</header>


@yield('content')


@include('layouts.partials.footer')

<script src="{{asset('frontend/js/vendor/jquery-1.12.0.min.js')}}"></script>
<script src="{{asset('frontend/js/popper.js')}}"></script>
<script src="{{asset('frontend/js/bootstrap.min.js')}}"></script>
<script src="{{asset('frontend/js/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('frontend/js/isotope.pkgd.min.js')}}"></script>
<script src="{{asset('frontend/js/imagesloaded.pkgd.min.js')}}"></script>
<script src="{{asset('frontend/js/jquery.counterup.min.js')}}"></script>
<script src="{{asset('frontend/js/waypoints.min.js')}}"></script>
<script src="{{asset('frontend/js/ajax-mail.js')}}"></script>
<script src="{{asset('frontend/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('frontend/js/plugins.js')}}"></script>
<script src="{{asset('frontend/js/main.js')}}"></script>
@yield('script')
</body>

</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title') Next Shopping</title>
    <link rel="icon" href="{{asset("pics/logo1.jpg")}}" type="image/gif" >
    @yield('seo')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0-11/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
    <link rel="stylesheet" href="{{asset("camera-slider/camera.css")}}">
    <link rel="stylesheet" href="{{asset("lightbox/css/lightbox.min.css")}}">
    <link rel="stylesheet" href="{{asset("css/price_range_style.css")}}">
    <link rel="stylesheet" href="{{asset("css/magnify.css")}}">
    <link rel="stylesheet" href="{{asset("sass/style.css")}}">
    @yield('css')
</head>
<body>
<div class="first-load">
    <div class="loader cav">Loading...</div>
</div>
<div id="header">
    <div id="return-to-top" class="arrow">
        <img src="{{asset("pics/back-to-top.png")}}" alt="#">
    </div>
    <div class="container-fluid px-5 top-header d-flex flex-wrap justify-content-between">
        <div class="login d-flex align-items-center">
            @if(auth()->user())
                <div class="user-in">
                    <i class="far fa-user-circle mr-2"></i><i class="fas fa-angle-down mr-2"></i>
                    <nav>
                        <a href="{{route('profile')}}">My Profile</a>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sign Out</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </nav>
                </div>
            @else
                <div class="login-text">
                    <a href="{{route('login')}}" class="button text-center d-block text-white">Login / Register</a>
                </div>
            @endif
        </div>
        <div class="header-social-icons">
            <a href="{{$insta}}" style="color: #e4405f"> <i class="fab fa-instagram"></i></a>
            <a href="{{$facebook}}" style="color: #3b5998"> <i class="fab fa-facebook-f"></i></a>
            <a href="{{$twitter}}"  style="color: #00acee"> <i class="fab fa-twitter"></i></a>
            <a href="{{$google}}" style="color: #dd4b39"> <i class="fab fa-google-plus-g"></i></a>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="{{url('/')}}"><img src="{{asset("pics/logo1.jpg")}}"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ml-auto px-5">
            <a class="nav-item nav-link active" href="{{route('home')}}"><i class="fas mr-2 fa-home"></i>HOME <span class="sr-only">(current)</span></a>

            <li class="nav-item dropdown d-none">
                <a class="nav-item nav-link" href="{{route('service')}}"><i class="fas mr-2 fa-tools"></i>SERVICES</a>
            </li>
            <a class="nav-item nav-link" href="{{route('contact')}}"><i class="far mr-2 fa-address-book"></i>CONTACT US</a>
            <a class="nav-item nav-link special-deal-btn" href="{{route('specialDeals')}}">SPECIAL DEALS</a>
            <div class="more-button">
                <i class="fas fa-ellipsis-v"></i>
                <div class="more-content">
                    <a href="{{route('page','privacy-policy')}}">Privacy Policy</a>
                    <a href="{{route('page','terms')}}">Terms & Condition</a>
                    <a href="{{route('page','return-policy')}}">Return Policy</a>
                    <a href="{{route('faqs')}}">FAQs</a>
                </div>
            </div>
            </div>
        </div>
    </nav>
    <div class="container-fluid px-5 py-3 d-flex align-items-center select-bar ">
        {{Form::select('brand',$searchbrands,null,['class'=>'custom-select','id'=>'headersearchbrand','placeholder'=>'Select Brands'])}}
        <div class="search position-relative">
            <input type="text" class="form-control" placeholder="Search entire store here..." id="headersearchvalue">
            <div class="icon search-icon">
                <a href="#" class="hearderserach"><i class="fas fa-search"></i></a>
            </div>
        </div>
        <div class="call-cart d-flex align-items-center justify-content-between ml-auto">
            <a href="tel:{{$phoneno}}" class="call-us-now d-flex align-items-center text-white mr-5">
                <i class="fas fa-2x mr-2 fa-phone"></i>
                <div class="call-text">
                    <h5>Call Us Now</h5>
                    <h6>{{$phoneno}}</h6>
                </div>
            </a>
            <a href="{{route('cart')}}" class="cart dropdown text-white d-flex align-items-center mr-4">
                <div class="icon position-relative">
                    <i class="fas fa-2x mr-2 fa-cart-arrow-down"></i>
                    <div class="badge bagdecartcount">{{$cartItems}}</div>
                </div>
                <div class="cart-text">
                    <h5>My Cart</h5>
                    <h6 class="itemcartcount">({{$cartItems}}) Item</h6>
                </div>
            </a>
        </div>
    </div>

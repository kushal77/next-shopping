
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Next Shopping</title>
    <link rel="icon" href="{{asset("pics/logo1.png")}}" type="image/gif" >
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
</head>
<body>
<div class="first-load">
    <div class="loader cav">Loading...</div>
</div>
<section class="a-one">
    <div class="container title-logo">
        <div class="img-box text-center">
            <a href="{{route('home')}}"><img src="{{asset("pics/logo.png")}}"  alt="#"></a>
        </div>
    </div>

    <div class="row no-gutters">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 d-flex align-items-center justify-content-center left-one">
            <a class="d-block" href="{{route('home')}}"><h1 class="display-4 text-white font-weight-bold cav">SHOP NOW</h1></a>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 d-flex align-items-center justify-content-center right-one">
            <a class="d-block" href="{{route('about')}}"><h1 class="display-4 text-white font-weight-bold cav">KNOW ABOUT US</h1></a>
        </div>
    </div>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.ripples/0.5.3/jquery.ripples.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="{{asset("camera-slider/camera.min.js")}}"></script>
<script src="{{asset("camera-slider/jquery.easing.1.3.js")}}"></script>
<script src="{{asset("lightbox/js/lightbox.min.js")}}"></script>
<script src="{{asset("js/jquery.matchHeight.js")}}"></script>
<script src="{{asset("js/jquery.magnify.js")}}"></script>
<script src="{{asset("js/price_range_script.js")}}"></script>
<script src="{{asset("js/main.js")}}"></script>
</body>
</html>
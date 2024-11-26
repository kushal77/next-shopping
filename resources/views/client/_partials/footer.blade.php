</div>
@if(Request::is('cart'))
<div class="modal fade login-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div id="modal-form">
                <div class="form-container sign-up-container">
                    <form action="{{ route('register') }}" method="POST">
                        <h1>Create Account</h1>
                        <input type="text" name="first_name" placeholder="Enter first name" required>
                        <input type="text" name="last_name" placeholder="Enter last name" required>
                        <input type="email" name="email" placeholder="Enter email" required>
                        <input type="password" name="password" placeholder="Enter password" required>
                        <input type="password" name="password_confirmation" placeholder="Re-enter password" required>
                        <button>Sign Up</button>
                    </form>
                </div>
                <div class="form-container sign-in-container">
                    <form action="{{route('login')}}" method="post">
                        @csrf
                        <input type="hidden" name="redirectTo" value="{{route('checkout')}}">
                        <h1>Sign in</h1>
                        <input type="email" name="email" placeholder="Email" />
                        <input type="password" name="password" placeholder="Password" />
                        <a href="{{ route('forgot-password') }}">Forgot your password?</a>
                        <button>Sign In</button>
                    </form>
                </div>
                <div class="overlay-container">
                    <div class="overlay">
                        <div class="overlay-panel overlay-left">
                            <h1>Welcome Back!</h1>
                            <p>To keep connected with us please login with your personal info</p>
                            <button class="ghost" id="signIn">Sign In</button>
                        </div>
                        <div class="overlay-panel overlay-right">
                            <h1>Hello, Friend!</h1>
                            <p>Enter your personal details and start journey with us</p>
                            <button class="ghost" id="signUp">Sign Up</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
<div class="modal fade cart-modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body text-center py-4 px-5">
                <div class="img-box">
                    <img src="{{asset("pics/cart-tick.png")}}" alt="#">
                </div>
                <h3 class="font-weight-bold red my-3 ">Congrats !!</h3>
                <h4>The item has been successfully added to your cart.</h4>
                <div class="modal-btn my-4 d-flex align-items-center justify-content-center">
                    <a class="button mr-3" href="{{route('cart')}}">Go To Cart</a>
                    <a class="button text-white" data-dismiss="modal">Continue Shopping</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade login-mobile mobile" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="bg py-5">
                <button style="outline:none" type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span class="text-white" aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form px-4" action="#" method="POST">
                <h3 class="text-center mt-5 mb-3">Login</h3>
                <h5>Email<sup class="red">*</sup></h5>
                <div class="input-group my-3 d-flex align-items-center">
                    <input type="email" placeholder="Email" class="form-control">
                    <i class="far p-3 fa-envelope"></i>
                </div>
                <h5>Password<sup class="red">*</sup></h5>
                <div class="input-group my-3 d-flex align-items-center">
                    <input type="password" placeholder="Password" class="form-control">
                    <i class="fas p-3 fa-lock"></i>
                </div>
                <div class="btns text-center">
                    <button class="button px-5 py-3" type="submit">Login</button>
                </div>
                <div class="forget my-4 d-flex align-items-center justify-content-between">
                    <label class="check-it">Remember me
                        <input type="checkbox" >
                        <span class="checkmark"></span>
                    </label>
                    <a data-toggle="modal" data-dismiss="modal" data-target=".reset-mobile" class="d-inline-block mb-2 red" href="#">Forgot password?</a>
                </div>
                <a href="#" title="Register" data-toggle="modal" data-dismiss="modal" data-target=".register-mobile" class="register-icon">
                    <i class="fas fa-user-plus"></i>
                </a>
            </form>
        </div>
    </div>
</div>


<div class="modal fade register-mobile mobile" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="bg py-5">
                <button style="outline:none" type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span class="text-white" aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form px-4" action="#" method="POST">
                <h3 class="text-center mt-5 mb-3">Register</h3>
                <h5>Name<sup class="red">*</sup></h5>
                <div class="input-group my-3 d-flex align-items-center">
                    <input type="text" placeholder="Full Name" class="form-control">
                    <i class="far p-3 fa-envelope"></i>
                </div>
                <h5>Email<sup class="red">*</sup></h5>
                <div class="input-group my-3 d-flex align-items-center">
                    <input type="email" placeholder="Email" class="form-control">
                    <i class="far p-3 fa-envelope"></i>
                </div>
                <h5>Password<sup class="red">*</sup></h5>
                <div class="input-group my-3 d-flex align-items-center">
                    <input type="password" placeholder="Password" class="form-control">
                    <i class="fas p-3 fa-lock"></i>
                </div>
                <div class="forget my-4 d-flex align-items-center justify-content-between">
                    <label class="check-it">I agree to the privacy policy.
                        <input type="checkbox" >
                        <span class="checkmark"></span>
                    </label>
                   <div class="btns">
                    <button class="button px-4 py-3" type="submit">Register</button>
                </div>
                </div>
                <a href="#" title="User Login" data-toggle="modal" data-dismiss="modal" data-target=".login-mobile" class="register-icon">
                    <i class="fas fa-user"></i>
                </a>
            </form>
        </div>
    </div>
</div>

<div class="modal fade reset-mobile mobile" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="bg py-5">
                <button style="outline:none" type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span class="text-white" aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form px-4" action="#" method="POST">
                <h3 class="text-center mt-5 mb-3">Reset Password</h3>
                <p class="text-center mb-3">Enter your account email to receive a link allowing you to reset your password.</p>
                <h5>Email<sup class="red">*</sup></h5>
                <div class="input-group my-3 d-flex align-items-center">
                    <input type="email" placeholder="Email" class="form-control">
                    <i class="far p-3 fa-envelope"></i>
                </div>
                <div class="btns text-center mb-4">
                    <button class="button px-5 py-3" type="submit">Reset Password</button>
                </div>
                <a href="#" title="Register" data-toggle="modal" data-dismiss="modal" data-target=".register-mobile" class="register-icon">
                    <i class="fas fa-user-plus"></i>
                </a>
            </form>
        </div>
    </div>
</div>
<div id="footer">
    <section class="footer py-5">
        <div class="container-fluid px-5">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="footer-logo">
                        <a href="index.php"> <img src="{{asset("pics/logo1.jpg")}}"></a>
                    </div>
                    <div class="container px-4">
                        <p class="my-3">{{$footer}}</p>
                        <div class="header-social-icons ">
                            <a href="{{$insta}}" style="color: #e4405f"> <i class="fab fa-instagram"></i></a>
                            <a href="{{$facebook}}" style="color: #3b5998"> <i class="fab fa-facebook-f"></i></a>
                            <a href="{{$twitter}}"  style="color: #00acee"> <i class="fab fa-twitter"></i></a>
                            <a href="{{$google}}" style="color: #dd4b39"> <i class="fab fa-google-plus-g"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 popular-tags">
                    <h4 class="font-weight-bold my-2">Popular Tags</h4>
                    <div class="tags">
                        @foreach($tags as $tag)
                            <a href="#">{{$tag->tag}}</a>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 newsletter">
                    <h4 class="font-weight-bold my-2">Newsletter</h4>
                    <div class="sign-up">
                        <h5 class="mb-3">Sign up to the newsletter</h5>
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="Your e-mail address">
                        </div>
                        <button class="button" type="submit">SIGN UP</button>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 image d-none d-md-block">
                    <img src="{{asset("pics/footer-img.jpg")}}">
                </div>
            </div>
        </div>
    </section>
    <section class="copyright">
        <div class="container-fluid px-5 d-flex align-items-center justify-content-between flex-wrap">
            <p class="text-white py-3">Copyright &copy; <a href="#" target="_blank">Next Shopping</a> 2024. Designed by <a href="https://kusal.com" target="_blank">Kushal</a></span> All rights reseved.</p>
            <div class="cards py-3">
                <img src="{{asset("pics/visa.png")}}" alt="#">
                <img src="{{asset("pics/mastercard.png")}}" alt="#">
                <img src="{{asset("pics/paypal.png")}}" alt="#">
                <img src="{{asset("pics/visa-electron.png")}}" alt="#">
                <img src="{{asset("pics/maestro.png")}}" alt="#">
                <img src="{{asset("pics/discover.png")}}" alt="#">
            </div>
        </div>
    </section>
</div>
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

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.hearderserach').on('click',function(){
        window.location.href='{{ url('/search') }}?brand='+$('#headersearchbrand').val()+'&&value='+$('#headersearchvalue').val();
    })
    $('.addtocart').on('click',function(e) {
        e.preventDefault();
        $('.cart-modal').modal('show');
        var item = $(this).data('item');
        var qty = 1;
        $.ajax({
            url: '{{ route('addtocart') }}',
            type: 'POST',
            data: {
                item: item,
                qty: qty,
            },
            beforeSend: function () {
                
            },
            success: function () {
                var count = parseInt($('.bagdecartcount').html()) +1;
                $('.bagdecartcount').html(count);
                $('.itemcartcount').html('('+count+') Item');
            }
        })
    })
</script>

@yield('script')

</body>
</html>

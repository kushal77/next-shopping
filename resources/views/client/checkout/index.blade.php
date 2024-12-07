@extends('client.master')

@section('content')

<section class="breadcrumbs py-4">
    <div class="container-fluid px-5">
        <h6><a href="{{route('home')}}">Home</a><i class="fas red mx-2 fa-chevron-right"></i>Checkout</h6>
    </div>
</section>


<section class="checkout py-4">
    <div class="container-fluid px-5 detail-box">
        <form action="{{route('saveorder')}}" method="post" id="saveorder">
            @csrf
            <div class="row">
                <div class="col-lg-6 col-md-6 py-4">
                    <div class="card mb-5">
                        <div class="card-head d-flex align-items-center">
                            <i class="fas fa-user-plus"></i>
                            <h6 class="font-weight-bold">PERSONAL DETAILS</h6>
                        </div>
                        <div class="form p-3">
                            <div class="input-group mb-3">
                                <input class="form-control mr-3" type="text" placeholder="First Name*" name="first_name" value="{{auth()->user()->first_name}}" id="js_first_name" readonly>
                                <input class="form-control" type="text" placeholder="Last Name*" name="last_name" value="{{auth()->user()->last_name}}" id="js_last_name" readonly>
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="email" placeholder="E-mail*" name="email" value="{{auth()->user()->email}}" id="js_email" readonly>
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="number" placeholder="Phone no.*" name="phone_no" value="{{auth()->user()->phone_no}}" id="js_phone_no" @if(auth()->user()->phone_no) readonly @endif>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-5">
                        <div class="card-head d-flex align-items-center">
                                <i class="fas fa-map-marker-alt"></i>
                            <h6 class="font-weight-bold">SHIPPING ADDRESS</h6>
                        </div>
                        @php
                            $shipping_address = json_decode(auth()->user()->shipping_address);
                        @endphp
                        <div class="form p-3">
                            <div class="form-group">
                                @php
                                    $sRegion = isset($shipping_address->region) && $shipping_address->region != null ? $shipping_address->region : 'null';
                                @endphp
                                <select class="form-control" name="region" id="js_region">
                                    <option class="bg-secondary" value="null" @if($sRegion == 'null') selected @endif> Region </option>
                                    @foreach(pluckRegionNames() as $region)
                                        <option value="{{ $region }}" @if($sRegion == $region) selected @endif>{{ $region }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                @php
                                    $sCity = isset($shipping_address->city) && $shipping_address->city != null ? $shipping_address->city : 'null';
                                @endphp
                                <select class="form-control" name="city" id="js_city">
                                    <option class="bg-secondary" value="null" @if($sCity == 'null') selected @endif> City</option>
                                    @foreach(pluckCityNames() as $city)
                                        <option value="{{ $city }}" @if($sCity == $city) selected @endif>{{ $city }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="text" placeholder="Address*" name="address"  value="{{ auth()->user()->address }}" id="js_address">
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="number" placeholder="Post Code*" name="post_code" value="{{ auth()->user()->post_code }}" id="js_post_code">
                            </div>
                        </div>
                    </div>
                    <div class="card mb-5">
                        <div class="card-head d-flex align-items-center">
                            <i class="fas fa-location-arrow"></i>
                            <h6 class="font-weight-bold">SHIPPING METHOD</h6>
                        </div>
                        <div class="form p-3">
                            <h6><label class="input-group d-flex align-items-center"><input class="mr-3" type="radio" checked>Flat Shipping Rate - Rs.{{$shipping}}</label></h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="card my-4 mb-5">
                        <div class="card-head d-flex align-items-center">
                            <i class="fas fa-money-check-alt"></i>
                            <h6 class="font-weight-bold">PAYMENT METHOD</h6>
                        </div>
                        <div class="form p-3">
                            <h6><label class="input-group d-flex align-items-center"><input class="mr-3" type="radio" checked>Cash on Delivery</label></h6>
                        </div>
                    </div>
                    <div class="card mb-5 d-none d-md-block">
                        <div class="card-head d-flex align-items-center">
                            <i class="fas fa-shopping-cart"></i>
                            <h6 class="font-weight-bold">SHOPPING CART</h6>
                        </div>
                        <div class="shopping-cart-title p-3 ">
                            <div class="row no-gutters mx-1">
                                <div class="col-lg-6">
                                    <h6 class="title">PRODUCT NAME</h6>
                                    @php $emishow = false; @endphp
                                    @foreach($cartlists->cartdetails as $cartdetail)
                                        @php if($cartdetail->product->emi){ $emishow = true; } @endphp
                                        <div data-mh="e1" class="content d-flex align-items-center">
                                           <a href="{{route('view.product',$cartdetail->product->alias)}}">
                                                <img src="{{asset('images/product/'.$cartdetail->product->images[0]->image)}}" alt="#">
                                            </a>
                                            <h6>
                                                <a href="{{route('view.product',$cartdetail->product->alias)}}"> 
                                                    {{$cartdetail->product->title}}
                                                </a> 
                                            </h6>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="col-lg-2">
                                    <h6 class="title">QUANTITY</h6>
                                    @foreach($cartlists->cartdetails as $cartdetails)
                                        <div data-mh="e1" class="content d-flex align-items-center">
                                            <input type="number" value="{{$cartdetails->quantity}}" class="text-center" readonly>
                                            {{-- <div class="edit">
                                                <i class="far d-block m-2 fa-trash-alt"></i>
                                                <i class="fas d-block m-2 fa-sync-alt"></i>
                                            </div> --}}
                                        </div>
                                    @endforeach
                                </div>
                                <div class="col-lg-2">
                                    <h6 class="title">UNIT PRICE</h6>
                                    @foreach($cartlists->cartdetails as $cartdetails)
                                        <div data-mh="e1" class="content d-flex align-items-center">
                                            <h6>Rs.{{$cartdetails->net_price}}</h6>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="col-lg-2">
                                    <h6 class="title">TOTAL</h6>
                                    @foreach($cartlists->cartdetails as $cartdetails)
                                        <div data-mh="e1" class="content d-flex align-items-center">
                                            <h6>Rs.{{$cartdetails->total}}</h6>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="row mx-1 no-gutters sub-total">
                                <div class="col-lg-6">
                                    <h6 class="my-2 text-muted font-weight-bold pl-2">SUB-TOTAL:</h6>
                                </div>
                                <div class="col-lg-2 offset-lg-4">
                                    <h6 class="my-2">Rs. {{$cartlists->sub_total}}</h6>
                                </div>
                                <div class="col-lg-6">
                                    <h6 class="my-2 text-muted font-weight-bold pl-2">DISCOUNT (COUPON):</h6>
                                </div>
                                <div class="col-lg-2 offset-lg-4">
                                    <h6 class="my-2">Rs. {{$cartlists->discount}}</h6>
                                </div>
                                <div class="col-lg-6">
                                    <h6 class="my-2 text-muted font-weight-bold pl-2">ESTIMATE SHIPPING:</h6>
                                </div>
                                <div class="col-lg-2 offset-lg-4">
                                    <h6 class="my-2">Rs. {{$shipping}}</h6>
                                </div>
                                <div class="col-lg-6">
                                    <h6 class="my-2 text-muted font-weight-bold pl-2">TOTAL:</h6>
                                </div>
                                <div class="col-lg-2 offset-lg-4">
                                    <h6 class="my-2 red">Rs. {{$cartlists->total + $shipping}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($emishow)
                    <div class="card">
                        <div class="card-head d-flex align-items-center">
                            <i class="fas fa-comment"></i>
                            <h6 class="font-weight-bold">EMI</h6>
                        </div>
                        <div class="form p-3">
                            <h6><label class="input-group d-flex align-items-center"><input class="mr-3" type="checkbox" name="emi">EMI</label></h6>
                        </div>
                    </div>
                    @endif
                    <label class="check-it my-4">
                        I have read and agree to the <a href="{{route('page','terms')}}">Terms & Condition</a>
                        <input type="checkbox" id="terms">
                        <span class="checkmark"></span>
                    </label>
                    <label class="check-it termsmessage" style="padding-left: 0px;color: #e11515;display: none;">You need to accept terms and condition to confirm order</label>
                    <a href="#" class="button d-inline-block confirmorder">CONFIRM ORDER</a>
                </div>
            </div>
        </form>
    </div>
</section>

@endsection

@section('script')
    <script type="text/javascript">
        $('.confirmorder').on('click',function(e){
            e.preventDefault();
            $('.termsmessage').hide();
            if($('#terms').is(":checked")){
                let first_name = $('#js_first_name').val();
                let last_name = $('#js_last_name').val();
                let email = $('#js_email').val();
                let phone_no = $('#js_phone_no').val();
                let dob = $('#js_dob').val();

                let region = $('#js_region').val();
                let city = $('#js_city').val();
                let address = $('#js_address').val();
                let post_code = $('#js_post_code').val();

                if (validate(first_name, last_name, email, region, city, address, post_code)) {
                    $('#saveorder').submit();
                }
            }else{
                $('.termsmessage').show();
            }
        })
        function validate(first_name, last_name, email, region, city, address, post_code) {
            let validated = true;
            if (first_name.length < 1) {
                $('#js_first_name').addClass('bg-danger');
                validated = false;
            } else {
                $('#js_first_name').removeClass('bg-danger');
            }

            if (last_name.length < 1) {
                $('#js_last_name').addClass('bg-danger');
                validated = false;
            } else {
                $('#js_last_name').removeClass('bg-danger');
            }

            if (email.length < 1) {
                $('#js_email').addClass('bg-danger');
                validated = false;
            } else {
                let regex = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
                if (!regex.test(String(email).toLowerCase())) {
                    $('#js_email').addClass('bg-danger');
                    validated = false;
                } else {
                    $('#js_email').removeClass('bg-danger');
                }
            }

            if (region == 'null') {
                $('#js_region').addClass('bg-danger');
                validated = false;
            } else {
                $('#js_region').removeClass('bg-danger');
            }

            if (city == 'null') {
                $('#js_city').addClass('bg-danger');
                validated = false;
            } else {
                $('#js_city').removeClass('bg-danger');
            }

            if (address.length < 1) {
                $('#js_address').addClass('bg-danger');
                validated = false;
            } else {
                $('#js_address').removeClass('bg-danger');
            }

            if (post_code.length < 1) {
                $('#js_post_code').addClass('bg-danger');
                validated = false;
            } else {
                $('#js_post_code').removeClass('bg-danger');
            }

            return validated;
        }
    </script>
@endsection
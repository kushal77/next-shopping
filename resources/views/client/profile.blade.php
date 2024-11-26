@extends('client.master')

@section('content')

    <section class="dashboard py-5">
        <div class="container-fluid px-5">
            <h3>My Dashboard</h3>
            <div class="row">
                <div class="col-lg-3 col-md-3 py-4">
                    <ul class="nav nav-tabs flex-column" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link py-3 active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                               aria-controls="home" aria-selected="true">My Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link py-3" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                               aria-controls="profile" aria-selected="false">Change Password</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link py-3" id="edit-info-tab" data-toggle="tab" href="#edit-info" role="tab"
                               aria-controls="edit-info" aria-selected="false">Edit Information</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link py-3" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                               aria-controls="contact" aria-selected="false">My Orders</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-9 col-md-9 py-4">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row">
                                <div class="col-lg-6">
                                    <table class="table table-striped">
                                        <tbody>
                                        <tr>
                                            <th scope="row">Name</th>
                                            <td>{{ $user->getFullName() }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Email</th>
                                            <td>{{ $user->email }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Date Of Birth</th>
                                            <td>{{ $user->dob }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Phone No.</th>
                                            <td>{{ $user->phone_no }}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-lg-6">
                                    <table class="table table-striped">
                                        <tbody>
                                        @php
                                            $billing_address = json_decode($user->billing_address);
                                            $shipping_address = json_decode($user->shipping_address);
                                        @endphp
                                        <tr>
                                            <th scope="row">Billing Address</th>
                                            <td>
                                                {{ $user->address != null ? $user->address . ', ' : ''}}
                                                {{ isset($billing_address->city) && $billing_address->city != null ? $billing_address->city . ', ' : ''}}
                                                {{ isset($billing_address->region) && $billing_address->region != null ? $billing_address->region  : ''}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Shipping Address</th>
                                            <td>
                                                {{ $user->address != null ? $user->address . ', ' : '' }}
                                                {{ isset($shipping_address->city) && $shipping_address->city != null ? $shipping_address->city . ', ' : '' }}
                                                {{ isset($shipping_address->region) && $shipping_address->region != null ? $shipping_address->region : '' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Post Code</th>
                                            <td>{{ $user->post_code }}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="edit-info" role="tabpanel" aria-labelledby="edit-info-tab">
                            <section class="checkout">
                                <div class="detail-box">
                                    <div class="confirmation-mail">
                                        <p class="mb-2 p-3 success" style="display: none;"
                                           id="js_update_profile_success"></p>
                                        <p class="mb-2 p-3 danger" style="display: none;"
                                           id="js_update_profile_failed"></p>
                                    </div>
                                    <form action="#">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="card mb-5">
                                                    <div class="card-head d-flex align-items-center">
                                                        <i class="fas fa-user-plus"></i>
                                                        <h6 class="font-weight-bold">PERSONAL DETAILS</h6>
                                                    </div>
                                                    <div class="form p-3">
                                                        <div class="input-group mb-3">
                                                            <input class="form-control mr-3" type="text"
                                                                   name="first_name"
                                                                   placeholder="First Name*" id="js_first_name"
                                                                   value="{{ $user->first_name }}">
                                                            <input class="form-control" type="text" name="last_name"
                                                                   placeholder="Last Name*" id="js_last_name"
                                                                   value="{{ $user->last_name }}">
                                                        </div>
                                                        <div class="input-group mb-3">
                                                            <input class="form-control" type="email" name="email"
                                                                   placeholder="E-mail*" id="js_email"
                                                                   value="{{ $user->email }}">
                                                        </div>
                                                        <div class="input-group mb-3">
                                                            <input class="form-control mr-3" type="number"
                                                                   name="phone_no"
                                                                   placeholder="Phone no." id="js_phone_no"
                                                                   value="{{ $user->phone_no }}">
                                                            <input class="form-control" type="date" name="dob"
                                                                   placeholder="Date Of Birth" id="js_dob"
                                                                   value="{{ $user->dob }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card mb-5">
                                                    <div class="card-head d-flex align-items-center">
                                                        <i class="fas fa-map-marker-alt"></i>
                                                        <h6 class="font-weight-bold">SHIPPING ADDRESS</h6>
                                                    </div>
                                                    <div class="form p-3">
                                                        <div class="input-group mb-3">
                                                            @php
                                                                $sRegion = isset($shipping_address->region) && $shipping_address->region != null ? $shipping_address->region : 'null';
                                                            @endphp
                                                            <select class="form-control mr-3" name="region"
                                                                    id="js_region">
                                                                <option class="bg-secondary" value="null"
                                                                        @if($sRegion == 'null') selected @endif>
                                                                    Region
                                                                </option>
                                                                @foreach(pluckRegionNames() as $region)
                                                                    <option value="{{ $region }}"
                                                                            @if($sRegion == $region) selected @endif>{{ $region }}</option>
                                                                @endforeach
                                                            </select>

                                                            @php
                                                                $sCity = isset($shipping_address->city) && $shipping_address->city != null ? $shipping_address->city : 'null';
                                                            @endphp
                                                            <select class="form-control" name="city" id="js_city">
                                                                <option class="bg-secondary" value="null"
                                                                        @if($sCity == 'null') selected @endif>
                                                                    City
                                                                </option>
                                                                @foreach(pluckCityNames() as $city)
                                                                    <option value="{{ $city }}" @if($sCity == $city) selected @endif>{{ $city }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="input-group mb-3">
                                                            <input class="form-control mr-3" type="text" name="address"
                                                                   placeholder="Address*" id="js_address"
                                                                   value="{{ $user->address }}">

                                                            <input class="form-control" type="number" name="post_code"
                                                                   placeholder="Post Code*" id="js_post_code"
                                                                   value="{{ $user->post_code }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <a href="javascript:;" class="button d-inline-block"
                                                   id="js_update_profile_button">Update Profile</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </section>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="checkout row">
                                <div class="detail-box col-lg-6">
                                    <div class="confirmation-mail">
                                        <p class="mb-2 p-3 success" style="display: none;"
                                           id="js_change_password_success"></p>
                                        <p class="mb-2 p-3 danger" style="display: none;"
                                           id="js_change_password_failed"></p>
                                    </div>
                                    <div class="card">
                                        <div class="card-head d-flex align-items-center">
                                            <i class="fas fa-user-plus"></i>
                                            <h6 class="font-weight-bold">Change Password</h6>
                                        </div>
                                        <div class="form p-3">
                                            <div class="form-group">
                                                <input class="form-control" type="password" name="password"
                                                       placeholder="Old Password" id="js_old_password">
                                            </div>
                                            <div class="form-group">
                                                <input class="form-control" type="password" name="password"
                                                       placeholder="New Password" id="js_new_password">
                                            </div>
                                            <div class="form-group">
                                                <input class="form-control" type="password" name="password"
                                                       placeholder="Re-type Password" id="js_new_password_confirm">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 d-flex align-items-end">
                                    <a href="javascript:;" class="button d-inline-block" id="js_update_password_button">Update
                                        Password</a>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            @foreach($orders as $order)
                                <div class="orderdetails">
                                    <div class="order-number d-flex align-items-center justify-content-between">
                                        <p>Order Number: <b>{{$order->order_number}}</b></p>
                                        {{-- <button id="print" class="button px-4 py-3"><i class="fas fa-print mr-2"></i>Print</button> --}}
                                    </div>
                                    <hr>
                                    <div class="order-status">
                                        <p class="mb-3">
                                            Order status: 
                                            <b>Arriving {{Carbon\Carbon::parse($order->expected_delivery)->format('M jS')}}</b>
                                        </p>
                                        <div class="process-line d-flex align-items-center justify-content-between mb-3">
                                            
                                            @if($order->status==0)
                                                <span><i class="fas fa-check"></i></span>
                                                <div class="line line1" style="background: none!important;"></div>
                                                <span>2</span>
                                                <div class="line line2" style="background: none!important;"></div>
                                                <span>3</span>
                                            @elseif($order->status=1)
                                                <span><i class="fas fa-check"></i></span>
                                                <div class="line line1"></div>
                                                <span><i class="fas fa-check"></i></span>
                                                <div class="line line2" style="background: none!important;"></div>
                                                <span>3</span>
                                            @else
                                                <span><i class="fas fa-check"></i></span>
                                                <div class="line line1"></div>
                                                <span><i class="fas fa-check"></i></span>
                                                <div class="line line1"></div>
                                                <span><i class="fas fa-check"></i></span>
                                            @endif
                                        </div>
                                        <div class="line-info flex-wrap d-flex align-items-center justify-content-between mb-5">
                                            <p>ORDER CONFIRMED <br>
                                                {{Carbon\Carbon::parse($order->created_at)->format('H:i A, M d,Y')}}
                                            </p>
                                            <p>SHIPPING 
                                                @if($order->status>=1)
                                                    <br> {{Carbon\Carbon::parse($order->upatd_date)->format('M jS')}}
                                                @endif
                                            </p>
                                            <p>TO DELIVER <br> Estimated Date: {{Carbon\Carbon::parse($order->expected_delivery)->format('M jS')}}</p>
                                        </div>
                                    </div>
                                    <div class="checkout">
                                        <div class="detail-box order-list">
                                            <div class="card mb-5">
                                                <div class="card-head d-flex align-items-center">
                                                    <i class="fas fa-shopping-cart"></i>
                                                    <h6 class="font-weight-bold">ITEMS ORDERED</h6>
                                                </div>
                                                <div class="shopping-cart-title p-3 ">
                                                    <div class="row no-gutters mx-1">
                                                        <div class="col-lg-6 col-md-6">
                                                            <h6 class="title">PRODUCT NAME</h6>
                                                            @foreach($order->detail as $cartdetail)
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
                                                        <div class="col-lg-2 col-md-2">
                                                            <h6 class="title">QUANTITY</h6>
                                                            @foreach($order->detail as $detail)
                                                                <div data-mh="e1" class="content d-flex align-items-center">
                                                                    <input type="number" value="{{$detail->quantity}}" class="text-center" readonly>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                        <div class="col-lg-2 col-md-2">
                                                            <h6 class="title">UNIT PRICE</h6>
                                                            @foreach($order->detail as $detail)
                                                                <div data-mh="e1" class="content d-flex align-items-center">
                                                                    <h6>Rs.{{$detail->net_price}}</h6>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                        <div class="col-lg-2 col-md-2">
                                                            <h6 class="title">TOTAL</h6>
                                                            @foreach($order->detail as $detail)
                                                                <div data-mh="e1" class="content d-flex align-items-center">
                                                                    <h6>Rs.{{$detail->total}}</h6>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    <div class="row mx-1 no-gutters sub-total">
                                                        <div class="col-lg-6">
                                                            <h6 class="my-2 text-muted font-weight-bold pl-2">SUB-TOTAL:</h6>
                                                        </div>
                                                        <div class="col-lg-2 offset-lg-4">
                                                            <h6 class="my-2">Rs. {{$order->net_price}}</h6>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <h6 class="my-2 text-muted font-weight-bold pl-2">DISCOUNT (COUPON):</h6>
                                                        </div>
                                                        <div class="col-lg-2 offset-lg-4">
                                                            <h6 class="my-2">Rs. {{$order->discount}}</h6>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <h6 class="my-2 text-muted font-weight-bold pl-2">ESTIMATED SHIPPING:</h6>
                                                        </div>
                                                        <div class="col-lg-2 offset-lg-4">
                                                            <h6 class="my-2">Rs. {{$order->shipping}}</h6>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <h6 class="my-2 text-muted font-weight-bold pl-2">TOTAL:</h6>
                                                        </div>
                                                        <div class="col-lg-2 offset-lg-4">
                                                            <h6 class="my-2 red">Rs. {{$order->total}}</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('script')
    <script type="text/javascript">
        $(function () {
            $('#js_update_password_button').on('click', function () {
                let old_password = $('#js_old_password').val();
                let new_password = $('#js_new_password').val();
                let new_password_confirm = $('#js_new_password_confirm').val();

                if (validate(old_password, new_password, new_password_confirm)) {
                    $.ajax({
                        url: '{{ route('ajax.change.password') }}',
                        type: 'POST',
                        data: {old_password: old_password, new_password: new_password},
                        beforeSend: function () {
                            $('#js_update_password_button').text('Updating...').attr('disabled', true);
                        },
                        success: function (response) {
                            if (response.response == true && response.status == 200) {
                                $('#js_change_password_success').show().html('<i class="fas fa-check-circle mr-2 text-success"></i>' + response.data);
                                $('#js_change_password_failed').hide();
                                $('#js_old_password, #js_new_password, #js_new_password_confirm').val('');
                            } else {
                                $('#js_change_password_failed').show().html('<i class="fas fa-times-circle mr-2 text-danger"></i>' + response.data);
                                $('#js_change_password_success').hide();
                            }
                            $('#js_update_password_button').text('Update Password').attr('disabled', false);
                        }
                    });
                }
            });

            function validate(old_password, new_password, new_password_confirm) {
                let validated = true;
                if (old_password.length < 1) {
                    $('#js_old_password').addClass('bg-danger');
                    validated = false;
                } else {
                    $('#js_old_password').removeClass('bg-danger');
                }

                if (new_password.length < 1) {
                    $('#js_new_password').addClass('bg-danger');
                    validated = false;
                } else {
                    $('#js_new_password').removeClass('bg-danger');
                }

                if (new_password_confirm.length < 1) {
                    $('#js_new_password_confirm').addClass('bg-danger');
                    validated = false;
                } else {
                    $('#js_new_password_confirm').removeClass('bg-danger');
                }

                if (new_password !== new_password_confirm) {
                    $('#js_new_password, #js_new_password_confirm').addClass('bg-danger');
                    validated = false
                }

                return validated;
            }
        });
    </script>

    <script type="text/javascript">
        $(function () {
            $('#js_update_profile_button').on('click', function () {
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
                    $.ajax({
                        url: '{{ route('ajax.update.profile') }}',
                        type: 'POST',
                        data: {
                            first_name: first_name,
                            last_name: last_name,
                            email: email,
                            phone_no: phone_no,
                            dob: dob,
                            region: region,
                            city: city,
                            address: address,
                            post_code: post_code
                        },
                        beforeSend: function () {
                            $('#js_update_profile_button').text('Updating...').attr('disabled', true);
                        },
                        success: function (response) {
                            if (response.response == true && response.status == 200) {
                                $('#js_update_profile_success').show().html('<i class="fas fa-check-circle mr-2 text-success"></i>' + response.data);
                                $('#js_update_profile_failed').hide();
                            } else {
                                $('#js_update_profile_failed').show().html('<i class="fas fa-times-circle mr-2 text-danger"></i>' + response.data);
                                $('#js_update_profile_success').hide();
                            }
                            $('#js_update_profile_button').text('Update Profile').attr('disabled', false);
                        }
                    });
                }
            });

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
        });
    </script>
@endsection

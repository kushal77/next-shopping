@extends('client.master')

@section('content')

<section class="confirm-order py-5">
    <div class="container-fluid px-5">
        <div class="row">
            <div class="col-lg-8 col-md-8 py-4">
                <div class="left-side p-4">
                    <h1 class="font-weight-bold">Thank You For Your Order</h1>
                    <hr>
                    <div class="row">
                        <div class="col-lg-7 col-md-7 pt-4">
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <th class="text-muted" scope="row">Order Number</th>
                                        <td>{{$order->order_number}}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted" scope="row">Order Date</th>
                                        <td>{{Carbon\Carbon::parse($order->created_at)->format('D M d Y')}}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted" scope="row">Cutomer</th>
                                        <td>{{$order->user->first_name}} {{$order->user->last_name}}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted" scope="row">Contact Number</th>
                                        <td>{{$order->user->phone_no}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        {{-- <div class="col-lg-5 col-md-5 pt-3 d-flex align-items-center justify-content-end">
                            <button id="print" class="button px-4 py-3"><i class="fas fa-print mr-2"></i>Print</button>
                        </div> --}}
                        <div class="row">
                            <div class="col-lg-12 col-md-12 py-2">
                                <p class="m-3">Please keep the above number for your reference. </p>
                                <p class="m-3">A confirmation email will be sent to you shortly on {{$order->user->email}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 py-2">
                            <h5 class="font-weight-bold">Shipping Address</h5>
                            @php $shipping = json_decode($order->shipping_address); $billing = json_decode($order->billing_address); @endphp
                            <p class="my-2">{{$shipping->region}}</p>
                            <p class="my-2">{{$shipping->city}}</p>
                            <p class="my-2">{{$shipping->address}} {{$shipping->post_code}}</p>
                        </div>
                        <div class="col-lg-6 col-md-6 py-2">
                            <h5 class="font-weight-bold">Payment Method</h5>
                            <div class="input-group d-flex align-items-center">
                                <input class="mr-2" type="radio" checked name="payment"><p>Cash on Delivery</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 py-2">
                            <h5 class="font-weight-bold">Billing Address</h5>
                            <p class="my-2">{{$billing->region}}</p>
                            <p class="my-2">{{$billing->city}}</p>
                            <p class="my-2">{{$billing->address}} {{$billing->post_code}}</p>
                            
                        </div>
                        <div class="col-lg-6 col-md-6 py-2">
                            <h5 class="font-weight-bold">Shipping Days</h5>
                            <p class="my-2">{{$shippingdays}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 py-4">
                <div class="right-side">
                    <h5 class="font-weight-bold py-3 px-4">Order Summary</h5>
                    <div class="total py-4">
                        <div class="sub-total d-flex justify-content-between my-3 px-4">
                            <p class="text-muted font-weight-bold">SUB TOTAL :</p>
                            <p>Rs. {{$order->net_price}}</p>
                        </div><hr>
                        <div class="sub-total d-flex justify-content-between my-3 px-4">
                            <p class="text-muted font-weight-bold">ESTIMATE SHIPPING :</p>
                            <p>Rs. {{$order->shipping}}</p>
                        </div><hr>
                        <div class="sub-total d-flex justify-content-between my-3 px-4">
                            <p class="text-muted font-weight-bold">DISCOUNTS :</p>
                            <p>Rs. {{$order->discount}}</p>
                        </div><hr>
                        <div class="sub-total d-flex justify-content-between my-3 px-4">
                            <p class=" font-weight-bold">ORDER TOTAL :</p>
                            <p class="font-weight-bold">Rs. {{$order->total}}</p>
                        </div>
                    </div>
                </div>
                <div class="right-side mt-5">
                    <h5 class="font-weight-bold py-3 px-4">Items Ordered</h5>
                    <div class="total pb-4">
                        @foreach($order->detail as $key=>$detail)
                            <div class="item-ordered py-3">
                                <p class="my-3 text-center font-weight-bold">Arrives in {{$shippingdays}}</p>
                                <div class="row px-3">
                                    <div class="col-lg-4 col-md-4 py-2">
                                        <img src="{{asset('images/product/'.$detail->product->images[0]->image)}}" alt="{{$detail->product->title}}" class="img-fluid">
                                    </div>
                                    <div class="col-lg-8 col-md-8">
                                        <p class="my-2">{{$detail->product->title}}</p>
                                        <p class="my-2">{{$detail->quantity}} Unit</p>
                                        <p class="my-2">Rs. {{$detail->total}}</p>
                                    </div>
                                </div>
                            </div>
                            @if($key!=count($order->detail)-1)
                                <hr>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
@extends('client.master')
@section('title')
    {{$product->title}} | 
@endsection
@section('seo')
    @php
        $seo = json_decode($product->seo);
    @endphp
    <meta property="og:title" content="{{$seo->metatitle}}" />
    <meta name="twitter:title" content="{{$seo->metatitle}}">
    <meta property="og:description" content="{{$seo->metadesc}}">
    <meta name="description" content="{{$seo->metadesc}}">
    <meta name="twitter:description" content="{{$seo->metadesc}}">
    <meta property="og:image" content="{{asset('images/product/'.$product->images[0]->image)}}" />
    <meta property="og:url" content="{{route('view.product',$product->alias)}}" />
    <meta property="og:type" content="website" />
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:image" content="{{asset('images/product/'.$product->images[0]->image)}}">
    <meta name="twitter:site" content="Hitech">
    <meta name="twitter:creator" content="Hitech">
    <meta name="keywords" content="{{$seo->metakey}}">
@endsection
@section('content')

<section class="breadcrumbs py-4">
    <div class="container-fluid px-5">
        <h6><a href="{{route('home')}}">Home</a>@if($parentCategory!=null)<i class="fas red mx-2 fa-chevron-right"></i><a href="{{route('view.category',$parentCategory->alias)}}">{{$parentCategory->title}}</a>@endif @if($category!=null)<i class="fas red mx-2 fa-chevron-right"></i><a href="{{route('view.category',$category->alias)}}">{{$category->title}}</a>@endif<i class="fas red mx-2 fa-chevron-right"></i>{{$product->title}}</h6>
    </div>
</section>


<section class="detail-page py-5">
    <div class="container-fluid px-5">
        <div class="row">
            <div class="col-lg-4 col-md-4 py-3">
                <div class="img-box position-relative">
                    <a id="zoom-placeholder" href="{{asset('images/product/'.$product->images[0]->image)}}" class="MagicZoom" data-options="zoomPosition: #zoom-placeholder;selectorTrigger: hover;"><img src="{{asset('images/product/'.$product->images[0]->image)}}" class="img-fluid" alt="#"></a>
                </div>
                <div class="img-list text-center mt-4">
                    @foreach($product->images as $key=>$image)
                        <a data-zoom-id="zoom-placeholder" href="{{asset('images/product/'.$image->image)}}" data-image="{{asset('images/product/'.$image->image)}}"><img src="{{asset('images/product/'.$image->image)}}"></a>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-8 col-md-8 py-3">
                <div class="title px-5">
                    <h4 class="top">{{$product->description}}</h4>
                    <h6 class="my-4">Brand : <a class="text-muted" href="{{ route('view.brand',$product->brand->alias) }}"> {{$product->brand->title}}</a> <span class="font-weight-bold mx-2 text-muted">|</span> <a class="text-muted" href="{{ route('view.brand',$product->brand->alias) }}">More products from {{$product->brand->title}}</a></h6>
                    <hr>
                    <h5 class="my-3 d-inline-block">Total Price :</h5>
                    @if($product->discount > 0)
                        <h4 class="my-3 d-inline-block mx-2 red">{{$product->net_price}}</h4>
                        <h5 class="my-3 d-inline-block text-muted ml-3"><strike>{{$product->price}}</strike></h5>
                    @else
                        <h4 class="my-3 d-inline-block mx-2 red">{{$product->net_price}}</h4>
                    @endif
                    <div class="input-group plus-minus-input">
                        <h5 class="mr-4">Quantity</h5>
                        <div class="input-group-button">
                            <button type="button" class="hollow circle" data-quantity="minus" data-field="quantity" data-min="1">
                                <i class="fa fa-minus" aria-hidden="true"></i>
                            </button>
                        </div>
                        <input class="input-group-field mx-2" type="number" id="quantity" name="quantity" value="1" readonly>
                        <div class="input-group-button">
                            <button type="button" class="hollow circle" data-quantity="plus" data-field="quantity" data-max="{{$product->quantity}}">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                    <div class="input-group">
                        <div class="cart my-5">
                            <a class="button px-4 py-3 detailaddtocart" data-item="{{encrypt($product->id)}}" data-type="1">Add to Cart</a>
                        </div>
                        <div class="buy-now my-5">
                            <a class="button px-4 py-3 detailaddtocart" data-item="{{encrypt($product->id)}}" data-type="2">Buy Now</a>
                        </div>
                    </div>
                </div>

                <div class="description ">
                    <h5 class=" px-5 py-4 text-white">Specifications of {{$product->title}}</h5>
                        <ul class="list-unstyled">
                            <div class="row py-4 px-5">
                                <div class="col-lg-6">
                                    <li class="head font-weight-bold">Brand</li>
                                    <li class="mb-3">{{$product->brand->title}}</li>
                                </div>
                                @php $customs = json_decode($product->custom); @endphp
                                @if(isset($customs))
                                    @foreach($customs as $key=>$custom)
                                        @if($custom->value)
                                            <div class="col-lg-6">
                                                <li class="head font-weight-bold">{{$key}}</li>
                                                <li class="mb-3">{{$custom->value}}</li>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                       
                    </div>
                </div>
          </div>    
        </div>
    </div>

</section>
@if($product->emi)
    <section class="emi-content">
        <div class="container-fluid px-5">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <h5 class="py-3 px-5">EMI Description</h5>
                    <div class="emi-des px-5 py-4">
                        {{$product->emi_description}}
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 emi-calc">
                    <h5 class="py-3 px-5">EMI Calculator</h5>
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="input-group my-2">
                                @php
                                    $amount = $product->net_price - $product->net_price*($product->downpayment/100);
                                @endphp
                                <input type="number" placeholder="Enter Loan Amount" class="form-control" name="amount" id="amount" value="{{$amount}}" required> 
                            </div>
                            <div class="input-group my-2">
                                <select class="form-control" name="months" id="months" required style="background-color: black;color: white;border: 1px solid #070707;">
                                    <option value="">Select Loan Months</option>
                                    @foreach($emirates as $emirate)
                                        <option value="{{$emirate->months}}">{{$emirate->months}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-group my-2">
                                <input type="number" placeholder="Enter Intrest Rate" class="form-control" name="rate" id="rate" disabled>
                            </div>
                            <button class="button px-5 py-4 mt-3" id="calculate">Calculate</button>
                        </div>
                        <div class="col-lg-7">
                            <div class="card text-center my-2 py-4">
                                <h6 class="text-white font-weight-bold my-3">LOAN EMI</h6>
                                <h4 class="loanemi">0</h4>
                                <h6 class="text-white font-weight-bold my-3">Total Interest Payable</h6>
                                <h4 class="interest">0</h4>
                                <h6 class="text-white font-weight-bold my-3">Total Payment<br>
                                (Principal + Interest)</h6>
                                <h4 class="amount">0</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif

<section class="related-products py-5">
    @if(count($relatedProducts) > 0)
    <div class="container-fluid px-5 newest-product">
        <h3 class="font-weight-bold">Related Products</h3>
        <div class="row py-5">
            @foreach($relatedProducts as $product)
                <div class="col-lg-3 col-md-4 col-sm-6 py-3">
                    <div class="card">
                        <a href="{{route('view.product',$product->alias)}}" class="card-img">
                            <div class="img-box p-3">
                                <img src="{{asset('images/product/'.$product->images[0]->image)}}">
                            </div>
                            <div class="cart-detail">
                                <a href="{{route('view.product',$product->alias)}}" class="button details text-white my-2">View Details</a>
                                <a class="button cart text-white my-2 addtocart" data-item="{{encrypt($product->id)}}">Add to Cart</a>
                            </div>
                        </a>
                        <div class="card-text p-4" data-mh="eq">
                            <h6 class="font-weight-bold"><a href="{{route('view.product',$product->alias)}}" data-toggle="tooltip" title="{{$product->title}}">{{$product->title}}</a></h6>
                            @if($product->discount > 0)
                                <h5 class="price red d-inline-block my-2 mr-3">{{$product->discount}}</h5>
                                <h5 class="text-muted d-inline-block"><strike>{{$product->price}}</strike></h5> 
                            @else
                                <h5 class="price red d-inline-block my-2 mr-3">{{$product->price}}</h5>
                            @endif
                        </div> 
                        @if($product->quantity < 1)
                            <h6 class="emi emi-off text-white text-center p-2">OUT OF STOCK !!!</h6>
                        @elseif($product->emi==1)
                            <h6 class="emi emi-available text-white text-center p-2">EMI AVAILABLE !!!</h6>
                        @else
                            <h6 class="emi emi-available text-white text-center p-2">PRODUCT IN STOCK !!!</h6>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @endif
</section>

@endsection

@section('script')
    <script type="text/javascript">
        jQuery(document).ready(function(){
            // This button will increment the value
            $('[data-quantity="plus"]').click(function(e){
                // Stop acting like a button
                e.preventDefault();
                // Get the field name
                fieldName = $(this).attr('data-field');
                maxvalue = $(this).attr('data-max');
                // Get its current value
                var currentVal = parseInt($('input[name='+fieldName+']').val());
                // If is not undefined
                if (!isNaN(currentVal)) {
                    if(maxvalue!=currentVal){
                        // Increment
                        $('input[name='+fieldName+']').val(currentVal + 1);
                    }
                } else {
                    // Otherwise put a 0 there
                    $('input[name='+fieldName+']').val(0);
                }
            });
            // This button will decrement the value till 0
            $('[data-quantity="minus"]').click(function(e) {
                // Stop acting like a button
                e.preventDefault();
                // Get the field name
                fieldName = $(this).attr('data-field');
                minvalue = $(this).attr('data-min');
                // Get its current value
                var currentVal = parseInt($('input[name='+fieldName+']').val());
                // If it isn't undefined or its greater than 0
                if (!isNaN(currentVal) && currentVal > 0) {
                    // Decrement one
                    if(minvalue!=currentVal){
                        $('input[name='+fieldName+']').val(currentVal - 1);
                    }
                } else {
                    // Otherwise put a 0 there
                    $('input[name='+fieldName+']').val(0);
                }
            });
        });
        $('.detailaddtocart').on('click',function(e) {
            e.preventDefault();
            var type = $(this).data('type');
            if(type==1){
                $('.cart-modal').modal('show');
            }
            var item = $(this).data('item');
            var qty = $('#quantity').val();
            $.ajax({
                url: '{{ route('addtocart') }}',
                type: 'POST',
                data: {
                    item: item,
                    qty: qty,
                },
                beforeSend: function () {},
                success: function () {
                    if(type==1){
                        var count = parseInt($('.bagdecartcount').html())+parseInt(qty);
                        $('.bagdecartcount').html(count);
                        $('.itemcartcount').html('('+count+') Item');
                    }else{
                        location.href = '{{route('cart')}}';
                    }
                }
            })
        })
        @if($product->emi)
        $('#calculate').on('click',function(e){
            e.preventDefault();
            var amount = $('#amount').val() 
            var months = $('#months').val()
            var rate   = $('#rate').val()
            var maxvalue = {{$amount}}
            if(!amount){
                alert('Enter Loan Amount')
                return false;
            }
            if(!months){
                alert('Select Loan Months')
                return false;
            }
            if(!rate){
                return false;
            }
            if (amount > maxvalue) {
                alert('Loan Emi Amount Cannot Exceed '+maxvalue)
                return false;
            }
            var interest = amount*rate*months/100;
            var total = parseFloat(interest) + parseFloat(amount);
            $('.loanemi').html(amount);
            $('.interest').html(interest);
            $('.amount').html(total);
        });
        $('#months').on('change',function(e){
            e.preventDefault();
            var months = $(this).val();
            $.ajax({
                url: '{{ route('getrate') }}',
                type: 'POST',
                data: {
                    months: months
                },
                success: function (data) {
                    $('#rate').val(data.rate)
                }
            })
        });
        @endif
    </script>
@endsection
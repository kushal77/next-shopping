@extends('client.master')

@section('content')
    <section class="breadcrumbs py-4">
        <div class="container-fluid px-5">
            <h6><a href="{{route('home')}}">Home</a><i class="fas red mx-2 fa-chevron-right"></i>Shopping Cart</h6>
            <hr class="mt-4">
        </div>
    </section>
    <section class="cart pb-5">
        <div class="container-fluid px-5">
            @if($cart)
                <div class="confirmation-mail">
                    <p class="mb-2 p-3 success cartupdatemessage" style="display: none;">
                        <i class="fas fa-check-circle mr-2 text-success"></i>Your cart has been successfully updated.
                    </p>
                    <p class="mb-2 p-3 danger invalidecouponcode" style="display: none;">
                        <i class="fas fa-times-circle mr-2 text-danger"></i>Please enter a valid coupon code.
                    </p>
                    <p class="mb-2 p-3 success validcouponcode" style="display: none;"></p>
                </div>
                <div class="row">
                    <div class="col-lg-9 px-4 py-2">
                        <div class="row cart-title p-3 mb-1">
                            <div class="col-lg-3 col-md-3  offset-md-2 ">
                                <h6 class="font-weight-bold">ITEM(S)</h6>
                            </div>
                            <div class="col-lg-2 col-md-2 ">
                                <h6 class="font-weight-bold">PRICE</h6>
                            </div>
                            <div class="col-lg-3 col-md-3">
                                <h6 class="font-weight-bold pl-4">QUANTITY</h6>
                            </div>
                            <div class="col-lg-2 col-md-2 ">
                                <h6 class="font-weight-bold">TOTAL</h6>
                            </div>
                        </div>
                        @foreach($cart->cartdetails as $cartdetail)
                            <div class="itemlist">
                                <div class="row cart-content mt-2 p-3">
                                    <div class="col-lg-2  col-md-2 image  d-flex align-items-center">
                                        <a href="{{route('view.product',$cartdetail->product->alias)}}">
                                            <img src="{{asset('images/product/'.$cartdetail->product->images[0]->image)}}">
                                        </a>
                                    </div>
                                    <div class="col-lg-3  col-md-3 d-flex align-items-center">
                                        <a href="{{route('view.product',$cartdetail->product->alias)}}" data-toggle="tooltip" title="{{$cartdetail->product->title}}">
                                           {{str_limit($cartdetail->product->title,50)}} 
                                       </a>
                                    </div>
                                    <div class="col-lg-2  col-md-2  d-flex align-items-center">
                                        <h5 class="my-2 red">{{$cartdetail->currency}}. {{$cartdetail->net_price}}</h5>
                                    </div>
                                    <div class="col-lg-3  col-md-3  d-flex align-items-center">
                                        <div class="input-group plus-minus-input">
                                            <div class="input-group-button">
                                                <button type="button" class="hollow circle" data-quantity="minus" data-field="{{$cartdetail->product->alias}}" data-min="1" data-price="{{$cartdetail->product->net_price}}" data-item="{{$cartdetail->product->alias}}">
                                                    <i class="fa fa-minus" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                            <input class="input-group-field mx-2" type="number" name="quantity[{{$cartdetail->product->alias}}]" id="quantity{{$cartdetail->product->alias}}" value="{{$cartdetail->quantity}}" data-item="{{encrypt($cartdetail->id)}}" readonly>
                                            <div class="input-group-button">
                                                <button type="button" class="hollow circle" data-quantity="plus" data-field="{{$cartdetail->product->alias}}"  data-max="{{$cartdetail->product->quantity}}" data-price="{{$cartdetail->product->net_price}}" data-item="{{$cartdetail->product->alias}}">
                                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2  col-md-2  d-flex align-items-center">
                                        <h5 class="my-2" id="{{$cartdetail->product->alias}}toatalprice">
                                            {{$cartdetail->currency}}. {{$cartdetail->total}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="row edit p-3">
                                    <div class="col-lg-12 col-md-12 ">
                                        <a href="#" data-toggle="tooltip" title="Delete" class="removeitemcart" data-item="{{encrypt($cartdetail->id)}}" data-product="{{$cartdetail->product->alias}}" data-price="{{$cartdetail->net_price}}"><i class="far red fa-times-circle"></i></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        
                        <div class="row coupon-code mt-2 d-flex justify-content-between">

                            <div class=" apply my-2 d-flex align-items-center">
                                @if($cart->discount_code)
                                    <input type="text" class="form-control" id="couponcode" value="{{$cart->discount_code}}" readonly>
                                    <a href="#" class="danger button text-white applycouponcode" data-type="0">Remove Coupon</a>
                                @else
                                    <input type="text" class="form-control" id="couponcode" placeholder="Coupon Code" value="{{$cart->discount_code}}">
                                    <a href="#" class="danger button text-white applycouponcode" data-type="1">Apply Coupon</a>
                                @endif
                                <br>
                            </div>
                            <div class="update-cart my-2 d-flex align-items-center">
                                <a class="btns mr-2" href="{{route('home')}}">Back To Shopping</a>
                                <a href="#" class="success button text-white updatecart">Update Cart</a>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="row pt-2 mb-1">
                            <div class="summary col-lg-12">
                                <h6 class=" order-title text-center text-white font-weight-bold p-3">ORDER SUMMARY</h6>
                                <div class="order-content mt-2">
                                    <h6 class="d-flex align-items-center justify-content-between p-3">
                                        <p>Sub Total</p>
                                        <p class="cartsubtotal">Rs. {{$cart->sub_total}}</p>
                                    </h6>
                                    <h6 class="d-flex align-items-center justify-content-between p-3">
                                        <p>Discount (Coupon)</p>
                                        <p class="cartdiscount">Rs. {{$cart->discount}}</p>
                                    </h6>
                                    <h6 class="d-flex total red align-items-center justify-content-between p-3">
                                        <p>Total</p>
                                        <p class="carttotal">Rs. {{$cart->total}}</p>
                                    </h6>
                                    <input type="hidden" name="subtotal" id="subtotal" value="{{$cart->sub_total}}">
                                    <input type="hidden" name="total" id="total" value="{{$cart->total}}">
                                    <input type="hidden" name="discount" id="discount" value="{{$cart->discount}}">
                                </div>
                                @if(auth()->user())
                                    <a href="{{route('checkout')}}" class=" d-inline-block button mt-2">Proceed To Checkout</a>
                                @else
                                    <a href="{{route('checkout')}}" class=" d-inline-block button mt-2 gotocheckout">Proceed To Checkout</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <h3 style="text-align: center;">
                    Your Cart Is Empty <br>
                    <div class="detail-page" style="background:none;">
                        <div class="title">
                            <div class="buy-now my-5">
                                <a class="button px-4 py-3" href="{{route('home')}}" style="margin-left: 35%;margin-right: 35%;">Continue Shopping</a>
                            </div>
                        </div>
                    </div>
                </h3>
            @endif
        </div>
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
                var currentVal = parseInt($('input[name="quantity['+fieldName+']"]').val());
                // If is not undefined
                if (!isNaN(currentVal)) {
                    if(maxvalue!=currentVal){
                        // Increment
                        $('input[name="quantity['+fieldName+']"]').val(currentVal + 1);
                        var price = $(this).data('price');
                        var subtotal = $('#subtotal').val();
                        var total = $('#total').val();
                        subtotal = parseFloat(subtotal)+parseFloat(price);
                        total = parseFloat(total)+parseFloat(price);
                        if(subtotal - Math.floor(subtotal)!=0){
                            subtotal = subtotal.toFixed(2);
                        }
                        if(total - Math.floor(total)!=0){
                            total = total.toFixed(2);
                        }
                        var pricetotal = (currentVal+1)*price;
                        $('.cartsubtotal').html('Rs. '+subtotal);
                        $('.carttotal').html('Rs. '+total);
                        $('#subtotal').prop('value',subtotal);
                        $('#total').prop('value',total);
                        if(pricetotal - Math.floor(pricetotal)==0){
                            $('#'+$(this).data('item')+'toatalprice').html('Rs. '+pricetotal);
                        }else{
                            $('#'+$(this).data('item')+'toatalprice').html('Rs. '+pricetotal.toFixed(2));
                        }
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
                var currentVal = parseInt($('input[name="quantity['+fieldName+']"]').val());
                // If it isn't undefined or its greater than 0
                if (!isNaN(currentVal) && currentVal > 0) {
                    // Decrement one
                    if(minvalue!=currentVal){
                        $('input[name="quantity['+fieldName+']"]').val(currentVal - 1);
                        var price = $(this).attr('data-price');
                        var subtotal = $('#subtotal').val();
                        var total = $('#total').val();
                        subtotal = subtotal-price;
                        if(subtotal - Math.floor(subtotal)!=0){
                            subtotal = subtotal.toFixed(2);
                        }
                        total = total-price;
                        if(total - Math.floor(total)!=0){
                            total = total.toFixed(2);
                        }
                        var pricetotal = (currentVal-1)*price;
                        $('.cartsubtotal').html('Rs. '+subtotal);
                        $('.carttotal').html('Rs. '+total);
                        $('#subtotal').prop('value',subtotal);
                        $('#total').prop('value',total);
                        if(pricetotal - Math.floor(pricetotal)==0){
                            $('#'+$(this).data('item')+'toatalprice').html('Rs. '+pricetotal);
                        }else{
                            $('#'+$(this).data('item')+'toatalprice').html('Rs. '+pricetotal.toFixed(2));
                        }
                    }
                } else {
                    // Otherwise put a 0 there
                    $('input[name='+fieldName+']').val(0);
                }
            });
        });
        $('.removeitemcart').on('click',function(e){
            e.preventDefault();
            if(confirm("Are you sure you want to remove item from cart?")){
                var net_price = $(this).data('price');
                var fieldName = $(this).data('product');
                qty = $('input[name="quantity['+fieldName+']"]').val();
                var subtotal = $('#subtotal').val();
                var total = $('#total').val();
                var price = parseFloat(net_price) * parseInt(qty);
                subtotal = subtotal-price;
                if(subtotal - Math.floor(subtotal)!=0){
                    subtotal = subtotal.toFixed(2);
                }
                total = total-price;
                if(total - Math.floor(total)!=0){
                    total = total.toFixed(2);
                }
                $('.cartsubtotal').html('Rs. '+subtotal);
                $('.carttotal').html('Rs. '+total);
                $('#subtotal').prop('value',subtotal);
                $('#total').prop('value',total);
                $(this).parent().parent().parent().remove();
                var count = parseInt($('.bagdecartcount').html())-qty;
                $('.bagdecartcount').html(count);
                $('.itemcartcount').html('('+count+') Item');
                var item = $(this).data('item');
                $.ajax({
                    url: '{{ route('removeitemfromcart') }}',
                    type: 'POST',
                    data: {item: item},
                    success: function (data) {
                        if(data.cartItems==1){
                            location.href = '{{route('cart')}}';
                        }
                    }
                })
            }else{
                return false;
            }
        })
        $('.updatecart').on('click',function(e){
            $('.invalidecouponcode').hide();
            $('.cartupdatemessage').hide();
            $('.validcouponcode').hide();
            e.preventDefault();
            var items = {};
            var count = 0;
            $('input[name^="quantity"]').each(function(key) {
                items[$(this).data('item')] = $(this).val(); 
                count+=parseInt($(this).val());
            });
            $.ajax({
                url: '{{ route('updateitemincart') }}',
                type: 'POST',
                data: items,
                success: function () {
                    $('.bagdecartcount').html(count);
                    $('.itemcartcount').html('('+count+') Item');
                    $('.cartupdatemessage').show();
                    $('body,html').animate({
                        scrollTop : 0
                    }, 1000);
                }
            })
        })
        $('.applycouponcode').on('click',function(e){
            $('.invalidecouponcode').hide();
            $('.cartupdatemessage').hide();
            e.preventDefault();
            var code = $('#couponcode').val();
            var type = $(this).attr('data-type');
            if(code){
                $.ajax({
                    url: '{{ route('addcoupontocart') }}',
                    type: 'POST',
                    data: {code:code,type:type},
                    beforeSend:function(){
                        console.log(type);
                        if(type=='1'){
                            $('.applycouponcode').html('Applying Coupon')
                        }else{
                            $('.applycouponcode').html('Removing Coupon')
                        }
                    },
                    success: function (data) {
                        if(data.error){
                            $('.invalidecouponcode').show();
                            $('body,html').animate({
                                scrollTop : 0
                            }, 1000);
                        }else{
                            $('.validcouponcode').html('<i class="fas fa-check-circle mr-2 text-success"></i>'+data.success+'.');
                            $('.validcouponcode').show();
                            $('body,html').animate({
                                scrollTop : 0
                            }, 1000);
                            var total = $('#total').val();
                            if(type=='1'){
                                total = parseFloat(total) - parseFloat(data.discount); 
                                $('.cartdiscount').html('Rs. '+data.discount);
                                $('#couponcode').prop('readonly',true);
                                $('.applycouponcode').html('Remove Coupon')
                                $('.applycouponcode').attr('data-type',0);
                            }else{
                                total = parseFloat(total) + parseFloat(data.discount); 
                                $('.cartdiscount').html('Rs. 0');
                                $('#couponcode').prop('readonly',false);
                                $('.applycouponcode').html('Apply Coupon')
                                $('.applycouponcode').attr('data-type',1);
                            }
                            if(total - Math.floor(total)!=0){
                                total = total.toFixed(2);
                            }
                            $('.carttotal').html('Rs. '+total);

                            $('#total').prop('value',total);
                        }
                    }
                })
            }else{
                $('.invalidecouponcode').show();
                $('body,html').animate({
                    scrollTop : 0
                }, 1000);
            }
        })
        $('.gotocheckout').on('click',function(e){
            e.preventDefault();
            $('.login-modal').modal('show');
        })
    </script>
@endsection
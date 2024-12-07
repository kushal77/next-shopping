@extends('client.master')
@section('title')
    {{$category->title}} | 
@endsection
@section('seo')
    @php
        $seo = json_decode($category->seo);
    @endphp
    <meta property="og:title" content="{{$seo->metatitle}}" />
    <meta name="twitter:title" content="{{$seo->metatitle}}">
    <meta property="og:description" content="{{$seo->metadesc}}">
    <meta name="description" content="{{$seo->metadesc}}">
    <meta name="twitter:description" content="{{$seo->metadesc}}">
    <meta property="og:image" content="{{asset('images/category/'.$category->image)}}" />
    <meta property="og:url" content="{{route('view.category',$category->alias)}}" />
    <meta property="og:type" content="website" />
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:image" content="{{asset('images/category/'.$category->image)}}">
    <meta name="twitter:site" content="Hitech">
    <meta name="twitter:creator" content="Hitech">
    <meta name="keywords" content="{{$seo->metakey}}">
@endsection
@section('content')

<section class="breadcrumbs py-4">
    <div class="container-fluid px-5">
        <h6><a href="{{route('home')}}">Home</a>@if($parentCategory!=null)<i class="fas red mx-2 fa-chevron-right"></i><a href="{{route('view.category',$parentCategory->alias)}}">{{$parentCategory->title}}</a>@endif<i class="fas red mx-2 fa-chevron-right"></i>{{$category->title}}</h6>
        <hr class="mt-4">
    </div>
</section>
@if(count($brands)>0)
    <section class="catagory pb-5">
        <div class="container-fluid px-5">
            <div class="brand-box">
                @foreach($brands as $brand)
                    <a href="{{route('view.brand',$brand->alias)}}"><img src="{{asset('images/brand/'.$brand->image)}}"></a>
                @endforeach
            </div>
        </div>
    </section>
@endif
<section class="catagory-content">
    <div class="container-fluid px-5">
        <div class="row">
            <div class="col-lg-2 col-md-2 left-panel">
                <form id="leftSearchBlock">
                    @if(count($brands)>0)
                        <div class="brands">
                            <h5 class="my-4">Brand</h5>
                            <!-- <label class="check-it">All
                                <input type="checkbox" checked="checked">
                                <span class="checkmark"></span>
                            </label> -->
                            @foreach($brands as $key=>$brand)
                                @if($key<2)
                                    <label class="check-it">{{$brand->title}}
                                        <input type="checkbox" name="sidesearchbrand" value="{{$brand->alias}}">
                                        <span class="checkmark"></span>
                                    </label>
                                @else
                                    @if($key==2)
                                        <div class="collapse" id="more-brand">
                                    @endif
                                        <label class="check-it">{{$brand->title}}
                                            <input type="checkbox" name="sidesearchbrand" value="{{$brand->alias}}">
                                            <span class="checkmark"></span>
                                        </label>
                                    @if($key==count($brands)-1)
                                        </div>
                                        <a class="d-block view-brand red mt-4" data-toggle="collapse" href="#more-brand" role="button" aria-expanded="false" aria-controls="more-brand">View More</a>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                    @endif
                    <div class="catagories mt-5">
                        <h5 class="my-4">Category</h5>
                        <!-- <label class="check-it">All
                            <input type="checkbox" checked="checked">
                            <span class="checkmark"></span>
                        </label> -->
                        @if($parentCategory != null)
                            @foreach($parentCategory->childrens as $key => $childCategory)
                                @if($key < 2)
                                    <label class="check-it">{{$childCategory->title}}
                                        <input type="checkbox" name="sidesearchcategory" value="{{$childCategory->alias}}">
                                        <span class="checkmark"></span>
                                    </label>
                                @else
                                    @if($key == 2)
                                    <div class="collapse" id="more-cata">
                                    @endif
                                    <label class="check-it">{{$childCategory->title}}
                                        <input type="checkbox" name="sidesearchcategory" value="{{$childCategory->alias}}">
                                        <span class="checkmark"></span>
                                    </label>
                                    @if($key == count($parentCategory->childrens)-1)
                                    </div>
                                    <a class="d-block view-cata red mt-4" data-toggle="collapse" href="#more-cata" role="button" aria-expanded="false" aria-controls="more-cata">View More</a>
                                    @endif
                                @endif
                            @endforeach
                        @else
                            @foreach($category->childrens as $key=>$childCategory)
                                @if($key < 2)
                                    <label class="check-it">{{$childCategory->title}}
                                        <input type="checkbox" name="sidesearchcategory" value="{{$childCategory->alias}}">
                                        <span class="checkmark"></span>
                                    </label>
                                @else
                                    @if($key == 2)
                                    <div class="collapse" id="more-cata">
                                    @endif
                                    <label class="check-it">{{$childCategory->title}}
                                        <input type="checkbox" name="sidesearchcategory" value="{{$childCategory->alias}}">
                                        <span class="checkmark"></span>
                                    </label>
                                    @if($key == count($category->childrens)-1)
                                    </div>
                                    <a class="d-block view-cata red mt-4" data-toggle="collapse" href="#more-cata" role="button" aria-expanded="false" aria-controls="more-cata">View More</a>
                                    @endif
                                @endif
                            @endforeach
                        @endif
                    </div>
                    <div class="price-range-block">
                        <div class="price d-flex align-items-center justify-content-between mb-2">
                            <h6>Min Price</h6>
                            <h6>Max Price</h6>
                        </div>
                        <div class="input_wrap d-flex align-items-center justify-content-between mb-4">
                            <input min=0 max="90000" oninput="validity.valid||(value='0');" id="min_price" class="price-range-field left_field" />
                                
                            <!-- <span class="range_separator"></span> -->

                            <input min=0 max="90000" oninput="validity.valid||(value='90000');" id="max_price" class="price-range-field right_field" />
                        </div>
                        <div id="slider-range" class="price-filter-range" name="rangeInput"></div>
                        <button type="submit" class="button mt-3">Search</button>
                    </div>
                </form>
            </div>
            <div class="col-lg-10 col-md-10 right-panel">
                <div class="sort-by pt-5 px-5 d-flex flex-wrap align-items-center justify-content-between">
                    <div class="heading">
                        <h4 class="font-weight-bold">{{$category->title}}</h4>
                        <p class="my-3 text-muted">{{count($products)}} @if(count($products) <= 1) item @else items @endif found in {{$category->title}}</p>
                    </div>
                    <div class="sort d-flex align-items-center">
                        <p>Sort By:</p>
                        <select class="custom-select" name="choosetype" id="choosetype">
                            <option selected>Select Type</option>
                            <option value="hightolow">Price high to low</option>
                            <option value="lowtohigh">Price low to high</option>
                        </select>
                    </div>
                </div>
                <hr>
                <div class="row newest-product py-5 px-5">
                    @foreach($products as $product)
                        <div class="col-lg-4 col-md-6 py-3">
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
                                        <h5 class="price red d-inline-block my-2 mr-3">{{$product->currency}}. {{$product->net_price}}</h5>
                                        <h5 class="text-muted d-inline-block"><strike>{{$product->currency}}. {{$product->price}}</strike></h5> 
                                    @else
                                        <h5 class="price red d-inline-block my-2 mr-3">{{$product->currency}}. {{$product->net_price}}</h5>
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
                    {{ $products->links('client.pagination')}}
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
@section('script')
    <script type="text/javascript">
        var categoryAlias = "{{$category->alias}}";
        $('#leftSearchBlock').on('submit',function(e) {
            e.preventDefault();
            var brands = [];
            var category = [];
            var min = $('#min_price').val();
            var max = $('#max_price').val();
            $.each($("input[name='sidesearchbrand']:checked"),function(){
                brands.push($(this).val());
            })
           
            $.each($("input[name='sidesearchcategory']:checked"),function(){
                category.push($(this).val());
            })
            window.location.href='{{ url("/") }}/'+categoryAlias+'/category?brand='+brands.toString()+'&&category='+category.toString()+'&&min='+min+'&&max='+max;
        })

        $('#choosetype').on('change',function(e){
            e.preventDefault();
            var brands = [];
            var category = [];
            var min = $('#min_price').val();
            var max = $('#max_price').val();
            $.each($("input[name='sidesearchbrand']:checked"), function(){
                brands.push($(this).val());
            });

            $.each($("input[name='sidesearchcategory']:checked"), function(){
                category.push($(this).val());
            });
            var choosetype = $(this).val();
            window.location.href='{{ url("/") }}/'+categoryAlias+'/category?brand='+brands.toString()+'&&category='+category.toString()+'&&min='+min+'&&max='+max+'&&choosetype='+choosetype;
        })

        $("#slider-range").slider({
            range: true,
            orientation: "horizontal",
            min: {{$minprice}},
            max: {{$maxprice}},
            values: [{{$minprice}}, {{$maxprice}}],
            step: 1,
            slide: function (event, ui) {
                if (ui.values[0] == ui.values[1]) {
                    return false;
                }
                $("#min_price").val(ui.values[0]);
                $("#max_price").val(ui.values[1]);
            }
        });
        $("#min_price").val($("#slider-range").slider("values", 0));
        $("#max_price").val($("#slider-range").slider("values", 1));
        
    </script>
@endsection
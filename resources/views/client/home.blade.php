@extends('client.master')

@section('content')
	<section class="banner py-4">
	    <div class="container-fluid px-5">
	        <div class="row">
	            <div class="col-lg-3 col-md-3 d-none d-md-block">
	                <div class="brand-nav">
	                	@foreach($rightbrands as $rightbrand)
		                    <a class="drop-brand {{$rightbrand->alias}}" >{{$rightbrand->title}}</a>
		                    <div class="drop-content drop-{{$rightbrand->alias}} container p-4" style="background-image: url({{asset('images/brand/'.$rightbrand->cat_bg_image)}});">
		                        <div class="row">
		                        	@foreach($rightcategories as $key=>$rightcategory)
		                        		@if($key==0)
			                            	<div class="col-lg-6 col-md-6">
	                            		@else
	                            			<div class="col-lg-5 col-md-5 offset-lg-1">
	                            		@endif
			                                <h4 class="red mb-2">{{$rightcategory->title}}</h4>
			                                <ul class="list-unstyled">
			                                	@foreach($rightcategory->childrens as $chilcat)
			                                    	<li><a href="{{route('view.brand',[$rightbrand->alias])}}?category={{$chilcat->alias}}">{{$chilcat->title}}</a></li>
		                                    	@endforeach
			                                </ul>    
			                            </div>
		                            @endforeach
		                            <img src="{{asset('images/brand/'.$rightbrand->cat_image)}}">
		                        </div>
		                    </div>
	                    @endforeach
	                </div>
	            </div>
	            <div class="col-lg-9 col-md-9 slider">
	                <div class="slider_inner"> 
	                	@foreach($banners as $banner) 
	                    	<div data-thumb="{{asset('images/banner/'.$banner->image)}}" data-src="{{asset('images/banner/'.$banner->image)}}"></div>
	                    @endforeach
	                </div>
	            </div>
	        </div>
	    </div>
	</section>

	{{-- <section class="top-brands py-5">
	    <div class="container-fluid px-5">
	        <div class="row">
	            <div class="col-lg-4 col-md-4 py-4">
	                <a href="{{route('specialDeals')}}" class="card py-5 px-4" >
	                    <div class="row">
	                        <div class="col-lg-7 content" data-mh="eq">
	                            <h3 class="font-weight-bold">TOP HEADPHONES</h3>
	                            <h5 class="my-2 ">Feel The Sound</h5>
	                            <h6 class=" font-weight-bold">SHOP NOW <i class="fas ml-1 fa-caret-right"></i> </h6>
	                        </div>
	                            <img src="pics/top-headphones.png">
	                    </div>
	                </a>
	            </div>
	            <div class="col-lg-4 col-md-4 py-4">
	                <a href="{{route('specialDeals')}}" class="card py-5 px-4" >
	                    <div class="row">
	                        <div class="col-lg-7 content" data-mh="eq">
	                            <h3 class="font-weight-bold">IPHONE X</h3>
	                            <h5 class="my-2 ">The Only One</h5>
	                            <h6 class=" font-weight-bold">SHOP NOW <i class="fas ml-1 fa-caret-right"></i> </h6>
	                        </div>
	                            <img src="pics/iphone6.png">
	                    </div>
	                </a>
	            </div>
	            <div class="col-lg-4 col-md-4 py-4">
	                <a href="{{route('specialDeals')}}'" class="card py-5 px-4" >
	                    <div class="row">
	                        <div class="col-lg-7 content" data-mh="eq">
	                            <h3 class="font-weight-bold">MACBOOK PRO</h3>
	                            <h5 class="my-2 ">With Retina Display</h5>
	                            <h6 class=" font-weight-bold">SHOP NOW <i class="fas ml-1 fa-caret-right"></i> </h6>
	                        </div>
	                            <img src="pics/macbook.png">
	                    </div>
	                </a>
	            </div>
	            <div class="col-lg-6 col-md-6 py-4">
	                <a href="{{route('specialDeals')}}" class="card py-5 px-4" >
	                    <div class="row">
	                        <div class="col-lg-7 content" data-mh="eq">
	                            <h3 class="font-weight-bold">PLAYSTATION 4</h3>
	                            <h5 class="my-2 ">Be First To Play</h5>
	                            <h6 class=" font-weight-bold">SHOP NOW <i class="fas ml-1 fa-caret-right"></i> </h6>
	                        </div>
	                            <img src="pics/play-station.png">
	                    </div>
	                </a>
	            </div>
	            <div class="col-lg-6 col-md-6 py-4">
	                <a href="{{route('specialDeals')}}" class="card py-5 px-4" >
	                    <div class="row">
	                        <div class="col-lg-7 content" data-mh="eq">
	                            <h3 class="font-weight-bold">LED MONITORS</h3>
	                            <h5 class="my-2 ">Up to 75% Off</h5>
	                            <h6 class=" font-weight-bold">SHOP NOW <i class="fas ml-1 fa-caret-right"></i> </h6>
	                        </div>
	                            <img src="pics/lcd.png">
	                    </div>
	                </a>
	            </div>
	        </div>
	    </div>
	</section> --}}

	@if(count($flashsales)>0)
		<section class="flash-sale py-5">
		    <div class="container-fluid px-5">
		        <h3 class="font-weight-bold text-white mb-4">FLASH SALE</h3>
		        <div class="owl-carousel owl-theme py-4">
		        	@foreach($flashsales as $product)
			            <div class="item">
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
			                        <h6 class="font-weight-bold"><a href="{{route('view.product',$product->alias)}}" data-toggle="tooltip" title="{{$product->title}}">{{str_limit($product->title,50)}}</a></h6>
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
		        </div>
		    </div> 
		</section>
	@endif

	@if(count($categories)>0)
		<section class="catagory py-5">
		    <div class="container-fluid px-5">
		        <h3 class="font-weight-bold">CATAGORIES</h3>
		        <div class="row py-5">
		        	@foreach($categories as $category)
			            <div class="col-lg-3 col-md-4 col-sm-6 col-md-4 py-3">
			                <a href="{{route('view.category',$category->alias)}}" class="card d-block card1 d-flex justify-content-end align-items-center p-3" style="background-image: url({{asset('images/category/'.$category->image)}});">
			                    <h5 class="font-weight-bold text-white">{{$category->title}}</h5>
			                </a>
		            	</div>
	            	@endforeach
		        </div>
		    </div>
		</section>
	@endif

	@if(count($newproducts)>0)
		<section class="newest-product py-5">
		    <div class="container-fluid px-5">
		        <div class="title-head d-flex justify-content-between align-items-center">
		            <h3 class="font-weight-bold">NEWEST PRODUTS</h3>
		            <h5><a href="{{route('newproducts')}}">View All</a></h5>
		        </div>
		        <div class="row py-5">
		        	@foreach($newproducts as $product)
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
			                        <h6 class="font-weight-bold"><a href="{{route('view.product',$product->alias)}}" data-toggle="tooltip" title="{{$product->title}}">{{str_limit($product->title,50)}}</a></h6>
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
		        </div>
		    </div>
		</section>
	@endif

	@if(count($specials)>0 || count($mostlikes)>0 || count($topsales)>0)
		<section class="special-tabs py-5">
			<div class="container-fluid px-5">
			    <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
			        <li class="nav-item">
			        	@if(count($topsales)>0)
			            	<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">TOP SALES</a>
			            @endif
			        </li>
			        <li class="nav-item">
			        	@if(count($specials)>0)
			            	<a class="nav-link @if(count($topsales)<0) active @endif" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">SPECIAL</a>
		            	@endif
			        </li>
			        <li class="nav-item">
			        	@if(count($mostlikes)>0)
			            	<a class="nav-link @if(count($topsales)<0 && count($specials)<0) active @endif" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">MOST LIKED</a>
		            	@endif
			        </li>
			    </ul>
			    <div class="tab-content" id="myTabContent">
			    	@if(count($topsales)>0)
				        <div class="tab-pane flash-sale fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
				            <div class="owl-carousel owl-theme py-4">
				            	@foreach($topsales as $product)
						            <div class="item">
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
						                        <h6 class="font-weight-bold"><a href="{{route('view.product',$product->alias)}}" data-toggle="tooltip" title="{{$product->title}}">{{str_limit($product->title,50)}}</a></h6>
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
					        </div>
				        </div>
			        @endif
			        @if(count($specials)>0)
				        <div class="tab-pane flash-sale fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
				            <div class="owl-carousel owl-theme py-4">
					            @foreach($specials as $product)
						            <div class="item">
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
						                        <h6 class="font-weight-bold"><a href="{{route('view.product',$product->alias)}}" data-toggle="tooltip" title="{{$product->title}}">{{str_limit($product->title,50)}}</a></h6>
						                        @if($product->discount > 0)
			                                        <h5 class="price red d-inline-block my-2 mr-3">{{$product->currency}}. {{$product->net_price}}</h5>
			                                        <h5 class="text-muted d-inline-block"><strike>{{$product->currency}}. {{$product->price}}</strike></h5> 
			                                    @else
			                                        <h5 class="price red d-inline-block my-2 mr-3">{{$product->currency}}. {{$product->net_price}}</h5>
			                                    @endif 
						                    </div> 
						                    @if($product->quantity>0) 
			                                    <h6 class="emi emi-available text-white text-center p-2">EMI AVAILABLE !!!</h6>
			                                @else
			                                    <h6 class="emi emi-off text-white text-center p-2">OUT OF STOCK !!!</h6>
			                                @endif
						                </div>
						            </div>
					            @endforeach
				        	</div>
				        </div>
			        @endif
			        @if(count($mostlikes)>0)
				        <div class="tab-pane fade flash-sale" id="contact" role="tabpanel" aria-labelledby="contact-tab">
				            <div class="owl-carousel owl-theme py-4">
					            @foreach($mostlikes as $product)
						            <div class="item">
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
						                        <h6 class="font-weight-bold"><a href="{{route('view.product',$product->alias)}}" data-toggle="tooltip" title="{{$product->title}}">{{str_limit($product->title,50)}}</a></h6>
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
				        	</div>
				        </div>
			        @endif
			    </div>
			</div>
		</section>
	@endif

	@if(count($justforyous)>0)
		<section class="flash-sale just-for-u py-5">
		    <div class="container-fluid px-5">
		        <h3 class="font-weight-bold text-white mb-4">JUST FOR YOU</h3>
		        <div class="owl-carousel owl-theme py-4">
		        	@foreach($justforyous as $product)
			            <div class="item">
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
			                        <h6 class="font-weight-bold"><a href="{{route('view.product',$product->alias)}}" data-toggle="tooltip" title="{{$product->title}}">{{str_limit($product->title,50)}}</a></h6>
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
		        </div>
		    </div> 
		</section>
	@endif
@endsection


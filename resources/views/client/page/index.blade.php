@extends('client.master')

@section('content')
	<style>
	    .select-bar{
	        display: none!important;
	    }
	    .dropdown{
	        display: block!important;
	    }

	    .return-policy p,
	    .return-policy li{
	        line-height:25px;
	    }
	    .return-policy h4::before{
	        content:'';
	        position:absolute;
	        top:120%;
	        left:0;
	        height:5px;
	        width:100%;
	        background:linear-gradient(to right,#fe0000,white);
	    }
	    .privacy-policy p,
	    .privacy-policy li{
	        line-height:25px;
	    }
	    .privacy-policy h4::before{
	        content:'';
	        position:absolute;
	        top:120%;
	        left:0;
	        height:5px;
	        width:100%;
	        background:linear-gradient(to right,#fe0000,white);
	    }
	     ol li{
	        font-weight:bold;
	        margin-bottom:15px;
	        margin-top:25px;
	    }
	</style>

	<section class="breadcrumbs py-4">
	    <div class="container-fluid px-5">
	        <h6><a href="{{route('home')}}">Home</a><i class="fas red mx-2 fa-chevron-right"></i>{{$page->title}}</h6>
	    </div>
	</section>

	<section class="return-policy py-5" style="background:white">
	    <div class="container-fluid px-5">
	        <h4 class="mb-5 d-inline-block position-relative font-weight-bold">{{$page->title}}</h4>
	        {!! $page->description !!}
	    </div>
	</section>
@endsection
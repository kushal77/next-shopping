@extends('client.master')

@section('css')
    <style>
        .select-bar{
            display: none!important;
        }
        .dropdown{
            display: block!important;
        }
    </style>
@endsection

@section('content')
<section class="breadcrumbs py-4">
    <div class="container-fluid px-5">
        <h6><a href="{{route('about')}}">About Us</a><i class="fas red mx-2 fa-chevron-right"></i>FAQs</h6>
    </div>
</section>	

<section class="service-search py-5">
    <form id="faqform" action="{{route('faqs.search')}}" method="get">
        <div class="container-fluid d-flex align-items-center justify-content-center">
            <div class="input-group">
                <input type="search" name="q" class="form-control" placeholder="Search for questions..." @if( isset($request->q) &&  $request->q!='') value="{{ $request->q }}" @endif>
                <a href="#" class="faqsubmit"><i class="fas fa-search" style="height: 50px;"></i></a>
            </div>
        </div>
    </form>
</section>

<section class="service-que py-5">
	@if( count($faqs)> 0)
	    @foreach($faqs as $key=>$faq)
		    <div class="container head py-4">
		        <h4 class="title red font-weight-bold"><span class="num text-white mr-4">{{$key+1}}</span>{{$faq->question}}</h4>
		        <p class="my-3 text-muted">{{$faq->answer}}</p>
		       {{--  <ul class="list-unstyled">
		            <li><p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Officia consectetur </p></li>
		            <li><p>voluptatibus debitis, ipsum earum molestias. Odit commodi, iusto nihil ratione facere </p></li>
		            <li><p>Ut enim ad minim veniam, quis nostrud exercitation </p></li>
		            <li><p>Ullamco laboris nisi ut aliquip ex ea commodo consequat. </p></li>
		        </ul> --}}
		    </div>
	    @endforeach
    @else
    	<h2><center>No Questions found!!</center></h2>
    @endif
</section>
@endsection

@section('script')
    <script type="text/javascript">
        $('.faqsubmit').on('click',function(e) {
            e.preventDefault();
            $('#faqform').submit();
        })
    </script>
@endsection
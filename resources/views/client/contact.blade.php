@extends('client.master')

@section('content')
	<section class="breadcrumbs py-4">
	    <div class="container-fluid px-5">
	        <h6><a href="{{route('home')}}">Home</a><i class="fas red mx-2 fa-chevron-right"></i>Contact Us</h6>
	    </div>
	</section>


	<section class="contact py-4">
	    <div class="container-fluid px-5">
	    	@if (session('success'))
        		<div class="confirmation-mail">
                    <p class="mb-4 p-3 success" style="display: block!important">
                        <i class="fas fa-check-circle mr-2 text-success"></i>
                        {!! session()->get('success') !!}
                    </p>
                </div>
      		@endif
       @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
                <li>{!! $error !!}</li>
              @endforeach
            </ul>
          </div>
        @endif  	
	        <div class="row">
	            <div class="col-lg-3 py-4">
	                <h4 class="font-weight-bold">CONTACT US</h4>
	                <div class="phone my-5 d-flex align-items-center">
	                    <i class="fas fa-2x mr-3 red fa-mobile-alt"></i>
	                    <p>{{$phoneno}}</p>
	                </div>
	                <div class="map my-5 d-flex align-items-center">
	                    <i class="fas fa-2x mr-3 red fa-map-marker-alt"></i>
	                    <p>{{$address}}</p>
	                </div>
	                <div class="mail my-5 d-flex align-items-center">
	                    <i class="far fa-2x mr-3 red fa-envelope-open"></i>
	                    <p>{{$email}}</p>
	                </div>
	                <div class="follow">
	                    <h4 class="font-weight-bold">FOLLOW US</h4>
	                    <div class="header-social-icons my-5">
	                        <a href="{{$insta}}" style="color: #e4405f"> <i class="fab fa-instagram"></i></a>
                            <a href="{{$facebook}}" style="color: #3b5998"> <i class="fab fa-facebook-f"></i></a>
                            <a href="{{$twitter}}"  style="color: #00acee"> <i class="fab fa-twitter"></i></a>
                            <a href="{{$google}}" style="color: #dd4b39"> <i class="fab fa-google-plus-g"></i></a>
	                    </div>
	                </div>
	            </div>
	            <div class="col-lg-5 py-4">
	                <h4 class="font-weight-bold">OUR LOCATION</h4>
	                <iframe class="my-5" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3533.091964212953!2d85.34678271440124!3d27.68355238280177!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb19a18187378f%3A0x8ba2460dd7896e64!2sOnline%20Zeal!5e0!3m2!1sen!2snp!4v1572065502249!5m2!1sen!2snp" width="100%" height="350" frameborder="0" style="border:0; border-radius:10px;" allowfullscreen=""></iframe>
	            </div>
	            <div class="col-lg-4 write-us py-4">
	                <h4 class="font-weight-bold">WRITE US</h4>
	                <form class="form my-5" action="{{route('contact.save')}}" method="post">
	                	{{csrf_field()}}
	                    <div class="form-group">
	                        <p class="font-weight-bold mb-2">Full Name</p>
	                        <div class="input-group d-flex align-items-center">
	                            <i class="fas px-3 fa-user"></i>
	                            <input type="text" class="form-control" name="name" placeholder="Please enter your name" value="{{old('name')}}">
	                        </div>
	                    </div>
	                    <div class="form-group">
	                        <p class="font-weight-bold mb-2">Email</p>
	                        <div class="input-group d-flex align-items-center">
	                                <i class="fas px-3 fa-at"></i>
	                            <input type="email" class="form-control" name="email" placeholder="Enter email here ..." value="{{old('email')}}">
	                        </div>
	                    </div>
	                    <p class="font-weight-bold mb-3">Message</p>
	                    <textarea name="message" id="#" class="form-control" rows="10" placeholder="Write your message here..." value="{{old('message')}}"></textarea>
	                    <button class="button mt-4" type="submit">Send Message</button>
	                </form>
	            </div>
	        </div>
	    </div>
	</section>
@endsection
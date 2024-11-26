@extends('client.master')

@section('content')

<section class="breadcrumbs py-4" style="background: white">
    <div class="container-fluid px-5">
        <h6><a href="route('home')">Home</a><i class="fas red mx-2 fa-chevron-right"></i>Login/Register</h6>
        <hr class="mt-4">
    </div>
</section>

<section class="user-sign">
    <section class="form py-4" >
        <div class="container">
            @if(session()->has('success'))
                <div class="confirmation-mail">
                    <p class="mb-4 p-3 success" style="display: block!important">
                        <i class="fas fa-check-circle mr-2 text-success"></i>
                        {!! session()->get('success') !!}
                    </p>
                </div>
            @endif
            @if(session()->has('verify'))
                <div class="confirmation-mail">
                    <p class="mb-4 p-3 success" style="display: block!important">
                        <i class="fas fa-check-circle mr-2 text-success"></i>
                        {!! session()->get('verify') !!}
                    </p>
                </div>
            @endif
            @if(session()->has('error'))
                <div class="confirmation-mail">
                    <p class="mb-4 p-3 danger" style="display: block!important">
                        <i class="fas fa-times-circle mr-2 text-danger"></i>
                        {!! session()->get('error') !!}
                    </p>
                </div>
            @endif
            <div class="row">
                <div class="col-md-6 clearfix">
                    <div class="first-form p-5">
                    <h4>Sign In</h4>
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <p>Email</p>
                        <input spellcheck="false"  type="text" class="form-control" name="email" placeholder="Enter your e-mail" required>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert" style="display: block!important;">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                        <p>Password</p>
                        <input spellcheck="false" type="password" class="form-control" name="password" placeholder="Enter password" required>
                        <div class="custom-control custom-checkbox">
                            <input spellcheck="false" type="checkbox" class="custom-control-input" id="customCheck1">
                            <label class="custom-control-label" for="customCheck1">Remember me</label>
                            <a class="text-white float-right forgot" href="{{ route('forgot-password') }}">Forgot your password?</a>
                        </div>
                        <button class="btn form-control" type="submit"> SIGN IN </button>
                    </form>
                    </div>
                </div>
                <div class="col-md-6 clearfix">
                    <div class="second-form p-5" style="background: rgba(185, 184, 184, 0.192)">
                        <h4>Registration</h4>
                        <form action="{{ route('register') }}" method="POST">
                            @csrf
                            <p>First Name</p>
                            <input spellcheck="false" type="text" class="form-control" name="first_name" placeholder="Enter first name" required>
                            @if ($errors->has('first_name'))
                                <span class="invalid-feedback" role="alert" style="display: block!important;">
                                    <strong>{{ $errors->first('first_name') }}</strong>
                                </span>
                            @endif
                            <p>Last Name</p>
                            <input spellcheck="false" type="text" class="form-control" name="last_name" placeholder="Enter last name" required>
                            @if ($errors->has('last_name'))
                                <span class="invalid-feedback" role="alert" style="display: block!important;">
                                    <strong>{{ $errors->first('last_name') }}</strong>
                                </span>
                            @endif
                            <p>Email</p>
                            <input spellcheck="false" type="text" class="form-control" name="email" placeholder="Enter email" required>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert" style="display: block!important;">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                            <p>Password</p>
                            <input spellcheck="false" type="password" class="form-control" name="password" placeholder="Enter password" required>
                            <p>Re-enter Password</p>
                            <input spellcheck="false" type="password" class="form-control" name="password_confirmation" placeholder="Re-enter password" required>
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert" style="display: block!important;">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                            <div class="but text-right ">
                                <button class="button register success" type="submit"> REGISTER </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>
@endsection

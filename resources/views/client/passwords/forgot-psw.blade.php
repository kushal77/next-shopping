@extends('client.master')
@section('content')
    <section class="breadcrumbs py-4" style="background: white">
        <div class="container-fluid px-5">
            <h6><a href="{{ route('home') }}">Home</a><i class="fas red mx-2 fa-chevron-right"></i><a href="{{ route('login') }}">Login/Register</a><i class="fas red mx-2 fa-chevron-right"></i>Forgot Password</h6>
            <hr class="mt-4">
        </div>
    </section>

    {{--  <div class="confirmation-mail" style="background: white">
        <div class="container">
            <p class="p-3 success"><i class="fas fa-check-circle mr-2 text-success"></i>A code has been sent to falanamail@gmail.com.</p>
        </div>
    </div>  --}}

    <section class="forgot-psw" style="background: white;">
        @if(session()->has('success'))
            <div class="confirmation-mail" style="background: white;display: block!important;">
                <div class="container">
                    <p class="p-3 success"><i class="fas fa-check-circle mr-2 text-success"></i>{!! session()->get('success') !!}</p>
                </div>
            </div>
        @endif
        @if(session()->has('error'))
            <div class="confirmation-mail" style="background: white;display: block!important;">
                <div class="container">
                    <p class="p-3 success"><i class="fas fa-times-circle mr-2 text-danger"></i>{!! session()->get('error') !!}</p>
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="reset-mobile mobile">
                    <div class="my-5">
                        <div class="bg"></div>
                        <form class="form px-5 py-4" method="POST" action="{{ route('reset-psw-mail') }}" >//{{ route('reset-psw-mail') }}
                            @csrf
                            <h3 class="text-center mt-5 mb-3">{{ __('Send Password Reset Link') }}</h3>
                            <p class="text-center mb-3">Enter your account email to receive a link allowing you to reset your password.</p>
                            <h5>{{ __('E-Mail Address') }}<sup class="red">*</sup></h5>
                            <div class="input-group my-3 d-flex align-items-center">
                                <input type="email" name="email" placeholder="Email" class="form-control">
                                <i class="far p-3 fa-envelope"></i>
                            </div>
                            <div class="btns text-center mb-4">
                                <button class="button success px-5 py-3" type="submit">{{ __('Send Password Reset Link') }}</button>
                            </div>
                            <a href="user-sign.php" class="register-icon">
                                <i class="fas fa-user-plus"></i>
                            </a>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

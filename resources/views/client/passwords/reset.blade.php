@extends('client.master')

@section('content')
<section class="forgot-psw" style="background: white;">
    <div class="row">
        <div class="col-lg-6 offset-lg-3">
            <div class="reset-mobile mobile">
                <div class="my-5">
                    <div class="bg"></div>
                    <form class="form px-5 py-4" method="POST" action="{{ route('client.password.reset') }}" >
                        @csrf
                        <h3 class="text-center mt-5 mb-3">{{ __('Reset Password') }}</h3>
                        <h5>{{ __('E-Mail Address') }}<sup class="red">*</sup></h5>
                        <div class="input-group my-3 d-flex align-items-center">
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus>
                            <i class="far p-3 fa-envelope"></i>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <h5>{{ __('Password') }}<sup class="red">*</sup></h5>
                        <div class="input-group my-3 d-flex align-items-center">
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                            <i class="fas p-3 fa-unlock"></i>

                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <h5>{{ __('Confirm Password') }}<sup class="red">*</sup></h5>
                        <div class="input-group my-3 d-flex align-items-center">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            <i class="fas p-3 fa-lock"></i>
                        </div>

                        <div class="btns text-center mb-4">
                            <button class="button success px-5 py-3" type="submit">{{ __('Reset Password') }}</button>
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

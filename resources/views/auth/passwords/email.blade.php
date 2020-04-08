@extends('layouts.login')

@section('content')
<div class="kt-login__form">
   <div class="kt-login__title">
      <h3>{{ __('Reset Password') }}</h3>
   </div>
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="kt-form">
        @csrf

        <div class="form-group row">
                <input id="email" type="email" placeholder = "{{ __('E-Mail Address') }}" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

        </div>

        <div class="kt-login__actions row">
                             <button id="kt_login_signin_submit" type="submit" class="btn btn-primary btn-elevate kt-login__btn-primary"> {{ __('Send Password Reset Link') }}</button>
                          </div>
    </form>
</div>   

@endsection

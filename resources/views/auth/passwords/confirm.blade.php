@extends('layouts.login')

@section('content')
<div class="kt-login__form">
   <div class="kt-login__title">
      <h3>{{ __('Confirm Password') }}</h3>
   </div>
   {{ __('Please confirm your password before continuing.') }}
   <form method="POST" action="{{ route('password.confirm') }}" class="kt-form">
        @csrf

        <div class="form-group row">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="{{ __('Password') }}" name="password" required autocomplete="current-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
        </div>
         

        <div class="kt-login__actions">
         <button id="kt_login_signin_submit" type="submit" class="btn btn-primary btn-elevate kt-login__btn-primary">{{ __('Confirm Password') }}</button>
         @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
      </div>
    </form>

</div>   
@endsection

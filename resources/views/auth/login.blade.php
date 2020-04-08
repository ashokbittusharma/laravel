@extends('layouts.login')
@section('content')
<!--begin::Signin-->
<div class="kt-login__form">
   <div class="kt-login__title">
      <h3>{{ __('Sign In') }}</h3>
   </div>
   <!--begin::Form-->
   <form class="kt-form"  method="POST" action="{{ route('login') }}">
      @csrf
      <div class="form-group row">
         <input id="email" type="email" placeholder="{{ __('E-Mail Address') }}"  class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
         @error('email')
         <span class="invalid-feedback" role="alert">
         <strong>{{ $message }}</strong>
         </span>
         @enderror
      </div>
      <div class="form-group row">
         <input id="password" type="password" placeholder="{{ __('Password') }}" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
         @error('password')
         <span class="invalid-feedback" role="alert">
         <strong>{{ $message }}</strong>
         </span>
         @enderror
      </div>
      <div class="form-group row">
         <select id="role" name="role" class="form-control">
            <option value="{{$admin}}">Admin</option>
            <option value="{{$employee}}">Employee</option>
         </select>
         @error('role')
         <span class="invalid-feedback" role="alert">
         <strong>{{ $message }}</strong>
         </span>
         @enderror
      </div>
      <div class="kt-login__extra form-group row">
         <label class="kt-checkbox">
         <input type="checkbox" class="form-control" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
         <span></span>
         </label>
         @if (Route::has('password.request'))
         <a class="kt-link kt-login__link-forgot" href="{{ route('password.request') }}">
         {{ __('Forgot Your Password?') }}
         </a>
         @endif
      </div>
      <!--begin::Action-->
      <div class="kt-login__actions">
         <button id="kt_login_signin_submit" type="submit" class="btn btn-primary btn-elevate kt-login__btn-primary">{{ __('Login') }}</button>
      </div>
      <!--end::Action-->
   </form>
   <!--end::Form-->
</div>
<!--end::Signin-->
@endsection
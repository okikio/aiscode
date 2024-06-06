@extends('front.layouts.auth')
@section('page_title', 'SignIn')
@section('content')

<div class="login-sec">

  <div class="col-lg-5 col-11  m-auto">
  <!-- <div class="text-center mb-3">
 <div class="header-ads mobile-ads">
        <img src="{{ asset('front/images/ad-left.png') }}" alt="" class="img-fluid">
      </div>
 </div> -->
    <div class="login-from">
      <div class="form-header">
        <h2 class="f-15 text-uppercase text-white text-center mb-0 fw-bold montserrat-font">Log in with</h2>
      </div>
      <div class="d-flex gap-lg-5 gap-3 justify-content-center py-md-2 py-2 my-1">
        <a href ="{{ route('front.socialLogin',['google']) }}"> <img src="{{ asset('front/images/google.png') }}" alt="google" class="img-fluid"></a>
        <a href ="{{ route('front.socialLogin',['facebook']) }}" class="d-flex align-items-center"> <img src="{{ asset('front/images/facebook.png') }}" alt="facebook" class="img-fluid"></a>
      </div>
      <div class="divider d-flex align-items-center mb-lg-4 mb-2">
        <p class="text-center  text-white mx-3 mb-0 light-dark f-12 fw-300 montserrat-font">OR</p>
      </div>
      <form action="{{ route('front.login.submit') }}" method="post" id="loginForm">
        @csrf
        <div class="mb-3">
          <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email" required>
        </div>
        <div class="mb-3">
          <input type="password" name="password" class="form-control" id="email" placeholder="Enter Password" required>
        </div>
        <div class="mb-3 text-center ">
          <button class="gaming-btn" type="submit" class="btn btn-primary">
            <span class="btn" >Log In</span>
          </button>
        </div>
      </form>
      <div class="form-footer text-center">
        <p class="mb-0 f-13 text-white">Don't have any account? <a href="{{ route('front.register') }}" class="primary-color">Sign Up</a>
        </p>
        <a href="{{ route('front.resetpassword') }}" class="text-white f-13">Forgot Password ?</a>
      </div>
    </div>
  </div>
</div>
@endsection
@extends('front.layouts.auth')
@section('page_title', 'SignUp')
@section('content')
<div class="login-sec">
    <div class="col-lg-5 col-11  m-auto">
    <div class="text-center mb-3">
 <div class="header-ads mobile-ads">
        <img src="{{ asset('front/images/ad-left.png') }}" alt="" class="img-fluid">
      </div>
 </div>
        <div class="login-from">
            <div class="form-header mb-lg-3 mb-2">
                <h2 class="f-15 text-uppercase text-white text-center mb-0 fw-700 montserrat-font">
                    Don’t have an account yet?
                </h2>
            </div>
            <form method="post" id="registerForm" name="registerForm">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="row g-2 align-items-center">
                    <div class="col-md-6 form-group">
                        <input type="text" class="form-control" id="first_name" placeholder="First Name" name="first_name" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <input type="Last Name" class="form-control" id="last_name" placeholder="Last Name" name="last_name" required>
                    </div>
                    <div class="col-md-12 form-group">
                        <input type="email" class="form-control" id="email" placeholder="Enter Email" name="email" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <input type="password" class="form-control" id="password" placeholder="Enter Password" name="password" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <input type="password" class="form-control" id="confirm_password" placeholder="ReEnter Password"  name="confirm_password" autocomplete="new-password" required>
                    </div>
                    <div class="col-md-12 form-group">
                        <input type="text" class="form-control" id="phone_number" placeholder="Phone Number" name="phone_number" required>
                    </div>
                    <div class="col-md-12 form-group">
                        <input type="text" class="form-control" id="nick_name" placeholder="User Name" name="nick_name" required>
                    </div>
                </div>
                <div class="row mt-2 gx-2 gy-2">
                    <p class="montserrat-font f-12 mb-1 text-uppercase text-white">Choose the date of birth</p>
                    <div class="col-md-4 form-group">
                        <select class="form-select" aria-label="Default select example" id="yearDropdownField" onchange="onChangeYearAndMonth(this)" name="year">
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select class="form-select" aria-label="Default select example" id="monthDropdownField" onchange="onChangeYearAndMonth(this)" name="month">
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select class="form-select" aria-label="Default select example" id="dateDropdownField" name="date">
                        </select>
                    </div>
                    <p class="montserrat-font  f-12 mt-1 mb-1 text-white">
                        Please Note:You must be over 18 to create an account.
                    </p>
                </div>
                <div class="mb-3 mt-1 text-center">
                    <button class="gaming-btn" type="submit" class="btn btn-primary">
                        <span class="btn">Sign Up</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('customJs')
<!-- jquery-validation -->
<script src="{{ asset('front/js/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('front/js/jquery-validation/additional-methods.min.js') }}"></script>
@include('front.customJs.register')
@endpush
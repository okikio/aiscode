@extends('front.layouts.auth')
@section('page_title', 'Reset Password')
@section('content')
<div class="login-sec">
    <div class="col-lg-5 col-11  m-auto">
      	<div class="login-from">
        	<div class="form-header">
          		<h2 class="f-15 text-uppercase text-white text-center mb-0 fw-bold montserrat-font">Reset Password?</h2>
        	</div>
            {!! Form::open(['route' => 'front.resetPassword','method' => 'post','id' => 'resetForm','class' =>'mt-lg-4 mt-3','name'=>'resetForm'] ) !!}
            <input type="hidden" name="token" value="{{ $passwordReset->token }}">
          		<div class="mb-3">
            		<input type="email" class="form-control" id="email" placeholder="Enter email address" name="email" required>
          		</div>
                <div class="mb-3">
                    <input type="password" class="form-control" id="password" placeholder="Enter password" name="password" required>
                </div>
                <div class="mb-3">
                    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Enter confirm password" required>
                </div>
          		<div class="mb-4 text-center ">
            		<button class="gaming-btn" type="submit" class="btn btn-primary">
              			<span class="btn" >Submit</span>
            		</button>
          		</div>
        	{!! Form::close() !!}
     	</div>
    </div>
 </div>
@endsection
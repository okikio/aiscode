@extends('front.layouts.auth')
@section('page_title', 'Forgot Password')
@section('content')
<div class="login-sec">
    <div class="col-lg-5 col-11  m-auto">
      	<div class="login-from">
        	<div class="form-header">
          		<h2 class="f-15 text-uppercase text-white text-center mb-0 fw-bold montserrat-font">Forgot Password?</h2>
        	</div>
            {!! Form::open(['route' => 'front.sendLinkToUser','method' => 'post','id' => 'forgotForm','class' =>'mt-lg-4 mt-3','name'=>'forgotForm'] ) !!}
          		<div class="mb-3 form-group">
            		<input type="email" class="form-control" id="email" placeholder="Enter your email address" name="email" required>
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
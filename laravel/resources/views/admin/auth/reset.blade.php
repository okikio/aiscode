@extends('admin.layouts.auth')
@section('page_title', 'Reset Password')
@section('content')
<div class="card-body">
  <p class="login-box-msg">You are only one step a way from your new password, recover your password now.</p>
  {!! Form::open(['route' => 'admin.resetPassword','method' => 'post','id' => 'resetForm','class' =>'pt-3'] ) !!}
    <input type="hidden" name="token" value="{{ $passwordReset->token }}">
    <div class="input-group mb-3">
      <input type="email" name="email" class="form-control" placeholder="Enter email">
      <div class="input-group-append">
        <div class="input-group-text">
          <span class="fas fa-envelope"></span>
        </div>
      </div>
    </div>
    <div class="input-group mb-3">
      <input type="password" name="password" class="form-control" placeholder="Enter password">
      <div class="input-group-append">
        <div class="input-group-text">
          <span class="fas fa-lock"></span>
        </div>
      </div>
    </div>
    <div class="input-group mb-3">
      <input type="password" name="password_confirmation" class="form-control" placeholder="Enter confirm password">
      <div class="input-group-append">
        <div class="input-group-text">
          <span class="fas fa-lock"></span>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <button type="submit" class="btn btn-primary btn-block">Change password</button>
      </div>
      <!-- /.col -->
    </div>
  {!! Form::close() !!}
  <p class="mt-3 mb-1">
    <a href="login.html">Login</a>
  </p>
</div>
@endsection
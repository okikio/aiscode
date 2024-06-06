@extends('admin.layouts.main')
@section('page_title', 'Profile')
@section('breadcrumb','Profile')
@section('content')
<!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Edit Profile</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            {!! Form::model($admin,['route' => ['admin.updateProfile'],'class'=>'forms-sample needs-validation','novalidate','files'=>true]) !!}
              <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputName">Name</label>
                  {{Form::text('name',null,['class'=>'form-control','id' => 'exampleInputName','required','placeholder'=>'Enter name'])}}
                </div>
                <!-- <div class="form-group">
                  <label for="exampleInputEmail1">Email address</label>
                  {{Form::email('email',null,['class'=>'form-control','id' => 'exampleInputEmail1','required','placeholder'=>'Enter email'])}}
                </div> -->
                <div class="form-group">
                  <label for="exampleInputFile">Upload Image</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" name="image" class="custom-file-input" id="exampleInputFile">
                      <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>
                  </div>
                  <br>
                  @if(!empty($admin->image))
                    <img class="w-40px" src="{{ $admin->image }}" alt="{{$admin->name}}" width="100px">
                  @endif
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('admin.dashboard') }}" type="button" class="btn btn-danger">Cancel</a>
              </div>
            {!! Form::close() !!}
          </div>
          <!-- /.card -->
          <!-- general form elements -->
        </div>
        <!-- Right column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Change Password</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            {!! Form::open(['route' => ['admin.changePassword'],'class'=>'forms-sample needs-validation','novalidate','files'=>true]) !!}
              <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputPassword">Current Password</label>
                  {{Form::password('c_password',['class'=>'form-control','required','placeholder'=>'Current Password'])}}
                  <div class="invalid-feedback">
                    Please enter a current password.
                  </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword2">New Password</label>
                  {{Form::password('password',['class'=>'form-control','required','placeholder'=>'New Password'])}}
                  <div class="invalid-feedback">
                    {{$errors->first('password')}}
                  </div>
                  <div class="invalid-feedback">
                    Please enter a new password.
                  </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword3">Confirm Password</label>
                  {{Form::password('password_confirmation',['class'=>'form-control','required','placeholder'=>'Confirm New Password'])}}
                  <div class="invalid-feedback">
                    Please enter a confirm password.
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('admin.dashboard') }}" type="button" class="btn btn-danger">Cancel</a>
              </div>
            {!! Form::close() !!}
          </div>
          <!-- /.card -->
          <!-- general form elements -->
        </div>
      </div>
    </div>
  </section>
<!-- /.content -->
@endsection
@include('admin.customJs.validation')
@extends('front.layouts.main')
@section('page_title', 'Profile')
@section('content')
<div class="inner-content">
    <div class="col-xl-9">
        <div class="inner-item-heading" style="margin-bottom: 0 !important;">
            <h2 class="f-24 fw-700 text-white text-uppercase montserrat-font mb-0">Profile</h2>
        </div>
    </div>
    <div class="row py-lg-0 py-3">
        <div class="col-xl-9">
        {!! Form::model($user,['route' => ['front.update-profile'],'id'=>'profile-from','files'=>true]) !!}
        <div class="row py-md-0 py-2 profile-row">
            <div class="col-md-3">
                <div class="avatar-upload profile-img-box ">
                    <div class="avatar-edit">
                        <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" name="image" />
                        <label for="imageUpload"><img src="{{ asset('front/images/upload-btn.png') }}" alt=""> </label>
                    </div>
                    <div class="avatar-preview profile-img">
                        <div id="imagePreview" style="background-image:url({{ auth()->user()->image }});">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="profile-from">
                    <div class="row gy-2 g-md-2 g-1  align-items-center">
                        <div class="col-md-12 text-md-end text-center">
                           <button type="submit" class="btn rounded-pill gradient-bg"><i class="fa-regular fa-pen-to-square"></i> &nbsp; Edit Save </button>
                            <a href="{{ route('front.profile') }}" class="btn btn-light rounded-pill px-md-5 px-4 ms-md-0 ms-2">Cancel</a>    
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="col-form-label">First Name</label>
                            {{Form::text('name',null,['class'=>'form-control','id' => 'name','required','placeholder'=>'Enter name'])}}
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="col-form-label">Last Name</label>
                            {{Form::text('last_name',null,['class'=>'form-control','id' => 'last_name','required','placeholder'=>'Enter last name'])}}
                        </div>
                        <div class="col-md-12 form-group">
                            <label class="col-form-label">Enter Email</label>
                            {{Form::text('email',null,['class'=>'form-control','id' => 'email','required','placeholder'=>'Enter email','readonly','data-toggle'=>"tooltip",'data-placement'=>"bottom",'title' => 'Email is readonly'])}}
                        </div>
                        @if(auth()->user()->login_type == 'normal')
                        <div class="col-md-6 form-group">
                            <label class="col-form-label">Enter Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" autocomplete="new-password" required />
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="col-form-label">ReEnter Password</label>
                            <input type="password" class="form-control" id="repassword" name="confirm_password" placeholder="ReEnter Password" required>
                        </div>
                        @endif
                        <div class="col-md-6 form-group">
                            <label class="col-form-label">User Name</label>
                            {{Form::text('nick_name',null,['class'=>'form-control','id' => 'nick_name','required','placeholder'=>'Enter user name'])}}
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="col-form-label">Phone Number</label>
                            {{Form::text('phone_number',null,['class'=>'form-control','id' => 'phone_number','required','placeholder'=>'Enter phone number'])}}
                        </div>
                        <div class="col-md-12 form-group">
                            <label class="col-form-label">Chose the
                            date of birth</label>
                            {{Form::date('birth_date',null,['class'=>'form-control','id' => 'birth_date','required','placeholder'=>'Enter birth date'])}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
        </div>
        <div class="col-xl-3">
            @include('front.partials.announcement')
        </div>
    </div>
</div>
@endsection
@push('customJs')
<!-- jquery-validation -->
<script src="{{ asset('front/js/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('front/js/jquery-validation/additional-methods.min.js') }}"></script>
@include('front.customJs.register')
<script type="text/javascript">
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});
</script>
@endpush
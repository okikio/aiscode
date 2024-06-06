@extends('front.layouts.main')
@section('page_title', 'Contact Us')
@section('content')
<div class="login-sec">
    <div class="col-lg-5 col-11  m-auto">
        <div class="login-from">
            <div class="form-header mb-lg-4 mb-3">
                <h2 class="f-15 text-uppercase text-white text-center mb-0 fw-700 montserrat-font">
                  Contact Us</h2>
            </div>
            {!! Form::open(['route' => 'front.contact-us.submit','method' => 'post','id' => 'contact-form','class' =>'contact-form','name'=>'contact-form'] ) !!}
            <div class="row g-3 align-items-center">
                <div class="col-md-12">
                    <input type="email" class="form-control" id="email"
                    placeholder="Enter Email" name="email">
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="first_name" placeholder="First Name" name="first_name">
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name">
                </div>
                <div class="col-md-12">
                    <select class="form-select" aria-label="Default select example" name="department">
                        <option value="">Which Department do you wish to contact</option>
                        <option value="Admin">Admin</option>
                        <option value="Submit a Game">Submit a Game</option>
                        <option value="Technical support">Technical Support</option>
                        <option value="Tournament Support">Tournament Support</option>
                        <option value="Sponsorship Opportunities">Sponsorship Opportunities</option>
                        <option value="Affiliates">Affiliates</option>
                    </select>
                </div>
                <div class="col-12">
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Write Subject" name="subject"></textarea>
                </div>
            </div>
            <div class="mb-4 pt-4 text-center">
                <button class="gaming-btn" type="submit" class="btn btn-primary">
                    <span class="btn">Submit Now</span>
                </button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
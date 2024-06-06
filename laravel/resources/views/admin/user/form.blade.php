<div class="row">
    <div class="form-group col-md-6">
        <label for="exampleInputName">First Name</label>
        {{Form::text('name',null,['class'=>'form-control','id' => 'exampleInputName','required','placeholder'=>'Enter first name'])}}
    </div>
    <div class="form-group col-md-6">
        <label for="exampleInputName">Last Name</label>
        {{Form::text('last_name',null,['class'=>'form-control','id' => 'exampleInputName','required','placeholder'=>'Enter last name'])}}
    </div>
    <div class="form-group col-md-6">
        <label for="exampleInputEmail">Email</label>
        {{Form::email('email',null,['class'=>'form-control','id' => 'exampleInputEmail','required','placeholder'=>'Enter email'])}}
        <div class="alert-danger">
            {{$errors->first('email')}}
        </div>
    </div>
    <div class="form-group col-md-6">
        <label for="exampleInputDOB">Date of Birth</label>
        {{Form::date('birth_date',null,['class'=>'form-control','id' => 'exampleInputDOB','required','placeholder'=>'Enter birth of date'])}}
    </div>
    <div class="form-group col-md-6">
        <label for="exampleInputNickname">Username</label>
        {{Form::text('nick_name',null,['class'=>'form-control','id' => 'exampleInputNickname','required','placeholder'=>'Enter username'])}}
    </div>
    <div class="form-group col-md-6">
        <label for="exampleInputPhone">Phone Number</label>
        {{Form::text('phone_number',null,['class'=>'form-control','id' => 'exampleInputPhone','required','placeholder'=>'Enter phone number'])}}
        <div class="alert-danger">
            {{$errors->first('phone_number')}}
        </div>
    </div>
    <!-- <div class="form-group col-md-6">
        <label for="exampleInputAddress">Address</label>
        {{Form::text('address',null,['class'=>'form-control','id' => 'exampleInputAddress','required','placeholder'=>'Enter address'])}}
    </div>
    <div class="form-group col-md-6">
        <label for="exampleInputZipcode">Zipcode</label>
        {{Form::text('zipcode',null,['class'=>'form-control','id' => 'exampleInputZipcode','required','placeholder'=>'Enter zipcode'])}}
    </div>
    <div class="form-group col-md-6">
        <label for="exampleInputCountry">Country</label>
        {{Form::text('country',null,['class'=>'form-control','id' => 'exampleInputCountry','required','placeholder'=>'Enter country'])}}
    </div>
    <div class="form-group col-md-6">
        <label for="exampleInputState">State</label>
        {{Form::text('state',null,['class'=>'form-control','id' => 'exampleInputState','required','placeholder'=>'Enter state'])}}
    </div> -->
    <div class="form-group col-md-6">
        <label for="exampleInputName">Affiliate User
        </label>
        {{Form::select('affiliate_id',$affiliate,null,['class'=>'form-control','id' => 'exampleInputName','placeholder'=>'Select Affiliate User'])}}
    </div>
</div>
<div class="card-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
    <a href="{{ route($path.'.index') }}" type="button" class="btn btn-danger">Cancel</a>
</div>
@include('admin.customJs.validation')
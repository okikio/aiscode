<div class="row">
    <div class="form-group col-md-6">
        <label for="exampleInputName">Name</label>
        {{Form::text('name',null,['class'=>'form-control','id' => 'exampleInputName','required','placeholder'=>'Enter name'])}}
    </div>
    @if($cmspage->slug == 'contact-us')
    <div class="form-group col-md-6">
        <label for="email">Email</label>
        {{Form::email('email',null,['class'=>'form-control','id' => 'email','required','placeholder'=>'Enter email'])}}
    </div>
    <div class="form-group col-md-6">
        <label for="phone_number">Phone Number</label>
        {{Form::text('phone_number',null,['class'=>'form-control','id' => 'phone_number','required','placeholder'=>'Enter phone number'])}}
    </div>
    @else
    <div class="form-group col-md-12">
        {{Form::textarea('description',null,['class'=>'form-control','id' => 'summernote','required','placeholder'=>'Enter Description'])}}
    </div>
    @endif
</div>
<div class="card-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
    <a href="{{ route($path.'.index') }}" type="button" class="btn btn-danger">Cancel</a>
</div>
@include('admin.customJs.validation')
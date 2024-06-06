<div class="row">
    <div class="form-group col-md-6">
        <label for="exampleInputName">Name</label>
        {{Form::text('name',null,['class'=>'form-control','id' => 'exampleInputName','required','placeholder'=>'Enter name'])}}
    </div>
</div>
<div class="card-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
    <a href="{{ route($path.'.index') }}" type="button" class="btn btn-danger">Cancel</a>
</div>
@include('admin.customJs.validation')
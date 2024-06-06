<div class="row">
    <div class="form-group col-md-6">
        <label for="exampleInputName">Rank Number</label>
        {{Form::number('rank',null,['class'=>'form-control','id' => 'exampleInputName','required','placeholder'=>'Enter rank number','min'=>'1'])}}
    </div>
    <div class="form-group col-md-6">
        <label for="exampleInputName">Winning Reward Name</label>
        {{Form::text('reward_name',null,['class'=>'form-control','id' => 'exampleInputName','required','placeholder'=>'Enter winning reward name'])}}
    </div>
    <div class="form-group col-md-6">
        <label for="exampleInputName">Winning Reward</label>
        {{Form::text('reward',null,['class'=>'form-control','id' => 'exampleInputName','required','placeholder'=>'Enter winning reward'])}}
    </div>
    <div class="form-group col-md-6">
        <label for="exampleInputName">Winning Reward Code</label>
        {{Form::text('reward_code',null,['class'=>'form-control','id' => 'exampleInputName','placeholder'=>'Enter winning reward code'])}}
    </div>
    <div class="form-group col-md-6">
        <label for="exampleInputName">Winning Description</label>
        {{Form::textarea('description',null,['class'=>'form-control','id' => 'exampleInputName','placeholder'=>'Enter winning description'])}}
    </div>
</div>
<div class="card-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
    <a href="{{ route($path.'.index') }}" type="button" class="btn btn-danger">Cancel</a>
</div>
@include('admin.customJs.validation')
@push('scripts')
@endpush
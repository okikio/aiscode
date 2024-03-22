<div class="row">
    <div class="form-group col-md-6">
        <label for="exampleInputName">Category</label>
        {{Form::select('category_id',$category,null,['class'=>'form-control','id' => 'exampleInputName','required','placeholder'=>'Select category'])}}
    </div>
    <div class="form-group col-md-6">
        <label for="exampleInputName">Name</label>
        {{Form::text('name',null,['class'=>'form-control','id' => 'exampleInputName','required','placeholder'=>'Enter name'])}}
    </div>
    <div class="form-group col-md-6">
        <label for="exampleInputName">Url</label>
        {{Form::text('url',null,['class'=>'form-control','id' => 'exampleInputName','required','placeholder'=>'Enter url'])}}
    </div>
    <div class="form-group col-md-6">
      <label for="exampleInputFile">Upload Image</label>
      <div class="input-group">
        <div class="custom-file">
          <input type="file" name="image" class="custom-file-input" id="exampleInputFile">
          <label class="custom-file-label" for="exampleInputFile">Choose file</label>
        </div>
      </div>
      @if(!empty($game->image))
        <img class="w-40px" src="{{ $game->image }}" alt="{{$game->name}}" width="100px">
      @endif
    </div>
</div>
<div class="card-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
    <a href="{{ route($path.'.index') }}" type="button" class="btn btn-danger">Cancel</a>
</div>
@include('admin.customJs.validation')
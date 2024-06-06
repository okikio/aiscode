<div class="row">
    <div class="form-group col-md-6">
        <label for="exampleInputGame">Game Name</label>
        {{Form::select('game_id',$game,null,['class'=>'form-control','id' => 'exampleInputGame','required','placeholder'=>'Select game'])}}
    </div>
    <div class="form-group col-md-6">
        <label for="exampleInputName">Tournament Name</label>
        {{Form::text('name',null,['class'=>'form-control','id' => 'exampleInputName','required','placeholder'=>'Enter name'])}}
    </div>
    <div class="form-group col-md-6">
        <label>Start Date</label>
        <div class="input-group date" id="startDate">
            {{Form::date('start_date',null,['class'=>'form-control','required','autocomplete'=>'off'])}}
        </div>
    </div>
    <div class="form-group col-md-6">
        <label>Start Time</label>
        <div class="input-group date" id="startTime" data-target-input="nearest">
            {{Form::text('start_time',null,['class'=>'form-control datetimepicker-input','data-target' => '#startTime','required','autocomplete'=>'off'])}}
            <div class="input-group-append" data-target="#startTime" data-toggle="datetimepicker">
                <div class="input-group-text"><i class="far fa-clock"></i></div>
            </div>
        </div>
    </div>
    <div class="form-group col-md-6">
        <label>End Date</label>
        <div class="input-group date" id="endDate">{{Form::date('end_date',null,['class'=>'form-control','required','autocomplete'=>'off'])}}
        </div>
    </div>
    <div class="form-group col-md-6">
        <label>End Time</label>
        <div class="input-group date" id="endTime" data-target-input="nearest">
            {{Form::text('end_time',null,['class'=>'form-control datetimepicker-input','data-target' => '#endTime','required','autocomplete'=>'off'])}}
            <div class="input-group-append" data-target="#endTime" data-toggle="datetimepicker">
              <div class="input-group-text"><i class="far fa-clock"></i></div>
            </div>
        </div>
    </div>
    <div class="form-group col-md-6">
        <label>Session Time</label>
        <div class="input-group" id="sessionTime">
            {{Form::text('session_time',null,['class'=>'form-control','data-target' => '#sessionTime','required','data-inputmask'=>"'mask': '99:99:99'", 'data-mask','autocomplete'=>'off'])}}
          <div class="input-group-text"><i class="far fa-clock"></i></div>
        </div>
    </div>
    <!-- <div class="form-group col-md-6">
        <label for="exampleInputGame">Status</label>
        {{Form::select('status',$status,null,['class'=>'form-control','id' => 'exampleInputGame','required','placeholder'=>'Select status'])}}
    </div> -->
    <div class="form-group col-md-12">
        <label for="exampleInputGame">Description</label>
        {{Form::textarea('description',null,['class'=>'form-control','id' => 'exampleInputGame','placeholder'=>'Enter description'])}}
    </div>
    <div class="form-group col-md-6">
        <label for="exampleInputwinner">Select Winner</label>
        {{Form::select('number_of_winner',$number_of_winner,null,['class'=>'form-control','id' => 'number_of_winner','required','placeholder'=>'Select winner'])}}
    </div>
</div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="winner_block row">
                    @if(isset($tournaments->getReward) && count($tournaments->getReward)>0)
                    @foreach($tournaments->getReward as $value)
                    <input type="hidden" name="winner_id[]" value="{{$value->winner_id}}">
                    <div class="form-group col-md-3">
                        <label for="rank">Winning Rank</label>
                        {{Form::text('rank[]',$value->rank,['class'=>'form-control rank','id' => 'rank','readonly'])}}
                    </div>
                    <div class="form-group col-md-3">
                        <label for="reward_name">Winning Reward Name</label>
                        {{Form::text('reward_name[]',$value->reward_name,['class'=>'form-control reward_name','id' => 'reward_name','required'])}}
                    </div>
                    <div class="form-group col-md-3">
                        <label for="reward">Winning Reward</label>
                        {{Form::text('reward[]',$value->reward,['class'=>'form-control reward','id' => 'reward','required'])}}
                    </div>
                    <div class="form-group col-md-3">
                        <label for="reward_code">Winning Reward Code</label>
                        {{Form::text('reward_code[]',$value->reward_code,['class'=>'form-control reward_code','id' => 'reward_code','required'])}}
                    </div>
                @endforeach
                @endif
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
    <a href="{{ route($path.'.index') }}" type="button" class="btn btn-danger">Cancel</a>
</div>
@include('admin.customJs.validation')
@push('scripts')
<script type="text/javascript">
    /*$('#startDate').datetimepicker({
        format: 'DD/MM/YYYY',
        // minDate: new Date()
    });*/
    $('#startTime').datetimepicker({
        format: 'LT'
    })
    /*$('#endDate').datetimepicker({
        format: 'DD/MM/YYYY',
        // minDate: new Date()
    });*/
    $('#endTime').datetimepicker({
        format: 'LT'
    });
    $('[data-mask]').inputmask();
    /*$("#number_of_winner").change(function() {
        var value = +$(this).val();
        value *= 1;
        var nr = 0;
        var elem = $('#reward_block').empty();
        while (nr < value) {
            elem.append('<div class="form-group col-md-5"><label for="exampleInputwinner">Reward</label><input type="text" name="reward[]" class="form-control reward" placeholder="Enter reward" required></div><div class="form-group col-md-5"><label for="exampleInputwinner">Reward Code</label><input type="text" name="reward_code[]" class="form-control reward_code" placeholder="Enter reward code" required></div>');
            nr++;
        }
    });*/

    $("#number_of_winner").change(function () {
        if($(this).val() != ''){
            var winner = +($(this).val())+1;
            $.ajax({
                url:"{{route('admin.tournaments.winner-list')}}",
                type: 'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {winner:winner},
                success:function(response){
                    $(".winner_block").empty();
                    $(".winner_block").append($(response));
                },
                error:function(){

                }
            });
        }else{
            $(".winner_block").empty();
        }
    })
</script>
@endpush
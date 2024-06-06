@if(isset($winner_list) && count($winner_list)>0)
@foreach($winner_list as $value)
    <input type="hidden" name="winner_id[]" value="{{$value->id}}">
    <div class="form-group col-md-3">
        <label for="rank">Winning Rank</label>
        {{Form::text('rank[]',$value->rank,['class'=>'form-control rank','id' => 'rank','readonly','required'])}}
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
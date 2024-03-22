<div class="row">
    <div class="form-group col-md-6">
        <label for="exampleInputGame">Game Name</label>
        <?php echo e(Form::select('game_id',$game,null,['class'=>'form-control','id' => 'exampleInputGame','required','placeholder'=>'Select Game'])); ?>

    </div>

    <div class="form-group col-md-6">
        <label for="exampleInputName">Tournament Name</label>
        <?php echo e(Form::text('name',null,['class'=>'form-control','id' => 'exampleInputName','required','placeholder'=>'Tournament Name'])); ?>

    </div>

    <div class="form-group col-md-6">
        <label>Start Date</label>
        <div class="input-group date" id="startDate">
            <?php echo e(Form::text('start_date', isset($tournaments) ? date('m/d/Y', strtotime($tournaments->start_date)) : null, ['class'=>'form-control', 'id' => 'start_date', 'required', 'placeholder'=>'mm/dd/yyyy'])); ?>


            
        </div>
    </div>

    <div class="form-group col-md-6">
        <label>Start Time</label>
        <div class="input-group date" id="startTime" data-target-input="nearest">
           

            <?php echo e(Form::text('start_time',null,['class'=>'form-control datetimepicker-input','data-target' => '#startTime','required','autocomplete'=>'off','placeholder'=>'Select Start Time'])); ?>

            <div class="input-group-append" data-target="#startTime" data-toggle="datetimepicker">
                <div class="input-group-text"><i class="far fa-clock"></i></div>
            </div>
        </div>
    </div>

    <div class="form-group col-md-6">
        <label>End Date</label>
        <div class="input-group date" id="endDate">
            <?php echo e(Form::text('end_date', isset($tournaments) ? date('m/d/Y', strtotime($tournaments->end_date)) : null, ['class'=>'form-control', 'id' => 'end_date', 'required', 'placeholder'=>'mm/dd/yyyy'])); ?>

            
        </div>
    </div>

    <div class="form-group col-md-6">
        <label>End Time</label>
        <div class="input-group date" id="endTime" data-target-input="nearest">
            <?php echo e(Form::text('end_time',null,['class'=>'form-control datetimepicker-input','data-target' => '#endTime','required','autocomplete'=>'off','placeholder'=>'Select End Time'])); ?>

            <div class="input-group-append" data-target="#endTime" data-toggle="datetimepicker">
              <div class="input-group-text"><i class="far fa-clock"></i></div>
            </div>
        </div>
    </div>

    <div class="form-group col-md-6">
        <label>Session Time</label>
        <div class="input-group" id="sessionTime">
            <?php echo e(Form::text('session_time',null,['class'=>'form-control','data-target' => '#sessionTime','required','data-inputmask'=>"'mask': '99:99:99'", 'data-mask','autocomplete'=>'off'])); ?>

          <div class="input-group-text"><i class="far fa-clock"></i></div>
        </div>
    </div>

    <div class="form-group col-md-12">
        <label for="exampleInputGame">Description</label>
        <?php echo e(Form::textarea('description',null,['class'=>'form-control','rows' => 4,'id' => 'exampleInputGame','placeholder'=>'Enter description'])); ?>

    </div>

    <?php
        $numbers = [];
        for ($i = 1; $i <= 50; $i++) {
            $numbers[(string)$i] = $i;
        }
    ?>

    <div class="form-group col-md-6">
        <label for="exampleInputwinner">Select Winner</label>
        
        <?php echo e(Form::select('number_of_winner',$numbers,null,['class'=>'form-control','id' => 'number_of_winner','required','placeholder'=>'Select Winner'])); ?>

    </div>
</div>






<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="winner_block row">
                <?php if(isset($tournaments->getReward) && count($tournaments->getReward)>0): ?>
               
                    <?php $__currentLoopData = $tournaments->getReward; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <input type="hidden" name="winner_id[]" value="<?php echo e($value->winner_id); ?>">
                        <div class="form-group col-md-4">
                            <label for="rank">Place</label>
                            <?php echo e(Form::text('rank[]',$value->rank,['class'=>'form-control rank','id' => 'rank','readonly'])); ?>

                        </div>
                        <div class="form-group col-md-4">
                            <label for="reward_name">Type</label>
                            <?php echo e(Form::text('reward_name[]',$value->reward_name,['class'=>'form-control reward_name','id' => 'reward_name','required','readonly'])); ?>

                        </div>
                        <div class="form-group col-md-4">
                            <label for="reward">Reward</label>
                            <?php echo e(Form::text('reward[]',$value->reward,['class'=>'form-control reward','id' => 'reward','required'])); ?>

                            <?php echo e(Form::hidden('reward_code[]',$value->reward_code,['class'=>'form-control reward_code','id' => 'reward_code','required'])); ?>

                        </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="card-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
    <a href="<?php echo e(route($path.'.index')); ?>" type="button" class="btn btn-danger">Cancel</a>
</div>

<?php echo $__env->make('admin.customJs.validation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startPush('scripts'); ?>

<link rel="stylesheet" href="<?php echo e(asset('front/toastr/toastr.min.css')); ?>">
<script src="<?php echo e(asset('front/toastr/toastr.min.js')); ?>"></script>

<script type="text/javascript">
   $(function() {
    $("#start_date").datepicker({
        dateFormat: 'm/d/yy',
        minDate: 0,
        onSelect: function(selectedDate) {
            $("#end_date").datepicker("option", "minDate", selectedDate);
        }
    });
    $("#end_date").datepicker({
        dateFormat: 'm/d/yy'
    });
});
$('#startTime').datetimepicker({
    format: 'LT'
});

$('#endTime').datetimepicker({
    format: 'LT'
});

$('[data-mask]').inputmask();

$('#end_date').on('change', function () {
    var startDate = $('#start_date').val();
    startDate = moment(startDate, 'M/D/YYYY').format('DD-MM-YYYY');
    var endDate = $('#end_date').val();
    endDate = moment(endDate, 'M/D/YYYY').format('DD-MM-YYYY');
    var startTime = $('input[name="start_time"]').val();
    var endTime = $('input[name="end_time"]').val();
    var s_time = $('input[name="session_time"]').val();
    console.log(startDate + '---'+ endDate + '---'+ startTime + '---'+ endTime );
    if (startDate && endDate && startTime && endTime && moment(startDate + ' ' + startTime) >= moment(endDate + ' ' + endTime)) {
        toastr.error('Please select a valid end date and time');
        $('input[name="end_date"]').val('');
        $('input[name="end_time"]').val('');
    }
    if (startDate && endDate && startTime && endTime && s_time) {
    var startDateTime = moment(startDate + ' ' + startTime);
    var endDateTime = moment(endDate + ' ' + endTime);
    var sessionTime = moment.duration(s_time); // Example session time of 3 hours

        if (startDateTime.isSame(endDateTime, 'day') && endDateTime.diff(startDateTime) < sessionTime) {
            toastr.error('please update the End Time (Game duration is greater then session time)');
            $('input[name="end_date"]').val('');
            $('input[name="end_time"]').val('');
        }
    }
});

$('#start_date').on('change', function () {
    var startDate = $('#start_date').val();
    startDate = moment(startDate, 'M/D/YYYY').format('DD-MM-YYYY');
    var endDate = $('#end_date').val();
    endDate = moment(endDate, 'M/D/YYYY').format('DD-MM-YYYY');
    var startTime = $('input[name="start_time"]').val();
    var endTime = $('input[name="end_time"]').val();
    var s_time = $('input[name="session_time"]').val();
    if (startDate && endDate && startTime && endTime && moment(startDate + ' ' + startTime) >= moment(endDate + ' ' + endTime)) {
        $('input[name="end_date"]').val('');
        $('input[name="end_time"]').val('');
     
    }
    if (startDate && endDate && startTime && endTime && s_time) {
    var startDateTime = moment(startDate + ' ' + startTime);
    var endDateTime = moment(endDate + ' ' + endTime);
    var sessionTime = moment.duration(s_time); // Example session time of 3 hours

        if (startDateTime.isSame(endDateTime, 'day') && endDateTime.diff(startDateTime) < sessionTime) {
            toastr.error('please update the End Time (Game duration is greater then session time)');
            $('input[name="end_date"]').val('');
            $('input[name="end_time"]').val('');
        }
    }
});



$('#endTime').on('change.datetimepicker', function(e) {

    var startDate = $('#start_date').val();
    startDate = moment(startDate, 'M/D/YYYY').format('DD-MM-YYYY');
    var endDate = $('#end_date').val();
    endDate = moment(endDate, 'M/D/YYYY').format('DD-MM-YYYY');
    var startTime = $('input[name="start_time"]').val();
    var endTime = $('input[name="end_time"]').val();
    var s_time = $('input[name="session_time"]').val();
    console.log(startDate + '---'+ endDate + '---'+ startTime + '---'+ endTime );
    if (startDate && endDate && startTime && endTime && moment(startDate + ' ' + startTime, 'YYYY-MM-DD LT') >= moment(endDate + ' ' + endTime, 'YYYY-MM-DD LT')) {
            toastr.error('Please select a valid end date and time');
            $('input[name="end_time"]').val('');
    }
    if (startDate && endDate && startTime && endTime && s_time) {
    var startDateTime = moment(startDate + ' ' + startTime);
    var endDateTime = moment(endDate + ' ' + endTime);
    var sessionTime = moment.duration(s_time); // Example session time of 3 hours

        if (startDateTime.isSame(endDateTime, 'day') && endDateTime.diff(startDateTime) < sessionTime) {
            toastr.error('please update the End Time (Game duration is greater then session time)');
            $('input[name="end_date"]').val('');
            $('input[name="end_time"]').val('');
        }
    }
});

$('#start_time').on('change.datetimepicker', function(e) {

    var startDate = $('#start_date').val();
    startDate = moment(startDate, 'M/D/YYYY').format('DD-MM-YYYY');
    var endDate = $('#end_date').val();
    endDate = moment(endDate, 'M/D/YYYY').format('DD-MM-YYYY');
    var startTime = $('input[name="start_time"]').val();
    var endTime = $('input[name="end_time"]').val();
    var s_time = $('input[name="session_time"]').val();
    console.log(startDate + '---'+ endDate + '---'+ startTime + '---'+ endTime );
    if (startDate && endDate && startTime && endTime && moment(startDate + ' ' + startTime) >= moment(endDate + ' ' + endTime)) {
        $('input[name="end_time"]').val('');
    }

    if (startDate && endDate && startTime && endTime && s_time) {
    var startDateTime = moment(startDate + ' ' + startTime);
    var endDateTime = moment(endDate + ' ' + endTime);
    var sessionTime = moment.duration(s_time); // Example session time of 3 hours

        if (startDateTime.isSame(endDateTime, 'day') && endDateTime.diff(startDateTime) < sessionTime) {
            toastr.error('please update the End Time (Game duration is greater then session time)');
            $('input[name="end_date"]').val('');
            $('input[name="end_time"]').val('');
        }
    }
});


    $("#number_of_winner").change(function () {
        if($(this).val() != ''){
            var winner = +($(this).val())+1;
            $.ajax({
                url:"<?php echo e(route('admin.tournaments.winner-list')); ?>",
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
    });

    function rewardData(reward_id,key)
    {

      var winner_id =  $("#winner_id_"+key).val();

      if(winner_id != ''){
            var winner = winner_id;
            $.ajax({
                url:"<?php echo e(route('admin.tournaments.reward-data')); ?>",
                type: 'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {winner_id:winner_id,reward_id:reward_id},
                success:function(response){
                
                   
                    $("#reward_name_"+key).val(response.reward_name);
                    $("#reward_code_"+key).val(response.reward_code);
                },
                error:function(){
                    console.log(response.error);
                }
            });
        }else{
            // $("#rank_"+key).val('');
            $("#reward_name_"+key).val('');
            $("#reward_"+key).val('');
            $("#reward_code_"+key).val('');
        }
     
        // $("#reward_name_"+key).val(response.reward_name);
        // $("#reward_"+key).val(response.reward);
        // $("#reward_code_"+key).val(response.reward_code);

    }

    function winnerData(winner_id,key)
    {
        if(winner_id != ''){
            var winner = winner_id;
            $.ajax({
                url:"<?php echo e(route('admin.tournaments.winner-data')); ?>",
                type: 'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {winner_id:winner_id},
                success:function(response){
                
                    var rewardSelect = $("#reward_" + key);
                    rewardSelect.empty(); // Clear existing options
                    rewardSelect.append($("<option></option>")
                            .attr("value", '')
                            .text('Select Reward'));
                    $.each(response, function(key, value) {
                        rewardSelect.append($("<option></option>")
                            .attr("value", value['reward'])
                            .text(value['reward']));
                    });
                    // $("#reward_name_"+key).val(response.reward_name);
                    // $("#reward_"+key).val(response.reward);
                    // $("#reward_code_"+key).val(response.reward_code);
                },
                error:function(){
                    console.log(response.error);
                }
            });
        }else{
            // $("#rank_"+key).val('');
            $("#reward_name_"+key).val('');
            $("#reward_"+key).val('');
            $("#reward_code_"+key).val('');
        }
    }
</script>
<?php $__env->stopPush(); ?>
<?php /**PATH /var/www/html/iwin/resources/views/admin/tournaments/form.blade.php ENDPATH**/ ?>



<?php
for ($i=1; $i < $winner_total; $i++) {
?>
    <div class="form-group col-md-4">
        <label for="rank">Place </label>
        <?php echo e(Form::text('rank[]',$i,['class'=>'form-control rank','id' => 'rank_'.$i,'placeholder'=>'Rank','readonly','required'])); ?>

    </div>

    <div class="form-group col-md-4">
        <label for="reward_name">Type</label>
        <?php echo e(Form::select('winner_id[]',$reward_list,'',['onchange'=>'winnerData(this.value,'.$i.')','placeholder'=>'No Reward','class'=>'form-control winner_id','id' => 'winner_id_'.$i,'required'])); ?>

    </div>

    <div class="form-group col-md-4">
        <label for="reward">Reward</label>
        <?php echo e(Form::select('reward[]', [], null, ['onchange'=>'rewardData(this.value,'.$i.')','class'=>'form-control reward', 'id' => 'reward_'.$i, 'required'])); ?>

        <?php echo e(Form::hidden('reward_name[]', null, ['class'=>'form-control reward_name', 'id' => 'reward_name_'.$i, 'required'])); ?>

        <?php echo e(Form::hidden('reward_code[]', null, ['class'=>'form-control reward_code', 'id' => 'reward_code_'.$i, 'required'])); ?>

    </div>

    
<?php
}
?>

<?php /**PATH /var/www/html/iwin/resources/views/admin/tournaments/winner_list.blade.php ENDPATH**/ ?>
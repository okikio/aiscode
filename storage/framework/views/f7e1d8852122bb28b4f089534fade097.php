<div class="row">
    <div class="form-group col-md-6">
        <label for="exampleInputName">First Name</label>
        <?php echo e(Form::text('name',null,['class'=>'form-control','id' => 'exampleInputName','required','placeholder'=>'Enter first name'])); ?>

    </div>
    <div class="form-group col-md-6">
        <label for="exampleInputName">Last Name</label>
        <?php echo e(Form::text('last_name',null,['class'=>'form-control','id' => 'exampleInputName','required','placeholder'=>'Enter last name'])); ?>

    </div>
    <div class="form-group col-md-6">
        <label for="exampleInputEmail">Email</label>
        <?php echo e(Form::email('email',null,['class'=>'form-control','id' => 'exampleInputEmail','required','placeholder'=>'Enter email'])); ?>

        <div class="alert-danger">
            <?php echo e($errors->first('email')); ?>

        </div>
    </div>
    <div class="form-group col-md-6">
        <label for="exampleInputDOB">Date of Birth</label>
        <?php echo e(Form::text('birth_date', isset($user) ? date('m/d/Y', strtotime($user->birth_date)) : null, ['class'=>'form-control', 'id' => 'exampleInputDOB', 'required', 'placeholder'=>'mm/dd/yyyy'])); ?>

        
    </div>
    <div class="form-group col-md-6">
        <label for="exampleInputNickname">Username</label>
        <?php echo e(Form::text('nick_name',null,['class'=>'form-control','id' => 'exampleInputNickname','required','placeholder'=>'Enter username'])); ?>

    </div>
    <div class="form-group col-md-6">
        <label for="exampleInputPhone">Phone Number</label>
        <?php echo e(Form::text('phone_number',null,['class'=>'form-control','id' => 'exampleInputPhone','required','placeholder'=>'Enter phone number'])); ?>

        <div class="alert-danger">
            <?php echo e($errors->first('phone_number')); ?>

        </div>
    </div>
    <!-- <div class="form-group col-md-6">
        <label for="exampleInputAddress">Address</label>
        <?php echo e(Form::text('address',null,['class'=>'form-control','id' => 'exampleInputAddress','required','placeholder'=>'Enter address'])); ?>

    </div>
    <div class="form-group col-md-6">
        <label for="exampleInputZipcode">Zipcode</label>
        <?php echo e(Form::text('zipcode',null,['class'=>'form-control','id' => 'exampleInputZipcode','required','placeholder'=>'Enter zipcode'])); ?>

    </div>
    <div class="form-group col-md-6">
        <label for="exampleInputCountry">Country</label>
        <?php echo e(Form::text('country',null,['class'=>'form-control','id' => 'exampleInputCountry','required','placeholder'=>'Enter country'])); ?>

    </div>
    <div class="form-group col-md-6">
        <label for="exampleInputState">State</label>
        <?php echo e(Form::text('state',null,['class'=>'form-control','id' => 'exampleInputState','required','placeholder'=>'Enter state'])); ?>

    </div> -->
    <div class="form-group col-md-6">
        <label for="exampleInputName">Affiliate User
        </label>
        <?php echo e(Form::select('affiliate_id',$affiliate,null,['class'=>'form-control','id' => 'exampleInputName','placeholder'=>'Select Affiliate User'])); ?>

    </div>
</div>
<div class="card-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
    <a href="<?php echo e(route($path.'.index')); ?>" type="button" class="btn btn-danger">Cancel</a>
</div>
<?php $__env->startPush('customJs'); ?>
<script>
    $(function() {
        $("#exampleInputDOB").datepicker({
            dateFormat: 'm/d/yy' // Use 'yy' for four-digit years
        });
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.customJs.validation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/iwin/resources/views/admin/user/form.blade.php ENDPATH**/ ?>
<?php $__env->startSection('page_title', 'Profile'); ?>

<?php $__env->startSection('content'); ?>
<div class="inner-content edit-profile-rows">
    <div class="col-xl-9">
        <div class="inner-item-heading position-lg-absolute" style="margin-bottom: 0 !important;">
            <h2 class="f-24 fw-700 text-white text-uppercase montserrat-font mb-0">Profile</h2>
        </div>
    </div>
    <div class="row py-lg-0 py-3">
        <div class="col-xl-9" >
            <?php echo Form::model($user,['route' => ['front.update-profile'],'id'=>'profile-from','files'=>true]); ?>

                <div class="row py-md-0 py-2 profile-row">
                    <div class="col-md-3">
                        <div class="avatar-upload profile-img-box ">
                            <div class="avatar-edit">
                                <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" name="image" />
                                <label for="imageUpload"><img src="<?php echo e(asset('front/images/upload-btn.png')); ?>" alt=""> </label>
                            </div>
                            <div class="avatar-preview profile-img">
                                <div id="imagePreview" style="background-image:url(<?php echo e(auth()->user()->image); ?>);">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="profile-from">
                            <div class="row gy-2 gx-2 align-items-start">
                                <div class="col-md-12 text-md-end text-center">
                                <button type="submit" class="btn rounded-pill gradient-bg"><i class="fa-regular fa-pen-to-square"></i> &nbsp; Edit Save </button>
                                    <a href="<?php echo e(route('front.profile')); ?>" class="btn btn-light rounded-pill px-md-5 px-4 ms-md-0 ms-2">Cancel</a>
                                </div>

                                <div class="col-md-4 form-group">
                                    <label class="col-form-label">First Name</label>
                                    <?php echo e(Form::text('name',null,['class'=>'form-control','id' => 'name','required','placeholder'=>'Enter name'])); ?>

                                </div>

                                <div class="col-md-4 form-group">
                                    <label class="col-form-label">Last Name</label>
                                    <?php echo e(Form::text('last_name',null,['class'=>'form-control','id' => 'last_name','required','placeholder'=>'Enter last name'])); ?>

                                </div>
                                <div class="col-md-4 form-group">
                                    <label class="col-form-label">User Name</label>
                                    <?php echo e(Form::text('nick_name',null,['class'=>'form-control','id' => 'nick_name','required','placeholder'=>'Enter user name'])); ?>

                                </div>
                               

                                

                                <div class="col-md-6 form-group">
                                    <label class="col-form-label">Enter Email</label>
                                    <?php echo e(Form::text('email',null,['class'=>'form-control','id' => 'email','required','placeholder'=>'Enter email','readonly','data-toggle'=>"tooltip",'data-placement'=>"bottom",'title' => 'Email is readonly'])); ?>

                                </div>

                                <div class="col-md-6 form-group">
                                    <label class="col-form-label">Phone Number</label>
                                    <?php echo e(Form::text('phone_number', null, [
                                'class' => 'form-control',
                                'id' => 'phone_number',
                                'required',
                                'pattern' => '\d{7,12}',
                                'title' => 'Please enter a valid phone number (7-12 digits)',
                                'placeholder' => 'Enter phone number',
                                'maxlength' => '12',
                                'minlength' => '7',
                                'onkeypress' => 'return event.charCode >= 48 && event.charCode <= 57'
                            ])); ?>

                                </div>

                                <div class="col-md-6 form-group">
                                    <label class="col-form-label">Date of Birth</label>
                                    <?php echo e(Form::date('birth_date',null,['class'=>'form-control','id' => 'birth_date','required','placeholder'=>'Select birth date'])); ?>

                                </div>

                                <div class="col-md-6 form-group">
                                    <label class="col-form-label">Address</label>
                                    <?php echo e(Form::text('address',null,['class'=>'form-control','id' => 'address','required','placeholder'=>'Enter address'])); ?>

                                </div>

                                <div class="col-md-4 form-group">
                                    <label class="col-form-label">Zipcode</label>
                                    <?php echo e(Form::number('zipcode',null,['class'=>'form-control','id' => 'zipcode','required','placeholder'=>'Enter zipcode'])); ?>

                                </div>

                                <div class="col-md-4 form-group">
                                    <label class="col-form-label">State</label>
                                    <?php echo e(Form::text('state',null,['class'=>'form-control','id' => 'state','required','placeholder'=>'Enter state'])); ?>

                                </div>

                                <div class="col-md-4 form-group">
                                    <label class="col-form-label">Country</label>
                                    <?php echo e(Form::text('country',null,['class'=>'form-control','id' => 'country','required','placeholder'=>'Enter country'])); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php echo Form::close(); ?>

        </div>
        <div class="col-xl-3">
            <?php echo $__env->make('front.partials.announcement', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('customJs'); ?>
    <!-- jquery-validation -->
    <script src="<?php echo e(asset('front/js/jquery-validation/jquery.validate.min.js')); ?>"></script>
    <script src="<?php echo e(asset('front/js/jquery-validation/additional-methods.min.js')); ?>"></script>
    <?php echo $__env->make('front.customJs.register', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('front.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/iwin/resources/views/front/user/edit-profile.blade.php ENDPATH**/ ?>
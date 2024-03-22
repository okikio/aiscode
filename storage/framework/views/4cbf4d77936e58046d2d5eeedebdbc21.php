<?php $__env->startSection('page_title', 'Forget Password'); ?>
<?php $__env->startSection('content'); ?>
<div class="card-body">
  <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>
  <?php echo Form::open(['route' => 'admin.sendLinkToUser','method' => 'post','id' => 'loginform','class' =>'pt-3'] ); ?>

    <div class="input-group mb-3">
      <input type="email" name="email" class="form-control" placeholder="Email">
      <div class="input-group-append">
        <div class="input-group-text">
          <span class="fas fa-envelope"></span>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <button type="submit" class="btn btn-primary btn-block">Request new password</button>
      </div>
      <!-- /.col -->
    </div>
  <?php echo Form::close(); ?>

  <p class="mt-3 mb-1">
    <a href="<?php echo e(route('admin.login')); ?>" class="auth-link text-black">Want to Signin?</a>
  </p>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/iwin/resources/views/admin/auth/resetPassword.blade.php ENDPATH**/ ?>
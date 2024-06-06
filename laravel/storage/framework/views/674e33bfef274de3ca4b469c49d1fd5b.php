<?php $__env->startSection('page_title', 'Sign In'); ?>
<?php $__env->startSection('content'); ?>
<div class="card-body">
  <p class="login-box-msg">Sign in</p>
  <form action="<?php echo e(route('admin.login.submit')); ?>" method="post" id="loginForm">
    <?php echo csrf_field(); ?>
    <div class="input-group mb-3">
      <input type="email" class="form-control" placeholder="Email" name="email" required>
      <div class="input-group-append">
        <div class="input-group-text">
          <span class="fas fa-envelope"></span>
        </div>
      </div>
    </div>
    <div class="input-group mb-3">
      <input type="password" class="form-control" placeholder="Password" name="password" required>
      <div class="input-group-append togglePassword">
        <div class="input-group-text toggle-password">
          <span class="fas fa-lock"></span>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-8">
        <div class="icheck-primary">
          <input type="checkbox" id="remember" name="remember_me" value="remember_me">
          <label for="remember">
            Remember Me
          </label>
        </div>
      </div>
      <!-- /.col -->
      <div class="col-4">
        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
      </div>
      <!-- /.col -->
    </div>
  </form>

  <div class="social-auth-links text-center mt-2 mb-3">
    <a href="<?php echo e(route('admin.resetpassword')); ?>" class="btn btn-block btn-danger">
      <i class="fas fa-frown mr-2"></i> I forgot my password
    </a>
  </div>
  <!-- /.social-auth-links -->
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('customJs'); ?>
<?php echo $__env->make('admin.customJs.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel/iwin/iwin/resources/views/admin/auth/login.blade.php ENDPATH**/ ?>
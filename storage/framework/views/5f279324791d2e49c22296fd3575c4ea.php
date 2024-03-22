<?php $__env->startSection('page_title', 'SignIn'); ?>
<?php $__env->startSection('content'); ?>

<div class="login-sec">

  <div class="col-lg-5 col-11  m-auto">
  <div class="header-ads mobile-ads">
        <script type="text/javascript">
                atOptions = {
                    'key' : '586bb6c7e998732050750222dcbae9da',
                    'format' : 'iframe',
                    'height' : 60,
                    'width' : 468,
                    'params' : {}
                };
            </script>
                <script  type="text/javascript" src="https://www.topcreativeformat.com/586bb6c7e998732050750222dcbae9da/invoke.js"></script>
            
            </div>
    <div class="login-from">
      <div class="form-header">
        <h2 class="f-15 text-uppercase text-white text-center mb-0 fw-bold montserrat-font">Log in with</h2>
      </div>
      <div class="d-flex gap-lg-5 gap-3 justify-content-center py-md-2 py-2 my-1">
        <a href ="<?php echo e(route('front.socialLogin',['google'])); ?>"> <img src="<?php echo e(asset('front/images/google.png')); ?>" alt="google" class="img-fluid"></a>
        <a href ="<?php echo e(route('front.socialLogin',['facebook'])); ?>" class="d-flex align-items-center"> <img src="<?php echo e(asset('front/images/facebook.png')); ?>" alt="facebook" class="img-fluid"></a>
      </div>
      <div class="divider d-flex align-items-center mb-lg-4 mb-2">
        <p class="text-center  text-white mx-3 mb-0 light-dark f-12 fw-300 montserrat-font">OR</p>
      </div>
      <form action="<?php echo e(route('front.login.submit')); ?>" method="post" id="loginForm">
        <?php echo csrf_field(); ?>
        <div class="mb-3">
          <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email" required>
        </div>
        <div class="mb-3">
          <input type="password" name="password" class="form-control" id="email" placeholder="Enter Password" required>
        </div>
        <div class="mb-3 text-center ">
          <button class="gaming-btn" type="submit" class="btn btn-primary">
            <span class="btn" >Log In</span>
          </button>
        </div>
      </form>
      <div class="form-footer text-center">
        <p class="mb-0 f-13 text-white">Don't have any account? <a href="<?php echo e(route('front.register')); ?>" class="primary-color">Sign Up</a>
        </p>
        <a href="<?php echo e(route('front.resetpassword')); ?>" class="text-white f-13">Forgot Password ?</a>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/iwin/resources/views/front/auth/login.blade.php ENDPATH**/ ?>
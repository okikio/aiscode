<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo e(asset('front/images/favicon-32x32.png')); ?>" />
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(asset('front/images/favicon-16x16.png')); ?>" />
  <title>IWin Gaming | <?php echo $__env->yieldContent('page_title'); ?></title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" referrerpolicy="no-referrer" />
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset('front/css/bootstrap.min.css')); ?>" media="all" />
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset('front/css/owl.carousel.min.css')); ?>" media="all" />
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset('front/css/header.css')); ?>" media="all" />
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset('front/css/footer.css')); ?>" media="all" />
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset('front/css/sidebar.css')); ?>" media="all" />
  <!-- Toastr -->
  <link rel="stylesheet" href="<?php echo e(asset('front/toastr/toastr.min.css')); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset('front/css/style.css')); ?>" media="all" />
  <?php echo $__env->yieldPushContent('css'); ?>
</head>
<body>
  <div id="preloader" class="preloader" style="display:none;">
    <div id="loader"></div>
  </div>
  <!-- header  -->
  <header id="header">
     <?php echo $__env->make('front.partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  </header>
  <div class="content">
    <div class="container-fluid">
      <div class="main-content">
        <div id="sidebar-left">
          <?php echo $__env->make('front.partials.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <div class="middle-content">
          <?php echo $__env->yieldContent('content'); ?>
        </div>
      </div>
    </div>
  </div>
  <!-- verfication popup -->
  <!-- Modal -->
  <div class="modal fade" id="verification" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="verificationLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body">
         <h4 class="f-20 text-white">We have sent you a verification link on your registered email address</h4>
        </div>
        <div class="modal-footer justify-content-center border-0">
          <a href="<?php echo e(route('home')); ?>" type="button" class="btn btn-primary">Okay</a>
        </div>
      </div>
    </div>
  </div>
  <!-- footer -->
  <footer id="footer" class="primary-bg overflow-hidden">
    <?php echo $__env->make('front.partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  </footer>
  <script src="<?php echo e(asset('front/js/jquery.min.js')); ?>"></script>
  <script src="<?php echo e(asset('front/js/bundle.min.js')); ?>"></script>
  <script src="<?php echo e(asset('front/js/owl.carousel.min.js')); ?>"></script>
  <script src="<?php echo e(asset('front/js/slider.js')); ?>"></script>
  <script src="<?php echo e(asset('front/toastr/toastr.min.js')); ?>"></script>
  <?php echo $__env->yieldPushContent('scripts'); ?>
  <?php echo $__env->yieldPushContent('customJs'); ?>
</body>
</html><?php /**PATH /var/www/html/iwin/resources/views/front/layouts/auth.blade.php ENDPATH**/ ?>
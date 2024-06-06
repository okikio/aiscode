<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo e(asset('front/images/favicon-32x32.png')); ?>" />
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(asset('front/images/favicon-16x16.png')); ?>" />
  <title>IWin Gaming | <?php echo $__env->yieldContent('page_title'); ?></title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    referrerpolicy="no-referrer" />
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset('front/css/bootstrap.min.css')); ?>" media="all" />
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset('front/css/owl.carousel.min.css')); ?>" media="all" />
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset('front/css/header.css')); ?>" media="all" />
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset('front/css/footer.css')); ?>" media="all" />
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset('front/css/sidebar.css')); ?>" media="all" />
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset('front/css/style.css')); ?>" media="all" />
  <!-- Toastr -->
  <link rel="stylesheet" href="<?php echo e(asset('front/toastr/toastr.min.css')); ?>">
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
        <div class="middle-content py-3 px-md-4 px-3">
          <?php echo $__env->yieldContent('content'); ?>
        </div>
      </div>
    </div>
  </div>
  
<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="movieTick" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="movieTickLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header border-0 p-0">
        <h1 class="modal-title fs-5" id="movieTickLabel"></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
    <h4>Coming Soon</h4>
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
</html><?php /**PATH /var/www/html/laravel/iwin/client_iwin/aiscode/resources/views/front/layouts/main.blade.php ENDPATH**/ ?>
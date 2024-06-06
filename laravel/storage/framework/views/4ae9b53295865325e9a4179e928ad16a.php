<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>IWin | <?php echo $__env->yieldContent('page_title'); ?></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo e(asset('adminassets/plugins/fontawesome-free/css/all.min.css')); ?>">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo e(asset('adminassets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')); ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo e(asset('adminassets/dist/css/adminlte.min.css')); ?>">
  <?php echo $__env->yieldPushContent('css'); ?>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="<?php echo e(route('admin.login')); ?>" class="h1"><b>I</b>Win</a>
    </div>
    <?php echo $__env->yieldContent('content'); ?>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?php echo e(asset('adminassets/plugins/jquery/jquery.min.js')); ?>"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo e(asset('adminassets/plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
<!-- jquery-validation -->
<script src="<?php echo e(asset('adminassets/plugins/jquery-validation/jquery.validate.min.js')); ?>"></script>
<script src="<?php echo e(asset('adminassets/plugins/jquery-validation/additional-methods.min.js')); ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo e(asset('adminassets/dist/js/adminlte.min.js')); ?>"></script>
<?php echo $__env->yieldPushContent('scripts'); ?>
<?php echo $__env->yieldPushContent('customJs'); ?>
</body>
</html><?php /**PATH /var/www/html/iwin/resources/views/admin/layouts/auth.blade.php ENDPATH**/ ?>
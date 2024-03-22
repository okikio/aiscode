<?php $__env->startSection('page_title', 'Dashboard'); ?>
<?php $__env->startSection('breadcrumb','Dashboard'); ?>
<?php $__env->startSection('content'); ?>
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
          <div class="inner">
            <h6>Total number of registered users</h6>
            <h3><?php echo e($user); ?></h3>
          </div>
          <div class="icon">
            <i class="ion ion-person"></i>
          </div>
        </div>
      </div>
      <!-- <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
          <div class="inner">
            <h3><?php echo e($game); ?></h3>

            <p>Total Game</p>
          </div>
          <div class="icon">
            <i class="ion ion-ios-list-outline"></i>
          </div>
        </div>
      </div> -->
      <!-- <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
          <div class="inner">
            <h3><?php echo e($category); ?></h3>

            <p>Total Category</p>
          </div>
          <div class="icon">
            <i class="ion ion-ios-list"></i>
          </div>
        </div>
      </div> -->
      <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
          <div class="inner">
            <h6>Total number of Tournaments</h6>
            <h3><?php echo e($tournaments); ?></h3>
          </div>
          <div class="icon">
            <i class="ion ion-ios-briefcase"></i>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
          <div class="inner">
            <h6>Total number of Active Users</h6>
            <h3><?php echo e($activeUser); ?></h3>
          </div>
          <div class="icon">
            <i class="ion ion-ios-person"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/iwin/resources/views/admin/dashboard.blade.php ENDPATH**/ ?>
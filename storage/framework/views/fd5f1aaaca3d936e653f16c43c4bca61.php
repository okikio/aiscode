<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
  </ul>
  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    
    <li class="nav-item">
      <a class="nav-link" data-widget="fullscreen" href="#" role="button" title="Full screen">
        <i class="fas fa-expand-arrows-alt"></i>
      </a>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
            <img src="<?php echo e(auth()->user()->image); ?>" class="img-circle elevation-2 mr-2" alt="User Image" width="30px" height="30px">
            <span>
                <?php echo e(auth()->user()->name); ?>

            </span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <a href="<?php echo e(route('admin.profile')); ?>" class="dropdown-item">
                <i class="nav-icon far fa-circle text-info mr-2"></i> Profile
            </a>
            <div class="dropdown-divider"></div>
            <a href="<?php echo e(route('admin.logout')); ?>" class="dropdown-item">
                <i class="nav-icon far fa-circle text-warning mr-2"></i> Logout
            </a>
            <div class="dropdown-divider"></div>
        </div>
    </li>
  </ul>
</nav>
<?php /**PATH /var/www/html/iwin/resources/views/admin/partials/header.blade.php ENDPATH**/ ?>
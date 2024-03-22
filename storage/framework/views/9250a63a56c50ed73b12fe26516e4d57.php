<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="<?php echo e(route('admin.dashboard')); ?>" class="brand-link">
    
    <img src="<?php echo e(asset('front/images/favicon-32x32.png')); ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light"><?php echo e(env('APP_NAME')); ?></span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->

    

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="<?php echo e(route('admin.dashboard')); ?>" class="nav-link <?php if(Request::segment(2) == 'dashboard'): ?> active <?php endif; ?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo e(route('admin.user.index')); ?>" class="nav-link <?php if(Request::segment(2) == 'user'): ?> active <?php endif; ?>">
            <i class="nav-icon fas fa-users"></i>
            <p>
              User Management
            </p>
          </a>
        </li>
        <!-- <li class="nav-item">
          <a href="<?php echo e(route('admin.category.index')); ?>" class="nav-link <?php if(Request::segment(2) == 'category'): ?> active <?php endif; ?>">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Game Category
            </p>
          </a>
        </li> -->
        <!-- <li class="nav-item">
          <a href="<?php echo e(route('admin.game.index')); ?>" class="nav-link <?php if(Request::segment(2) == 'game'): ?> active <?php endif; ?>">
            <i class="nav-icon fas fa-chart-pie"></i>
            <p>
              Game Management
            </p>
          </a>
        </li> -->
        <li class="nav-item">
          <a href="<?php echo e(route('admin.affiliate-ads.index')); ?>" class="nav-link <?php if(Request::segment(2) == 'affiliate-ads'): ?> active <?php endif; ?>">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Affiliate Ads Revenue
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo e(route('admin.winner.index')); ?>" class="nav-link <?php if(Request::segment(2) == 'winner'): ?> active <?php endif; ?>">
            <i class="nav-icon fas fa-flag"></i>
            <p>
                Prize Management
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo e(route('admin.tournaments.index')); ?>" class="nav-link <?php if(Request::segment(2) == 'tournaments'): ?> active <?php endif; ?>">
            <i class="nav-icon fas fa-list"></i>
            <p>
              Tournaments
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo e(route('admin.cms-page.index')); ?>" class="nav-link <?php if(Request::segment(2) == 'cms-page'): ?> active <?php endif; ?>">
            <i class="nav-icon fas fa-table"></i>
            <p>
              CMS Pages
            </p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
<?php /**PATH /var/www/html/iwin/resources/views/admin/partials/sidebar.blade.php ENDPATH**/ ?>

<div class="games-room-btns  desktop">
  <?php if(Request::segment(1) == 'tournaments'): ?>
  <a href="<?php echo e(route('home')); ?>" class="btn rounded-pill <?php if(Request::segment(1) == ''): ?> gradient-bg <?php else: ?> btn-light <?php endif; ?> px-5">Practice </a>
  <?php endif; ?>
  <?php if(Request::segment(1) == ''): ?>
  <?php if(auth()->guard()->check()): ?>
    <a href="<?php echo e(route('front.tournaments')); ?>" class="btn rounded-pill px-5 btn-light"  style="background-color: red; border-color:red">Tournaments</a>
  <?php else: ?>
    <a href="<?php echo e(route('front.login')); ?>" class="btn rounded-pill btn-light px-5" style="background-color: red; border-color:red">Tournaments</a>
  <?php endif; ?>
  <?php endif; ?>
</div><?php /**PATH /var/www/html/laravel/iwin/client_iwin/aiscode/resources/views/front/partials/subheader.blade.php ENDPATH**/ ?>
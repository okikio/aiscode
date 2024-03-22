<nav>
  <div class="nav nav-tabs" id="games-tab" role="tablist">
    <button class="nav-link" id="nav-all-tab" data-bs-toggle="tab" data-bs-target="#nav-all" type="button" role="tab" aria-controls="nav-all" aria-selected="true">All</button>
  <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $catKey => $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <button class="nav-link" id="nav-<?php echo e($cat->slug); ?>-tab" data-bs-toggle="tab" data-bs-target="#nav-<?php echo e($cat->slug); ?>" type="button" role="tab" aria-controls="nav-<?php echo e($cat->slug); ?>" aria-selected="true"><?php echo e($cat->name); ?></button>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>
</nav><?php /**PATH /var/www/html/iwin/resources/views/front/partials/navbar.blade.php ENDPATH**/ ?>
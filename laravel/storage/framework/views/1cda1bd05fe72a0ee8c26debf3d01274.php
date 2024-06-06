$(function(){window.<?php echo e(config('datatables-html.namespace', 'LaravelDataTables')); ?>=window.<?php echo e(config('datatables-html.namespace', 'LaravelDataTables')); ?>||{};window.<?php echo e(config('datatables-html.namespace', 'LaravelDataTables')); ?>["%1$s"]=$("#%1$s").DataTable(%2$s);});
<?php $__currentLoopData = $scripts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $script): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php echo $__env->make($script, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH /var/www/html/iwin/vendor/yajra/laravel-datatables-html/src/resources/views/script.blade.php ENDPATH**/ ?>
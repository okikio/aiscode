<div class="help-box">
	<?php echo $__env->make('front.partials.video', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<?php if(auth()->guard()->check()): ?>
	<a href="<?php echo e(route('front.tournaments')); ?>" class="f-14 fw-600 btn btn-secondary text-uppercase w-100 montserrat-font tournament-btn">Tournaments</a>
	<?php else: ?>
	<a href="<?php echo e(route('front.login')); ?>" class="f-14 fw-600 btn btn-secondary text-uppercase w-100 montserrat-font tournament-btn">Tournaments</a>
	<?php endif; ?>
	<div class="tournament-box mt-3">
	  <div class="tournament-header">
	  <h2 class="f-14 fw-700 text-white montserrat-font mb-0">ANNOUNCEMENT</h2>
	   </div>
	  	<div class="tournament-item text-center">
		  	<div class="tournament-end">
			  	<?php $__currentLoopData = $future_tournaments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ft): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			    <p class="f-12 text-white">
			    	<?php echo e($ft->name); ?> Tournament Begins on <?php echo e(date('M dS', strtotime($ft->start_date))); ?>

			    </p>
			    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			    <?php $__currentLoopData = $winning_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $wd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			    <p class="f-12 text-white ">
			    	<?php echo e($wd->getUser->name); ?> wins <?php echo e($wd->reward); ?> in <?php echo e($wd->getTournaments->name); ?> Tournaments
			    </p>
			    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		  	</div>
	  	</div>
	</div>
</div><?php /**PATH /var/www/html/laravel/iwin/iwin/resources/views/front/partials/announcement.blade.php ENDPATH**/ ?>
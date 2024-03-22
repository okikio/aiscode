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
				<p class="f-12 text-white">
					New tournaments starting soon.  Check back frequently.
				</p>
				<p class="f-12 text-white">
					Check out our Partners Page to see which nonprofits and celebrities we are working with.
				</p>
				<p class="f-12 text-white">
					If you represent a NPO and would like to benefit from partnering with us, drop us a note.
				</p>
				<p class="f-12 text-white">
					The prize values in our tournaments will continue to grow.  Check back regularly.
				</p>
			  	

			    
		  	</div>
	  	</div>
	</div>
</div><?php /**PATH /var/www/html/iwin/resources/views/front/partials/announcement.blade.php ENDPATH**/ ?>
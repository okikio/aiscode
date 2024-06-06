<?php $__env->startSection('page_title', 'Tournaments'); ?>
<?php $__env->startSection('content'); ?>
<div class="inner-content">
  <div class="row pb-3 pt-1">
  <div class="text-center">
      <!-- <div class="header-ads mobile-ads">
       <script type="text/javascript">
          atOptions = {
            'key' : '586bb6c7e998732050750222dcbae9da',
            'format' : 'iframe',
            'height' : 60,
            'width' : 468,
            'params' : {}
          };
       </script>
        <script  type="text/javascript" src="https://www.topcreativeformat.com/586bb6c7e998732050750222dcbae9da/invoke.js"></script>
       </div> -->
 </div>
    <div class="col-xl-9">
      <div class="inner-item-heading mb-1 d-flex  flex-m-column gap-3 ">
        <div class="d-flex gap-3 align-items-md-center">
          <a href="<?php echo e(route('front.tournaments')); ?>" class="f-20 back-btn"><i class="fa-solid fa-arrow-left"></i></a>
          <h2 class="f-24 fw-700 text-white text-uppercase montserrat-font mb-0"><?php echo e($tournaments->name); ?></h2>
        </div>
        <?php echo $__env->make('front.partials.adsmobile', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="game-end-timer">
          <input type="hidden" name="tournaments_id" value="<?php echo e($tournaments->id); ?>" id="tournaments_id">
          <input type="hidden" name="user_id" value="<?php echo e(auth()->user()->id); ?>" id="user_id">
          <!-- <p class="f-13 game-end-timer-header mb-0">Ends In</p>
          <p class="f-13 mb-0 text-white game-end-timer-text session_time"></p> -->
        </div>
      </div>
      <div class="practice-game-box turnament-game-box">
      <div class="practice-game-lobby">
        <iframe src="<?php echo e($game->url); ?>" height="100%" width="100%"></iframe>
      </div>
      </div>
    </div>
    <div class="col-xl-3">
      <div class="help-box">
        <?php echo $__env->make('front.partials.video', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        
        <div class="leader-board-box mt-3 ">
          <div class="leader-board-header">
            <h2 class="f-14 fw-700 text-white montserrat-font mb-0">Leader Board </h2>
          </div>
          <div class="leader-board">
            <ol class="ps-0 mb-0">
              <?php if(count($leaderboard_data)>0): ?>
                <?php if($user_leader == true): ?>
                <?php $__currentLoopData = $leaderboard_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li>
                  <div class="leader-board-item">
                    <p><?php echo e($key+1); ?>. &nbsp; 
                      <?php if(!empty($data->getUser->nick_name)): ?>
                      <?php echo e($data->getUser->nick_name); ?>

                      <?php else: ?>
                      <?php echo e($data->getUser->name); ?>

                      <?php endif; ?>
                    </p>
                    <p class="scoor fw-700"><?php echo e($data->score); ?></p>
                  </div>
                </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                <?php $__currentLoopData = $leaderboard_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li>
                  <div class="leader-board-item">
                    <p><?php echo e($key+1); ?>. &nbsp; 
                      <?php if(!empty($data->getUser->nick_name)): ?>
                      <?php echo e($data->getUser->nick_name); ?>

                      <?php else: ?>
                      <?php echo e($data->getUser->name); ?>

                      <?php endif; ?>
                    </p>
                    <p class="scoor fw-700"><?php echo e($data->score); ?></p>
                  </div>
                </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php if(!empty($user_data)): ?>
                <li>
                  <div class="leader-board-item">
                    <p><?php echo e(count($leaderboard_data)+1); ?>. &nbsp;
                      <?php if(!empty($user_data->getUser->nick_name)): ?>
                      <?php echo e($user_data->getUser->nick_name); ?>

                      <?php else: ?>
                      <?php echo e($user_data->getUser->name); ?>

                      <?php endif; ?>
                    </p>
                    <p class="scoor fw-700"><?php echo e($user_data->score); ?></p>
                  </div>
                </li>
                <?php endif; ?>
                <?php endif; ?>
              <?php endif; ?>
            </ol>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/iwin/resources/views/front/tournaments/tournament-room.blade.php ENDPATH**/ ?>
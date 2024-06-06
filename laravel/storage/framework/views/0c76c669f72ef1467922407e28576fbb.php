
<div class="footer-items">
  <div class="container-fluid">
    <div class="footer-ad google-img-ads">
      <div class="justify-content-start footer-ad-one">  
   
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
    
    </div>
   
      <!-- <div class="justify-content-start footer-ad-one"><img src="<?php echo e(asset('front/images/ad-left.png')); ?>" alt="" class="img-fluid"></div> -->
      <?php if(!empty($latest_tournament)): ?>
      <div class="win-box mod win-box-hidden">
        <div class="trophy">
          <img src="<?php echo e(asset('front/images/cup.png')); ?>">
        </div>
        <div class="spacer"></div>
        <div class="win-content">
          <div class="nickname f-10">
            1ST <?php if(!empty($latest_tournament->getUser->nick_name)): ?>
                  <?php echo e($latest_tournament->getUser->nick_name); ?>

                <?php else: ?>
                  <?php echo e($latest_tournament->getUser->name); ?>

                <?php endif; ?>
          </div>
          <div class="bottom-tournament-name f-10">
            <?php echo e($latest_tournament->reward_name); ?>

          </div>
          <?php if($latest_tournament->reward != '-'): ?>
          <div class="win f-8">
            <span> WIN: <?php echo e($latest_tournament->reward); ?> </span>
            <img src="<?php echo e(asset('front/images/coin.png')); ?>">
          </div>
          <?php endif; ?>
        </div>
      </div>
      <?php endif; ?>
      <div class="justify-self2 google-img-ads">
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
      </div>
    </div>
    <div class="d-flex justify-content-between align-items-center footer-list">
      <ul class="footer-ul">
        <li><a href="<?php echo e(route('front.cmsPages',['about-us'])); ?>">ABOUT US</a></li>
        <li><a href="<?php echo e(route('front.cmsPages',['our-partners'])); ?>">OUR PARTNERS</a></li>
        <li><a href="<?php echo e(route('front.cmsPages',['affiliate'])); ?>">AFFILIATES</a></li>
        <li><a href="<?php echo e(route('front.cmsPages',['charities'])); ?>">CHARITIES</a></li>
        <li><a href="<?php echo e(route('front.cmsPages',['advertisers'])); ?>">ADVERTISERS</a></li>
        <li><a href="<?php echo e(route('front.cmsPages',['sponsors'])); ?>">SPONSORS</a></li>
        <li><a href="<?php echo e(route('front.cmsPages',['special-features'])); ?>">SPECIAL FEATURES</a></li>
        <li><a href="<?php echo e(route('front.cmsPages',['tournament-rules'])); ?>">TOURNAMENT RULES</a></li>
        <li><a href="<?php echo e(route('front.cmsPages',['legal'])); ?>">LEGAL</a></li>
        <li><a href="<?php echo e(route('front.cmsPages',['future-features'])); ?>">FUTURE FEATURES</a></li>
        <li><a href="<?php echo e(route('front.cmsPages',['terms-of-use'])); ?>">TERMS OF USE</a></li>
        <li><a href="<?php echo e(route('front.cmsPages',['privacy-policy'])); ?>">PRIVACY POLICY</a></li>
      </ul>
      <!-- <a href="javascript:void" class="movie-theter-icon">
      <img src="<?php echo e(asset('front/images/movie-theter.png')); ?>" alt="movie-theter">
     </a> -->
    </div>
  </div>
</div><?php /**PATH /var/www/html/iwin/resources/views/front/partials/footer.blade.php ENDPATH**/ ?>
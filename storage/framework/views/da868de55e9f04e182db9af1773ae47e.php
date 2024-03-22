<?php $__env->startSection('page_title', 'Home Page'); ?>
<?php $__env->startSection('content'); ?>
<div class="inner-content ">
  <div class="row gy-4">
    <div class="col-xl-9">
      <div class="inner-item-heading mb-1">
        <h2 class="f-24 fw-700 text-white text-uppercase montserrat-font mb-0">PRACTICE GAMES</h2> 
        <?php echo $__env->make('front.partials.subheader', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      </div>
      <div class="games-tabs-sec">
        <div class="games-tabs-list">
          <?php echo $__env->make('front.partials.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          <div class="icon-input" id="searchForm">
            <input class="icon-input__text-field search" name="search" id="search" type="text" placeholder="Search">
            <i class="icon-input__icon fa-solid fa-magnifying-glass"></i>
          </div>
        </div>
        <div class="tab-content" id="nav-tabContent">
          <div class="tab-pane fade" id="nav-all" role="tabpanel" aria-labelledby="nav-all-tab" tabindex="0">
            <?php if(count($game)>0): ?>
            <div class="slot-slider">
              <?php $__currentLoopData = $game; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="slider-item slider-item-<?php echo e($data->slug); ?>">
                  <div class="slider-frame">
                    <div class="slider-img">
                      <img src="<?php echo e($data->image); ?>" alt="<?php echo e($data->name); ?>" class="img-fluid">
                    </div>
                  </div>
                  <a href="<?php echo e(route('front.practice-room',[$data->slug])); ?>" class="btn btn-secondary gradient-bg montserrat-font rounded-pill f-14 fw-600 w-100"><?php echo e($data->name); ?></a>
                </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <nav aria-label="Page navigation example">
              <ul class="pagination justify-content-end pager allCat" id="allCat">
              </ul>
            </nav>
            <?php else: ?>
            <h4 class="text-white">Coming soon</h4>
            <?php endif; ?>
          </div>
          <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $catKey => $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php if(count($cat->getGame)>0): ?>
          <div class="tab-pane fade" id="nav-<?php echo e($cat->slug); ?>" role="tabpanel" aria-labelledby="nav-<?php echo e($cat->slug); ?>-tab" tabindex="0">
            <div class="slot-slider">
              <?php $__currentLoopData = $cat->getGame; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="slider-item slider-item-<?php echo e($data->slug); ?>">
                  <div class="slider-frame">
                    <div class="slider-img">
                      <img src="<?php echo e($data->image); ?>" alt="<?php echo e($data->name); ?>" class="img-fluid">
                    </div>
                  </div>
                  <a href="<?php echo e(route('front.practice-room',[$data->slug])); ?>" class="btn btn-secondary gradient-bg montserrat-font rounded-pill f-14 fw-600 w-100"><?php echo e($data->name); ?></a>
                </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <nav aria-label="Page navigation example">
              <ul class="pagination justify-content-end pager" id="<?php echo e($cat->slug); ?>Cat">
              </ul>
            </nav>
          </div>
          <?php else: ?>
          <div class="tab-pane fade" id="nav-<?php echo e($cat->slug); ?>" role="tabpanel" aria-labelledby="nav-<?php echo e($cat->slug); ?>-tab"
            tabindex="0">
            <h4 class="text-white">Coming soon</h4>
          </div>
          <?php endif; ?>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      </div>
    </div>
    <div class="col-xl-3">
      <?php echo $__env->make('front.partials.announcement', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script type="text/javascript">
  $(document).ready(function () {
    $('#nav-all-tab').addClass('active');
    $('#nav-all').addClass('active show');
  });
  /*$('.nav-link').on('click',function () {
    var id = $(this).attr('id');
    if(id == 'nav-all-tab'){
      $('#searchForm').show();
    }else{
      $('#searchForm').hide();
    }
  });*/
  $(".search").on('keyup',function (){
    if($(this).val() != ''){
      $.ajax({
        type:"GET",
        url: '<?php echo e(route("front.search")); ?>',
        data: {text: $(this).val()},
        success: function(response) {
          if(response.status == 'success'){
            $.each(response.data,function(key,value){
              $('.slider-item-'+value).show();
            });
            $.each(response.data2,function(key,value){
              $('.slider-item-'+value).hide();
            });
          }else{
            $('.slider-item').hide();
          } 
        }
      });
    }else{
      $('.slider-item').show();
    }
  });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('front.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel/iwin/client_iwin/aiscode/resources/views/welcome.blade.php ENDPATH**/ ?>
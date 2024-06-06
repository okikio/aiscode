<?php $__env->startSection('page_title', 'Profile'); ?>
<?php $__env->startSection('content'); ?>
<div class="inner-content profile-rows ">
    <div class="row py-lg-1 py-3">
        <div class="col-xl-9">
            <div class="inner-item-heading mb-1 pt-md-0 pt-3">
                <h2 class="f-24 fw-700 text-white text-uppercase montserrat-font mb-0">Profile</h2>
            </div>

            <div class="d-flex justify-content-between flex-wrap">
                <div class="profile-tabs">
                    <ul class="nav nav-tabs" id="profileTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="general-tab" data-bs-toggle="tab"
                                data-bs-target="#general-tab-pane" type="button" role="tab"
                                aria-controls="general-tab-pane" aria-selected="true">General</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="rewards-tab" data-bs-toggle="tab"
                                data-bs-target="#rewards-tab-pane" type="button" role="tab"
                                aria-controls="rewards-tab-pane" aria-selected="false">Rewards</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="friends-tab" data-bs-toggle="tab"
                                data-bs-target="#friends-tab-pane" type="button" role="tab"
                                aria-controls="friends-tab-pane" aria-selected="false">Friends</button>
                        </li>
                    </ul>
                </div>
                <div class="games-room-btns align-items-center profile-btn ">
                    <a href="<?php echo e(route('front.edit-profile')); ?>" class="btn rounded-pill gradient-bg px-md-5 px-3"><i class="fa-regular fa-pen-to-square"></i> &nbsp; Edit Profile </a>
                </div>
            </div>

            <div class="row mt-md-4 py-md-4 py-4 profile-row">
                <div class="col-xl-3">
                    <div class="profile-img-box ">
                        <div class="profile-img position-relative">
                            <img src="<?php echo e(auth()->user()->image); ?>" alt="" class="img-fluid">
                        </div>
                    </div>
                </div>
                <div class="col-xl-9">
                    <div class="profile-tabs">
                        <div class="tab-content" id="profileTabContent">
                            <div class="tab-pane fade show active" id="general-tab-pane" role="tabpanel" aria-labelledby="general-tab" tabindex="0">
                                <ul class="general-tab-item">
                                    <li>
                                        <p><span>First Name :</span> <?php echo e(auth()->user()->name); ?></p>
                                    </li>
                                    <li>
                                        <p><span>Last Name :</span> <?php echo e(auth()->user()->last_name); ?></p>
                                    </li>
                                    <li>
                                        <p><span>Email :</span> <?php echo e(auth()->user()->email); ?></p>
                                    </li>
                                    <li>
                                        <p><span>Phone Number :</span> <?php echo e(auth()->user()->phone_number); ?></p>
                                    </li>
                                    <li>
                                        <p><span>User Name : </span> <?php echo e(auth()->user()->nick_name); ?></p>
                                    </li>
                                    <li>
                                        <p><span>Date of Birth :</span> <?php echo e(date('m/d/Y',strtotime(auth()->user()->birth_date))); ?></p>
                                    </li>
                                    <li>
                                        <p><span>Address :</span> <?php echo e(auth()->user()->address); ?></p>
                                    </li>
                                    <li>
                                        <p><span>Zipcode : </span> <?php echo e(auth()->user()->zipcode); ?></p>
                                    </li>
                                    <li>
                                        <p><span>State :</span> <?php echo e(auth()->user()->state); ?></p>
                                    </li>
                                    <li>
                                        <p><span>Country : </span> <?php echo e(auth()->user()->country); ?></p>
                                    </li>
                                </ul>

                                <?php if(auth()->user()->login_type == 'normal'): ?>
                                    <div class="link-account-div">
                                        <p class="f-16 fw-700 montserrat-font text-white text-center">Link Your Account With:</p>
                                        <div class="link-account-btn">
                                            <a href="<?php echo e(route('front.linked-account',['facebook'])); ?>" class="btn facebook-btn rounded-0 text-uppercase"><img src="<?php echo e(asset('front/images/facebook-white.png')); ?>" alt="facebook-white" class="img-fluid"> Facebook</a>
                                            <a href="<?php echo e(route('front.linked-account',['google'])); ?>" class="btn google-btn rounded-0 text-uppercase"><img src="<?php echo e(asset('front/images/google-btn.png')); ?>" alt="google-btn" class="img-fluid"> Google </a>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="tab-pane fade" id="rewards-tab-pane" role="tabpanel" aria-labelledby="rewards-tab" tabindex="0">
                                <h4 class="text-white">Coming Soon</h4>
                            </div>

                            <div class="tab-pane fade" id="friends-tab-pane" role="tabpanel"
                                aria-labelledby="friends-tab" tabindex="0">
                                <h4 class="text-white">Coming Soon</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3">
            <?php echo $__env->make('front.partials.announcement', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/iwin/resources/views/front/user/profile.blade.php ENDPATH**/ ?>
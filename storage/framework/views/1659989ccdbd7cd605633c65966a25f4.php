<?php $__env->startSection('page_title', 'User'); ?>
<?php $__env->startSection('breadcrumb','View User'); ?>
<?php $__env->startSection('content'); ?>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">View User</h3>
                        <a href="<?php echo e(route($path.'.index')); ?>" class="btn btn-outline-info float-right">Back</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td>First Name</td>
                                    <td><?php echo e($user->name ?? '-'); ?></td>
                                </tr>
                                <tr>
                                    <td>Last Name</td>
                                    <td><?php echo e($user->last_name ?? '-'); ?></td>
                                </tr>
                                <tr>
                                    <td>Email Address</td>
                                    <td><?php echo e($user->email ?? '-'); ?></td>
                                </tr>
                                <tr>
                                    <td>Date of Birth</td>
                                    <td><?php echo e(date('m/d/Y',strtotime($user->birth_date)) ?? '-'); ?></td>
                                </tr>
                                <tr>
                                    <td>Username</td>
                                    <td><?php echo e($user->nick_name ?? '-'); ?></td>
                                </tr>
                                <tr>
                                    <td>Phone Number</td>
                                    <td><?php echo e($user->phone_number ?? '-'); ?></td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td><?php echo e($user->address ?? '-'); ?></td>
                                </tr>
                                <tr>
                                    <td>Zipcode</td>
                                    <td><?php echo e($user->zipcode ?? '-'); ?></td>
                                </tr>
                                <tr>
                                    <td>State</td>
                                    <td><?php echo e($user->state ?? '-'); ?></td>
                                </tr>
                                <tr>
                                    <td>Country</td>
                                    <td><?php echo e($user->country ?? '-'); ?></td>
                                </tr> 
                                <tr>
                                    <td>Status</td>
                                    <td><?php echo e($user->status == 'active' ? "Active" : "InActive"); ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
<!-- /.container-fluid -->
</section>
<!-- /.content -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/iwin/resources/views/admin/user/show.blade.php ENDPATH**/ ?>
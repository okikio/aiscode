<?php $__env->startSection('page_title', 'Tournaments'); ?>
<?php $__env->startSection('breadcrumb','View Tournaments'); ?>
<?php $__env->startSection('content'); ?>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">View Tournaments</h3>
                        <a href="<?php echo e(route($path.'.index')); ?>" class="btn btn-outline-info float-right">Back</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td>Tournament Name</td>
                                    <td><?php echo e($tournaments->name); ?></td>
                                </tr>
                                <tr>
                                    <td>Game Name</td>
                                    <td><?php echo e($tournaments->getGame->name); ?></td>
                                </tr>
                                <tr>
                                    <td>Start Date & Time</td>
                                    <?php
                                        date('m/d/Y',strtotime($tournaments->end_time))
                                    ?>
                                    <td><?php echo e(date('m/d/Y',strtotime($tournaments->start_date)).' '. $tournaments->start_time); ?></td>
                                </tr>
                                <tr>
                                    <td>End Date & Time</td>
                                    <td><?php echo e(date('m/d/Y',strtotime($tournaments->end_time)).' '. $tournaments->end_time); ?></td>
                                </tr>
                                <tr>
                                    <td>Session Time</td>
                                    <td><?php echo e($tournaments->session_time); ?></td>
                                </tr>
                                <tr>
                                    <td>Description</td>
                                    <td><?php echo e($tournaments->description); ?></td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td><?php echo e(ucfirst($tournaments->status)); ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <h3><u>Tournament Reward:</u></h3>
                            

                            <thead>
                                <th>Place</th>
                                <th>Type</th>
                                <th>Reward</th>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $winner; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($value->rank); ?></td>
                                    <td><?php echo e($value->reward_name); ?></td>
                                    <td><?php echo e($value->reward); ?></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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

<?php echo $__env->make('admin.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/iwin/resources/views/admin/tournaments/show.blade.php ENDPATH**/ ?>
<?php $__env->startSection('page_title', 'Tournaments'); ?>
<?php $__env->startSection('breadcrumb','Edit Tournaments'); ?>
<?php $__env->startSection('content'); ?>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit Tournament</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <?php echo Form::model($tournaments,['route' => [$path.'.update', $tournaments->id],'class'=>'needs-validation','novalidate','files'=>true]); ?>

                            <?php echo method_field('PATCH'); ?>
                            <?php echo $__env->make($path.'.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo Form::close(); ?>

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
<?php echo $__env->make('admin.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/iwin/resources/views/admin/tournaments/edit.blade.php ENDPATH**/ ?>
<?php $__env->startSection('page_title', 'CMS Page'); ?>
<?php $__env->startSection('breadcrumb','CMS Page'); ?>
<?php $__env->startSection('content'); ?>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">CMS Page List</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <?php echo $html->table(['class' => 'table table-bordered table-hover table-striped'], true); ?>

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
<?php $__env->startPush('scripts'); ?>
    <?php echo $html->scripts(); ?>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/iwin/resources/views/admin/cms-page/index.blade.php ENDPATH**/ ?>
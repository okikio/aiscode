<?php $__env->startSection('page_title', 'Tournament LeaderBoard'); ?>
<?php $__env->startSection('breadcrumb','Tournament LeaderBoard'); ?>
<?php $__env->startSection('content'); ?>
<!-- Main content -->
<style type="text/css">
    .dataTables_length,.dataTables_filter {
        margin-left: 10px;
        float: right;
    }
</style>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Tournament LeaderBoard</h3>
                        <a href="<?php echo e(route($path.'.index')); ?>" class="btn btn-outline-info float-right">Back</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <td><b>Tournament Name: </b><?php echo e($tournaments->name); ?></td>
                                <td><b>Game Name : </b><?php echo e($tournaments->getGame->name); ?></td>
                            </tr>
                            <tr>
                                <td><b>Start Date & Time : </b><?php echo e(date('m/d/Y',strtotime($tournaments->start_date)).' '. $tournaments->start_time); ?></td>
                                <td><b>End Date & Time: </b><?php echo e(date('m/d/Y',strtotime($tournaments->end_date)).' '. $tournaments->end_time); ?></td>
                            </tr>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <div class="card">
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

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
<script type="text/javascript">
    $('#dateSearch').on('click', function() {
        window.LaravelDataTables["dataTableBuilder"].ajax.reload();
    });            
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/iwin/resources/views/admin/tournaments/leaderboard.blade.php ENDPATH**/ ?>
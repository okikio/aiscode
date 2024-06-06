<?php $__env->startSection('page_title', 'Tournaments'); ?>
<?php $__env->startSection('breadcrumb','Tournaments'); ?>
<?php $__env->startSection('content'); ?>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Tournaments List</h3>
                        <a href="<?php echo e(route($path.'.create')); ?>" class="btn btn-outline-primary float-right"><i class="fa fa-plus"></i> Add Tournament </a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <?php echo $html->table(['class' => 'table table-bordered table-hover table-striped','id'=>'tournaments-table'], true); ?>

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

<script type="text/javascript">
    function deleteTournaments(id){
        Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#5B73E8',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                url:"<?php echo e(route('admin.tournaments.destroy',[''])); ?>"+"/"+id,
                type: 'delete',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {_method: 'Delete', id:id},
                success:function(msg){
                    console.log(msg);
                    if(msg.status == 'success'){
                        Swal.fire("Deleted!",  msg.message, "success");
                        window.LaravelDataTables["tournaments-table"].ajax.reload();
                    }else{
                        Swal.fire("Warning!", msg.message, "warning");
                    }
                },
                error:function(){
                    Swal.fire("Error!", 'Error in change status Record', "error");
                }
                });
            }
        })
    };
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel/iwin/iwin/resources/views/admin/tournaments/index.blade.php ENDPATH**/ ?>
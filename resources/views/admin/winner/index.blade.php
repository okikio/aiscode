@extends('admin.layouts.main')
@section('page_title', 'Winner')
@section('breadcrumb','Winner')
@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"> Winning Management</h3>
                        <a href="{{route($path.'.create')}}" class="btn btn-outline-primary float-right"><i class="fa fa-plus"></i> Add Winner </a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        {!! $html->table(['class' => 'table table-bordered table-hover table-striped','id'=>'winner-table'], true) !!}
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
@endsection
@push('scripts')
{!! $html->scripts() !!}
<script type="text/javascript">
    function deleteWinner(id){
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
                url:"{{route('admin.winner.destroy',[''])}}"+"/"+id,
                type: 'delete',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {_method: 'Delete', id:id},
                success:function(msg){
                    if(msg.status == 'success'){
                        Swal.fire("Deleted!",  msg.message, "success");
                        window.LaravelDataTables["winner-table"].ajax.reload();
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
@endpush
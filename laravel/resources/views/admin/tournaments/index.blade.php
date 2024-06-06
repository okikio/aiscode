@extends('admin.layouts.main')
@section('page_title', 'Tournaments')
@section('breadcrumb','Tournaments')
@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Tournaments List</h3>
                        <a href="{{route($path.'.create')}}" class="btn btn-outline-primary float-right"><i class="fa fa-plus"></i> Add Tournament </a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        {!! $html->table(['class' => 'table table-bordered table-hover table-striped','id'=>'tournaments-table'], true) !!}
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
                url:"{{route('admin.tournaments.destroy',[''])}}"+"/"+id,
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
@endpush
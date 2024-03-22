@extends('admin.layouts.main')
@section('page_title', 'User')
@section('breadcrumb','User')
@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">User List</h3>
                        <a href="{{route($path.'.create')}}" class="btn btn-outline-primary float-right"><i class="fa fa-plus"></i> Add User </a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        {!! $html->table(['class' => 'table table-bordered table-hover table-striped','id' => 'user-table'], true) !!}
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
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
{!! $html->scripts() !!}
<script type="text/javascript">
    function deleteUser(id){
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
                url:"{{route('admin.user.destroy',[''])}}"+"/"+id,
                type: 'delete',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {_method: 'Delete', id:id},
                success:function(msg){
                    console.log(msg);
                    if(msg.status == 'success'){
                        Swal.fire("Deleted!",  msg.message, "success");
                        window.LaravelDataTables["user-table"].ajax.reload();
                    }else{
                        Swal.fire("Warning!", msg.message, "warning");
                    }
                },
                error:function(){
                    Swal.fire("Error!", 'Error in delete Record', "error");
                }
                });
            }
        })
    };
    function changeStatus(status, id){
        var lable = status == 0 ? 'active' : 'inactive';
        Swal.fire({
            title: 'Are you sure?',
            text: "You wont to be able to "+ lable +" this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#5B73E8',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, change it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                url:"{{route('admin.user.changeStatus')}}",
                type: 'post',
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {status: lable, id:id},
                success:function(msg){
                    if(msg.status == 'success'){
                        Swal.fire("Change!",  msg.message, "success");
                        window.LaravelDataTables["user-table"].ajax.reload();
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
    }
</script>
@endpush
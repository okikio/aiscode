@extends('admin.layouts.main')
@section('page_title', 'LeaderBoard Logs')
@section('breadcrumb','LeaderBoard Logs')
@section('content')
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
                        <h3 class="card-title">LeaderBoard Logs</h3>
                        <a href="{{route($path.'.leaderboard',$id)}}" class="btn btn-outline-info float-right">Back</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <td><b>User Name: </b>{{$user->nick_name}}</td>
                                <td><b>Email : </b>{{$user->email}}</td>
                            </tr>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        {!! $html->table(['class' => 'table table-bordered table-hover table-striped'], true) !!}
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
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
<script type="text/javascript">
    $('#dateSearch').on('click', function() {
        window.LaravelDataTables["dataTableBuilder"].ajax.reload();
    });            
</script>
@endpush
@extends('admin.layouts.main')
@section('page_title', 'Affiliate Ads Revenue')
@section('breadcrumb','Affiliate User List View')
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
                        <h3 class="card-title">Affiliate User List View</h3>
                        <a href="{{route($path.'.index')}}" class="btn btn-outline-info float-right">Back</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <td><b>UserName: </b>{{$highest_user->getUser->name}}</td>
                                <td><b>Affilate Code: </b>{{$highest_user->getUser->affiliate_code}}</td>
                            </tr>
                            <tr>
                                <td><b>Total Revenue: </b>${{$total_revenue}}</td>
                                <td><b>Current Month Revenue: </b>${{$current_month}}</td>
                            </tr>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                                <div class="form-group col-md-12 row">
                                    <label class="col-form-label">From:</label>
                                    <div class="col-sm-4">
                                        <input type="date" class="form-control mt-2 mb-2" value="{{$start_date}}" id="init_dt" data-date-format="DD MMMM YYYY">
                                    </div>
                                    <label class="col-form-label">To:</label>
                                    <div class="col-sm-4">
                                        <input type="date" class="form-control mt-2 mb-2" value="{{$end_date}}" id="final_dt" data-date-format="DD MMMM YYYY">
                                    </div>
                                    <button type="button" id="dateSearch" class="btn btn-primary mt-2 mb-2 ml-sm-6 ml-xs-0 fnd_btn">Find</button>
                                </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        
                        <br>
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
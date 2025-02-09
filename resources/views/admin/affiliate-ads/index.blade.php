@extends('admin.layouts.main')
@section('page_title', 'Affiliate Ads Revenue')
@section('breadcrumb','Affiliate Ads Revenue')
@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Affiliate Ads Revenue</h3>
                    </div>
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
@endpush
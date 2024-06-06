@extends('admin.layouts.main')
@section('page_title', 'Cms Page')
@section('breadcrumb','Edit Cms Page')
@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit Cms Page</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        {!! Form::model($cmspage,['route' => [$path.'.update', $cmspage->id],'class'=>'needs-validation','novalidate','files'=>true]) !!}
                            @method('PATCH')
                            @include($path.'.form')
                        {!! Form::close() !!}
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
<script type="text/javascript">
    $(function () {
        $('#summernote').summernote()
    })
</script>
@endpush
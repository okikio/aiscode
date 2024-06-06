@extends('admin.layouts.main')
@section('page_title', 'User')
@section('breadcrumb','Edit User')
@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit User</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        {!! Form::model($user,['route' => [$path.'.update', $user->id],'class'=>'needs-validation','novalidate','files'=>true]) !!}
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
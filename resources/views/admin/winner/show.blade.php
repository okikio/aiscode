@extends('admin.layouts.main')
@section('page_title', 'Winner')
@section('breadcrumb','View Winner')
@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">View Winner</h3>
                        <a href="{{route($path.'.index')}}" class="btn btn-outline-info float-right">Back</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td>Rank Number</td>
                                    <td>{{$winner->rank}}</td>
                                </tr>
                                <tr>
                                    <td>Winning Reward Name</td>
                                    <td>{{$winner->reward_name}}</td>
                                </tr>
                                <tr>
                                    <td>Winning Reward</td>
                                    <td>{{$winner->reward}}</td>
                                </tr>
                                <tr>
                                    <td>Winning Reward Code</td>
                                    <td>{{$winner->reward_code}}</td>
                                </tr>
                                <tr>
                                    <td>Winning Description</td>
                                    <td>{{$winner->description}}</td>
                                </tr>
                            </tbody>
                        </table>
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
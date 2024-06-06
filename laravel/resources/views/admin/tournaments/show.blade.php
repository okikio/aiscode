@extends('admin.layouts.main')
@section('page_title', 'Tournaments')
@section('breadcrumb','View Tournaments')
@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">View Tournaments</h3>
                        <a href="{{route($path.'.index')}}" class="btn btn-outline-info float-right">Back</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td>Tournament Name</td>
                                    <td>{{$tournaments->name}}</td>
                                </tr>
                                <tr>
                                    <td>Game Name</td>
                                    <td>{{$tournaments->getGame->name}}</td>
                                </tr>
                                <tr>
                                    <td>Start Date & Time</td>
                                    <td>{{$tournaments->start_date.' '. $tournaments->start_time}}</td>
                                </tr>
                                <tr>
                                    <td>End Date & Time</td>
                                    <td>{{$tournaments->end_date.' '. $tournaments->end_time}}</td>
                                </tr>
                                <tr>
                                    <td>Session Time</td>
                                    <td>{{$tournaments->session_time}}</td>
                                </tr>
                                <tr>
                                    <td>Description</td>
                                    <td>{{$tournaments->description}}</td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td>{{ucfirst($tournaments->status)}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <h3><u>Tournament Reward:</u></h3>
                            <thead>
                                <th>Winning Rank</th>
                                <th>Winning Reward Name</th>
                                <th>Winning Reward</th>
                                <th>Winning Reward Code</th>
                                <th>Winning Description</th>
                            </thead>
                            <tbody>
                                @foreach($winner as $key=>$value)
                                <tr>
                                    <td>{{$value->rank}}</td>
                                    <td>{{$value->reward_name}}</td>
                                    <td>{{$value->reward}}</td>
                                    <td>{{$value->reward_code}}</td>
                                    <td>{{$value->description}}</td>
                                </tr>
                                @endforeach
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
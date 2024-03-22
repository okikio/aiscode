@extends('admin.layouts.main')
@section('page_title', 'User')
@section('breadcrumb','View User')
@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">View User</h3>
                        <a href="{{route($path.'.index')}}" class="btn btn-outline-info float-right">Back</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td>First Name</td>
                                    <td>{{$user->name}}</td>
                                </tr>
                                <tr>
                                    <td>Last Name</td>
                                    <td>{{$user->last_name}}</td>
                                </tr>
                                <tr>
                                    <td>Email Address</td>
                                    <td>{{$user->email}}</td>
                                </tr>
                                <tr>
                                    <td>Date of Birth</td>
                                    <td>{{$user->birth_date}}</td>
                                </tr>
                                <tr>
                                    <td>Username</td>
                                    <td>{{$user->nick_name}}</td>
                                </tr>
                                <tr>
                                    <td>Phone Number</td>
                                    <td>{{$user->phone_number}}</td>
                                </tr>
                                <!-- <tr>
                                    <td>Address</td>
                                    <td>{{$user->address}}</td>
                                </tr>
                                <tr>
                                    <td>Zipcode</td>
                                    <td>{{$user->zipcode}}</td>
                                </tr>
                                <tr>
                                    <td>State</td>
                                    <td>{{$user->state}}</td>
                                </tr>
                                <tr>
                                    <td>Country</td>
                                    <td>{{$user->country}}</td>
                                </tr> -->
                                <tr>
                                    <td>Status</td>
                                    <td>{{ $user->status == 'active' ? "Active" : "InActive" }}</td>
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
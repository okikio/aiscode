@extends('admin.layouts.main')
@section('page_title', 'Dashboard')
@section('breadcrumb','Dashboard')
@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
          <div class="inner">
            <h6>Total number of registered users</h6>
            <h3>{{$user}}</h3>
          </div>
          <div class="icon">
            <i class="ion ion-person"></i>
          </div>
        </div>
      </div>
      <!-- <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
          <div class="inner">
            <h3>{{$game}}</h3>

            <p>Total Game</p>
          </div>
          <div class="icon">
            <i class="ion ion-ios-list-outline"></i>
          </div>
        </div>
      </div> -->
      <!-- <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>{{$category}}</h3>

            <p>Total Category</p>
          </div>
          <div class="icon">
            <i class="ion ion-ios-list"></i>
          </div>
        </div>
      </div> -->
      <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
          <div class="inner">
            <h6>Total number of Tournaments</h6>
            <h3>{{$tournaments}}</h3>
          </div>
          <div class="icon">
            <i class="ion ion-ios-briefcase"></i>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
          <div class="inner">
            <h6>Total number of Active Users</h6>
            <h3>{{$activeUser}}</h3>
          </div>
          <div class="icon">
            <i class="ion ion-ios-person"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
@extends('front.layouts.main')
@section('page_title', 'Practice Room')
@section('content')
<div class="inner-content">
  <div class="row gy-3">
    <div class="col-xl-9">
      <div class="inner-item-heading mb-1 d-flex gap-3 align-items-center justify-content-start">
        <a href="{{ url('/') }}" class="f-22 back-btn"><i class="fa-solid fa-arrow-left"></i></a>
        <h2 class="f-24 fw-700 text-white text-uppercase montserrat-font mb-0">PRACTICE ROOM - {{$game->name}}</h2>
      </div>
      @include('front.partials.adsmobile')
      <div class="practice-game-lobby">
        <!-- game hear -->
        <iframe src="{{$game->url}}" height="100%" width="100%"></iframe>
      </div>
    </div>

    <div class="col-xl-3">
      @include('front.partials.announcement')
    </div>
  </div>
</div>
@endsection
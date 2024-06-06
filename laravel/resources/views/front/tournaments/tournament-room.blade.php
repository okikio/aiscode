@extends('front.layouts.main')
@section('page_title', 'Tournaments')
@section('content')
<div class="inner-content">
  <div class="row py-3">
  <div class="text-center">
 <div class="header-ads mobile-ads">
        <img src="{{ asset('front/images/ad-left.png') }}" alt="" class="img-fluid">
      </div>
 </div>
    <div class="col-xl-9">
      <div class="inner-item-heading mb-1">
        <div class="d-flex gap-3">
          <a href="{{ route('front.tournaments') }}" class="f-20 back-btn"><i class="fa-solid fa-arrow-left"></i></a>
          <h2 class="f-24 fw-700 text-white text-uppercase montserrat-font mb-0">{{ $tournaments->name }}</h2>
        </div>
        @include('front.partials.adsmobile')
        <div class="game-end-timer">
          <input type="hidden" name="tournaments_id" value="{{$tournaments->id}}" id="tournaments_id">
          <input type="hidden" name="user_id" value="{{auth()->user()->id}}" id="user_id">
          <!-- <p class="f-13 game-end-timer-header mb-0">Ends In</p>
          <p class="f-13 mb-0 text-white game-end-timer-text session_time"></p> -->
        </div>
      </div>
      <div class="practice-game-lobby">
        <iframe src="{{$game->url}}" height="100%" width="100%"></iframe>
      </div>
    </div>
    <div class="col-xl-3">
      <div class="help-box">
        @include('front.partials.video')
        <a href="{{ route('home') }}"
          class="f-14 fw-600 btn btn-secondary text-uppercase w-100 montserrat-font">practice</a>
        <div class="leader-board-box mt-3 ">
          <div class="leader-board-header">
            <h2 class="f-14 fw-700 text-white montserrat-font mb-0">Leader Board </h2>
          </div>
          <div class="leader-board">
            <ol class="ps-0 mb-0">
              @if(count($leaderboard_data)>0)
                @if($user_leader == true)
                @foreach($leaderboard_data as $key=>$data)
                <li>
                  <div class="leader-board-item">
                    <p>{{$key+1}}. &nbsp; {{$data->getUser->name}}</p>

                    <p class="scoor fw-700">{{$data->score}}</p>
                  </div>
                </li>
                @endforeach
                @else
                @foreach($leaderboard_data as $key=>$data)
                <li>
                  <div class="leader-board-item">
                    <p>{{$key+1}}. &nbsp; {{$data->getUser->name}}</p>

                    <p class="scoor fw-700">{{$data->score}}</p>
                  </div>
                </li>
                @endforeach
                @if(!empty($user_data))
                <li>
                  <div class="leader-board-item">
                    <p>{{count($leaderboard_data)+1}}. &nbsp; {{$user_data->getUser->name}}</p>
                    <p class="scoor fw-700">{{$user_data->score}}</p>
                  </div>
                </li>
                @endif
                @endif
              @endif
            </ol>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
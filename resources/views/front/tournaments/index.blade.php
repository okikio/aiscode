@extends('front.layouts.main')
@section('page_title', 'Tournaments')
@section('content')
<div class="inner-content ">
  <div class="row">
  <!-- <div class="text-center">
 <div class="header-ads mobile-ads">
        <img src="{{ asset('front/images/ad-left.png') }}" alt="" class="img-fluid">
      </div>
 </div> -->
    <div class="col-xl-9">
      <div class="inner-item-heading mb-1">
        <h2 class="f-24 fw-700 text-white text-uppercase montserrat-font mb-0">Tournament Lobby</h2>
        @include('front.partials.subheader')
      </div>
      <div class="games-tabs-sec">
        <div class="games-tabs-list">
          @include('front.partials.navbar')
          <div class="icon-input" id="searchForm">
            <input class="icon-input__text-field search" name="search" id="search" type="text" placeholder="Search">
            <i class="icon-input__icon fa-solid fa-magnifying-glass"></i>
          </div>
        </div>
        <div class="tab-content" id="nav-tabContent">
          <div class="tab-pane fade" id="nav-all" role="tabpanel"
            aria-labelledby="nav-all-tab" tabindex="0">
            @if(count($tournaments)>0)
            <div class="slot-slider">
                @foreach($tournaments as $key => $data)
                <?php 
                $start_date = Carbon\Carbon::parse($data->start_date);
                $end_date = Carbon\Carbon::parse($data->end_date);
                $toDate = Carbon\Carbon::now()->format('Y-m-d');
                $startDays = $start_date->diffInDays($toDate);
                $endDays = $end_date->diffInDays($toDate);
                if($toDate >= $data->start_date){
                  $start_on = 0;
                  $upcoming = 0;
                  $end_on = $endDays;
                }else if($toDate < $data->start_date){
                  $start_on = $startDays;
                  $upcoming = 1;
                  $end_on = 0;
                }else{
                  $start_on = 0;
                  $upcoming = 0;
                  $end_on = 0;
                }
                ?>
                <div class="slider-item slider-item-{{$data->getGame->slug}}">
                  <div class="slider-frame">
                    <div class="slider-img">
                      <img src="{{$data->getGame->image}}" alt="pummel-game" class="img-fluid">
                      <div class="slider-img-content">
                        <p>{{ $data->description }}</p>
                      </div>
                      <div class="game-timeline">
                        <p class="session-time mb-0 f-10 text-white">
                          Session Time : <span> {{ $data->session_time }}</span>
                        </p>
                        @if($upcoming == 1)
                        <p class="day-left f-10 mb-0 text-white"> Start Time : <span> {{ $start_on }} Days Left</span>
                        </p>
                        @elseif($end_on == 0)
                        <p class="day-left f-10 mb-0 text-white"> End Time : <span> Last Day</span>
                        @else
                        <p class="day-left f-10 mb-0 text-white"> End Time : <span> {{ $end_on }} Days Left</span>
                        @endif
                      </div>
                      <!-- <div class="game-duration">
                        <p class="day-left mb-0 f-10 text-white">
                          Duration <span class="d-block"> 40:00 Mins</span>
                        </p>
                      </div> -->
                    </div>
                  </div>
                  <a href="{{ route('front.tournaments-room',[$data->getGame->slug,$data->id,auth()->user()->id]) }}" class="btn btn-secondary gradient-bg montserrat-font rounded-pill f-14 fw-600 w-100">{{$data->getGame->name}}</a>
                </div>
                @endforeach
            </div>
            @else
            <h4 class="text-white">Coming soon</h4>
            @endif
          </div>
          @foreach($category as $catKey => $cat)
          @if(count($cat->getTournaments->where('status','!=','completed'))>0)
          <div class="tab-pane fade" id="nav-{{$cat->slug}}" role="tabpanel"
            aria-labelledby="nav-{{$cat->slug}}-tab" tabindex="0">
            <div class="slot-slider">
                @foreach($cat->getTournaments->where('status','!=','completed') as $key => $data)
                <?php 
                $start_date = Carbon\Carbon::parse($data->start_date);
                $end_date = Carbon\Carbon::parse($data->end_date);
                $toDate = Carbon\Carbon::now()->format('Y-m-d');
                $startDays = $start_date->diffInDays($toDate);
                $endDays = $end_date->diffInDays($toDate);
                if($toDate >= $data->start_date){
                  $start_on = 0;
                  $upcoming = 0;
                  $end_on = $endDays;
                }else if($toDate < $data->start_date){
                  $start_on = $startDays;
                  $upcoming = 1;
                  $end_on = 0;
                }else{
                  $start_on = 0;
                  $upcoming = 0;
                  $end_on = 0;
                }
                ?>
                <div class="slider-item slider-item-{{$data->getGame->slug}}">
                  <div class="slider-frame">
                    <div class="slider-img">
                      <img src="{{$data->getGame->image}}" alt="pummel-game" class="img-fluid">
                      <div class="slider-img-content">
                        <p>{{ $data->description }}</p>
                      </div>
                      <div class="game-timeline">
                        <p class="session-time mb-0 f-10 text-white">
                          Session Time : <span> {{ $data->session_time }}</span>
                        </p>
                        @if($upcoming == 1)
                        <p class="day-left f-10 mb-0 text-white"> Start Time : <span> {{ $start_on }} Days Left</span>
                        </p>
                        @elseif($end_on == 0)
                        <p class="day-left f-10 mb-0 text-white"> End Time : <span> Last Day</span>
                        @else
                        <p class="day-left f-10 mb-0 text-white"> End Time : <span> {{ $end_on }} Days Left</span>
                        @endif
                      </div>
                      <!-- <div class="game-duration">
                        <p class="day-left mb-0 f-10 text-white">
                          Duration <span class="d-block"> 40:00 Mins</span>
                        </p>
                      </div> -->
                    </div>
                  </div>
                  <a href="{{ route('front.tournaments-room',[$data->getGame->slug,$data->id,auth()->user()->id]) }}" class="btn btn-secondary gradient-bg montserrat-font rounded-pill f-14 fw-600 w-100">{{$data->getGame->name}}</a>
                </div>
                @endforeach
            </div>
          </div>
          @else
          <div class="tab-pane fade" id="nav-{{$cat->slug}}" role="tabpanel" aria-labelledby="nav-{{$cat->slug}}-tab"
            tabindex="0">
            <h4 class="text-white">Coming soon</h4>
          </div>
          @endif
          @endforeach
        </div>
      </div>
    </div>
    <div class="col-xl-3">
      <div class="help-box">
        @include('front.partials.video')
        <a href="{{ route('home') }}"
          class="f-14 fw-600 btn btn-secondary text-uppercase w-100 montserrat-font">Practice</a>
        <div class="tournament-box mt-3 ">
          <div class="tournament-header">
            <h2 class="f-14 fw-700 text-white montserrat-font mb-0">FUTURE TOURNAMENTS</h2>
          </div>
          <div class="tournament-item text-center">
            <div class="tournament-end">
            @foreach($future_tournaments as $ftData)
              <p class="f-12 text-white ">{{ $ftData->name }} Tournament Begins on {{date('M dS', strtotime($ftData->start_date))}}</p>
            @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-9">
    </div>
  </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript">
  $(document).ready(function () {
    $('#nav-all-tab').addClass('active');
    $('#nav-all').addClass('active show');
  })
  /*$('.nav-link').on('click',function () {
    var id = $(this).attr('id');
    if(id == 'nav-all-tab'){
      $('#searchForm').show();
    }else{
      $('#searchForm').hide();
    }
  });*/
  $(".search").on('keyup',function (){
    if($(this).val() != ''){
      $.ajax({
        type:"GET",
        url: '{{ route("front.search") }}',
        data: {text: $(this).val()},
        success: function(response) {
          if(response.status == 'success'){
            $.each(response.data,function(key,value){
              $('.slider-item-'+value).show();
            });
            $.each(response.data2,function(key,value){
              $('.slider-item-'+value).hide();
            });
          }else{
            $('.slider-item').hide();
          } 
        }
      });
    }else{
      $('.slider-item').show();
    }
  });
</script>
@endpush
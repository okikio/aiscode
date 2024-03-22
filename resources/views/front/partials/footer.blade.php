<div class="footer-items">
  <div class="container-fluid">
    <div class="footer-ad">
      <div class="justify-content-start footer-ad-one"><img src="{{ asset('front/images/ad-left.png') }}" alt="" class="img-fluid"></div>
      @if(!empty($latest_tournament))
      <div class="win-box mod win-box-hidden">
        <div class="trophy">
          <img src="{{ asset('front/images/cup.png') }}">
        </div>
        <div class="spacer"></div>
        <div class="win-content">
          <div class="nickname f-10">
            1ST {{$latest_tournament->getUser->name}}
          </div>
          <div class="bottom-tournament-name f-10">
            {{$latest_tournament->reward_name}}
          </div>
          @if($latest_tournament->reward != '-')
          <div class="win f-8">
            <span> WIN: {{$latest_tournament->reward}} </span><img src="{{ asset('front/images/coin.png') }}">
          </div>
          @endif
        </div>
      </div>
      @endif
      <div class="justify-self2"><img src="{{ asset('front/images/ad-right.png') }}" alt="" class="img-fluid"></div>
    </div>
    <div class="d-flex justify-content-between align-items-center footer-list">
      <ul class="footer-ul">
        <li><a href="{{route('front.cmsPages',['about-us'])}}">About Us</a></li>
        <li><a href="{{route('front.cmsPages',['our-partners'])}}">OUR PARTNERS</a></li>
        <li><a href="{{route('front.cmsPages',['affiliate'])}}">Affiliates</a></li>
        <li><a href="{{route('front.cmsPages',['charities'])}}">CHARITIES</a></li>
        <li><a href="{{route('front.cmsPages',['advertisers'])}}">Advertisers</a></li>
        <li><a href="{{route('front.cmsPages',['sponsors'])}}">SPONSORS</a></li>
        <li><a href="{{route('front.cmsPages',['special-features'])}}">SPECIAL FEATURES</a></li>
        <li><a href="{{route('front.cmsPages',['tournament-rules'])}}">TOURNAMENT RULES</a></li>
        <li><a href="{{route('front.cmsPages',['legal'])}}">LEGAL</a></li>
        <li><a href="{{route('front.cmsPages',['future-features'])}}">FUTURE FEATURES </a></li>
      </ul>
      <!-- <a href="javascript:void" class="movie-theter-icon">
      <img src="{{ asset('front/images/movie-theter.png')}}" alt="movie-theter">
     </a> -->
    </div>
  </div>
</div>
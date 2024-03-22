<nav class="navbar navbar-expand-lg">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ route('home') }}"><img class="logo" src="{{ asset('front/images/iwin-logo.svg') }}" alt="iwin-logo"></a>
    <div class="desktop-profile px-3  flex-lg-row flex-column align-items-center gap-3">
      @auth
      <a class="user-profile " href="{{ route('front.profile') }}">
        <p class="mb-0 f-13 text-white">Welcome <span class="text-uppercase primary-color fw-700">{{ auth()->user()->name}}</span></p>
        <div class="user-profile-img">
          <img src="{{ asset('front/images/user-profile.png') }}" alt="" class="img-fluid">
        </div>
      </a>
      @endauth
      <div class="header-ads">
        <img src="{{ asset('front/images/ad-left.png') }}" alt="" class="img-fluid">
      </div>
    </div>
    <div class="welcome-btn">
      <!-- <img src="{{ asset('front/images/video-to-gif.gif') }}" alt=""> -->
      <!--   <video id="welcome-video" autoplay="autoplay" controls="" width="100%" height="40">
    <source src="{{ asset('front/videos/iWin_Gaming.mp4') }}" type="video/mp4">
  </video> -->
    </div>
   <div class="align-items-center header-right-side">
   <form class="navbar-form navbar-left p-0" role="search">
      <!-- Define a button to toggle the search area -->
      <button id='search-button' class=''><span class='fa-solid fa-magnifying-glass'></span></button>
      <!-- Create your entire search form -->
      <div id='search-form' class="form-group">
        <div class="input-group">
          <span id='search-icon' class="input-group-addon"><span class='fa-solid fa-magnifying-glass'></span></span>
          <input type="text" class="form-control search" name="search" id="search" placeholder="Search">
        </div>
      </div>
    </form>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
   </div>
    <div class="offcanvas offcanvas-start" id="navbarNav">
      <div class="offcanvas-header">
     
        @auth
        <a class="user-profile" href="{{ route('front.profile') }}">
          <p class="mb-0 f-13 text-white">Welcome <span class="text-uppercase primary-color fw-700">{{ auth()->user()->name}}</span></p>
          <div class="user-profile-img">
            <img src="{{ asset('front/images/user-profile.png') }}" alt="" class="img-fluid">
          </div>
        </a>
        @endauth
        
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        <div class="text-end movie-ticket-box">
        <button type="button" data-bs-toggle="modal" data-bs-target="#movieTick" class="movie-theter-icon">
              <img src="{{ asset('front/images/movie-theter.png')}}" alt="movie-theter">
            </button>
            </div>
      </div>

      <div class="offcanvas-body align-items-baseline">
        <ul class="navbar-nav ms-lg-auto ms-md-0 align-items-lg-center desktop-menu">
          <li class="nav-item">
            <a class="btn btn-primary @if(Request::segment(1) == '') active @endif" href="{{ route('home') }}">Home</a>
          </li>
          <li class="nav-item">
            <a class="btn btn-primary @if(Request::segment(1) == 'contact-us') active @endif" href="{{ route('front.contact-us') }}">Contact</a>
          </li>
          @auth
          <!-- <li class="nav-item">
            <button class="gaming-outline-btn">
              <a  href="{{ route('front.submitGame') }}" class="btn">Submit a Game</a>
            </button>
          </li> -->
          <li class="nav-item">
            <button class="gaming-outline-btn">
              <a href="{{ route('front.logout') }}" class="btn">Sign Out</a>
            </button>
          </li>
          @else
          <li class="nav-item">
            <a href="{{ route('front.login') }}" class="btn @if(Request::segment(1) == 'login') gaming-btn @else gaming-outline-btn @endif rounded-0">
              Sign In
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('front.register') }}" class="btn @if(Request::segment(1) == 'register') gaming-btn @else gaming-outline-btn @endif rounded-0">
              Sign Up
            </a>
          </li>
          @endauth
          <li class="nav-item">
            <button type="button" data-bs-toggle="modal" data-bs-target="#movieTick" class="movie-theter-icon">
              <img src="{{ asset('front/images/movie-theter.png')}}" alt="movie-theter">
            </button>
          </li>
        </ul>
        <div class="mobile-menu">
          
          <ul class="navbar-nav ms-lg-auto ms-md-0 align-align-items-lg-center">
            <li class="nav-item">
              <div class="games-room-btns mobile-btn">
                <a href="{{ route('home') }}" class="btn rounded-pill gradient-bg ">Practice </a>
                @auth
                <a href="{{ route('front.tournaments') }}" class="btn rounded-pill btn-light" style="background-color: red; border-color:red">Tournaments</a>
                @else
                <a href="{{ route('front.login') }}" class="btn rounded-pill btn-light" style="background-color: red; border-color:red">Tournaments</a>
                @endif
              </div>
            </li>
            <li class="nav-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="nav-item"><a href="{{route('front.cmsPages',['about-us'])}}">About Us</a></li>
            <li class="nav-item"><a href="{{route('front.cmsPages',['our-partners'])}}">Our PARTNERS</a></li>
            <li class="nav-item"><a href="{{route('front.cmsPages',['affiliate'])}}">Affiliates</a></li>
            <li class="nav-item"><a href="{{route('front.cmsPages',['charities'])}}">CHARITIES</a></li>
            <li class="nav-item"><a href="{{route('front.cmsPages',['advertisers'])}}">Advertisers</a></li>
            <li class="nav-item"><a href="{{route('front.cmsPages',['sponsors'])}}">SPONSORS</a></li>
            <li class="nav-item"><a href="{{route('front.cmsPages',['special-features'])}}">SPECIAL FEATURES</a></li>
            <li class="nav-item"><a href="{{route('front.cmsPages',['tournament-rules'])}}">TOURNAMENT RULES</a></li>
            <li class="nav-item"><a href="{{route('front.cmsPages',['legal'])}}">LEGAL</a></li>
            <li class="nav-item"><a href="{{route('front.cmsPages',['future-features'])}}">FUTURE FEATURES </a></li>
          </ul>

          <div class="header-social-media">
            <p class="mb-0 text-white montserrat-font">Follow us </p>
            <ul class="">
              <li><a href="https://www.facebook.com/people/IWin-Gaming/100083289045045/" target="_blank"><i class="fa-brands fa-facebook-f"></i></a></li>
              <li><a href="https://www.instagram.com/iwingamers/" target="_blank"><i class="fa-brands fa-instagram"></i></a></li>
              <li><a href="https://twitter.com" target="_blank"><i class="fa-brands fa-twitter"></i></a></li>
              <li><a href="https://www.linkedin.com" target="_blank"><i class="fa-brands fa-linkedin"></i></a></li>
            </ul>
          </div>
          @auth
          <div class="log-btn">
            <a href="{{ route('front.logout') }}" class="btn gaming-btn rounded-0">
              Sign Out
            </a>
          </div>
          @else
          <div class="log-btn">
            <a href="{{ route('front.login') }}" class="btn gaming-btn rounded-0">
              Sign In
            </a>
          </div>
          @endauth
        </div>
      </div>
    </div>
  </div>
</nav>
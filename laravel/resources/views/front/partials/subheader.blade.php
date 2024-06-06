
<div class="games-room-btns  desktop">
  @if(Request::segment(1) == 'tournaments')
  <a href="{{ route('home') }}" class="btn rounded-pill @if(Request::segment(1) == '') gradient-bg @else btn-light @endif px-5">Practice </a>
  @endif
  @if(Request::segment(1) == '')
  @auth
    <a href="{{ route('front.tournaments') }}" class="btn rounded-pill px-5 btn-light"  style="background-color: red; border-color:red">Tournaments</a>
  @else
    <a href="{{ route('front.login') }}" class="btn rounded-pill btn-light px-5" style="background-color: red; border-color:red">Tournaments</a>
  @endif
  @endif
</div>
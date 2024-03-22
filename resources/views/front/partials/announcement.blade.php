<div class="help-box">
	@include('front.partials.video')
	@auth
	<a href="{{ route('front.tournaments') }}" class="f-14 fw-600 btn btn-secondary text-uppercase w-100 montserrat-font tournament-btn">Tournaments</a>
	@else
	<a href="{{ route('front.login') }}" class="f-14 fw-600 btn btn-secondary text-uppercase w-100 montserrat-font tournament-btn">Tournaments</a>
	@endif
	<div class="tournament-box mt-3">
	  <div class="tournament-header">
	  <h2 class="f-14 fw-700 text-white montserrat-font mb-0">ANNOUNCEMENT</h2>
	   </div>
	  	<div class="tournament-item text-center">
		  	<div class="tournament-end">
			  	@foreach($future_tournaments as $ft)
			    <p class="f-12 text-white">
			    	{{$ft->name}} Tournament Begins on {{date('M dS', strtotime($ft->start_date))}}
			    </p>
			    @endforeach
			    @foreach($winning_data as $wd)
			    <p class="f-12 text-white ">
			    	{{$wd->getUser->name}} wins {{$wd->reward}} in {{$wd->getTournaments->name}} Tournaments
			    </p>
			    @endforeach
		  	</div>
	  	</div>
	</div>
</div>
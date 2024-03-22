@extends('front.layouts.main')
@section('page_title', $cms_data->name)
@section('content')
@include('front.partials.adsmobile')
<div class="cms-pages" >
   	<div class="section-heading">
    	<h2 class="f-24 fw-700 text-white text-uppercase">{{ $cms_data->name}}</h2>
   	</div>
   	<div class="cms-content">
		<p>
    	    {!! html_entity_decode($cms_data->description) !!}
		</p>
   	</div>
 </div>
@endsection
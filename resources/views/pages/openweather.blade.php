@extends('app')

@section('url') {{ $page->url }} @endsection
@section('metadescription') {{ $page->metadescription }} @endsection
@section('title') {{ $page->metatitle }} @endsection

@section('content')

<div class="hero content {{ $page->css }}">
	@include('layout.nav')
<div class="grid-container full">
	<div class="grid-x grid-padding-x">
		<div class="cell small-12 text-center">
			<h1>{{ $page->heading }}</h1>
		</div><!-- End of cell-->
	</div><!--end of grid-x -->
</div><!--End of grid container-->
@include('layout.hero-wave')
</div>

<div class="section-one">
<div class="grid-x grid-padding-x">
	<div class="cell small-12 medium-10 large-8 medium-offset-1 large-offset-2">
	<div class="weather-title">
	   <h3 class="wtitle">Limoges-Bellegarde, France</h3>
	   <p>4 day weather forecast</p>
	</div><!-- End of cell-->
	</div>
</div><!--end of grid-x -->

<div class="grid-x grid-padding-x">
	<div class="cell small-12 text-center">
		<h5 class="month-bar">{{ Carbon\Carbon::parse($dayone)->format('d/m/y') }}</h5>    
	</div>
</div>
<div class="grid-x grid-padding-x">
	@foreach($data['list'] as $date)
		@if(Carbon\Carbon::parse($dayone)->format('d/m/y') == Carbon\Carbon::parse($date['dt'])->format('d/m/y'))
		<div class="cell small-6 medium-3 ml-2">
			<div class="weather-tile text-center">
				@foreach($date['weather'] as $weather) 
					<img src="/img/weather/{{ $weather['icon'] }}.png" width="100px"><br> 
				@endforeach
				<p><strong>{{ Carbon\Carbon::parse($date['dt'])->format('H:i') }}</strong><br>
			    <strong>{{ round($date['main']['temp'] - 273.15) }}°</strong> @foreach($date['weather'] as $weather) {{ $weather['main'] }} @endforeach<br>
			    Feels like {{ round($date['main']['feels_like'] - 273.15) }}°<br>
			    {{ $date['main']['pressure'] }}<small>hPa</small><br>
				@if($date['wind']['deg'] >= 348.75 AND $date['wind']['deg'] < 11.25)
					<strong>N</strong>
				@elseif($date['wind']['deg'] >= 11.25 AND $date['wind']['deg'] < 33.75)
					<strong>NNE</strong>
				@elseif($date['wind']['deg'] >= 33.75 AND $date['wind']['deg'] < 56.25)
					<strong>NE</strong>
				@elseif($date['wind']['deg'] >= 56.25 AND $date['wind']['deg'] < 78.75)
					<strong>ENE</strong>
				@elseif($date['wind']['deg'] >= 78.75 AND $date['wind']['deg'] < 101.25)
					<strong>E</strong>
				@elseif($date['wind']['deg'] >= 101.25 AND $date['wind']['deg'] < 123.75)
					<strong>ESE</strong>
				@elseif($date['wind']['deg'] >= 123.75 AND $date['wind']['deg'] < 146.25)
					<strong>SE</strong>
				@elseif($date['wind']['deg'] >= 146.25 AND $date['wind']['deg'] < 168.75)
					<strong>SSE</strong>
				@elseif($date['wind']['deg'] >= 168.75 AND $date['wind']['deg'] < 191.25)
					<strong>S</strong>
				@elseif($date['wind']['deg'] >= 191.25 AND $date['wind']['deg'] < 213.75)
					<strong>SSW</strong>
				@elseif($date['wind']['deg'] >= 213.75 AND $date['wind']['deg'] < 236.25)
					<strong>SW</strong>
				@elseif($date['wind']['deg'] >= 236.25 AND $date['wind']['deg'] < 258.75)
					<strong>WSW</strong>
				@elseif($date['wind']['deg'] >= 258.75 AND $date['wind']['deg'] < 281.25)
					<strong>W</strong>
				@elseif($date['wind']['deg'] >= 281.25 AND $date['wind']['deg'] < 303.75)
					<strong>WNW</strong>
				@elseif($date['wind']['deg'] >= 303.75 AND $date['wind']['deg'] < 326.25)
					<strong>NW</strong>
				@elseif($date['wind']['deg'] >= 326.25 AND $date['wind']['deg'] < 348.75)
					<strong>NNW</strong>
				@else
					<strong>N/A
				@endif</p>
					
			</div>
		</div><!-- End of cell-->
		@endif
	@endforeach
</div><!--end of grid-x -->

<div class="grid-x grid-padding-x">
	<div class="cell small-12 text-center">
		<h5 class="month-bar">{{ Carbon\Carbon::parse($daytwo)->format('d/m/y') }}</h5>    
	</div>
</div>
<div class="grid-x grid-padding-x">
	@foreach($data['list'] as $date)
		@if(Carbon\Carbon::parse($daytwo)->format('d/m/y') == Carbon\Carbon::parse($date['dt'])->format('d/m/y'))
		<div class="cell small-6 medium-3 ml-2">
			<div class="weather-tile text-center">
				@foreach($date['weather'] as $weather) 
					<img src="/img/weather/{{ $weather['icon'] }}.png" width="100px"><br> 
				@endforeach
				<p><strong>{{ Carbon\Carbon::parse($date['dt'])->format('H:i') }}</strong><br>
			    <strong>{{ round($date['main']['temp'] - 273.15) }}°</strong> @foreach($date['weather'] as $weather) {{ $weather['main'] }} @endforeach<br>
			    Feels like {{ round($date['main']['feels_like'] - 273.15) }}°<br>
			    {{ $date['main']['pressure'] }}<small>hPa</small><br>
				@if($date['wind']['deg'] >= 348.75 AND $date['wind']['deg'] < 11.25)
					N
				@elseif($date['wind']['deg'] >= 11.25 AND $date['wind']['deg'] < 33.75)
					NNE
				@elseif($date['wind']['deg'] >= 33.75 AND $date['wind']['deg'] < 56.25)
					NE
				@elseif($date['wind']['deg'] >= 56.25 AND $date['wind']['deg'] < 78.75)
					ENE
				@elseif($date['wind']['deg'] >= 78.75 AND $date['wind']['deg'] < 101.25)
					E
				@elseif($date['wind']['deg'] >= 101.25 AND $date['wind']['deg'] < 123.75)
					ESE
				@elseif($date['wind']['deg'] >= 123.75 AND $date['wind']['deg'] < 146.25)
					SE
				@elseif($date['wind']['deg'] >= 146.25 AND $date['wind']['deg'] < 168.75)
					SSE
				@elseif($date['wind']['deg'] >= 168.75 AND $date['wind']['deg'] < 191.25)
					S
				@elseif($date['wind']['deg'] >= 191.25 AND $date['wind']['deg'] < 213.75)
					SSW
				@elseif($date['wind']['deg'] >= 213.75 AND $date['wind']['deg'] < 236.25)
					SW
				@elseif($date['wind']['deg'] >= 236.25 AND $date['wind']['deg'] < 258.75)
					WSW
				@elseif($date['wind']['deg'] >= 258.75 AND $date['wind']['deg'] < 281.25)
					W
				@elseif($date['wind']['deg'] >= 281.25 AND $date['wind']['deg'] < 303.75)
					WNW
				@elseif($date['wind']['deg'] >= 303.75 AND $date['wind']['deg'] < 326.25)
					NW
				@elseif($date['wind']['deg'] >= 326.25 AND $date['wind']['deg'] < 348.75)
					NNW
				@else
					N/A
				@endif</p>
					
			</div>
		</div><!-- End of cell-->
		@endif
	@endforeach
</div><!--end of grid-x -->

<div class="grid-x grid-padding-x">
	<div class="cell small-12 text-center">
		<h5 class="month-bar">{{ Carbon\Carbon::parse($dayone)->format('d/m/y') }}</h5>    
	</div>
</div>
<div class="grid-x grid-padding-x">
	@foreach($data['list'] as $date)
		@if(Carbon\Carbon::parse($daythree)->format('d/m/y') == Carbon\Carbon::parse($date['dt'])->format('d/m/y'))
		<div class="cell small-6 medium-3 ml-2">
			<div class="weather-tile text-center">
				@foreach($date['weather'] as $weather) 
					<img src="/img/weather/{{ $weather['icon'] }}.png" width="100px"><br> 
				@endforeach
				<p><strong>{{ Carbon\Carbon::parse($date['dt'])->format('H:i') }}</strong><br>
			    <strong>{{ round($date['main']['temp'] - 273.15) }}°</strong> @foreach($date['weather'] as $weather) {{ $weather['main'] }} @endforeach<br>
			    Feels like {{ round($date['main']['feels_like'] - 273.15) }}°<br>
			    {{ $date['main']['pressure'] }}<small>hPa</small><br>
				@if($date['wind']['deg'] >= 348.75 AND $date['wind']['deg'] < 11.25)
					N
				@elseif($date['wind']['deg'] >= 11.25 AND $date['wind']['deg'] < 33.75)
					NNE
				@elseif($date['wind']['deg'] >= 33.75 AND $date['wind']['deg'] < 56.25)
					NE
				@elseif($date['wind']['deg'] >= 56.25 AND $date['wind']['deg'] < 78.75)
					ENE
				@elseif($date['wind']['deg'] >= 78.75 AND $date['wind']['deg'] < 101.25)
					E
				@elseif($date['wind']['deg'] >= 101.25 AND $date['wind']['deg'] < 123.75)
					ESE
				@elseif($date['wind']['deg'] >= 123.75 AND $date['wind']['deg'] < 146.25)
					SE
				@elseif($date['wind']['deg'] >= 146.25 AND $date['wind']['deg'] < 168.75)
					SSE
				@elseif($date['wind']['deg'] >= 168.75 AND $date['wind']['deg'] < 191.25)
					S
				@elseif($date['wind']['deg'] >= 191.25 AND $date['wind']['deg'] < 213.75)
					SSW
				@elseif($date['wind']['deg'] >= 213.75 AND $date['wind']['deg'] < 236.25)
					SW
				@elseif($date['wind']['deg'] >= 236.25 AND $date['wind']['deg'] < 258.75)
					WSW
				@elseif($date['wind']['deg'] >= 258.75 AND $date['wind']['deg'] < 281.25)
					W
				@elseif($date['wind']['deg'] >= 281.25 AND $date['wind']['deg'] < 303.75)
					WNW
				@elseif($date['wind']['deg'] >= 303.75 AND $date['wind']['deg'] < 326.25)
					NW
				@elseif($date['wind']['deg'] >= 326.25 AND $date['wind']['deg'] < 348.75)
					NNW
				@else
					N/A
				@endif</p>
					
			</div>
		</div><!-- End of cell-->
		@endif
	@endforeach
</div><!--end of grid-x -->

<div class="grid-x grid-padding-x">
	<div class="cell small-12 text-center">
		<h5 class="month-bar">{{ Carbon\Carbon::parse($dayone)->format('d/m/y') }}</h5>    
	</div>
</div>
<div class="grid-x grid-padding-x">
	@foreach($data['list'] as $date)
		@if(Carbon\Carbon::parse($dayfour)->format('d/m/y') == Carbon\Carbon::parse($date['dt'])->format('d/m/y'))
		<div class="cell small-6 medium-3 ml-2">
			<div class="weather-tile text-center">
				@foreach($date['weather'] as $weather) 
					<img src="/img/weather/{{ $weather['icon'] }}.png" width="100px"><br> 
				@endforeach
				<p><strong>{{ Carbon\Carbon::parse($date['dt'])->format('H:i') }}</strong><br>
			    <strong>{{ round($date['main']['temp'] - 273.15) }}°</strong> @foreach($date['weather'] as $weather) {{ $weather['main'] }} @endforeach<br>
			    Feels like {{ round($date['main']['feels_like'] - 273.15) }}°<br>
			    {{ $date['main']['pressure'] }}<small>hPa</small><br>
				@if($date['wind']['deg'] >= 348.75 AND $date['wind']['deg'] < 11.25)
					N
				@elseif($date['wind']['deg'] >= 11.25 AND $date['wind']['deg'] < 33.75)
					NNE
				@elseif($date['wind']['deg'] >= 33.75 AND $date['wind']['deg'] < 56.25)
					NE
				@elseif($date['wind']['deg'] >= 56.25 AND $date['wind']['deg'] < 78.75)
					ENE
				@elseif($date['wind']['deg'] >= 78.75 AND $date['wind']['deg'] < 101.25)
					E
				@elseif($date['wind']['deg'] >= 101.25 AND $date['wind']['deg'] < 123.75)
					ESE
				@elseif($date['wind']['deg'] >= 123.75 AND $date['wind']['deg'] < 146.25)
					SE
				@elseif($date['wind']['deg'] >= 146.25 AND $date['wind']['deg'] < 168.75)
					SSE
				@elseif($date['wind']['deg'] >= 168.75 AND $date['wind']['deg'] < 191.25)
					S
				@elseif($date['wind']['deg'] >= 191.25 AND $date['wind']['deg'] < 213.75)
					SSW
				@elseif($date['wind']['deg'] >= 213.75 AND $date['wind']['deg'] < 236.25)
					SW
				@elseif($date['wind']['deg'] >= 236.25 AND $date['wind']['deg'] < 258.75)
					WSW
				@elseif($date['wind']['deg'] >= 258.75 AND $date['wind']['deg'] < 281.25)
					W
				@elseif($date['wind']['deg'] >= 281.25 AND $date['wind']['deg'] < 303.75)
					WNW
				@elseif($date['wind']['deg'] >= 303.75 AND $date['wind']['deg'] < 326.25)
					NW
				@elseif($date['wind']['deg'] >= 326.25 AND $date['wind']['deg'] < 348.75)
					NNW
				@else
					N/A
				@endif</p>
					
			</div>
		</div><!-- End of cell-->
		@endif
	@endforeach
</div><!--end of grid-x -->


</div>
@endsection
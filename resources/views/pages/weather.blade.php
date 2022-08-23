@extends('app')

@section('content')

<div class="hero content">
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
	   <p>5 day, 6 hourly weather forecast - data supplied by Met Office</p>
	</div><!-- End of cell-->
	</div>
</div><!--end of grid-x -->

<div class="grid-x grid-padding-x">
	@isset($forecast->SiteRep->DV->Location)
		@foreach($forecast->SiteRep->DV->Location->Period as $day)
		<div class="cell small-12 medium-10 medium-offset-1 large-8 large-offset-2">
			
			<div class="grid-x grid-padding-x">
			<div class="cell small-12">
				
					<div class="grid-x grid-padding-x">
						<div class="cell small-12">
							<p class="header"><strong>{{ date('D j/m/y', strtotime ($day->value)) }}</strong></p>
						</div>
					@foreach($day->Rep as $forecast)
						@if($loop->odd)
						<div class="cell small-6 medium-3">
							<div class="weather-tile text-center">
								
								@include('layout.weathericons')<br> 
								<p><strong>{{ date('H:i', strtotime (Carbon\Carbon::createMidnightDate($day->value)->addMinutes($forecast->mpm))) }}</strong><br>
							    <strong>{{ $forecast->T }}°</strong> @include('layout.weathertype')<br>
							    Feels like {{ $forecast->F }}°<br>
								{{ $forecast->D }} {{ $forecast->S }}mph</p>
									
							</div>
						</div><!-- End of cell-->
						@endif
					@endforeach</p>
					</div><!--end of grid-x -->
			

			</div><!-- End of cell-->
			</div><!--end of grid-x -->
			
		</div><!-- End of cell-->
		@endforeach
	@else
		<div class="cell small-12 medium-10 medium-offset-1 large-8 large-offset-2 text-center"> 
			<div class="profilewhitebx">
				<p>Weather forecast currently unavailable</p>
			</div>
		</div>
	@endisset
</div><!--end of grid-x -->
</div>
@endsection
@extends('app')

@section('content')

<div class="hero content">
	@include('layout.nav')
<div class="grid-container full">
	<div class="grid-x grid-padding-x">
		<div class="cell small-12 text-center">
			<h1>Weather</h1>
		</div><!-- End of cell-->
	</div><!--end of grid-x -->
</div><!--End of grid container-->
@include('layout.hero-wave')
</div>

<div class="section-one">
	<div class="grid-container full">
		<div class="grid-x grid-padding-x">
			<div class="cell small-12 medium-3 large-2 text-center">
				<div class="weather-tile">
					test
				</div>
			</div><!-- End of cell-->

			<div class="cell small-12 medium-3 large-2 text-center">
				<div class="weather-tile">
					test
				</div>
			</div><!-- End of cell-->

			<div class="cell small-12 medium-3 large-2 text-center">
				<div class="weather-tile">
					test
				</div>
			</div><!-- End of cell-->

			<div class="cell small-12 medium-3 large-2 text-center">
				<div class="weather-tile">
					test
				</div>
			</div><!-- End of cell-->

			<div class="cell small-12 medium-3 large-2 text-center">
				<div class="weather-tile">
					test
				</div>
			</div><!-- End of cell-->

			<div class="cell small-12 medium-3 large-2 text-center">
				<div class="weather-tile">
					<- Scroll for more
				</div>
			</div><!-- End of cell-->
		</div><!--end of grid-x -->
	</div><!--End of grid container-->
</div>

@endsection
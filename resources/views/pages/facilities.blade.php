@extends('app')

@section('content')

<div class="hero content">
	@include('layout.nav')
<div class="grid-container">
	<div class="grid-x grid-padding-x">
		<div class="cell small-12 text-center">
			<h1>Facilities</h1>
		</div><!-- End of cell-->
	</div><!--end of grid-x -->
</div><!--End of grid container-->
@include('layout.hero-wave')
</div>

<div class="section-one">
	<div class="grid-container">
		<div class="grid-x grid-padding-x">
			<div class="cell small-12">
				<h3><span class="weighted">On site</span> facillities</h3>
				<p>Currently, we offer a drive and survive only, we provide all anglers with the basic facilities needed during your stay. The generator provides the house with power for the fridge, lighting, multiple USB charging points, etc. There is also a flushing toilet, wash basin, and hot showers heated by a gas boiler. Unfortunately, there is currently no drinking water, however, we provide all anglers with ten litres of bottled water on arrival.</p>

				<p>Should you wish to reel in there is also a covered outdoor area up by the house with benches and a large table for multiple guests to relax, this area also has a brick barbecue available for guests to use.</p>
				<p>If you prefer to leave the rods out will find two pub-style benches with a portable barbecue between swim three and seven.  </p>
				<br>
			</div><!-- End of cell-->
		</div><!--end of grid-x -->
	</div><!--End of grid container-->
	<section class="horizSlider">
	  <div class="slide">
	    <h2 class="slideText">Text title</h2>
	    <img width="1000" height="500" class="slideImage" src="https://source.unsplash.com/random/1000x500" alt="Filler image">
	  </div>
	  
	  <div class="slide">
	    <h2 class="slideText">Text title</h2>
	    <img width="1000" height="500" class="slideImage" src="https://source.unsplash.com/random/1000x500" alt="Filler image">
	  </div>
	  
	  <div class="slide">
	    <h2 class="slideText">Text title</h2>
	    <img width="1000" height="500" class="slideImage" src="https://source.unsplash.com/random/1000x500">
	  </div>
	  
	  <div class="slide">
	    <h2 class="slideText">Text title</h2>
	    <img width="1000" height="500" class="slideImage" src="https://source.unsplash.com/random/1000x500">
	  </div>
	  
	  <div class="slide">
	    <h2 class="slideText">Text title</h2>
	    <img width="1000" height="500" class="slideImage" src="https://source.unsplash.com/random/1000x500">
	  </div>
	</section>

	<div class="grid-container">
		<div class="grid-x grid-padding-x">
			<div class="cell small-12">
				<br>
				<h3><span class="weighted">Local</span> Amenities</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
				cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
				proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
			</div><!-- End of cell-->
		</div><!--end of grid-x -->
	</div><!--End of grid container-->
</div>

@endsection
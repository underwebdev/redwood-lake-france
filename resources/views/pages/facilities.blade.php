@extends('app')

@section('content')

<div class="hero content {{ $page->css }}">
	@include('layout.nav')
<div class="grid-container">
	<div class="grid-x grid-padding-x">
		<div class="cell small-12 text-center">
			<h1>{{ $page->heading }}</h1>
		</div><!-- End of cell-->
	</div><!--end of grid-x -->
</div><!--End of grid container-->
@include('layout.hero-wave')
</div>

<div class="section-one">
	<div class="grid-container">
		<div class="grid-x grid-padding-x">
			<div class="cell small-12">
				<h3><span class="weighted">On site</span> facilities</h3>
				@foreach($page->modules->where('order', 1) as $module)
					<p>{!! nl2br(e($module->content)) !!}</p>
				@endforeach
			</div><!-- End of cell-->
		</div><!--end of grid-x -->
	</div><!--End of grid container-->
	<section class="horizSlider">
	  <div class="slide">
	    <h2 class="slideText"></h2>
	    <img width="1000" height="500" class="slideImage" src="/img/gallery/redwoodlake-house.jpeg" alt="Filler image">
	  </div>
	  
	  <div class="slide">
	    <h2 class="slideText"></h2>
	    <img width="1000" height="500" class="slideImage" src="/img/gallery/redwoodlake-platform.jpeg" alt="Filler image">
	  </div>
	  
	  <div class="slide">
	    <h2 class="slideText"></h2>
	    <img width="1000" height="500" class="slideImage" src="/img/gallery/aqua-park.jpeg">
	  </div>
	  
	  <div class="slide">
	    <h2 class="slideText"></h2>
	    <img width="1000" height="500" class="slideImage" src="/img/gallery/redwood-bbq-area.jpg">
	  </div>
	  
	  <div class="slide">
	    <h2 class="slideText">Text title</h2>
	    <img width="1000" height="500" class="slideImage" src="https://source.unsplash.com/random/1000x500">
	  </div>
	</section>

	<div class="grid-x grid-padding-x">
		<div class="cell small-12 text-center">
			<p><span class="show-for-large">Scroll</span><span class="hide-for-large">Swipe</span>  for more<i class="fas fa-arrow-alt-circle-right wobble"></i>
		      
		</div><!-- End of cell-->
	</div><!--end of grid-x -->

	<div class="grid-container">
		<div class="grid-x grid-padding-x">
			<div class="cell small-12">
				<br>
				<h3><span class="weighted">Local</span> Amenities</h3>
				@foreach($page->modules->where('order', 2) as $module)
					<p>{!! nl2br(e($module->content)) !!}</p>
				@endforeach
			</div><!-- End of cell-->
		</div><!--end of grid-x -->
	</div><!--End of grid container-->
</div>

@endsection
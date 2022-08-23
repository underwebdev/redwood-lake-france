@extends('app')

@section('content')

<div class="hero content">
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
				@foreach($page->modules->where('order', 2) as $module)
					<p>{!! nl2br(e($module->content)) !!}</p>
				@endforeach
			</div><!-- End of cell-->
		</div><!--end of grid-x -->
	</div><!--End of grid container-->
</div>

@endsection
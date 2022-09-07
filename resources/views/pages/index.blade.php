@extends('app')

@section('content')

<div class="hero home">
		@include('layout.nav')
<div class="grid-container full">
	<div class="grid-x grid-padding-x">
		<div class="cell small-12 medium-10 large-9 hero-text">
			<h1>{{ $page->heading }}</h1>
			<h2><strong>{!! nl2br(e($page->subheading)) !!}</strong></h2>
			<div class="hero-review show-for-medium">
				<p><i class="fas fa-quote-left"></i> {{ $review->body }} <i class="fas fa-quote-right"></i></p>
			</div>
			<a href="/booking" class="button secondary hollow large">Book Now</a>
		</div><!-- End of cell-->
	</div><!--end of grid-x -->
</div><!--End of grid container-->
<div class="hero-wave">
@include('layout.hero-wave')
</div>
</div>

<div class="section-one">
	<div class="intro">
		<div class="grid-container">
			<div class="grid-x grid-padding-x">
				<div class="cell small-12">
					<h3><span class="weighted">Welcome to</span> Etang de Seuil</h3>
					@foreach($page->modules->where('order', 1) as $module)
					<p>{!! nl2br(e($module->content)) !!}</p>
					@endforeach
				</div><!-- End of cell-->
			</div><!--end of grid-x -->
		</div><!--End of grid container-->
	</div>
</div>

@include('layout.wave')

<div class="section-one">
	<div class="lake-info">
		<div class="grid-container full">
			<div class="grid-x grid-padding-x">
				<div class="cell small-12 large-6">
					<div id="lake-desc">
					<h4><span class="weighted">The</span> Lake</h4>
					@foreach($page->modules->where('order', 2) as $module)
					<p>{!! nl2br(e($module->content)) !!}</p>
					@endforeach
				  </div>    
				</div><!-- End of cell-->
				<div class="cell large-6 show-for-large align-self-middle">
					<div id="lake-image">
					<div class="photo-outline">
						<img src="/img/lake-rods.jpg"> 
					</div>
					</div> 
				</div><!-- End of cell-->
			</div><!--end of grid-x -->
		</div>
	</div>

	<div class="mobile-gallery-home">
	<div class="grid-x grid-padding-x hide-for-large">
		<div class="cell small-12">
			<div class="photo-outline">
			  <img src="/img/redwood-lake-common-carp.jpg"> 
			</div>
		</div><!-- End of cell-->
	</div><!--end of grid-x -->
	</div>

	<div class="fish-info">
	<div class="grid-container full">
		<div class="grid-x grid-padding-x">
			<div class="cell large-6 show-for-large align-self-middle">
				<div id="fish-image">
				<div class="photo-outline">
			    	<img src="/img/redwood-lake-common-carp.jpg"> 
			  </div>
			  </div>  
			</div><!-- End of cell-->
			<div class="cell small-12 large-6">
				<div id="fish-desc">
				<h4><span class="weighted">The</span> Fish</h4>
				@foreach($page->modules->where('order', 3) as $module)
					<p>{!! nl2br(e($module->content)) !!}</p>
				@endforeach
				</div>
			</div><!-- End of cell-->
		</div><!--end of grid-x -->
	</div>
	</div>
</div>

@include('layout.wave')

<div class="section-one">
	<div class="facilities">
	<div class="grid-container full">
		<div class="grid-x grid-padding-x">
			<div class="cell small-12 large-6">
				<h4><span class="weighted">Complex</span> Facilities</h4>
			  @foreach($page->modules->where('order', 4) as $module)
					<p>{!! nl2br(e($module->content)) !!}</p>
				@endforeach
			</div><!-- End of cell-->
			<div class="cell small-12 large-6 align-self-middle">
				<div class="photo-outline">
			  	<img src="/img/facility.jpeg">
			  </div>   
			</div><!-- End of cell-->
		</div><!--end of grid-x -->
	</div>
	</div>
</div>

@include('layout.wave')

<div class="section-one">
	<div class="pricing">
	<div class="grid-container">
			<div class="grid-x grid-padding-x">
				<div class="cell small-12">
					<h4 class="text-center"><span class="weighted">Price</span> Packages</h4>
					@foreach($page->modules->where('order', 5) as $module)
						<p>{!! nl2br(e($module->content)) !!}</p>
						@endforeach
				</div>
			</div>
		</div>
		<div class="grid-x grid-padding-x" data-equalizer data-equalize-on="medium">
			@foreach($priceguides as $priceguide)
				@include('layout.pricing-block')
			@endforeach
			<div class="cell small-12 text-center">
				<a href="/booking" class="button large">View Availabillity</a>
			      
			</div><!-- End of cell-->
		</div><!--end of grid-x -->
	</div>
	</div>
</div>

<div class="subscribe-curve">
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 316">
  <path fill="#232323" fill-opacity="1" d="M0,160L120,170.7C240,181,480,203,720,202.7C960,203,1200,181,1320,170.7L1440,160L1440,320L1320,320C1200,320,960,320,720,320C480,320,240,320,120,320L0,320Z"></path>
</svg>
</div>
<div class="subscribe">
@livewire('subscribe-form')
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 316">
  <path fill="#f7f6fb" fill-opacity="1" d="M0,160L120,170.7C240,181,480,203,720,202.7C960,203,1200,181,1320,170.7L1440,160L1440,320L1320,320C1200,320,960,320,720,320C480,320,240,320,120,320L0,320Z"></path>
</svg>
</div>

<div class="section-one">
	<div class="availabillity">
	<div class="grid-container">
		<div class="grid-x grid-padding-x">
			<div class="cell small-12 text-center">
				<h4><span class="weighted">Booking</span> Availabillity</h4>
				<p>We are currently taking bookings up until {{ Carbon\Carbon::parse($latestdate)->format('F Y') }}. Please check for availability below.</p>
			</div>
		</div>
		<div class="grid-x grid-padding-x">
				@include('layout.calendar')  
		</div><!--end of grid-x -->
		<div class="cell small-12 text-center view-more-container">
		  <a href="/booking" class="button large">View Full Calendar</a>  
		</div><!-- End of cell-->
	</div>
	</div>
</div>

@include('layout.wave')

<div class="section-one">
	<div class="info">
	<div class="grid-container">
		<div class="grid-x grid-padding-x">
			<div class="cell small-12">
				<h4><span class="weighted">Complex</span> Gallery</h4>
			</div><!-- End of cell-->
		</div><!--end of grid-x -->
	</div><!--End of grid container-->
	</div>

@livewire('feature-gallery', ['page' => $page])
</div>

@include('layout.wave')

<div class="section-one">
	<div class="contact">
	<div class="grid-container">
		<div class="grid-x grid-padding-x">
			<div class="cell small-12 medium-10 large-8 medium-offset-1 large-offset-2">
				<h4><span class="weighted">Contact</span> Information</h4>
			</div><!-- End of cell-->
			<div class="cell small-12 medium-10 large-8 medium-offset-1 large-offset-2">
				<p><i class="far fa-envelope"></i> info@etangdeseuil.co.uk<br>
					<i class="fab fa-instagram"></i> etangdeseuil</p> 
				@foreach($page->modules->where('order', 6) as $module)
					<p>{!! nl2br(e($module->content)) !!}</p>
				@endforeach
			      
			</div><!-- End of cell-->
			<div class="cell small-12 medium-10 large-8 medium-offset-1 large-offset-2">
				@livewire('contact-form')
			</div><!-- End of cell-->
		</div><!--end of grid-x -->
	</div><!--End of grid container-->
	</div>
</div><!-- end of section one -->

@endsection
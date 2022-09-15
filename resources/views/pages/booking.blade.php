@extends('app')

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
	<div class="intro">
	<div class="grid-container">
		<div class="grid-x grid-padding-x">
			<div class="cell small-12">
				<h3 class="text-center"><span class="weighted">Booking</span> Information</h3>
				@foreach($page->modules->where('order', 1) as $module)
					<p>{!! nl2br(e($module->content)) !!}</p>
				@endforeach
			</div><!-- End of cell-->
		</div><!--end of grid-x -->
	</div><!--End of grid container-->
	</div>

	<div class="booking-pricing">
	<div class="grid-container">
		<div class="grid-x grid-padding-x">
			<div class="cell small-12">
				<h3 class="text-center"><span class="weighted">Price</span> Packages</h3>
				@foreach($page->modules->where('order', 2) as $module)
					<p>{!! nl2br(e($module->content)) !!}</p>
				@endforeach
			</div>
		</div>
		<div class="grid-x grid-padding-x" data-equalizer data-equalize-on="medium">
			@foreach($priceguides as $priceguide)
				@include('layout.pricing-block-alt')
			@endforeach
			<div class="cell small-12 text-center">
				<p>All bookings require a 30% deposit to confirm the requested dates. The remaining balance is due 8 weeks prior to arrival.</p>

				<strong>Scroll Down For Availabillity</strong><br>
				<i class="fas fa-arrow-alt-circle-down bounce"></i>
			</div><!-- End of cell-->
		</div><!--end of grid-x -->
	</div><!--End of grid container-->
	</div>
</div>

@include('layout.wave')

<div class="section-one">
<div class="availabillity">
	@livewire('booking-calendar')
</div>
</div>

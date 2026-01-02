@extends('app')

@section('url') {{ $page->url }} @endsection
@section('metadescription') {{ $page->metadescription }} @endsection
@section('title') {{ $page->metatitle }} @endsection

@section('content')

<div class="hero content black">
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
	<div class="grid-container">
		<div class="grid-x grid-padding-x">
			<div class="cell small-12">
				<h3 class="text-center"><span class="weighted">Booking</span> Terms & Conditions</h3>
				@foreach($page->modules->where('order', 1) as $module)
					<p class="text-center">{!! nl2br(e($module->content)) !!}</p>
				@endforeach
			</div><!-- End of cell-->
			<div class="cell small-12 medium-8 large-6 medium-offset-2 large-offset-3">
				<ol>
					@foreach($terms as $term)
					<li>{{ $term->body }}</li>
					@endforeach
				</ol>
				<div class="text-center">
					<a href="https://redwoodlake.co.uk/booking" class="button success">Booking Availability</a>
				</div>
			</div><!-- End of cell-->
		</div><!--end of grid-x -->
	</div><!--End of grid container-->
</div>

@endsection
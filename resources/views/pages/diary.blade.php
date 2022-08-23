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
	<div class="grid-container full">
		<div class="grid-x grid-padding-x">
			<div class="cell small-12 medium-6 text-center">
				<div class="photo-diary-hero">
					Image one
				</div>
				<p>Caption</p>
			</div><!-- End of cell-->
			<div class="cell small-12 medium-6 text-center">
				<div class="photo-diary-hero">
					Image two
				</div>
				<p>Caption</p>
			</div><!-- End of cell-->
		</div><!--end of grid-x -->
	</div><!--End of grid container-->
	<div class="grid-container full">
		<div class="grid-x grid-padding-x">
			<div class="cell small-6 medium-4 large-3">
				<div class="photo-diary-thumb">
					thumbnail
				</div>
				<div class="photo-diary-caption">
					this is some text
				</div>
			</div><!-- End of cell-->
			<div class="cell small-6 medium-4 large-3">
				<div class="photo-diary-thumb">
					thumbnail
				</div>
				<div class="photo-diary-caption">
					this is some text
				</div>
			</div><!-- End of cell-->
			<div class="cell small-6 medium-4 large-3">
				<div class="photo-diary-thumb">
					thumbnail
				</div>
				<div class="photo-diary-caption">
					this is some text
				</div>
			</div><!-- End of cell-->
			<div class="cell small-6 medium-4 large-3">
				<div class="photo-diary-thumb">
					thumbnail
				</div>
				<div class="photo-diary-caption">
					this is some text
				</div>
			</div><!-- End of cell-->
		</div><!--end of grid-x -->
	</div><!--End of grid container-->
</div>

@endsection
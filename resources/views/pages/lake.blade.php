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
	<div class="intro">
		<div class="grid-container">
			<div class="grid-x grid-padding-x">
				<div class="cell small-12">
					<h3><span class="weighted">The</span> Lake</h3>
					@foreach($page->modules->where('order', 1) as $module)
					<p>{!! nl2br(e($module->content)) !!}</p>
					@endforeach
				</div><!-- End of cell-->
			</div><!--end of grid-x -->
		</div><!--End of grid container-->
	</div>

	<div class="lake-info-container">
		<div class="grid-container full">
			<div class="grid-x grid-padding-x">
				@livewire('lake-map')
			</div><!--end of grid-x -->
		</div><!--End of grid container-->
	</div>

	<div class="fish-gallery">
		<div class="grid-container full">
			<div class="grid-x grid-padding-x">
				<div class="cell small-6 medium-4 text-center">
					<div class="photo-border-block">
						<h4>Photo Preview</h4>
					</div>
				</div><!-- End of cell-->
				<div class="cell small-6 medium-4 text-center">
					<div class="photo-border-block">
						<h4>Photo Preview</h4>
					</div>
				</div><!-- End of cell-->
				<div class="cell small-6 medium-4 text-center">
					<div class="photo-border-block">
						<h4>Photo Preview</h4>
					</div>
				</div><!-- End of cell-->
				<div class="cell small-6 medium-4 text-center">
					<div class="photo-border-block">
						<h4>Photo Preview</h4>
					</div>
				</div><!-- End of cell-->
				<div class="cell small-6 medium-4 text-center">
					<div class="photo-border-block">
						<h4>Photo Preview</h4>
					</div>
				</div><!-- End of cell-->
				<div class="cell small-6 medium-4 text-center">
					<div class="photo-border-block">
						<h4>Photo Preview</h4>
					</div>
				</div><!-- End of cell-->
			</div><!--end of grid-x -->
		</div><!--End of grid container-->
	</div>
</div>
@endsection
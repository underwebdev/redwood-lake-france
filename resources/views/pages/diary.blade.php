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
	<div class="grid-container full">
		<div class="grid-x grid-padding-x">
			<div class="cell small-12">
				<h3><span class="weighted">Fishery</span> Photo Diary</h3>
				@foreach($page->modules->where('order', 1) as $module)
					<p>{!! nl2br(e($module->content)) !!}</p>
				@endforeach      
			</div><!-- End of cell-->
			<div class="cell small-12 medium-6 text-center">
				<div class="photo-diary-hero">
					<img src="{{ $featured->photo }}">
				</div>
				<p class="text-center"><strong>{{ $featured->caption }}</strong></p>
			</div><!-- End of cell-->
			<div class="cell small-12 medium-6 text-center">
				<div class="photo-diary-hero">
					<img src="{{ $secondary->photo }}">
				</div>
				<p class="text-center"><strong>{{ $secondary->caption }}</strong></p>
			</div><!-- End of cell-->
		</div><!--end of grid-x -->
	</div><!--End of grid container-->
	<div class="grid-container full">
		<div class="grid-x grid-padding-x">
			@foreach($photos as $photo)
			<div class="cell small-6 medium-4 large-3">
				<div class="photo-diary-thumb">
					<img src="{{ $photo->photo }}">
				</div>
				<div class="photo-diary-caption">
					<p class="text-center"><strong>{{ $photo->caption }}</strong></p>
				</div>
			</div><!-- End of cell-->
			@endforeach
		</div><!--end of grid-x -->
	</div><!--End of grid container-->
</div>

@endsection
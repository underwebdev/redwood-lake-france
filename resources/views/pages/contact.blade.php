@extends('app')

@section('url') {{ $page->url }} @endsection
@section('metadescription') {{ $page->metadescription }} @endsection
@section('title') {{ $page->metatitle }} @endsection

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
<div class="grid-container">
	<div class="grid-x grid-padding-x">
		<div class="cell small-12 medium-10 large-8 medium-offset-1 large-offset-2">
			@foreach($page->modules->where('order', 1) as $module)
				<p>{!! nl2br(e($module->content)) !!}</p>
			@endforeach

			<div class="grid-x grid-padding-x">
				<div class="cell small-12 medium-6">
					<h4><span class="weighted">Complex</span> Address</h4>
					<p>Étang de Seuil<br>
					Saint-Pardoux-le-Lac<br>
					87140<br> 
					France</p>
				</div><!-- End of cell-->
				<div class="cell small-12 medium-6">
					<h4><span class="weighted">Contact</span> Details</h4>
					<p><a href="https://instagram.com/redwoodlakefrance"><i class="fab fa-instagram"></i> redwoodlakefrance</a><br>
					<i class="fab fa-instagram"></i> redwoodlakefrance</p> 
				      
				</div><!-- End of cell-->
			</div><!--end of grid-x -->
			<div class="text-center">
				<br>
				<strong>Scroll Down For Contact Form</strong><br>
				<i class="fas fa-arrow-alt-circle-down bounce"></i>
			</div>
		</div><!-- End of cell-->    
	</div><!--end of grid-x -->
</div><!--End of grid container-->
</div>

@include('layout.wave')

<div class="section-one">
<div class="grid-container">
	<div class="grid-x grid-padding-x">
		<div class="cell small-12 medium-10 large-8 medium-offset-1 large-offset-2">
			@livewire('contact-form')
		</div><!-- End of cell-->    
	</div><!--end of grid-x -->
</div><!--End of grid container-->
</div>
@endsection
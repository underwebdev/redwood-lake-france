@extends('app')

@section('content')

<div class="hero content">
	@include('layout.nav')
<div class="grid-container full">
	<div class="grid-x grid-padding-x">
		<div class="cell small-12 text-center">
			<h1>Contact</h1>
		</div><!-- End of cell-->
	</div><!--end of grid-x -->
</div><!--End of grid container-->
@include('layout.hero-wave')
</div>

<div class="section-one">
<div class="grid-container">
	<div class="grid-x grid-padding-x">
		<div class="cell small-12 medium-10 large-8 medium-offset-1 large-offset-2">
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

			<div class="grid-x grid-padding-x">
				<div class="cell small-12 medium-6">
					<h4><span class="weighted">Complex</span> Address</h4>
					<p>Étang de Seuil<br>
					87140 Saint-Pardoux-le-Lac<br>
					France</p>
					<a href="" class="button">View in Google Maps</a>
				</div><!-- End of cell-->
				<div class="cell small-12 medium-6">
					<h4><span class="weighted">Contact</span> Details</h4>
					<p><i class="far fa-envelope"></i> info@etangdeseuil.co.uk<br>
					<i class="fas fa-mobile-alt"></i> 01895 746167<br>
					<i class="fab fa-instagram"></i> etangdeseuil</p> 
				      
				</div><!-- End of cell-->
			</div><!--end of grid-x -->
			<div class="text-center">
				<br>
				<strong>Scroll Down For Contact Form</strong><br>
				<i class="fas fa-arrow-alt-circle-down"></i>
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
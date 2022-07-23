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

<div class="grid-container">
	<div class="grid-x grid-padding-x">
		<div class="cell small-12 medium-10 large-8 medium-offset-1 large-offset-2">
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

			Email: 

			Telephone: 

			@livewire('contact-form')
		</div><!-- End of cell-->    
	</div><!--end of grid-x -->
</div><!--End of grid container-->

@endsection
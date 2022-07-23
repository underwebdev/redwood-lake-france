@extends('app')

@section('content')

<div class="hero content">
	@include('layout.nav')
<div class="grid-container">
	<div class="grid-x grid-padding-x">
		<div class="cell small-12 text-center">
			<h1>Our Location</h1>
		</div><!-- End of cell-->
	</div><!--end of grid-x -->
</div><!--End of grid container-->
@include('layout.hero-wave')
</div>

<div class="grid-container">
	<div class="grid-x grid-padding-x">
		<div class="cell small-12">
			<h3>Finding Us</h3>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>        
		</div><!-- End of cell-->  
	</div><!--end of grid-x -->
</div><!--End of grid container-->

<div class="grid-container">
	<div class="grid-x grid-padding-x">
		<div class="cell small-12">
			Google map        
		</div><!-- End of cell-->  
	</div><!--end of grid-x -->
</div><!--End of grid container-->


<div class="grid-container">
	<div class="grid-x grid-padding-x">
		<div class="cell small-12">
			<h3>Local Town Name</h3>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
			<p>Supermarket - 10 mins<br>
			Petrol station - 14 mins<br>
			Hospital - 25 mins</p>      
		</div><!-- End of cell-->
	</div><!--end of grid-x -->
</div><!--End of grid container-->
@endsection
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

<div class="section-one">
<div class="grid-container">
	<div class="grid-x grid-padding-x">
		<div class="cell small-12">
			<h3>Finding Us</h3>
			<p>Etang de Seuil is situated in central west France just thirty minutes from Limoges nestled in the beautiful Limousin countryside. There are numerous different routes that can be used when driving here.<br> 
			Toll and ferry costs vary considerably depending on the route you choose. The travel times we have listed below are only a guide and will obviously depend on traffic and routes etc. </p>

			<h3>PORTS</h3>
			<p>Calais Eurotunnel 664 km 7 hr 03 min<br>
			Calais car ferry 661 km 6 hr 35 min<br>
			Dieppe 549 km 5 hr 51 min<br>
			Le Havre 542 km 5 hr 35 min<br>
			Caen 435 km 4 hr 53 min<br>
			St Malo 452 km 5 hr 32 min<br>
			Cherbourg 605 km 6 hr 25 min</p>                   
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
</div>
@endsection
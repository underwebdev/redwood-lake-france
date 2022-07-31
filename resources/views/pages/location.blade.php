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
			<h3><span class="weighted">Finding</span> Us</h3>
			<p>Etang de Seuil is situated in central west France just thirty minutes from Limoges nestled in the beautiful Limousin countryside. There are numerous different routes that can be used when driving here.<br> 
			Toll and ferry costs vary considerably depending on the route you choose. The travel times we have listed below are only a guide and will obviously depend on traffic and routes etc. </p>

			<div class="grid-x grid-padding-x">
				<div class="cell small-12 medium-6">
					<h4><span class="weighted">Complex</span> Address</h4>
					<p>Étang de Seuil<br>
					87140 Saint-Pardoux-le-Lac<br>
					France</p>
					<a href="" class="button">View in Google Maps</a>
				</div><!-- End of cell-->
				<div class="cell small-12 medium-6">
					<h4><span class="weighted">Nearest</span> Ports</h4>
					<p>Calais Eurotunnel 664km <strong>7hr 03min</strong><br>
					Calais car ferry 661km <strong>6hr 35min</strong><br>
					Dieppe 549km <strong>5hr 51min</strong><br>
					Le Havre 542km <strong>5hr 35min</strong><br>
					Caen 435km <strong>4hr 53min</strong><br>
					St Malo 452km <strong>5hr 32min</strong><br>
					Cherbourg 605km <strong>6hr 25min</strong></p>   
				      
				</div><!-- End of cell-->
			</div>      
		</div><!-- End of cell-->  
	</div><!--end of grid-x -->
</div><!--End of grid container-->
<br><br>
<div class="grid-container full">
	<div class="grid-x">
		<div class="cell small-12">
			<img src="/img/map.png">     
		</div><!-- End of cell-->  
	</div><!--end of grid-x -->
</div><!--End of grid container-->
</div>
<div class="section-one">
	<br>
<br>
<div class="grid-container">
	<div class="cell small-12">
		<h3><span class="weighted">Driving</span> to Etang de Seuil</h3>
		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
		<div class="button-group">
			<a href="" class="button">Port of Calais to Etang de Seuil</a>
			<a href="" class="button">Euro Tunnel Calais to Etang de Seuil</a>
		</div>

		<h3><span class="weighted">Flying</span> to Etang de Seuil</h3>
		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
		<a href="" class="button">View Flights</a>
	</div><!-- End of cell-->
</div><!--End of grid container-->
</div>



@endsection
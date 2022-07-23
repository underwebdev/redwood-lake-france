@extends('app')

@section('content')

<div class="hero content">
	@include('layout.nav')
<div class="grid-container full">
	<div class="grid-x grid-padding-x">
		<div class="cell small-12 text-center">
			<h1>Etang de Seuil</h1>
		</div><!-- End of cell-->
	</div><!--end of grid-x -->
</div><!--End of grid container-->
@include('layout.hero-wave')
</div>

<div class="grid-container">
	<div class="grid-x grid-padding-x">
		<div class="cell small-12">
			<h3>The Lake</h3>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
		</div><!-- End of cell-->
	</div><!--end of grid-x -->
</div><!--End of grid container-->

<div class="grid-container full">
	<div class="grid-x grid-padding-x">
		<div class="cell small-12 medium-8">
		   	<h3>Arial Map</h3>   
		</div><!-- End of cell-->
		<div class="cell small-12 medium-4">
			<div class="grid-x grid-padding-x">
				<div class="cell small-6 medium-6 ml-3 large-6">
					<h3 class="heading-font yellow">Fishery Info</h3>
				      <p><strong>Size:</strong> 8 acres<br>
				      <strong>Swims: </strong> 15<br>
				      <strong>Rod Limit: </strong> 3<br>
				      <strong>Open:</strong> March - December</p>
				</div><!-- End of cell-->
				<div class="cell small-6 medium-6 ml-3 large-6">
					<h3 class="heading-font yellow">Lake Records</h3>
				      <p><strong>Common: </strong>0lb 0oz<br>
				      <strong>Mirror: </strong>0lb 0oz<br>
				      <strong>Total fish: </strong>7000<br>
				      <strong>Average size: </strong>25lb</p>
				  	 </p>    
				</div><!-- End of cell-->
				<div class="cell small-12">
					<h3>Swim List</h3>
					<ol>
						<li>Swim</li>\
						<li>Swim</li>
						<li>Swim</li>
						<li>Swim</li>
						<li>Swim</li>
						<li>Swim</li>
						<li>Swim</li>
						<li>Swim</li>
						<li>Swim</li>
						<li>Swim</li>
						<li>Swim</li>
						<li>Swim</li>
					</ol>
				</div><!-- End of cell-->
		    
		    	<a href="/rules" class="button expanded">View Rules</a>
			</div>
		</div><!-- End of cell-->
	</div><!--end of grid-x -->
</div><!--End of grid container-->

@endsection
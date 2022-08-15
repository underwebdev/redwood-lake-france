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
<div class="section-one">
	<div class="intro">
		<div class="grid-container">
			<div class="grid-x grid-padding-x">
				<div class="cell small-12">
					<h3><span class="weighted">The</span> Lake</h3>
					<p>Etang de Seuil is a beautiful stream-fed Pre-Napoleonic seven-acre lake dating back to the 18th century. Nestled amongst fifteen acres of secluded woodland and meadows in the small hamlet of Seuil this stunning lake is a fifteen-minute drive from the market town of Bellac and the infamous Lac de Saint - Pardoux.</p>

					<p>The lake has received very little angling pressure over the years. Early catch reports show it contains a few unique original Carp with stocking records and photos from the previous owner showing three hundred or so fast-growing Carp were stocked between 2017 and 2020.
					From the small amount of fishing done so far, it's clear the lake is more of a run's water and has produced mostly young pretty fish up to 40lb.</p>
				</div><!-- End of cell-->
			</div><!--end of grid-x -->
		</div><!--End of grid container-->
	</div>

	<div class="lake-info-container">
		<div class="grid-container full">
			<div class="grid-x grid-padding-x">
				<div class="cell small-12 medium-8">
				   	<img src="/img/lake-map.png" height="800px">
				</div><!-- End of cell-->
				<div class="cell small-12 medium-4">
					<div class="grid-x grid-padding-x">
						<div class="cell small-6 medium-6 ml-3 large-6">
							<h3 class="heading-font yellow">Info</h3>
						      <p><strong>Size:</strong> 7 acres<br>
						      <strong>Swims: </strong> 9<br>
						      <strong>Rod Limit: </strong> 3<br>
						      <strong>Open:</strong> All Year</p>
						</div><!-- End of cell-->
						<div class="cell small-6 medium-6 ml-3 large-6">
							<h3 class="heading-font yellow">Records</h3>
						      <p><strong>Common: </strong>39lb 0oz<br>
						      <strong>Mirror: </strong>39lb 0oz<br>
						      <strong>Total fish: </strong>350<br>
						      <strong>Average size: </strong>20lb</p>
						  	 </p>    
						</div><!-- End of cell-->
						<div class="cell small-12">
							<div class="swim-list">
								<h3>Swims</h3>
								<ul>
									<li>Swim One</li>
									<li>Swim Two</li>
									<li>Swim Three</li>
									<li>Swim Four</li>
									<li>Swim Five</li>
									<li>Swim Six</li>
									<li>Swim Seven</li>
									<li>Swim Eight</li>
									<li>Swim Nine</li>
								</ul>
							</div>
						</div><!-- End of cell-->
						<div class="cell small-12">
							<div class="button-group">
				    			<a href="/rules" class="button success expanded">Lake Rules</a>
				    			<a href="/fishing-in-france" class="button warning expanded">French Fishing Regulation</a>
				    		</div>

						</div><!-- End of cell-->
					</div>
				</div><!-- End of cell-->
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
@extends('app')

@section('content')

<div class="hero content">
	@include('layout.nav')
<div class="grid-container">
	<div class="grid-x grid-padding-x">
		<div class="cell small-12 text-center">
		</div><!-- End of cell-->
	</div><!--end of grid-x -->
</div><!--End of grid container-->
@include('layout.hero-wave')
</div>

<div class="section-one">
<div class="grid-container full">
	<div class="grid-x grid-padding-x">
		<div class="cell small-12">
			<div class="table-scroll">
				<table>
					<thead>
						<tr>
							<td>Name</td>
							<td>Species</td>
							<td>Top Weight</td>
							<td>Last Capture</td>
							<td>Total Captures</td>
							<td>Description</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div><!-- End of cell-->
	</div><!--end of grid-x -->
</div><!--End of grid container-->

<div class="fish-content">
<div class="grid-container full">
	<div class="grid-x grid-padding-x">
		<div class="cell small-12 medium-4">
			<div class="cell small-12 text-center" data-sticky-container>
			<div class="sticky" data-sticky data-top-anchor="dark-container:bottom">
				<div class="photo-border-block">
					<a href="" data-lity>
					<img src="">
					</a>
				</div>
				
				<div class="photo-border-block">
					<a href="" data-lity>
					<img src="">
					</a>
				</div>
				
			</div>
			<br>
			<a href="/stock" class="button expanded">Back To Stock</a>
			</div><!-- End of cell-->
		      
		</div><!-- End of cell-->
		<div class="cell small-12 medium-8">
			<div class="table-scroll">
			<table>
				<thead>
					<tr>
						<td>jan</td>
						<td>feb</td>
						<td>mar</td>
						<td>apr</td>
						<td>may</td>
						<td>jun</td>
						<td>jul</td>
						<td>aug</td>
						<td>sep</td>
						<td>oct</td>
						<td>nov</td>
						<td>dec</td>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
				</tbody>
			</table>
			</div>

			<div class="table-scroll">
				<table>
					<thead>
						<tr>
							<td>Date</td>
							<td>Angler</td>
							<td>Weight</td>
							<td class="text-center">Photo</td>
							<td>Weather</td>
							<td>Bait</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td></td>
							<td></td>
							<td class="">0lb 0oz</td>
							
							<td class="text-center">
								<i class="fas fa-camera"></i>
							</td>
							<td></td>
							<td></td>
						</tr>
					</tbody>
				</table>
		    </div>
			
		</div><!-- End of cell-->
	  
	</div><!--end of grid-x -->
</div><!--End of grid container-->
</div>
</div>

<section class="horizSlider">
	  <div class="slide">
	    <h2 class="slideText">Text title</h2>
	    <img width="1000" height="500" class="slideImage" src="https://source.unsplash.com/random/1000x500" alt="Filler image">
	  </div>
	  
	  <div class="slide">
	    <h2 class="slideText">Text title</h2>
	    <img width="1000" height="500" class="slideImage" src="https://source.unsplash.com/random/1000x500" alt="Filler image">
	  </div>
	  
	  <div class="slide">
	    <h2 class="slideText">Text title</h2>
	    <img width="1000" height="500" class="slideImage" src="https://source.unsplash.com/random/1000x500">
	  </div>
	  
	  <div class="slide">
	    <h2 class="slideText">Text title</h2>
	    <img width="1000" height="500" class="slideImage" src="https://source.unsplash.com/random/1000x500">
	  </div>
	  
	  <div class="slide">
	    <h2 class="slideText">Text title</h2>
	    <img width="1000" height="500" class="slideImage" src="https://source.unsplash.com/random/1000x500">
	  </div>
	</section>
</div>
@endsection

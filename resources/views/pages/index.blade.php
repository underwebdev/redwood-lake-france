@extends('app')

@section('content')

<div class="hero home">
		@include('layout.nav')
<div class="grid-container full">
	<div class="grid-x grid-padding-x">
		<div class="cell small-12 medium-7 hero-text">
			<h1>Quality Carp Fishing In France</h1>
			<h2><strong>French fishing in beautiful surroundings for up to 5 anglers.</strong></h2>
			<div class="hero-review">
				<i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i> - Customer review snippet, social proof
			</div>
			<a href="/booking" class="button">Book Now</a>
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
					<h3>Welcome to Etang de Seuil</h3>
					<p>Etang de Seuil is a beautiful stream-fed Pre-Napoleonic seven-acre lake dating back to the 18th century. Nestled amongst fifteen acres of secluded woodland and meadows in the small hamlet of Seuil this stunning lake is a fifteen-minute drive from the market town of Bellac and the infamous Lac de Saint - Pardoux .
					Bellac offers everything you will need for your carp fishing holiday, including a large fishing shop selling all the top carp brands. Limoges airport is 25 minutes away with direct flights from most UK airports.</p>
				      
				</div><!-- End of cell-->
			</div><!--end of grid-x -->
		</div><!--End of grid container-->
	</div>
</div>

<div class="divider-curve">
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
  <path fill="#EEEFF1" fill-opacity="1" d="M0,160L120,170.7C240,181,480,203,720,202.7C960,203,1200,181,1320,170.7L1440,160L1440,320L1320,320C1200,320,960,320,720,320C480,320,240,320,120,320L0,320Z"></path>
</svg>
</div>

<div class="section-one">
	<div class="lake-info">
		<div class="grid-container full">
			<div class="grid-x grid-padding-x">
				<div class="cell small-12 medium-6">
					<div id="lake-desc">
					<h4>The Lake</h4>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
				  </div>    
				</div><!-- End of cell-->
				<div class="cell small-12 medium-6 align-self-middle">
					<div id="lake-image">
					<div class="photo-outline">
						<img src="/img/lake-rods.jpeg"> 
					</div>
					</div> 
				</div><!-- End of cell-->
			</div><!--end of grid-x -->
		</div>
	</div>

	<div class="fish-info">
	<div class="grid-container full">
		<div class="grid-x grid-padding-x">
			<div class="cell small-12 medium-6 align-self-middle">
				<div id="fish-image">
				<div class="photo-outline">
			    	<img src="/img/common-carp.jpeg"> 
			  </div>
			  </div>  
			</div><!-- End of cell-->
			<div class="cell small-12 medium-6">
				<div id="fish-desc">
				<h4>The Fish</h4>
				<p>Situated in the Nouvelle-Aquitaine region renowned for its long warm summers the lake has received very few anglers over the years, it is thought to contain a few originals, and stocking records and photos show around 300 very pretty carp were introduced from a handful of stockings between 2018 and 2020 by the previous owner, from the limited fishing we have seen so far the lake is currently more of a runs water and has so far produced big hits of fish up to 40lb. Due to the lack of bait and angling pressure, many of these fish are lean and incredibly hard fighting living mainly on naturals, many carp remain uncaught and we are sure there are plenty of surprises to come.</p>
				</div>
			</div><!-- End of cell-->
		</div><!--end of grid-x -->
	</div>
	</div>
</div>

<div class="divider-curve">
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
  <path fill="#EEEFF1" fill-opacity="1" d="M0,160L120,170.7C240,181,480,203,720,202.7C960,203,1200,181,1320,170.7L1440,160L1440,320L1320,320C1200,320,960,320,720,320C480,320,240,320,120,320L0,320Z"></path>
</svg>
</div>

<div class="section-one">
	<div class="facilities">
	<div class="grid-container">
		<div class="grid-x grid-padding-x">
			<div class="cell small-12 medium-6">
				<h4>Facilities</h4>
			  	<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			  	tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			  	quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			  	consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			  	cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			  	proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
			</div><!-- End of cell-->
			<div class="cell small-12 medium-6 align-self-middle">
				<div class="photo-outline">
			  		<img src="/img/facilities.jpg">
			  	</div>      
			</div><!-- End of cell-->
		</div><!--end of grid-x -->
	</div>
	</div>
</div>

<div class="divider-curve">
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
  <path fill="#EEEFF1" fill-opacity="1" d="M0,160L120,170.7C240,181,480,203,720,202.7C960,203,1200,181,1320,170.7L1440,160L1440,320L1320,320C1200,320,960,320,720,320C480,320,240,320,120,320L0,320Z"></path>
</svg>
</div>

<div class="section-one">
	<div class="pricing">
	<div class="grid-container">
		<div class="grid-x grid-padding-x">
			<div class="cell small-12">
				<h4 class="text-center">Pricing</h4>
				<p>We will be operating a drive-and-survive lake exclusive only for five anglers, there are nine comfortable grass-lined swims to choose from. Discounted rates will be ongoing while we thin out the slower growing fish and get the lake facilities up to the high standard our anglers require.</p>
			</div>
			<div class="cell small-12 medium-5 medium-offset-1"> 
				<div class="pricing-block">
					<h4 class=text-center><strong>Package One</strong></h4>
					<ul>
						<li>Bullet One</li>
						<li>Bullet Two</li>
						<li>Bullet Three</li>
						<li>Bullet Four</li>
						<li>Bullet Five</li>
					</ul>
					<p>Extra Services:</p>
					<ul>
						<li>Bullet One</li>
						<li>Bullet Two</li>
					</ul>
					<hr>
					<h6><strong>£1200 per week</strong><br><small>£240 p.p based on 5 anglers</small></h6>
				</div>
			</div><!-- End of cell-->
			<div class="cell small-12 medium-5"> 
				<div class="pricing-block">
					<h4 class="text-center"><strong>Package Two</strong></h4>
					<ul>
						<li>Bullet One</li>
						<li>Bullet Two</li>
						<li>Bullet Three</li>
						<li>Bullet Four</li>
						<li>Bullet Five</li>
					</ul>
					<p>Extra Services:</p>
					<ul>
						<li>Bullet One</li>
						<li>Bullet Two</li>
					</ul>
					<hr>
					<h6><strong>£1800 per week</strong><br><small>£240 p.p based on 5 anglers</small></h6>
				</div>
			</div><!-- End of cell-->
			<div class="cell small-12 text-center">
				<p>All bookings require a £700 deposit to confirm the requested dates. The remaining balance is due 12 weeks prior to arrival.</p>
				<a href="/booking" class="button large">View Availabillity</a>
			      
			</div><!-- End of cell-->
		</div><!--end of grid-x -->
	</div><!--End of grid container-->
	</div>
</div>

<div class="subscribe-curve">
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
  <path fill="#232323" fill-opacity="1" d="M0,160L120,170.7C240,181,480,203,720,202.7C960,203,1200,181,1320,170.7L1440,160L1440,320L1320,320C1200,320,960,320,720,320C480,320,240,320,120,320L0,320Z"></path>
</svg>
</div>
<div class="subscribe">
<div class="grid-container">
	<div class="grid-x grid-padding-x">
		<div class="cell small-12 medium-8 large-6 medium-offset-2 large-offset-3">
			<h4 class="text-center">Subscribe For Updates</h4>
			<p>We occassionally have weeks become available at short notice, these will usually be offered at a discounted rate, to get email notifications when these places become available enter your name and email below</p>
				<label for="">First Name</label>
				<input type="text" placeholder="" name="">
				<label for="">Email</label>
				<input type="text" placeholder="" name="">
				<button class="button expanded secondary hollow">Get Updates</button>
		</div><!-- End of cell-->
	</div><!--end of grid-x -->
</div><!--End of grid container-->
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 280">
  <path fill="#eeeff1" fill-opacity="1" d="M0,160L120,170.7C240,181,480,203,720,202.7C960,203,1200,181,1320,170.7L1440,160L1440,320L1320,320C1200,320,960,320,720,320C480,320,240,320,120,320L0,320Z"></path>
</svg>
</div>

<div class="section-one">
	<div class="availabillity">
	<div class="grid-container">
		<div class="grid-x grid-padding-x">
			<div class="cell small-12 text-center">
				<h4>Availabillity</h4>
				<p>We are currently taking bookings for 2022 and 2023. Please check for availability below.</p>
			</div>
		</div>
		@include('layout.calendar')
		<div class="cell small-12 text-center view-more-container">
		  <a href="/booking" class="button large">View Full Calendar</a>  
		</div><!-- End of cell-->
	</div>
	</div>
</div>

<div class="divider-curve">
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
  <path fill="#EEEFF1" fill-opacity="1" d="M0,160L120,170.7C240,181,480,203,720,202.7C960,203,1200,181,1320,170.7L1440,160L1440,320L1320,320C1200,320,960,320,720,320C480,320,240,320,120,320L0,320Z"></path>
</svg>
</div>

<div class="section-one">
	<div class="info">
	<div class="grid-container">
		<div class="grid-x grid-padding-x">
			<div class="cell small-12">
				<h4>Gallery</h4>
			</div><!-- End of cell-->
		</div><!--end of grid-x -->
	</div><!--End of grid container-->
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

<div class="divider-curve">
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
  <path fill="#EEEFF1" fill-opacity="1" d="M0,160L120,170.7C240,181,480,203,720,202.7C960,203,1200,181,1320,170.7L1440,160L1440,320L1320,320C1200,320,960,320,720,320C480,320,240,320,120,320L0,320Z"></path>
</svg>
</div>

<div class="section-one">
	<div class="contact">
	<div class="grid-container">
		<div class="grid-x grid-padding-x">
			<div class="cell small-12">
				<h4>Contact</h4>
			</div><!-- End of cell-->
			<div class="cell small-12 medium-6">
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
				cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
				proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
			      
			</div><!-- End of cell-->
			<div class="cell small-12 medium-6 text-center align-self-middle">
				<div class="contact-info text-center">
					<p><i class="far fa-envelope"></i> info@etangdeseuil.co.uk<br>
					<i class="fas fa-mobile-alt"></i> 01895 746167</p> 
				</div>
			      
			</div><!-- End of cell-->
			<div class="cell small-12 medium-10 large-8 medium-offset-1 large-offset-2">
				@livewire('contact-form')
			</div><!-- End of cell-->
		</div><!--end of grid-x -->
	</div><!--End of grid container-->
	</div>
</div><!-- end of section one -->

@endsection
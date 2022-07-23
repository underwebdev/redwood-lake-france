@extends('app')

@section('content')

<div class="hero content">
	@include('layout.nav')
<div class="grid-container full">
	<div class="grid-x grid-padding-x">
		<div class="cell small-12 text-center">
			<h1>Booking</h1>
		</div><!-- End of cell-->
	</div><!--end of grid-x -->
</div><!--End of grid container-->
@include('layout.hero-wave')
</div>

<div class="intro">
<div class="grid-container">
	<div class="grid-x grid-padding-x">
		<div class="cell small-12">
			<h3>Booking Information</h3>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

			<hr>
		      
		</div><!-- End of cell-->
	</div><!--end of grid-x -->
</div><!--End of grid container-->
</div>

<div class="pricing">
<div class="grid-container">
	<div class="grid-x grid-padding-x">
		<div class="cell small-12">
			<h4 class="text-center">Pricing</h4>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
		</div>
		<div class="cell small-12 medium-5 medium-offset-1"> 
			<div class="pricing-block">
				<h5 class=text-center><strong>Package One</strong></h5>
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
				<h5 class="text-center"><strong>Package Two</strong></h5>
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
		</div><!-- End of cell-->
	</div><!--end of grid-x -->
</div><!--End of grid container-->
</div>

<div class="availabillity">
<div class="grid-container">
	<div class="grid-x grid-padding-x">
		<div class="cell small-12 text-center">
			<h4>Availabillity</h4>
			<p>We are currently taking bookings for 2022 and 2023. Please check for availability below.</p>
		</div>
	</div>
	<div class="grid-x grid-padding-x">
		<div class="cell small-12 text-center">
			<h5 class="month-bar">{{ Carbon\Carbon::now()->format('F') }}</h5></div>      
		</div><!-- End of cell-->
		<div class="grid-x grid-padding-x">
			<div class="cell small-6 medium-3 text-center">
				<div class="date-container">
					<div class="date-tile">
						<p>April</p>
						<h3>1</h3>
						<p>2022</p>
					</div>
					<a href="/deposit" class="button success expanded">Book Now</a>
				</div>
			      
			</div><!-- End of cell-->
			<div class="cell small-6 medium-3 text-center">
				<div class="date-container">
					<div class="date-tile">
						<p>April</p>
						<h3>8</h3>
						<p>2022</p>
					</div>
					<a href="/deposit" class="button success expanded">Book Now</a>
				</div>
			</div><!-- End of cell-->
			<div class="cell small-6 medium-3 text-center">
				<div class="date-container">
					<div class="date-tile">
						<p>April</p>
						<h3>15</h3>
						<p>2022</p>
					</div>
					<a href="/deposit" class="button success expanded">Book Now</a>
				</div>
			</div><!-- End of cell-->
			<div class="cell small-6 medium-3 text-center">
				<div class="date-container">
					<div class="date-tile">
						<p>April</p>
						<h3>22</h3>
						<p>2022</p>
					</div>
					<a href="/deposit" class="button success expanded">Book Now</a>
				</div>
			</div><!-- End of cell-->
		</div><!--end of grid-x -->
	<div class="grid-x grid-padding-x">
		<div class="cell small-12 text-center">
			<h5 class="month-bar">{{ Carbon\Carbon::now()->addMonth()->format('F') }}</h5></div>      
		</div><!-- End of cell-->
		<div class="grid-x grid-padding-x">
			<div class="cell small-6 medium-3 text-center">
				<div class="date-container">
					<div class="date-tile">
						<p>April</p>
						<h3>1</h3>
						<p>2022</p>
					</div>
					<a href="/deposit" class="button success expanded">Book Now</a>
				</div>
			      
			</div><!-- End of cell-->
			<div class="cell small-6 medium-3 text-center">
				<div class="date-container">
					<div class="date-tile">
						<p>April</p>
						<h3>8</h3>
						<p>2022</p>
					</div>
					<a href="/deposit" class="button success expanded">Book Now</a>
				</div>
			</div><!-- End of cell-->
			<div class="cell small-6 medium-3 text-center">
				<div class="date-container">
					<div class="date-tile">
						<p>April</p>
						<h3>15</h3>
						<p>2022</p>
					</div>
					<a href="/deposit" class="button success expanded">Book Now</a>
				</div>
			</div><!-- End of cell-->
			<div class="cell small-6 medium-3 text-center">
				<div class="date-container">
					<div class="date-tile">
						<p>April</p>
						<h3>22</h3>
						<p>2022</p>
					</div>
					<a href="/deposit" class="button success expanded">Book Now</a>
				</div>
			</div><!-- End of cell-->
		</div><!--end of grid-x -->
	</div>
</div><!--End of grid container-->
</div>
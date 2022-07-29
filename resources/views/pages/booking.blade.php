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

<div class="section-one">
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
			      
			</div><!-- End of cell-->
		</div><!--end of grid-x -->
	</div><!--End of grid container-->
	</div>

	<div class="booking-pricing">
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
			<div class="cell small-12 text-center">
				<p>All bookings require a £700 deposit to confirm the requested dates. The remaining balance is due 12 weeks prior to arrival.</p>

				<strong>Scroll Down For Availabillity</strong><br>
				<i class="fas fa-arrow-alt-circle-down"></i>
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
<div class="availabillity">
<div class="grid-container">
	<div class="grid-x grid-padding-x">
		<div class="cell small-12 text-center">
			<h4>Availabillity</h4>
			<p>We are currently taking bookings for 2022 and 2023. Please check for availability below.</p>
		</div>
	</div>
	<div class="grid-x grid-padding-x">
		<div class="cell small-6">
			<label for="">Month</label>
			<select id=""name="">
				<option value="">Please Select</option> 
				<option value="">January</option> 
				<option value="">Febuary</option> 
				<option value="">March</option> 
				<option value="">April</option> 
				<option value="">May</option> 
				<option value="">June</option> 
				<option value="">July</option> 
				<option value="">August</option> 
				<option value="">September</option> 
				<option value="">October</option> 
				<option value="">November</option> 
				<option value="">December</option> 
			</select>
		</div><!-- End of cell-->
		<div class="cell small-6">
			<label for="">Year</label>
			<select id=""name="">
				<option value="">Please Select</option>
				<option value="">{{ Carbon\Carbon::now()->format('Y') }}</option>
				<option value="">{{ Carbon\Carbon::now()->addYear()->format('Y') }}</option>  
			</select>
		</div><!-- End of cell-->
	</div><!--end of grid-x -->
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
@extends('app')

@section('content')

<div class="grid-container full">
	<div class="grid-x grid-padding-x">	
		<div class="cell small-12 medium-8 large-6 large-offset-3 medium-offset-2">
			<div class="center-border text-center">
				<div class="center-border-header text-center">
					<img src="/img/logo/RedwoodLogo.png" width="200px">
				</div>
				<div class="center-border-content">
					<h3><strong>Payment Complete</strong></h3>
					<p>Thank you for booking your trip to Redwood Lake. You will shortly receive an email containing your booking confirmation and a seperate email containing your password to log in to this website.</p>
					<p>Once logged in to our website you will be able to manage your booking, add additional anglers to your party and make payments if required.</p> 
					<p>If you do not receive the confirmation email, please check your junk/spam folder.</p>
					<a href="/login" class="button success large radius">Login To Your Account</a>
				</div>
			</div>
		</div><!-- End of cell-->
	</div><!--end of grid-x -->
</div><!--End of grid container--> 

@endsection
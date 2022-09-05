@extends('app')

@section('content')

<div class="grid-container full">
	<div class="grid-x grid-padding-x">	
		<div class="cell small-12 medium-6 large-4 large-offset-4 medium-offset-3">
			<div class="center-border text-center">
				<div class="center-border-header text-center">
					
				</div>
				<div class="center-border-content">
					<h3><strong>Payment Complete</strong></h3>
					<p class="text-left">Thank you for booking your trip to Redwood Lake. You will shortly receive an email containing your booking confirmation and your password to log in to this website to manage your booking, if you do not receive this email please check your junk/spam folder.</p>
					<a href="/login" class="button success large radius">Login To Your Account</a>
				</div>
			</div>
		</div><!-- End of cell-->
	</div><!--end of grid-x -->
</div><!--End of grid container--> 

@endsection
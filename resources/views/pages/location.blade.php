@extends('app')

@section('content')

<div class="hero content {{ $page->css }}">
	@include('layout.nav')
<div class="grid-container">
	<div class="grid-x grid-padding-x">
		<div class="cell small-12 text-center">
			<h1>{{ $page->heading }}</h1>
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
			@foreach($page->modules->where('order', 1) as $module)
				<p>{!! nl2br(e($module->content)) !!}</p>
			@endforeach

			<div class="grid-x grid-padding-x">
				<div class="cell small-12 medium-6">
					<h4><span class="weighted">Complex</span> Address</h4>
					<p>Étang de Seuil<br>
					Saint-Pardoux-le-Lac<br>
					87140<br>
					France</p>
					<a href="https://goo.gl/maps/urbLG7Vjmt9UnULs6" class="button">View in Google Maps</a>
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
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2768.8002199697057!2d1.202970315577331!3d46.05508297911228!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47fead8ed3dc3c65%3A0xf28884017ff4c0fd!2s%C3%89tang%20de%20Seuil%2C%2087140%20Saint-Pardoux-le-Lac%2C%20France!5e0!3m2!1sen!2suk!4v1662197843759!5m2!1sen!2suk" width="100%" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>  
		</div><!-- End of cell-->  
	</div><!--end of grid-x -->
</div><!--End of grid container-->
</div>
<div class="section-one">
	<br>
<br>
<div class="grid-container">
	<div class="cell small-12">
		<h3><span class="weighted">Driving</span> to Redwood Lake (Etang de Seuil)</h3>
		@foreach($page->modules->where('order', 2) as $module)
			<p>{!! nl2br(e($module->content)) !!}</p>
		@endforeach
		<div class="button-group">
			<a href="https://www.google.com/maps/dir/Port+Calais,+Unnamed+Road,+62100+Calais,+France/%C3%89tang+de+Seuil,+87140+Saint-Pardoux-le-Lac,+France/@48.4339951,-2.9921142,6z/data=!3m1!4b1!4m13!4m12!1m5!1m1!1s0x47dc3f717b892b65:0xe80f7b854634e7e9!2m2!1d1.8732131!2d50.9708404!1m5!1m1!1s0x47fead8ed3dc3c65:0xf28884017ff4c0fd!2m2!1d1.205159!2d46.055083" class="button">Port of Calais to Etang de Seuil</a><br>
			<a href="https://www.google.com/maps/dir/Eurotunnel+Calais+Terminal,+Coquelles,+France/%C3%89tang+de+Seuil,+87140+Saint-Pardoux-le-Lac,+France/@48.4190039,-2.99212,6z/data=!3m1!4b1!4m13!4m12!1m5!1m1!1s0x47dc3ee7fd5ba9cd:0xd28c7f4ccb700ec0!2m2!1d1.8125997!2d50.9354021!1m5!1m1!1s0x47fead8ed3dc3c65:0xf28884017ff4c0fd!2m2!1d1.205159!2d46.055083" class="button">Euro Tunnel Calais to Etang de Seuil</a><br>
			<a href="https://www.google.com/maps/dir/Port+de+Plaisance,+Quai+Vendeuvre,+14000+Caen,+France/%C3%89tang+de+Seuil,+87140+Saint-Pardoux-le-Lac,+France/@47.6052492,-1.8108589,7z/data=!3m1!4b1!4m13!4m12!1m5!1m1!1s0x480a429f1b86e211:0x9bd21bfc2c5203aa!2m2!1d-0.3539953!2d49.1829324!1m5!1m1!1s0x47fead8ed3dc3c65:0xf28884017ff4c0fd!2m2!1d1.205159!2d46.055083" class="button">Port of Caen to Etang de Seuil</a>
		</div>

		<h3><span class="weighted">Flying</span> to Redwood Lake (Etang de Seuil)</h3>
		@foreach($page->modules->where('order', 3) as $module)
			<p>{!! nl2br(e($module->content)) !!}</p>
		@endforeach
		<a href="" class="button">View Flights</a>
	</div><!-- End of cell-->
</div><!--End of grid container-->
</div>



@endsection
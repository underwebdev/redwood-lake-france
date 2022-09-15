@extends('app')

@section('url') {{ $page->url }} @endsection
@section('metadescription') {{ $page->metadescription }} @endsection
@section('title') {{ $page->metatitle }} @endsection

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
				<div class="cell small-12">
					<h4><span class="weighted">Complex</span> Address</h4>
					<p>Étang de Seuil, Saint-Pardoux-le-Lac, 87140, France</p>
				</div><!-- End of cell-->
			</div>
			<div class="grid-x grid-padding-x">
				<div class="cell small-12 large-6">
					<h4><span class="weighted">Ferry</span> Crossing</h4>
					<div class="table-scroll">
						<table>
							<thead>
								<tr>
									<th>Crossing</th>
									<th>Time</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>Folkestone to Calais</td>
									<td>35 mins (Eurotunnel)</td>
								</tr>
								<tr>
									<td>Dover to Calais</td>
									<td>1hr 20min</td>
								</tr>
								<tr>
									<td>Newhaven to Dieppe</td>
									<td>4hrs</td>
								</tr>
								<tr>
									<td>Portsmouth to Le Harve</td>
									<td>Not Operating</td>
								</tr>
								<tr>
									<td>Portsmouth to Caen</td>
									<td>5hrs 45mins (7 hrs overnight)</td>
								</tr>
								<tr>
									<td>Portsmouth to St Malo</td>
									<td>11hrs (overnight)</td>
								</tr>
								<tr>
									<td>Portsmouth to Cherbourg</td>
									<td>8hrs (overnight)</td>
								</tr>
								<tr>
									<td>Poole to Cherbourg</td>
									<td>4hrs 30mins</td>
								</tr>
								<tr>
									<td>Plymouth to Roscoff</td>
									<td>5hrs 30mins (9hrs overnight)</td>
								</tr>
							</tbody>
						</table>
				    </div>
				</div><!-- End of cell-->
				<div class="cell small-12 large-6">
					<h4><span class="weighted">Nearest</span> Ports</h4>

					<div class="table-scroll">
						<table>
							<thead>
								<tr>
									<th>Port</th>
									<th>Distance</th>
									<th>Time</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>Calais Eurotunnel</td>
									<td>664km</td>
									<td>7hr 03min</td>
									<td class="text-right">
										<a href="https://www.google.com/maps/dir/Calais+Eurotunnel,+Kanaaltunnel,+Coquelles,+France/%C3%89tang+de+Seuil,+87140+Saint-Pardoux-le-Lac,+France/@48.480896,0.3558901,7z/data=!3m1!4b1!4m13!4m12!1m5!1m1!1s0x47dc3ee7e1f67c7f:0x9914651fa24caa06!2m2!1d1.8148836!2d50.9359118!1m5!1m1!1s0x47fead8ed3dc3c65:0xf28884017ff4c0fd!2m2!1d1.205159!2d46.055083" class="button tiny">View Map</a>
									</td>
								</tr>
								<tr>
									<td>Calais car ferry</td>
									<td>661km</td>
									<td>6hr 35min</td>
									<td class="text-right">
										<a href="https://www.google.com/maps/dir/Calais,+France/%C3%89tang+de+Seuil,+87140+Saint-Pardoux-le-Lac,+France/@48.4849913,-0.2598117,7z/data=!3m1!4b1!4m13!4m12!1m5!1m1!1s0x47dc3f75d7f1e363:0xacbed9e08cd279f4!2m2!1d1.858686!2d50.95129!1m5!1m1!1s0x47fead8ed3dc3c65:0xf28884017ff4c0fd!2m2!1d1.205159!2d46.055083" class="button tiny">View Map</a>
									</td>
								</tr>
								<tr>
									<td>Dieppe</td>
									<td>549km</td>
									<td>5hr 51min</td>
									<td class="text-right">
										<a href="https://www.google.com/maps/dir/Dieppe,+France/%C3%89tang+de+Seuil,+87140+Saint-Pardoux-le-Lac,+France/@47.9708321,-1.1480004,7z/data=!3m1!4b1!4m13!4m12!1m5!1m1!1s0x47e0a207670619f9:0xaea20a3d78418545!2m2!1d1.077483!2d49.922992!1m5!1m1!1s0x47fead8ed3dc3c65:0xf28884017ff4c0fd!2m2!1d1.205159!2d46.055083" class="button tiny">View Map</a>
									</td>
								</tr>
								<tr>
									<td>Le Havre</td>
									<td>542km</td>
									<td>5hr 35min</td>
									<td class="text-right">
										<a href="https://www.google.com/maps/dir/Le+Havre,+France/%C3%89tang+de+Seuil,+87140+Saint-Pardoux-le-Lac,+France/@47.7602947,-1.1480127,7z/data=!3m1!4b1!4m13!4m12!1m5!1m1!1s0x47e02f2395218b7d:0x5bc1867aaf33af12!2m2!1d0.107929!2d49.49437!1m5!1m1!1s0x47fead8ed3dc3c65:0xf28884017ff4c0fd!2m2!1d1.205159!2d46.055083" class="button tiny">View Map</a>
									</td>
								</tr>
								<tr>
									<td>Caen</td>
									<td>435km</td>
									<td>4hr 53min</td>
									<td class="text-right">
										<a href="https://www.google.com/maps/dir/Port+De+Caen,+D514,+Ouistreham,+France/%C3%89tang+de+Seuil,+87140+Saint-Pardoux-le-Lac,+France/@47.641849,-1.803908,7z/data=!3m1!4b1!4m13!4m12!1m5!1m1!1s0x480a669f09b61813:0xe9e76e22bb37d06c!2m2!1d-0.2626316!2d49.2616412!1m5!1m1!1s0x47fead8ed3dc3c65:0xf28884017ff4c0fd!2m2!1d1.205159!2d46.055083" class="button tiny">View Map</a>
									</td>
								</tr>
								<tr>
									<td>St Malo</td>
									<td>452km</td>
									<td>5hr 32min</td>
									<td class="text-right">
										<a href="https://www.google.com/maps/dir/St+Malo,+France/%C3%89tang+de+Seuil,+87140+Saint-Pardoux-le-Lac,+France/@47.3485521,-1.530164,8z/data=!3m1!4b1!4m13!4m12!1m5!1m1!1s0x480e81102126bf5d:0xf8e97dadb22be12d!2m2!1d-2.025674!2d48.649337!1m5!1m1!1s0x47fead8ed3dc3c65:0xf28884017ff4c0fd!2m2!1d1.205159!2d46.055083" class="button tiny">View Map</a>
									</td>
								</tr>
								<tr>
									<td>Cherbourg</td>
									<td>605km</td>
									<td>6hr 25min</td>
									<td class="text-right">
										<a href="https://www.google.com/maps/dir/Cherbourg,+France/%C3%89tang+de+Seuil,+87140+Saint-Pardoux-le-Lac,+France/@47.826284,-2.0199577,7z/data=!3m1!4b1!4m13!4m12!1m5!1m1!1s0x480c97121faa62e1:0x7ec61fc418bcf800!2m2!1d-1.622224!2d49.6338979!1m5!1m1!1s0x47fead8ed3dc3c65:0xf28884017ff4c0fd!2m2!1d1.205159!2d46.055083" class="button tiny">View Map</a>
									</td>
								</tr>
								<tr>
									<td>Roscoff</td>
									<td>581km</td>
									<td>6hr 36min</td>
									<td class="text-right">
										<a href="https://www.google.com/maps/dir/Roscoff,+France/%C3%89tang+de+Seuil,+87140+Saint-Pardoux-le-Lac,+France/@47.3869824,-2.5213589,8z/data=!3m1!4b1!4m13!4m12!1m5!1m1!1s0x4813e1457ead5c67:0x7edaeff9d05b4845!2m2!1d-3.985325!2d48.726199!1m5!1m1!1s0x47fead8ed3dc3c65:0xf28884017ff4c0fd!2m2!1d1.205159!2d46.055083" class="button tiny">View Map</a>
									</td>
								</tr>
							</tbody>
						</table>
					</div> 
					<br>
				</div><!-- End of cell-->
			</div>      
		</div><!-- End of cell-->  
	</div><!--end of grid-x -->
</div><!--End of grid container-->

<div class="grid-container">
	<div class="cell small-12">
		<h3><span class="weighted">Driving</span> to Redwood Lake (Etang de Seuil)</h3>
		@foreach($page->modules->where('order', 2) as $module)
			<p>{!! nl2br(e($module->content)) !!}</p>
		@endforeach
		<h3><span class="weighted">Flying</span> to Redwood Lake (Etang de Seuil)</h3>
		@foreach($page->modules->where('order', 3) as $module)
			<p>{!! nl2br(e($module->content)) !!}</p>
		@endforeach
	</div><!-- End of cell-->
</div><!--End of grid container-->
<div class="map-container">
<div class="grid-container full">
	<div class="grid-x">
		<div class="cell small-12">
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2768.8002199697057!2d1.202970315577331!3d46.05508297911228!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47fead8ed3dc3c65%3A0xf28884017ff4c0fd!2s%C3%89tang%20de%20Seuil%2C%2087140%20Saint-Pardoux-le-Lac%2C%20France!5e0!3m2!1sen!2suk!4v1662197843759!5m2!1sen!2suk" width="100%" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>  
		</div><!-- End of cell-->  
	</div><!--end of grid-x -->
</div><!--End of grid container-->
</div>
</div>



@endsection
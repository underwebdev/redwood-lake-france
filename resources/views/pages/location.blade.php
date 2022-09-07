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
									<th>Distance</th>
									<th>Time</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>Example</td>
									<td>500km</td>
									<td>2 Hours</td>
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
										<a href="" class="button tiny">View Map</a>
									</td>
								</tr>
								<tr>
									<td>Calais car ferry</td>
									<td>661km</td>
									<td>6hr 35min</td>
									<td class="text-right">
										<a href="" class="button tiny">View Map</a>
									</td>
								</tr>
								<tr>
									<td>Dieppe</td>
									<td>549km</td>
									<td>5hr 51min</td>
									<td class="text-right">
										<a href="" class="button tiny">View Map</a>
									</td>
								</tr>
								<tr>
									<td>Le Havre</td>
									<td>542km</td>
									<td>5hr 35min</td>
									<td class="text-right">
										<a href="" class="button tiny">View Map</a>
									</td>
								</tr>
								<tr>
									<td>Caen</td>
									<td>435km</td>
									<td>4hr 53min</td>
									<td class="text-right">
										<a href="" class="button tiny">View Map</a>
									</td>
								</tr>
								<tr>
									<td>St Malo</td>
									<td>452km</td>
									<td>5hr 32min</td>
									<td class="text-right">
										<a href="" class="button tiny">View Map</a>
									</td>
								</tr>
								<tr>
									<td>Cherbourg</td>
									<td>605km</td>
									<td>6hr 25min</td>
									<td class="text-right">
										<a href="" class="button tiny">View Map</a>
									</td>
								</tr>
							</tbody>
						</table>
					</div> 
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
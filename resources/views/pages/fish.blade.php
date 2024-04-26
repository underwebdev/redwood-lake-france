@extends('app')

@section('content')

<div class="hero content fishbg">
	@include('layout.nav')
<div class="grid-container">
	<div class="grid-x grid-padding-x">
		<div class="cell small-12 text-center">
			<h1>Capture History</h1>
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
							<th>Name</th>
							<th>Species</th>
							<th>Top Weight</th>
							<th>Last Capture</th>
							<th class="text-center">Captures</th>
							<th>Description</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								@isset($stock->name)
									{{ $stock->name }}
								@else 
									N/A
								@endisset
							</td>
							<td>{{ $stock->specimen->name }}</td>
							<td>{{ $stock->lbs }}lb {{ $stock->oz }}oz</td>
							<td>
								@foreach($stock->reports as $report)
									@if($loop->first)
										{{ date('j/m/y', strtotime ($report->date)) }}<br>
									@endif
								@endforeach
							</td>
							<td class="text-center">{{ $stock->reports()->count() }}</td>
							<td>{{ $stock->description }}</td>
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
				<div class="fish-border-block">
					<a href="{{ $stock->sideone }}" data-lity>
					<img src="{{ $stock->sideonethumb }}">
					</a>
				</div>
				
				@isset($stock->sidetwo)
				<div class="fish-border-block">
					<a href="{{ $stock->sidetwo }}" data-lity>
					<img src="{{ $stock->sidetwothumb }}">
					</a>
				</div>
				@endisset
				
			</div>
			<a href="/stock" class="button expanded">Back To Stock</a>
			</div><!-- End of cell-->
		      
		</div><!-- End of cell-->
		<div class="cell small-12 medium-8">
			<div class="table-scroll">
			<table>
				<thead>
					<tr>
						<th>jan</th>
						<th>feb</th>
						<th>mar</th>
						<th>apr</th>
						<th>may</th>
						<th>jun</th>
						<th>jul</th>
						<th>aug</th>
						<th>sep</th>
						<th>oct</th>
						<th>nov</th>
						<th>dec</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>{{ $stock->reports()->whereMonth('date', '=', date('01'))->count() }} </td>
						<td>{{ $stock->reports()->whereMonth('date', '=', date('02'))->count() }}</td>
						<td>{{ $stock->reports()->whereMonth('date', '=', date('03'))->count() }}</td>
						<td>{{ $stock->reports()->whereMonth('date', '=', date('04'))->count() }}</td>
						<td>{{ $stock->reports()->whereMonth('date', '=', date('05'))->count() }}</td>
						<td>{{ $stock->reports()->whereMonth('date', '=', date('06'))->count() }}</td>
						<td>{{ $stock->reports()->whereMonth('date', '=', date('07'))->count() }}</td>
						<td>{{ $stock->reports()->whereMonth('date', '=', date('08'))->count() }}</td>
						<td>{{ $stock->reports()->whereMonth('date', '=', date('09'))->count() }}</td>
						<td>{{ $stock->reports()->whereMonth('date', '=', date('010'))->count() }}</td>
						<td>{{ $stock->reports()->whereMonth('date', '=', date('11'))->count() }}</td>
						<td>{{ $stock->reports()->whereMonth('date', '=', date('12'))->count() }}</td>
					</tr>
				</tbody>
			</table>
			</div>

			<div class="table-scroll">
				<table>
					<thead>
						<tr>
							<th>Date</th>
							<th>Angler</th>
							<th>Weight</th>
							<th class="text-center"></th>
							<th class="text-center">Swim</th>
						</tr>
					</thead>
					<tbody>
						@foreach($stock->reports as $report)
						<tr>
							<td>{{ date('j/m/y', strtotime ($report->date)) }}</td>
							<td>{{ $report->angler->firstName }} {{ $report->angler->lastName }}</td>
							<td class="">{{ $report->lbs }}lb {{ $report->oz }}oz</td>
							<td class="text-center">
								@isset($report->sideone)
								<a href="{{ $report->sideone }}" data-lity>
									<i class="fas fa-camera"></i>
								</a>
								@endisset
								@isset($report->sidetwo)
								<a href="{{ $report->sidetwo }}" data-lity>
									<i class="fas fa-camera"></i>
								</a>
								@endisset
							</td>
							<td class="text-center">
								@isset($report->swim_id)
									{{ $report->swim->shortname }}
								@else
									N/A
								@endisset
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
		    </div>
			
		</div><!-- End of cell-->
	  
	</div><!--end of grid-x -->
</div><!--End of grid container-->
</div>
</div>
@endsection

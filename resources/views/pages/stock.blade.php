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
			@foreach($page->modules->where('order', 1) as $module)
				<p>{!! nl2br(e($module->content)) !!}</p>
			@endforeach
			<br>
		      
		</div><!-- End of cell-->
	</div><!--end of grid-x -->
</div><!--End of grid container-->

<div class="grid-container full">
	<div class="grid-x grid-padding-x">
		<div class="cell small-12">
			<div class="table-scroll">
				<table>
					<thead>
						<tr>
							<th>Mirror</th>
							<th>Common</th>
							<th>Total</th>
							<th>Uncaught</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>{{ $stock->where('specimen_id', 2)->count() }}</td>
							<td>{{ $stock->where('specimen_id', 1)->count() }}</td>
							<td>{{ $stock->count() }}</td>
							<td></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="table-scroll">
				<table>
					<thead>
						<tr>
							<th>55+</th>
							<th>50+</th>
							<th>45+</th>
							<th>40+</th>
							<th>35+</th>
							<th>30+</th>
							<th>25+</th>
							<th>20+</th>
							<th>20<</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>{{ $stock->where('lbs', '>', 54)->count() }}</td>
							<td>{{ $stock->where('lbs', '>', 49)->count() }}</td>
							<td>{{ $stock->where('lbs', '>', 44)->count() }}</td>
							<td>{{ $stock->where('lbs', '>', 39)->count() }}</td>
							<td>{{ $stock->where('lbs', '>', 34)->count() }}</td>
							<td>{{ $stock->where('lbs', '>', 29)->count() }}</td>
							<td>{{ $stock->where('lbs', '>', 24)->count() }}</td>
							<td>{{ $stock->where('lbs', '>', 19)->count() }}</td>
							<td>{{ $stock->where('lbs', '<', 20)->count() }}</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div><!-- End of cell-->
	</div><!--end of grid-x -->
</div><!--End of grid container-->

<div class="grid-container full">
	<div class="grid-x grid-padding-x">
		@foreach($stock as $fish)
		@if($fish->reports()->exists())
		<div class="cell small-12 medium-4 large-3 text-center">
			<div class="fish-border-block">
		    	<img src="{{ $fish->sideonethumb }}">
		    </div>
		    <div class="stock-info text-left">
			    <strong>Top Weight:</strong> {{ $fish->lbs }}lb {{ $fish->oz }}oz<br>
			    <strong>Captures:</strong> {{ $fish->reports->count() }}<br>
			    <strong>Last Capture:</strong> 
			    @foreach($fish->reports as $report)
					@if($loop->first)
						{{ date('j/m/y', strtotime ($report->date)) }}<br>
					@endif
				@endforeach
			</div>
		    <a href="/stock/{{ $fish->id }}" class="button success expanded">View Fish</a>
		</div><!-- End of cell-->
		@endif
		@endforeach
	</div><!--end of grid-x -->
</div><!--End of grid container-->
</div>

@endsection
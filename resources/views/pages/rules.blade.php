@extends('app')

@section('content')

<div class="hero content">
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
				<h3><span class="weighted">Fishery</span> Rules</h3>
				@foreach($page->modules->where('order', 1) as $module)
					<p>{!! nl2br(e($module->content)) !!}</p>
				@endforeach
			</div><!-- End of cell-->
			<div class="cell small-12 medium-8 large-6 medium-offset-2 large-offset-3">
				<ol>
					@foreach($rules as $rule)
					<li>{{ $rule->body }}</li>
					@endforeach
				</ol>
				<div class="text-center">
					<a href="https://etangdeseuil.co.uk/regulations" class="button success">French Fishing Regulations</a>
				</div>
			</div><!-- End of cell-->
		</div><!--end of grid-x -->
	</div><!--End of grid container-->
</div>

@endsection
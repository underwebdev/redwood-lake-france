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
				<h3 class="text-center"><span class="weighted">Fishery</span> Rules</h3>
				@foreach($page->modules->where('order', 1) as $module)
					<p>{!! nl2br(e($module->content)) !!}</p>
				@endforeach
				<br>
			</div><!-- End of cell-->
		</div><!--end of grid-x -->
		<div class="grid-x grid-padding-x">
			<div class="cell small-12 medium-6">
				<ol>
					@foreach($rules as $rule)
					<li>{{ $rule->body }}</li>
					@endforeach
				</ol>
			</div><!-- End of cell-->
			<div class="cell small-12 medium-6">
				<div class="polaroid-photo rotate-left">
					<img src="/img/redwood-lake-common-carp-rules.jpg">
				</div>

				<div class="polaroid-photo rotate-right">
					<img src="/img/redwood-lake-mirror-carp.jpeg">
				</div>
			      
			</div><!-- End of cell-->
		  
		</div><!--end of grid-x -->
	</div><!--End of grid container-->
</div>

@endsection
@extends('app')

@section('content')

@include('layout.nav-plain')

<div class="grid-x grid-padding-x">
	<div class="cell small-12 large-8">
		<div class="feature-container">	 
			@isset($article->cover)
				<img src="{{ $article->cover }}" class="news-feature">
			@endisset
		
			<h2><strong>{{ $article->title }}</strong></h2>
			<p><small><i class="far fa-calendar-alt"></i> {{ date('j M Y', strtotime ($article->created_at)) }}  <span class="seperator"> / </span> {{ date('H:i A', strtotime ($article->created_at)) }} </small><br>
			{!! nl2br(e($article->body)) !!}</p> test

		</div>
		
		<div class="feature-gallery-container">
			<div class="grid-x grid-padding-x">	
				@foreach($article->images as $image)
				<div class="cell small-12 medium-6 ml-4 large-6 xlarge-4 text-center">
					<div class="news-thumb">
						<a href="{{ $image->image}}" data-lity>
						<img src="{{ $image->thumbnail }}">
						</a>
					</div>
				</div>
				@endforeach
			</div><!--end of grid-x -->
		</div>

   
	</div><!-- End of cell-->
	<div class="cell small-12 large-4">
		<div class="articlecontainer">
			@if($articles->count() < 1)
				<p class="text-center"><strong>No other articles have been posted</strong></p>
			@else
				@foreach($articles as $announce)
					<p><strong>{{ $announce->heading }}</strong><br>
					<small>{{ date('j M Y', strtotime ($announce->created_at)) }}</small><br>
					{{ substr($announce->body, 0,  75)}}... <br>
					<a href="/news/{{ $announce->id }}">Read more...</a><br>
					</p>
					<hr>
				@endforeach
			@endif
			<a href="/news" class="button expanded success">Back to news</a>
		</div>
	     
	</div><!-- End of cell-->

</div><!--end of grid-x -->

@endsection
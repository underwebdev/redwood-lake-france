@extends('app')

@section('content')

@include('layout.nav-plain')
<div class="article-spacer-large show-for-large">
</div>
<div class="grid-x grid-padding-x">
	<div class="cell small-12 large-8">
		<div class="feature-container">	 
			@isset($article->cover)
				<img src="/assets/article-cover/{{ $article->id }}" class="news-feature" width="100%">
			@endisset
		
			<h2>{{ $article->title }}</h2>
			@if($article->breadcrumbs()->count() > 0)
			<nav aria-label="You are here:" role="navigation">
			<ul class="breadcrumbs">
				@foreach($article->breadcrumbs as $breadcrumb)
				<li><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
				@endforeach
			</ul>
			</nav>
			@endif
			<p><small><i class="far fa-calendar-alt"></i> {{ date('j M Y', strtotime ($article->created_at)) }}  <span class="seperator"> / </span> {{ date('H:i A', strtotime ($article->created_at)) }} </small><br>
			{!! nl2br(e($article->body)) !!}</p>

		</div>
		
		<div class="feature-gallery-container">
			<div class="grid-x grid-padding-x">	
				@foreach($article->images as $image)
				<div class="cell small-12 medium-6 ml-4 large-6 xlarge-4 text-center">
					<div class="news-thumb">
						<a href="/assets/article-gallery/{{ $image->id }}.{{ Str::afterLast($image->image, '.') }}" data-lity>
						<img src="/assets/article-gallery/{{ $image->id }}.{{ Str::afterLast($image->image, '.') }}">
						</a>
					</div>
				</div>
				@endforeach
			</div><!--end of grid-x -->
		</div>

   
	</div><!-- End of cell-->
	<div class="cell small-12 large-4">
		<div class="other-articles">
			@if($articles->count() < 1)
				<p class="text-center"><strong>No other articles have been posted</strong></p>
			@else
				@foreach($articles as $announce)
					<p><strong>{{ $announce->title }}</strong><br>
					<small><i class="far fa-calendar-alt"></i> {{ date('j M Y', strtotime ($announce->created_at)) }}</small><br>
					{{ substr($announce->body, 0,  75)}}... <br>
					<a href="/article/{{ $announce->url }}">Read more...</a><br>
					</p>
					<hr>
				@endforeach
			@endif
			<a href="/news" class="button expanded success">Back to news</a>
		</div>
	     
	</div><!-- End of cell-->

</div><!--end of grid-x -->

@endsection
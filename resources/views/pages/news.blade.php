@extends('app')

@section('url') {{ $page->url }} @endsection
@section('metadescription') {{ $page->metadescription }} @endsection
@section('title') {{ $page->metatitle }} @endsection

@section('content')

<div class="hero content {{ $page->css }}">
	@include('layout.nav')
	<div class="grid-container full">
		<div class="grid-x grid-padding-x">
			<div class="cell small-12 text-center">
				<h1>{{ $page->heading }}</h1>
			</div><!-- End of cell-->
		</div><!--end of grid-x -->
	</div><!--End of grid container-->
	@include('layout.hero-wave')
</div>

<div class="section-one">
<div class="grid-container full">
	<div class="grid-x grid-padding-x">
		<div class="cell small-12">
			<div class="feature-container">	        	
			<div class="grid-x grid-padding-x" data-equalizer>
				<div class="cell small-12 medium-12 ml-8" data-equalizer-watch>
					@isset($featured->cover)
					<a href="/article/{{ $featured->url }}">
					    <img src="/assets/article-cover/{{ $featured->id }}" class="news-feature" >
					</a>
					@endisset
				</div>
				<div class="cell small-12 medium-12 ml-4 outline" data-equalizer-watch>
		
						<h2><a href="/article/{{ $featured->url }}">{{ $featured->title }}</a></h2>
						<h5><small>{{ substr($featured->body, 0,  250)}}...</small></h5>
				    	<p><small><i class="far fa-calendar-alt"></i> {{ date('j M Y', strtotime ($featured->created_at)) }} <span class="seperator">|</span> {{ date('H:i A', strtotime ($featured->created_at)) }}</small></p>
				    	<a href="/article/{{ $featured->url }}" class="button success hollow expanded">Read Article</a>
				   
				</div><!-- End of cell-->
			</div>
			</div>
		      
		</div><!-- End of cell-->
	</div><!--end of grid-x -->
</div>
<div class="grid-container full">
	<div class="grid-x grid-padding-x" data-equalizer>
		@foreach($articles as $article)
		<div class="cell small-12 medium-6 large-4">
			<div class="news-holder" data-equalizer-watch>
				<div class="news-thumb expanded">
					<a href="/article/{{ $article->url }}">
						<img src="/assets/article-cover/{{ $article->id }}" width="100%">
					</a>
				</div>
				<h5><a href="/article/{{ $article->url }}">{{ $article->title }}</a></h5>
				<small><i class="far fa-calendar-alt"></i> {{ date('j M Y', strtotime ($article->created_at)) }} <span class="seperator">/</span> {{ date('H:i A', strtotime ($article->created_at)) }}</small><br>
    		</div>
		</div><!-- End of cell-->
		@endforeach
	</div><!--end of grid-x -->
</div><!--End of grid container-->
</div>

@endsection
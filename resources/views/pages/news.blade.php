@extends('app')

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
			<a href="/news/{{ $featured->url }}">
			<div class="feature-container">	        	
			<div class="grid-x grid-padding-x" data-equalizer>
				<div class="cell small-12 medium-12 ml-8">
					@isset($featured->cover)
					    <img src="{{ $featured->cover }}" class="news-feature" data-equalizer-watch>
					@endisset
				</div>
				<div class="cell small-12 medium-12 ml-4">
						<h2 class="heading-font"><strong>{{ $featured->heading }}</strong></h2>
						<h5><small>{{ substr($featured->body, 0,  250)}}...</small></h5>
				    	<p><small><i class="far fa-calendar-alt"></i> {{ date('j M Y', strtotime ($featured->created_at)) }} <span class="seperator">/</span>Posted by: {{ $featured->admin->firstName }} {{ $featured->admin->lastName }} <span class="seperator">/</span> {{ date('H:i A', strtotime ($featured->created_at)) }}</small></p>
				</div><!-- End of cell-->
			</div>
			</div></a>
		      
		</div><!-- End of cell-->
	</div><!--end of grid-x -->
</div>
<div class="grid-container full">
	<div class="grid-x grid-padding-x" data-equalizer>
		@foreach($articles as $article)
		<div class="cell small-12 medium-6 large-4">
			<a href="/article/{{ $article->url }}">
				<div class="news-holder" data-equalizer-watch>
				<div class="news-thumb">
					<img src="{{ $article->thumbnail }}">
				</div>
				<h5 class="heading-font"><strong>{{ $article->title }}</strong></h5>
				<small><i class="far fa-calendar-alt"></i> {{ date('j M Y', strtotime ($article->created_at)) }} <span class="seperator">/</span> {{ date('H:i A', strtotime ($article->created_at)) }}</small><br>
	    </div>
	    </a>
		      
		</div><!-- End of cell-->
		@endforeach
	</div><!--end of grid-x -->
</div><!--End of grid container-->
</div>

@endsection
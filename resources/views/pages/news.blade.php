@extends('app')

@section('content')

<div class="hero content">
	@include('layout.nav')
<div class="grid-container full">
	<div class="grid-x grid-padding-x">
		<div class="cell small-12 text-center">
			<h1>News</h1>
		</div><!-- End of cell-->
	</div><!--end of grid-x -->
</div><!--End of grid container-->
@include('layout.hero-wave')
</div>
<div class="section-one">
<div class="grid-container full">
	<div class="grid-x grid-padding-x">
		<div class="cell small-12 medium-8">
			<div class="news-image">
				News Image
			</div>
		</div><!-- End of cell-->
		<div class="cell small-12 medium-4">
			<div class="latest-news-headline">
				<div class="main-article-preview">
				<h2>Heading</h2>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation.</p>
					<a href="" class="button success expanded">Read More</a>
				</div>
			</div>
		</div><!-- End of cell-->
	</div><!--end of grid-x -->
	<div class="grid-x grid-padding-x">
		<div class="cell small-12 medium-6 large-4">
		      
		</div><!-- End of cell-->
		<div class="cell small-12 medium-6 large-4">
		      
		</div><!-- End of cell-->
		<div class="cell small-12 medium-6 large-4">
		      
		</div><!-- End of cell-->
	</div><!--end of grid-x -->
</div><!--End of grid container-->
</div>

@endsection
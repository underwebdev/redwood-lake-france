@extends('app')

@section('url') {{ $page->url }} @endsection
@section('metadescription') {{ $page->metadescription }} @endsection
@section('title') {{ $page->metatitle }} @endsection

@section('content')

<div class="hero home">
		@include('layout.nav')
<div class="grid-container full">
	<div class="grid-x grid-padding-x">
		<div class="cell small-12 text-center">
			<div class="hero-text">
					<h1>{{ $page->heading }}</h1>
					<div class="hero-review show-for-medium text-center">
						<p>"{{ $review->body }}"</p>
					</div>
					<a href="/booking" class="button secondary hollow large show-for-medium">Book Now</a>
			</div>
			<br class="hide-for-medium">
			<a href="/booking" class="button secondary hollow hide-for-medium">Book Now</a>
		</div><!-- End of cell-->
	</div><!--end of grid-x -->
</div><!--End of grid container-->

@include('layout.hero-wave')

</div>

<div class="section-one">
	<div class="intro">
		<div class="grid-container">
			<div class="grid-x grid-padding-x">
				<div class="cell small-12">
					<h2 class="text-center"><span class="weighted">Welcome to</span> Redwood Lake</h2>
					@foreach($page->modules->where('order', 1) as $module)
					<p>{!! nl2br(e($module->content)) !!}</p>
					@endforeach
				</div><!-- End of cell-->
			</div><!--end of grid-x -->
		</div><!--End of grid container-->
	</div>
</div>

@include('layout.wave')

<div class="section-one">
	<div class="lake-info">
		<div class="grid-container full">
			<div class="grid-x grid-padding-x">
				<div class="cell small-12 ml-6">
					<div id="lake-desc">
					<h4 class="text-center"><span class="weighted">The</span> Lake</h4>
					@foreach($page->modules->where('order', 2) as $module)
					<p>{!! nl2br(e($module->content)) !!}</p>
					@endforeach
				  </div>    
				</div><!-- End of cell-->
				<div class="cell small-12 ml-6 align-self-middle text-right">
					<div class="lake-video">
						<div class="youtube-facade" data-embed-url="https://www.youtube-nocookie.com/embed/7VjuPR-cLFQ?si=1IUe-TqWhTpd3oYj&amp;controls=0&amp;autoplay=1" role="button" tabindex="0" aria-label="Play video">
							<img src="https://img.youtube.com/vi/7VjuPR-cLFQ/hqdefault.jpg" alt="" width="560" height="315" loading="lazy">
							<span class="youtube-facade-play" aria-hidden="true"></span>
						</div>
					</div>
					<script>
					(function(){
						var facade = document.querySelector('.youtube-facade');
						if (!facade) return;
						function loadEmbed() {
							var url = facade.getAttribute('data-embed-url');
							if (!url) return;
							var iframe = document.createElement('iframe');
							iframe.src = url;
							iframe.title = 'YouTube video player';
							iframe.setAttribute('allow', 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share');
							iframe.referrerPolicy = 'strict-origin-when-cross-origin';
							iframe.allowFullscreen = true;
							iframe.style.cssText = 'position:absolute;top:0;left:0;width:100%;height:100%;border-radius:8px;border:0;';
							facade.parentNode.replaceChild(iframe, facade);
						}
						facade.addEventListener('click', loadEmbed);
						facade.addEventListener('keydown', function(e) { if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); loadEmbed(); } });
					})();
					</script>
				</div><!-- End of cell-->
			</div><!--end of grid-x -->
		</div>
	</div>

	<div class="section-divider show-for-ml">
	</div>
	<div class="fish-info">
	<div class="grid-container full">
		<div class="grid-x grid-padding-x">
			<div class="cell small-12 ml-6 align-self-middle">
				<div class="show-for-medium" id="fish-image">
			    	<picture>
			    		<source type="image/webp" srcset="/img/rob-burgess-common-630w.webp 630w, /img/rob-burgess-common.webp 800w" sizes="(max-width: 768px) 100vw, 629px">
			    		<img src="/img/rob-burgess-common.JPG" class="photo-border-block" alt="Rob Burgess French Common Carp - Redwood Lake" width="800" height="578" loading="lazy">
			    	</picture>
			  </div>
			</div><!-- End of cell-->
			<div class="cell small-12 ml-6">
				<div id="fish-desc">
				<h4 class="text-center"><span class="weighted">The</span> Fish</h4>
				@foreach($page->modules->where('order', 3) as $module)
					<p>{!! nl2br(e($module->content)) !!}</p>
				@endforeach

				<picture>
					<source type="image/webp" srcset="/img/rob-burgess-common-630w.webp 630w, /img/rob-burgess-common.webp 800w" sizes="(max-width: 768px) 100vw, 629px">
					<img src="/img/rob-burgess-common.JPG" class="mobile-border-block hide-for-medium" alt="Rob Burgess French Common Carp - Redwood Lake" width="800" height="578" loading="lazy">
				</picture>
				</div>
			</div><!-- End of cell-->
		</div><!--end of grid-x -->
	</div>
	</div>
</div>

@include('layout.wave')

<div class="section-one">
	<div class="facilities">
	<div class="grid-container full">
		<div class="grid-x grid-padding-x">
			<div class="cell small-12 large-6">
				<h4 class="text-center"><span class="weighted">Complex</span> Facilities</h4>
			  @foreach($page->modules->where('order', 4) as $module)
					<p>{!! nl2br(e($module->content)) !!}</p>
				@endforeach
			</div><!-- End of cell-->
			<div class="cell small-12 large-6 align-self-middle text-right">
				<div class="show-for-medium" id="facility-image">
			  	<picture>
			  		<source type="image/webp" srcset="/img/new-facillity-620w.webp 620w, /img/new-facillity.webp 700w" sizes="(max-width: 768px) 100vw, 621px">
			  		<img src="/img/new-facillity.jpg" class="photo-border-block" alt="lake exclusive carp fishing in france facilities" width="700" height="525" loading="lazy">
			  	</picture>
			  </div>
			  <picture>
			  	<source type="image/webp" srcset="/img/new-facillity-620w.webp 620w, /img/new-facillity.webp 700w" sizes="(max-width: 768px) 100vw, 621px">
			  	<img src="/img/new-facillity.jpg" class="mobile-border-block hide-for-medium" alt="lake exclusive carp fishing in france facilities" width="700" height="525" loading="lazy">
			  </picture>
			</div><!-- End of cell-->
		</div><!--end of grid-x -->
	</div>
	</div>
</div>

@include('layout.wave')

<div class="section-one">
	<div class="pricing">
	<div class="grid-container">
			<div class="grid-x grid-padding-x">
				<div class="cell small-12">
					<div id="price-desc">
					<h4 class="text-center"><span class="weighted">Price</span> Guide</h4>
					@foreach($page->modules->where('order', 5) as $module)
						<p>{!! nl2br(e($module->content)) !!}</p>
						@endforeach
					</div>
				</div>
			</div>
		</div>
		<div class="grid-x grid-padding-x" data-equalizer data-equalize-on="medium">
			@foreach($priceguides as $priceguide)
				@include('layout.pricing-block-alt')
			@endforeach
			<div class="cell small-12 text-center">
				<a href="/booking#bookingcalender" class="button large">View Availability</a>     
			</div><!-- End of cell-->
		</div><!--end of grid-x -->
	</div>
	</div>
</div>

<div class="footer-curve">
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 315">
  <path fill="#232323" fill-opacity="1" d="M0,160L120,170.7C240,181,480,203,720,202.7C960,203,1200,181,1320,170.7L1440,160L1440,320L1320,320C1200,320,960,320,720,320C480,320,240,320,120,320L0,320Z"></path>
</svg>
</div>
<div class="subscribe">
@livewire('subscribe-form')
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 316">
  <path fill="#f7f6fb" fill-opacity="1" d="M0,160L120,170.7C240,181,480,203,720,202.7C960,203,1200,181,1320,170.7L1440,160L1440,320L1320,320C1200,320,960,320,720,320C480,320,240,320,120,320L0,320Z"></path>
</svg>
</div>

<div class="section-one">
	@livewire('feature-gallery', ['page' => $page])
</div>

@include('layout.wave')

<div class="section-one">
	<div class="contact">
	<div class="grid-container">
		<div class="grid-x grid-padding-x">
			<div class="cell small-12 medium-10 large-8 medium-offset-1 large-offset-2">
				<h4 class="text-center"><span class="weighted">Contact</span> Information</h4>
			</div><!-- End of cell-->
			<div class="cell small-12 medium-10 large-8 medium-offset-1 large-offset-2">
				<p class="text-center"><i class="far fa-envelope"></i> info@redwoodlake.co.uk<br>
					<i class="fab fa-instagram"></i> @redwoodlakefrance</p> 
				@foreach($page->modules->where('order', 6) as $module)
					<p>{!! nl2br(e($module->content)) !!}</p>
				@endforeach
			      
			</div><!-- End of cell-->
			<div class="cell small-12 medium-10 large-8 medium-offset-1 large-offset-2">
				@livewire('contact-form')
			</div><!-- End of cell-->
		</div><!--end of grid-x -->
	</div><!--End of grid container-->
	</div>
</div><!-- end of section one -->

@endsection
<div class="cell small-12 medium-6 large-5 @if($loop->odd)large-offset-1 @endif"> 
	<div class="pricing-block-alt" data-equalizer-watch>
		<div class="price-block-header-alt">
			<h4 class=text-center>{{ $priceguide->package->name }}</h4>
			@isset($priceguide->name)
				<h5 class="text-center"><strong>{{ $priceguide->name }}</strong></h5>
			@endisset
		</div>
		<div class="price-block-content-alt">
			@foreach($priceguide->package->breakdowns as $breakdown)
				<div class="grid-x">
					<div class="cell small-1 text-center">
						<i class="fas fa-tree"></i>      
					</div><!-- End of cell-->
					<div class="cell small-11">
					    <p>{{ $breakdown->body }}</p>  
					</div><!-- End of cell-->
				</div><!--end of grid-x -->
			@endforeach
		</div>
		<div class="price-container-alt text-center">
			<div class="price-total-alt">
				<h6>£{{ $priceguide->price / 100 }} <small>per week</small></h6>
			</div>
			<div class="price-individual-alt">
				<strong>£{{ $priceguide->price / 5 / 100 }} p.p based on 5 anglers</strong>
			</div>
		</div>
	</div>
</div><!-- End of cell-->
<div class="cell small-12 medium-6 large-5 @if($loop->first)large-offset-1 @endif"> 
	<div class="pricing-block" data-equalizer-watch>
		<div class="price-block-header">
		<h4 class=text-center>{{ $priceguide->package->name }}</h4>
			@isset($priceguide->name)
				<h5 class="text-center">{{ $priceguide->name }}</h5>
			@endisset
		</div>
		<div class="price-block-content">
			
				@foreach($priceguide->package->breakdowns as $breakdown)
					<i class="fas fa-tree"></i>{{ $breakdown->body }}<br>
				@endforeach
			
		</div>
		<div class="price-container text-center">
			<div class="price-total">
				<h6>£{{ $priceguide->price / 100 }} per week</h6>
			</div>
			<div class="price-individual">
				£{{ $priceguide->price / 5 / 100 }} p.p based on 5 anglers
			</div>
		</div>
	</div>
</div><!-- End of cell-->
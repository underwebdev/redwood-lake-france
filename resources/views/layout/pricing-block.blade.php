<div class="cell small-12 medium-6 medium-offset-3"> 
	<div class="pricing-block" data-equalizer-watch>
		<h4 class=text-center><strong>{{ $priceguide->package->name }}</strong></h4>
			@isset($priceguide->name)
				<h5 class="text-center">{{ $priceguide->name }}</h5>
			@endisset
		<ul>
			@foreach($priceguide->package->breakdowns as $breakdown)
				<li>{{ $breakdown->body }}</li>
			@endforeach
		</ul>
		<div class="price-container">
			<div class="price-total">
				<h6><strong>£{{ $priceguide->price / 100 }} per week</strong></h6>
			</div>
			<div class="price-individual">
				£{{ $priceguide->price / 5 / 100 }} p.p based on 5 anglers
			</div>
		</div>
	</div>
</div><!-- End of cell-->
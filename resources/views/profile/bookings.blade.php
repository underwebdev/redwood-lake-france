@extends('profile')

@section('content')

<div class="grid-container">
	<div class="grid-x grid-padding-x">
		<div class="cell small-12">
			@if($user->angler->bookings()->exists() OR $user->angler->payments()->exists() OR $user->angler->parties()->exists())
				@if($user->angler->bookings()->exists())
				<h5 class="info-bar">Bookings</h5>
				<div class="table-scroll">
					<table>
						<thead>
							<tr>
								<th>Arrival</th>
								<th>Departure</th>
								<th class="text-center">Anglers</th>
								<th>Total</th>
								<th>Payments</th>
								<th>Balance</th>
								<th>Due</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@foreach($user->angler->bookings as $booking)
							<tr>
								<td>{{ date('j/m/y H:i', strtotime ($booking->arrival)) }}</th>
								<td>{{ date('j/m/y H:i', strtotime ($booking->departure)) }}</td>
								<td class="text-center">{{ $booking->anglers }}</td>
								<td>£{{ $booking->total / 100 }}</td>
								<td>£{{ $booking->payments->sum('total') / 100 }}</td>
								<td>£{{ ($booking->total - $booking->payments()->sum('total')) / 100 }}</td>
								<td>{{ Carbon\Carbon::parse($booking->arrival)->subDays($booking->priceguide->due)->format('j/m/Y') }}</td>
								<td class="text-right"><a href="/my-account/booking/{{ $booking->id }}" class="button success small">Manage</a></th>
							</tr>
							@endforeach
						</tbody>
					</table>
			    </div>
			    @endif
			    @if($user->angler->payments()->exists())
			    <h5 class="info-bar">Payments</h5>
			    <div class="table-scroll">
			    	<table>
			    		<thead>
			    			<tr>
			    				<th>Date</th>
			    				<th>Total</th>
			    				<th>Method</th>
			    				<th>Booking</th>
			    				<th>Status</th>
			    			</tr>
			    		</thead>
			    		<tbody>
			    			@foreach($user->angler->payments as $payment)
			    			<tr>
			    				<td>{{ date('j/m/y H:i', strtotime ($payment->created_at)) }}</td>
			    				<td>£{{ $payment->total / 100 }}</td>
			    				<td>{{ $payment->paymethod->name }}</td>
			    				<td>{{ date('j/m/y', strtotime ($payment->booking->arrival)) }}</td>
			    				<td>@empty($payment->status)Pending @else Confirmed @endempty</td>
			    			</tr>
			    			@endforeach
			    		</tbody>
			    	</table>
			    </div>
			    @endif
			    @if($user->angler->parties()->exists())
				<h5 class="info-bar">Bookings</h5>
				<div class="table-scroll">
					<table>
						<thead>
							<tr>
								<th>Ref</th>
								<th>Arrival</th>
								<th>Departure</th>
								<th class="text-center">Anglers</th>
							</tr>
						</thead>
						<tbody>
							@foreach($user->angler->bookings as $booking)
							<tr>
								<td>{{ $booking->id }}</td>
								<td>{{ date('j/m/y H:i', strtotime ($booking->arrival)) }}</td>
								<td>{{ date('j/m/y H:i', strtotime ($booking->departure)) }}</td>
								<td class="text-center">{{ $booking->anglers }}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>

				@endif
			@else
				<p class="text-center"><strong>No booking data available</strong></p>
			@endif
		</div><!-- End of cell-->  
	</div><!--end of grid-x -->
</div><!--End of grid container-->

@endsection
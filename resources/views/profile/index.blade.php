@extends('profile')

@section('content')
<div class="grid-container full">
	<div class="grid-x grid-padding-x">
		<div class="cell small-12 ml-3">
			<div class="user-container">
				<div class="text-center">
					<img src="/img/logo/RedwoodLogo.png">
				</div>
				<div class="info">
					<p class="text-center"><strong>{{ $user->angler->firstName }} {{ $user->angler->lastName }}</strong><br>
					Angler Ref: {{ $user->angler->ref }}<br>
					{{ $user->email }}<br>
					{{ $user->angler->telephone }}</p>
				</div>
			</div>     
		</div><!-- End of cell-->
		<div class="cell small-12 ml-9">
			@if($user->angler->bookings()->exists())
			<h5 class="info-bar">Bookings</h5>
			<div class="table-scroll">
				<table>
					<thead>
						<tr>
							<th>Ref</th>
							<th>Arrival</th>
							<th class="text-center">Anglers</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach($user->angler->bookings as $booking)
						<tr>
							<td>{{ $booking->id }}</td>
							<td>{{ date('j/m/y', strtotime ($booking->arrival)) }}</td>
							<td class="text-center">{{ $booking->anglers }}</td>
							<td class="text-right"><a href="/my-account/booking/{{ $booking->id }}" class="button success small">Manage</a></td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			@endif

			@if($user->angler->payments()->exists())
			<h5 class="info-bar">Your Payments</h5>
			<div class="table-scroll">
				<table>
					<thead>
						<tr>
							<th>Date</th>
							<th>Amount</th>
							<th>Booking</th>
							<th>Method</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach($user->angler->payments as $payment)
						<tr>
							<td>{{ date('j/m/y', strtotime ($payment->created_at)) }}</td>
							<td>£{{ $payment->total / 100 }}</td>
							<td>{{ date('j/m/y', strtotime ($payment->booking->arrival)) }}</td>
							<td>{{ $payment->paymethod->name }}</td>
							<td>@empty($payment->status)Pending @else Confirmed @endempty</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			@endif

			@if($angler->parties()->exists())
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

			<div class="text-center">
				<a href="/my-account/catch-reports">Add Catch Report</a>
			</div>
		</div><!-- End of cell-->
	</div><!--end of grid-x -->
</div><!--End of grid container-->

@endsection
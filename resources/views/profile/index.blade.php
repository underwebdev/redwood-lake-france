@extends('profile')

@section('content')
<br>
<br>
<div class="grid-container">
	<div class="grid-x grid-padding-x">
		<div class="cell small-12 medium-3">
			<p>Full Name<br>
			Angler Ref: 1001<br>
			</p>
		      
		</div><!-- End of cell-->
		<div class="cell small-12 medium-9">
			<h5 class="info-bar">Bookings</h5>
			<div class="table-scroll">
				<table>
					<thead>
						<tr>
							<th>Ref</th>
							<th>Arrival</th>
							<th>Anglers</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td class="text-right"><a href="" class="button success small">Manage</a></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="text-center">
				<a href="" class="button">Make Payment</a>
			</div>

			<h5 class="info-bar">Your Payments</h5>
			<div class="table-scroll">
				<table>
					<thead>
						<tr>
							<th>Date</th>
							<th>Amount</th>
							<th>Anglers</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td class="text-right"><a href="" class="button success small">Manage</a></td>
						</tr>
					</tbody>
				</table>
			</div>

			<h5 class="info-bar">Party Payments</h5>
			<div class="table-scroll">
				<table>
					<thead>
						<tr>
							<th>Date</th>
							<th>Arrival</th>
							<th>Anglers</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td class="text-right"><a href="" class="button success small">Manage</a></td>
						</tr>
					</tbody>
				</table>
			</div>
		      
		</div><!-- End of cell-->
	</div><!--end of grid-x -->
</div><!--End of grid container-->

@endsection
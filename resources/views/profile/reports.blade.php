@extends('profile')

@section('content')

<div class="grid-container">
	<div class="grid-x grid-padding-x">
		<div class="cell small-12">
			<h5 class="info-bar">Your Reports</h5>
			<div class="table-scroll">
				<table>
					<thead>
						<tr>
							<th>Reports</th>
							<th>Common</th>
							<th>Mirror</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td></td>
							<td></td>
							<td></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="text-center">
				<button class="button success">Add Report</button>
			</div>

			<h5 class="info-bar">Latest Reports</h5>
			<div class="grid-x grid-padding-x">
				<div class="cell small-12 medium-4">
					<select id=""name="">
						<option value=""> </option> 
					</select>   
				</div><!-- End of cell-->
				<div class="cell small-12 medium-4">
					<select id=""name="">
						<option value=""> </option> 
					</select>   
				</div><!-- End of cell-->
				<div class="cell small-12 medium-4">
					<select id=""name="">
						<option value=""> </option> 
					</select>   
				</div><!-- End of cell-->
	
			</div><!--end of grid-x -->
		</div><!-- End of cell-->
	</div><!--end of grid-x -->
</div><!--End of grid container-->

@endsection
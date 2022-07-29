@extends('app')

@section('content')

<div class="hero content">
	@include('layout.nav')
<div class="grid-container">
	<div class="grid-x grid-padding-x">
		<div class="cell small-12 text-center">
			<h1>Catch Reports</h1>
		</div><!-- End of cell-->
	</div><!--end of grid-x -->
</div><!--End of grid container-->
@include('layout.hero-wave')
</div>

<div class="section-one">
	<div class="grid-container">
		<div class="grid-x grid-padding-x">
			<div class="cell small-12">
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
				cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
				proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p><br>      
			</div><!-- End of cell-->
		</div><!--end of grid-x -->
		<div class="grid-x grid-padding-x">
			<div class="cell small-12 medium-4">
				<select id=""name="">
					<option value="">Select Species</option> 
				</select>  
			</div><!-- End of cell-->
			<div class="cell small-12 medium-4">
			   <select id=""name="">
					<option value="">Select Weight</option> 
				</select>        
			</div><!-- End of cell-->
			<div class="cell small-12 medium-4">
			    <input type="text" placeholder="Angler Name" name="">       
			</div><!-- End of cell-->
		</div><!--end of grid-x -->
		<div class="grid-x grid-padding-x">
			<div class="cell small-12">
				<div class="table-scroll">
					<table>
					<thead>
					<tr>
						<td>Date</td>
						<td>Name</td>
						<td class="tspace">Weight</td>
						<td>Species</td>
						<td></td>
					</tr>
					</thead>
					<tbody>
						<tr>
							<td>24/07/22</td>
							<td>David Butler</td>
							<td width="200" class="bluereport ">24 lb 0 oz</td>
							<td>Common</td>
							<td class="text-center"></td>
							</tr>
								<tr>
							<td>24/07/22</td>
							<td>David Butler</td>
							<td width="200" class="bluereport ">22 lb 0 oz</td>
							<td>Mirror</td>
							<td class="text-center"></td>
							</tr>
								<tr>
							<td>24/07/22</td>
							<td>Simon Barker</td>
							<td width="200" class="greenreport ">17 lb 9 oz</td>
							<td>Common</td>
							<td class="text-center">
								<i class="fas fa-camera"></i>
							</td>
							</tr>
								<tr>
							<td>24/07/22</td>
							<td>Simon Barker</td>
							<td width="200" class="greenreport ">17 lb 5 oz</td>
							<td>Common</td>
							<td class="text-center">
								<i class="fas fa-camera"></i>
							</td>
							</tr>
								<tr>
							<td>24/07/22</td>
							<td>Simon Barker</td>
							<td width="200" class="bluereport ">21 lb 5 oz</td>
							<td>Common</td>
							<td class="text-center">
								<i class="fas fa-camera"></i>
							</td>
							</tr>
								<tr>
							<td>23/07/22</td>
							<td>Simon Barker</td>
							<td width="200" class="bluereport ">24 lb 12 oz</td>
							<td>Common</td>
							<td class="text-center">
								<i class="fas fa-camera"></i>
							</td>
							</tr>
								<tr>
							<td>23/07/22</td>
							<td>Simon Barker</td>
							<td width="200" class="bluereport ">23 lb 6 oz</td>
							<td>Mirror</td>
							<td class="text-center">
								<i class="fas fa-camera"></i>
							</td>
							</tr>
								<tr>
							<td>23/07/22</td>
							<td>Simon Barker</td>
							<td width="200" class="greenreport ">17 lb 6 oz</td>
							<td>Common</td>
							<td class="text-center">
								<i class="fas fa-camera"></i>
							</td>
							</tr>
								<tr>
							<td>23/07/22</td>
							<td>Simon Barker</td>
							<td width="200" class="greenreport ">16 lb 0 oz</td>
							<td>Common</td>
							<td class="text-center">
								<i class="fas fa-camera"></i>
							</td>
							</tr>
								<tr>
							<td>24/07/22</td>
							<td>Simon Todhunter</td>
							<td width="200" class="bluereport ">25 lb 0 oz</td>
							<td>Mirror</td>
							<td class="text-center">
								<i class="fas fa-camera"></i>
							</td>
							</tr>
								<tr>
							<td>23/07/22</td>
							<td>Dominic Bond</td>
							<td width="200" class="plain ">3 lb 10 oz</td>
							<td>Mirror</td>
							<td class="text-center">
								<i class="fas fa-camera"></i>
							</td>
							</tr>
								<tr>
							<td>23/07/22</td>
							<td>Dominic Bond</td>
							<td width="200" class="plain ">3 lb 9 oz</td>
							<td>Mirror</td>
							<td class="text-center">
								<i class="fas fa-camera"></i>
							</td>
							</tr>
								<tr>
							<td>23/07/22</td>
							<td>Dominic Bond</td>
							<td width="200" class="greenreport ">11 lb 10 oz</td>
							<td>Mirror</td>
							<td class="text-center">
								<i class="fas fa-camera"></i>
							</td>
							</tr>
								<tr>
							<td>23/07/22</td>
							<td>Dominic Bond</td>
							<td width="200" class="greenreport ">13 lb 10 oz</td>
							<td>Mirror</td>
							<td class="text-center">
								<i class="fas fa-camera"></i>
							</td>
							</tr>
								<tr>
							<td>23/07/22</td>
							<td>Dominic Bond</td>
							<td width="200" class="greenreport ">17 lb 9 oz</td>
							<td>Mirror</td>
							<td class="text-center">
								<i class="fas fa-camera"></i>
							</td>
							</tr>
								<tr>
							<td>24/07/22</td>
							<td>Rob Gooch</td>
							<td width="200" class="bluereport ">25 lb 12 oz</td>
							<td>Mirror</td>
							<td class="text-center">
								<i class="fas fa-camera"></i>
							</td>
							</tr>
								<tr>
							<td>24/07/22</td>
							<td>Rob Gooch</td>
							<td width="200" class="bluereport ">24 lb 14 oz</td>
							<td>Common</td>
							<td class="text-center">
								<i class="fas fa-camera"></i>
							</td>
							</tr>
								<tr>
							<td>23/07/22</td>
							<td>Rob Gooch</td>
							<td width="200" class="bluereport ">23 lb 8 oz</td>
							<td>Common</td>
							<td class="text-center">
								<i class="fas fa-camera"></i>
							</td>
							</tr>
								<tr>
							<td>24/07/22</td>
							<td>Rob Gooch</td>
							<td width="200" class="bluereport ">22 lb 4 oz</td>
							<td>Common</td>
							<td class="text-center"></td>
							</tr>
								<tr>
							<td>23/07/22</td>
							<td>Rob Gooch</td>
							<td width="200" class="greenreport ">18 lb 0 oz</td>
							<td>Mirror</td>
							<td class="text-center">
								<i class="fas fa-camera"></i>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			</div><!-- End of cell-->
		</div><!--end of grid-x -->
	</div><!--End of grid container-->
</div>
@endsection
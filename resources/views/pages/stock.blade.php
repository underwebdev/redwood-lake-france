@extends('app')

@section('content')

<div class="hero content">
	@include('layout.nav')
<div class="grid-container">
	<div class="grid-x grid-padding-x">
		<div class="cell small-12 text-center">
			<h1>The Fish</h1>
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
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
			<br>
		      
		</div><!-- End of cell-->
	</div><!--end of grid-x -->
</div><!--End of grid container-->

<div class="grid-container full">
	<div class="grid-x grid-padding-x">
		<div class="cell small-12">
			<div class="table-scroll">
				<table>
					<thead>
						<tr>
							<td>Mirror</td>
							<td>Common</td>
							<td>Total</td>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
			<div class="table-scroll">
				<table>
					<thead>
						<tr>
							<td>55+</td>
							<td>50+</td>
							<td>45+</td>
							<td>40+</td>
							<td>35+</td>
							<td>30+</td>
							<td>25+</td>
							<td>20+</td>
							<td>20<</td>
							<td>Total</td>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div><!-- End of cell-->
	</div><!--end of grid-x -->
</div><!--End of grid container-->

<div class="grid-container full">
	<div class="grid-x grid-padding-x">
		<div class="cell small-12 medium-4 large-3 text-center">
			<div class="photo-border-block">
		      Fish
		    </div>
		    <a href="/stock/id" class="button success expanded">View Fish</a>
		</div><!-- End of cell-->
		<div class="cell small-12 medium-4 large-3 text-center">
			<div class="photo-border-block">
		      Fish
		    </div>
		    <a href="/stock/id" class="button success expanded">View Fish</a>
		</div><!-- End of cell-->
		<div class="cell small-12 medium-4 large-3 text-center">
			<div class="photo-border-block">
		      Fish
		    </div>
		    <a href="/stock/id" class="button success expanded">View Fish</a>
		</div><!-- End of cell-->
		<div class="cell small-12 medium-4 large-3 text-center">
			<div class="photo-border-block">
		      Fish
		    </div>
		    <a href="/stock/id" class="button success expanded">View Fish</a>
		</div><!-- End of cell-->
	</div><!--end of grid-x -->
</div><!--End of grid container-->
</div>

@endsection
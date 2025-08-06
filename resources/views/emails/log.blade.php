@extends('admin')

@section('content')

<div class="grid-container full">
    <div class="grid-x grid-padding-x">
        <div class="cell small-12">
            <div class="admin-title-panel">
                <div class="grid-x">
                    <div class="cell small-12 medium-6">
                        <h1>Email Log</h1>
                    </div>
                    <div class="cell small-12 medium-6 text-right align-self-middle">
                        
                    </div><!-- End of cell-->
                </div>
            </div>
        </div><!-- End of cell-->
    </div><!--end of grid-x -->
    @include('layout.alerts')
</div><!--End of grid container-->

<div class="grid-container full">
    <div class="grid-x grid-padding-x">
        <div class="cell small-12">
        	<div class="table-scroll">
        		<table>
        			<thead>
        				<tr>
        					<th>Booking</th>
        					<th>Type</th>
        					<th>Recipient</th>
        					<th>Sent</th>
        					<th>Delivered</th>
        					<th>Opened</th>
        				</tr>
        			</thead>
        			<tbody>
        				@foreach($emails as $email)
        				<tr>
        					<td><a href="/admin/booking/{{ $email->booking->id }}">#{{ $email->booking->id }}</a></td>
        					<td>{{ $email->type }}</td>
        					<td>{{ $email->recipient }}</td>
        					<td>{{ date('j/m/y H:i', strtotime ($email->sent)) }}</td>
        					<td>{{ date('j/m/y H:i', strtotime ($email->delivered)) }}</td>
        					<td>{{ date('j/m/y H:i', strtotime ($email->opened)) }}</td>
        				</tr>
        				@endforeach
        			</tbody>
        		</table>
                
        </div><!-- End of cell-->  
    </div><!--end of grid-x -->
</div><!--End of grid container-->

@endsection
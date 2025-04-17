@extends('admin')

@section('content')
<div class="grid-container full">
        <div class="grid-x grid-padding-x">
            <div class="cell small-12">
                <div class="admin-title-panel">
                    <div class="grid-x">
                        <div class="cell small-12 medium-6">
                            <h1>Email Previews</h1>
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
        	                <th>Name</th>
        	                <th></th>
        	            </tr>
        	        </thead>
        	        <tbody>
                        <tr>
                            <td>Payment reminder</td>
                            <td class="float-right">
                                <a class="button tiny" href="/emails/payment-reminder">Preview</a>
                            </td>
                        </tr>

                        <tr>
                            <td>Payment overdue</td>
                            <td class="float-right">
                                <a class="button tiny" href="/emails/payment-overdue">Preview</a>
                            </td>
                        </tr>

                        <tr>
                            <td>Guest information</td>
                            <td class="float-right">
                                <a class="button tiny" href="/emails/guest-information">Preview</a>
                            </td>
                        </tr>
   
        	            <tr>
        	                <td>Welcome Email</td>
        					<td class="float-right">
        						<a class="button tiny" href="/emails/welcome-email">Preview</a>
        					</td>
        	            </tr>

        	            <tr>
        	                <td>Review Request</td>
        					<td class="float-right">
        						<a class="button tiny" href="/emails/review-request">Preview</a>
        					</td>
        	            </tr>
        	            
        	        </tbody>
        	    </table>
        	</div> <!-- End of table scroll -->
                
        </div><!-- End of cell-->  
    </div><!--end of grid-x -->
</div><!--End of grid container-->

@endsection
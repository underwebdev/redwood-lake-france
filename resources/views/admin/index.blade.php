@extends('admin')

@section('content')

<div class="grid-container full">
    <div class="grid-x grid-padding-x">
        <div class="cell small-12">
            <div class="admin-title-panel">
                <div class="grid-x">
                    <div class="cell small-12 medium-6">
                        <h1>Admin Area</h1>
                    </div>
                    <div class="cell small-12 medium-6 text-right align-self-middle">
                        
                    </div><!-- End of cell-->
                </div>
            </div>
        </div><!-- End of cell-->
    </div><!--end of grid-x -->
    @include('layout.alerts')
</div><!--End of grid container-->

@endsection
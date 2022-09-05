<div>
    <div class="grid-container full">
        <div class="grid-x grid-padding-x">
            <div class="cell small-12">
                <div class="admin-title-panel">
                    <div class="grid-x">
                        <div class="cell small-12 medium-6">
                            <h1>Bookings</h1>
                        </div>
                        <div class="cell small-12 medium-6 text-right align-self-middle">
                            @if($mode == 1)
                           
                            @else
                            <button class="button alert" wire:click="back">Go Back</button>
                            @endif
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
                <input type="text" placeholder="Search by booking ref or lead party name" wire:model="lookup">
                <div class="table-scroll">
                    <table>
                        <thead>
                            <tr>
                                <th>Arrival</th>
                                <th>Ref</th>
                                <th>Lead</th>
                                <th>Balance Due</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bookings as $booking)
                            <tr>
                                <td>{{ date('j/m/y', strtotime ($booking->arrival)) }}</td>
                                <td>{{ $booking->id }}</td>
                                <td>{{ $booking->angler->firstName }} {{ $booking->angler->lastName }}</td>
                                <td>{{ Carbon\Carbon::parse($booking->arrival)->subDays($booking->priceguide->due) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>   
            </div><!-- End of cell-->
        </div><!--end of grid-x -->
    </div><!--End of grid container-->
</div>

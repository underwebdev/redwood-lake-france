<div>
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
    <div class="grid-container full">
        <div class="grid-x grid-padding-x">
            <div class="cell small-12">
                @if($current)
                <div class="table-scroll">
                    <table>
                        <thead>
                            <tr>
                                <th>Current Booking</th>
                                <th>Lead</th>
                                <th>Anglers</th>
                                <th>Departure</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#{{ $current->id }}</td>
                                <td>{{ $current->angler->firsName }} {{ $current->angler->lastName }}</td>
                                <td>{{ $current->anglers }}</td>
                                <td>{{ date('j/m/y', strtotime ($current->departure)) }}</td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                @else
                    <p class="text-center"><strong>No Current Booking</strong></p>
                @endif

                @if($next)
                 <div class="table-scroll">
                    <table>
                        <thead>
                            <tr>
                                <th>Next Booking</th>
                                <th>Lead</th>
                                <th>Anglers</th>
                                <th>Arrival</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#{{ $next->id }}</td>
                                <td>{{ $next->angler->firstName }} {{ $next->angler->lastName }}</td>
                                <td>{{ $next->anglers }}</td>
                                <td>{{ date('j/m/y', strtotime ($next->arrival)) }}</td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                @else
                    <p class="text-center"><strong>No Bookings Scheduled</strong></p>
                @endif

            </div><!-- End of cell-->
            <div class="cell small-12">
                <div class="table-scroll">
                    <table>
                        <thead>
                            <tr>
                                <th>Latest Bookings</th>
                                <th>Lead</th>
                                <th>Anglers</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bookings as $booking)
                            <tr>
                                <td>{{ date('j/m/y', strtotime ($booking->arrival)) }}</td>
                                <td>{{ $booking->angler->firstName }} {{ $booking->angler->lastName }}</td>
                                <td>{{ $booking->anglers }}</td>
                                <td class="text-right"><a href="/admin/booking/{{ $booking->id }}" class="button small">View</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="text-center">
                    <a href="/admin/bookings" class="button">View All</a>
                </div>
            </div><!-- End of cell-->
            <div class="cell small-12">
                <div class="table-scroll">
                    <table>
                        <thead>
                            <tr>
                                <th>Latest Payments</th>
                                <th>Name</th>
                                <th>Amount</th>
                                <th>Method</th>
                                <th>Timestamp</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($payments as $payment)
                            <tr>
                                <td>{{ date('j/m/y', strtotime ($payment->booking->arrival)) }}</td>
                                <td>{{ $payment->angler->firstName }} {{ $payment->angler->lastName }}</td>
                                <td>£{{ $payment->total / 100 }}</td>
                                <td>{{ $payment->paymethod->name }}</td>
                                <td>{{ date('j/m/y H:i', strtotime ($payment->created_at)) }}</td>
                                <td class="text-right"><a class="button small">View Payment</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="text-center">
                    <a href="/admin/payments" class="button">View All</a>
                </div>
            </div><!-- End of cell-->
        </div><!--end of grid-x -->
    </div><!--End of grid container-->
</div>

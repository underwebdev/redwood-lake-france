<div>
    <div class="grid-container full">
        <div class="grid-x grid-padding-x">
            <div class="cell small-12">
                <div class="admin-title-panel">
                    <div class="grid-x">
                        <div class="cell small-12 medium-6">
                            <h1>Payment #{{ $payment->id }}</h1>
                        </div>
                        <div class="cell small-12 medium-6 text-right align-self-middle">
                            @if($payment->status < 1)
                            <button class="button success" wire:click="confirmPayment">Confirm Payment</button>
                            @endif
                            <a href="/admin/payments" class="button alert">All Payments</a>
                           
                        </div><!-- End of cell-->
                    </div>
                </div>
            </div><!-- End of cell-->
        </div><!--end of grid-x -->
        @include('layout.alerts')
    </div><!--End of grid container-->
    <div class="grid-container">
        <div class="grid-x grid-padding-x">
            <div class="cell small-12">
                <div class="table-scroll">
                    <table>
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Total</th>
                                <th>Net</th>
                                <th>Method</th>
                                <th>Ref</th>
                                <th>Angler</th>
                                <th>Booking</th>
                                <th class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ date('j/m/y', strtotime ($payment->created_at)) }}</td>
                                <td>£{{ number_format($payment->total / 100, 2) }}</td>
                                <td>£{{ number_format($payment->net / 100, 2) }}</td>
                                <td>{{ $payment->paymethod->name }}</td>
                                <td>
                                    @if($payment->paymethod_id == 1)
                                        {{$payment->transaction_id }} @else {{ $payment->booking->id }} - {{ $payment->angler->lastName }} 
                                    @endif
                                </td>
                                <td>{{ $payment->angler->firstName }} {{ $payment->angler->lastName }}</td>
                                <td>{{ date('j/m/y', strtotime ($payment->booking->arrival)) }}</td>
                                <td class="text-center">
                                    @if($payment->status == 1)
                                        <i class="fas fa-check-circle"></i> 
                                    @else 
                                        <span class="error"><i class="fas fa-exclamation"></i></span> 
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>        
            </div><!-- End of cell-->  
        </div><!--end of grid-x -->
    </div><!--End of grid container-->
</div>

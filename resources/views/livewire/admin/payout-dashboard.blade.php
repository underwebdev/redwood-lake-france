<div>
    <div class="grid-container full">
        <div class="grid-x grid-padding-x">
            <div class="cell small-12">
                <div class="admin-title-panel">
                    <div class="grid-x">
                        <div class="cell small-12 medium-6">
                            <h1>Payouts</h1>
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
    <div class="grid-container">
        @if($mode == 1)
        <div class="grid-x grid-padding-x">
            <div class="cell small-12">
                <div class="table-scroll">
                    <table>
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>Total</td>
                                <td>Created</td>
                                <td>Due</td>
                                <td class="text-center">Status</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($payouts as $payout)
                            <tr>
                                <td>{{ $payout->payout }}</td>
                                <td>£{{ number_format($payout->amount / 100, 2) }}</td>
                                <td>{{ date('j/m/y', strtotime ($payout->created)) }}</td>
                                <td>{{ date('j/m/y', strtotime ($payout->due)) }}</td>
                                <td class="text-center">
                                    @if($payout->status == 'paid')
                                        <i class="fas fa-check-circle"></i>
                                    @elseif($payout->status == 'in_transit')
                                        <i class="fas fa-exchange-alt"></i>
                                    @endif
                                </td>
                                <td class="text-right"><button class="button success small" wire:click="selectPayout('{{ $payout->id }}')">View</button></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div><!-- End of cell-->
        </div><!--end of grid-x -->
        @elseif($mode == 2)
        <div class="grid-x grid-padding-x">
            <div class="cell small-12">
                <div class="table-scroll">
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Total</th>
                                <th>Created</th>
                                <th>Due</th>
                                <th class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $selectedpayout->payout }}</td>
                                <td>£{{ number_format($selectedpayout->amount / 100, 2) }}</td>
                                <td>{{ date('j/m/y', strtotime ($selectedpayout->created)) }}</td>
                                <td>{{ date('j/m/y', strtotime ($selectedpayout->due)) }}</td>
                                <td class="text-center">
                                    @if($selectedpayout->status == 'paid')
                                        <i class="fas fa-check-circle"></i>
                                    @elseif($payout->status == 'in_transit')
                                        <i class="fas fa-exchange-alt"></i>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="table-scroll">
                    <table>
                        <thead>
                            <tr>
                                <td>Date</td>
                                <td>Name</td>
                                <td>Booking</td>
                                <td class="text-right">Net</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($selectedpayout->payments as $payment)
                            <tr>
                                <td>{{ date('j/m/y H:i', strtotime ($payment->created_at)) }}</td>
                                <td>{{ $payment->booking->angler->firstName }} {{ $payment->booking->angler->lastName }}</td>
                                <td>{{ date('j/m/y', strtotime ($payment->booking->arrival)) }}</td>
                                <td class="text-right">£{{ number_format($payment->net / 100) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div><!-- End of cell-->
        </div><!--end of grid-x -->
        @endif
    </div><!--End of grid container-->
</div>

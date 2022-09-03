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
                                <td>Account</td>
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
                                <td>
                                   
                                <td><button class="button success small" wire:click="selectPayout('{{ $payout->id }}')">View</button></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div><!-- End of cell-->
        </div><!--end of grid-x -->
        @elseif($mode == 2)

        @endif
    </div><!--End of grid container-->
</div>

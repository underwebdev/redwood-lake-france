<div>
    <div class="grid-container full">
        <div class="grid-x grid-padding-x">
            <div class="cell small-12">
                <div class="admin-title-panel">
                    <div class="grid-x">
                        <div class="cell small-12 medium-6">
                            <h1>Payments</h1>
                        </div>
                        <div class="cell small-12 medium-6 text-right align-self-middle">
                            @if($mode == 1)
                                <button class="button success">Manual Payment</button>
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
            @if($mode == 1)
            <div class="cell small-12">
                <input type="text" placeholder="Search payments by name or booking ref" wire:model="lookup">
                <div class="table-scroll">
                    <table>
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Arrival</th>
                                <th>Ref</th>
                                <th>Method</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($payments as $payment)
                            <tr>
                                <td>{{ $payment->angler->firstName }} {{ $payment->angler->lastName }}</td>
                                <td>{{ date('j/m/y', strtotime ($payment->booking->arrival)) }}</td>
                                <td>{{ $payment->booking->id }}</td>
                                <td>{{ $payment->paymethod->name }}</td>
                                <td class="text-right"><a href="" class="button small">View Booking</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div><!-- End of cell-->
            @elseif($mode == 2)
            <div class="cell small-12 medium-8 large-6 medium-offset-2 large-offset-3">
                <label for="">Arrival Date</label>
                <select id=""name="">
                    <option value=""> </option> 
                </select>

                <label for="">Angler</label>
                <select id=""name="">
                    <option value=""> </option> 
                </select>

                <label for="">Amount</label>
                <input type="text" placeholder="" name="">

                <button class="button success">Save Payment</button>
            </div>
            @endif
        </div><!--end of grid-x -->
    </div><!--End of grid container-->
</div>

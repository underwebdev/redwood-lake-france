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
                                <button class="button success" wire:click="$set('mode', 2)">Manual Payment</button>
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
                <input type="text" placeholder="Search payments by name or booking ref" wire:model.live="lookup">
                <div class="table-scroll">
                    <table>
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Total</th>
                                <th>Name</th>
                             
                                <th class="text-center">Booking</th>
                                <th>Method</th>
                                <th class="text-center">Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($payments as $payment)
                            <tr>
                                <td>{{ date('j/m/y', strtotime ($payment->created_at)) }}</td>
                                <td>£{{ number_format($payment->total / 100, 2) }} </td>
                                <td>{{ $payment->angler->firstName }} {{ $payment->angler->lastName }}</td>
                           
                                <td class="text-center"><a href="/admin/booking/{{ $payment->booking->id }}">{{ date('j/m/y', strtotime ($payment->booking->arrival )) }}</a></td>
                                <td>{{ $payment->paymethod->name }}</td>
                                <td class="text-center">
                                    @if($payment->status == 1)
                                        <i class="fas fa-check-circle"></i> 
                                    @else 
                                        <span class="error"><i class="fas fa-exclamation"></i></span> 
                                    @endif
                                </td>
                                <td class="text-right"><a href="/admin/payment/{{ $payment->id }}" class="button small">View</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div><!-- End of cell-->
            @elseif($mode == 2)
            <div class="cell small-12 medium-8 large-6 medium-offset-2 large-offset-3">
                <label for="">Arrival Date
                    @error('booking')
                        <span class="error">{{ $message }}</span>
                    @enderror
                    </label>
                <select id="" wire:model.live="booking">
                    <option value="">Please Select</option>
                    @foreach($bookings as $booking)
                    <option value="{{ $booking->id }}">{{ date('j/m/y', strtotime ($booking->arrival)) }} - {{ $booking->angler->lastName }}</option>
                    @endforeach

                </select>

                <label for="">Angler
                    @error('angler')
                        <span class="error">{{ $message }}</span>
                    @enderror
                    </label>
                <select id="" wire:model.live="angler">
                    <option value="">Please Select</option>
                    @isset($selectedBooking)
                    <option value="{{ $booking->angler->id }}">{{ $booking->angler->firstName }} {{ $booking->angler->lastName }}</option>
                    @foreach($selectedBooking->guests as $guest)
                    <option value="{{ $guest->id }}">{{ $guest->firstName }} {{ $guest->lastName }}</option>
                    @endforeach
                    @endisset 
                </select>

                <label for="">Amount £
                    @error('amount')
                        <span class="error">{{ $message }}</span>
                    @enderror
                    </label>
                <input type="text" wire:model.live="amount">

                <button class="button success" wire:click="confirmTransfer">Save Payment</button>
            </div>
            @elseif($mode == 3)
            @endif
        </div><!--end of grid-x -->
    </div><!--End of grid container-->
</div>

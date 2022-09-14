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
                            <button class="button success" wire:click="$set('mode', 2)">Manual Booking</button>
                            <button class="button" wire:click="$set('mode', 3)">Placeholder</button>
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
                <input type="text" placeholder="Search by booking ref or lead party name" wire:model="lookup">
                <div class="table-scroll">
                    <table>
                        <thead>
                            <tr>
                                <th>Arrival</th>
                                <th>Ref</th>
                                <th>Lead</th>
                                <th>Balance Due</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bookings as $booking)
                            <tr>
                                <td>{{ date('j/m/y', strtotime ($booking->arrival)) }}</td>
                                <td>{{ $booking->id }}</td>
                                <td>{{ $booking->angler->firstName }} {{ $booking->angler->lastName }}</td>
                                <td>{{ Carbon\Carbon::parse($booking->arrival)->subDays($booking->priceguide->due)->format('d/m/Y') }}</td>
                                <td class="text-right"><a href="/admin/booking/{{ $booking->id }}" class="button small">View Booking</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="table-scroll">
                    <table>
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Created</th>
                                <th>Notes</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($adminplaceholders as $placeholder)
                            <tr>
                                <td>{{ date('j/m/y', strtotime ($placeholder->date)) }}</td>
                                <td>{{ date('j/m/y H:i', strtotime ($placeholder->created_at)) }}</td>
                                <td>@isset($placeholder->notes){{ $placeholder->notes }} @else N/A @endisset</td>
                                <td class="text-right"><button class="button alert small" wire:click="deletePlaceholder('{{ $placeholder->id }}')">Delete</button></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>   
            </div><!-- End of cell-->
            @elseif($mode == 2)
            <div class="cell small-12 medium-8 large-6 medium-offset-2 large-offset-3">
                <label for="">Date
                    @error('date')
                        <span class="error">{{ $message }} </label> 
                    @enderror
                    @if($invalidDate)
                        <span class="error">Selected date is not a saturday</span>
                    @endif
                </label>
                <input type="text" placeholder="" wire:model="date">

                <label for="">Angler</label>
                <select id="" wire:model="angler">
                    <option value="">Please Select</option>
                    <option value="new">New Angler</option> 
                </select>

                @if($angler == 'new')
                    <label for="">First Name</label>
                    <input type="text" placeholder="" wire:model="firstName">
                    <label for="">Last Name</label>
                    <input type="text" placeholder="" wire:model="lastName">
                    <label for="">Telephone</label>
                    <input type="text" placeholder="" wire:model="telephone">
                    <label for="">Email</label>
                    <input type="text" placeholder="" wire:model="email"> 
                    <label for="">Confirm Email
                        @error('')<span class="error">This field is required</span>@enderror
                    </label>
                    <input type="text" placeholder="" wire:model="email_confirmation">
                @endif

               

                <label for="">Telephone
                    @error('telephone')<span class="error">This field is required</span>@enderror
                </label>
                <input type="text" placeholder="" wire:model="telephone">

                <label for="">Address
                    @error('address')<span class="error">This field is required</span>@enderror
                </label>
                <input type="text" placeholder="" wire:model="address1">

                <label for="">Address 2
                    @error('address2')<span class="error">This field is required</span>@enderror
                </label>
                <input type="text" placeholder="" wire:model="address2">

                <label for="">Address 3
                    @error('address3')<span class="error">This field is required</span>@enderror
                </label>
                <input type="text" placeholder="" wire:model="address3">

                <label for="">Post Code
                    @error('postcode')<span class="error">This field is required</span>@enderror
                </label>
                <input type="text" placeholder="" wire:model="postcode">

                <label for="">Number Of Anglers (Including lead)
                    @error('anglers')<span class="error">This field is required</span>@enderror
                </label>
                <select id=""wire:model="anglers">
                    <option value="">Please select</option>
                    <option value="1">1</option> 
                    <option value="2">2</option> 
                    <option value="3">3</option> 
                    <option value="4">4</option> 
                    <option value="5">5</option> 
                </select>

                @if($validcode)
                    <p><strong>Code:</strong> {{ $voucher->code }}<br>
                    <strong>Discount:</strong> £{{ $voucher->amount / 100 }}</p>
                    <button wire:click="removeVoucher">Remove Voucher</button>
                    <br>
                @else
                <label for="">Discount Code
                    @if($invalidcode)
                        <span class="error">Code not valid for selected booking date</span>
                    @endif
                </label>
                <input type="text" wire:model.lazy="discountcode">
                @endif

                <label for="">Would you like to add 25kg pellet?</label>
                <select id="" wire:model="extra">
                    <option value="">Yes</option>
                    <option value="">No</option> 
                </select>

                <label for="">Add a Payment</label>
                <select id="" wire:model="payment">
                    <option value="">Please select</option>
                    <option value="1">Yes</option>
                    <option value="2">No</option> 
                </select>

                @if($payment == 1)
                <label for="">Payment Amount (if entered, the customer will receive an email receipt for the amount stated.)</label>
                <input type="text" placeholder="" wire:model="amount">
                @endif

                <button class="button success" wire:click="saveBooking">Create Booking</button>

            </div>
            @elseif($mode == 3)
            <div class="cell small-12 medium-8 large-6 medium-offset-2 large-offset-3">
                <label for="">Date 
                    @error('date')
                        <span class="error">{{ $message }} </label> 
                    @enderror
                    @if($invalidDate)
                        <span class="error">Selected date is not a saturday</span>
                    @endif
                <input type="text" id="datepicker" wire:model.lazy="date">
                <label for="">Notes</label>
                <textarea wire:model="notes" cols="50" rows="10"></textarea>
                <button class="button success" wire:click="savePlaceholder">Save Placeholder</button>
            </div><!-- End of cell-->

            @endif
        </div><!--end of grid-x -->
    </div><!--End of grid container-->
</div>

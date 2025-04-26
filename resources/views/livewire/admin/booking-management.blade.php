<div>
    <div class="grid-container full">
        <div class="grid-x grid-padding-x">
            <div class="cell small-12">
                <div class="admin-title-panel">
                    <div class="grid-x">
                        <div class="cell small-12 medium-6">
                            <h1>Booking #{{ $booking->id }}</h1>
                        </div>
                        <div class="cell small-12 medium-6 text-right align-self-middle">
                            @if($mode == 1)
                                @unless($booking->payments()->sum('total') >= $booking->total)
                                    <button class="button success" wire:click="$set('mode', 2)">Manual Payment</button>
                                @endunless
                                <button class="button warning" wire:click="$set('mode', 5)">Update</button>
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

    @if($booking->cancellation()->exists())
    <div class="grid-container">
        <div class="grid-x grid-padding-x">
            <div class="cell small-12">
                <div class="callout alert text-center">
                    <p><strong>Booking Cancelled</strong></p>
                </div>      
            </div><!-- End of cell-->
        </div><!--end of grid-x -->
    </div><!--End of grid container-->

    @elseif($booking->payments->where('status', 1)->sum('total') < $booking->total && Carbon\Carbon::parse($booking->arrival)->subDays($booking->priceguide->due) > Carbon\Carbon::now())
    <div class="grid-container">
        <div class="grid-x grid-padding-x">
            <div class="cell small-12">
                <div class="callout alert text-center">
                    <p><strong>Payment due in {{ Carbon\Carbon::parse($booking->arrival)->subDays($booking->priceguide->due)->diffInDays(Carbon\Carbon::now()) }} days</strong></p>
                </div>      
            </div><!-- End of cell-->
        </div><!--end of grid-x -->
    </div><!--End of grid container-->
    @elseif($booking->payments->where('status', 1)->sum('total') < $booking->total && Carbon\Carbon::today() > Carbon\Carbon::parse($booking->arrival)->subDays($booking->priceguide->due))
    <div class="grid-container">
        <div class="grid-x grid-padding-x">
            <div class="cell small-12">
                <div class="callout alert text-center">
                    <p><strong>Payment overdue</strong></p>
                </div>      
            </div><!-- End of cell-->
        </div><!--end of grid-x -->
    </div><!--End of grid container-->
    
    @endif

    <div class="grid-container">
        <div class="grid-x grid-padding-x">
            @if($mode == 1)
            <div class="cell small-12">
                <div class="table-scroll">
                <table>
                    <thead>
                        <tr>
                            <th>Arrival</th>
                            <th>Departure</th>
                            <th class="text-center">Anglers</th>
                            <th>Total</th>
                            @if($booking->voucher()->exists())
                            <th>Discount</th>
                            @endif
                            <th>Payments</th>
                            <th>Balance</th>
                            <th>Due</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ date('j/m/y H:i', strtotime ($booking->arrival)) }}</td>
                            <td>{{ date('j/m/y H:i', strtotime ($booking->departure)) }}</td>
                            <td class="text-center">{{ $booking->anglers }}</td>
                            <td>£{{ $booking->total / 100 }}</td>
                            @if($booking->voucher()->exists())
                            <td>@foreach($booking->voucher as $voucher)<span class="error">£{{ $voucher->amount / 100 }}</span> <small>({{ $voucher->code }})</small> @endforeach</td>
                            @endif
                            <td>£{{ $booking->payments->sum('total') / 100 }}</td>
                            <td>£{{ ($booking->total - $booking->payments()->sum('total')) / 100 }}</td>
                            <td>
                                @if(Carbon\Carbon::parse($booking->arrival)->subDays($booking->priceguide->due) < Carbon\Carbon::now())
                                    <span class="error">{{ Carbon\Carbon::parse($booking->arrival)->subDays($booking->priceguide->due)->format('j/m/Y') }}</span>
                                @else

                                    {{ Carbon\Carbon::parse($booking->arrival)->subDays($booking->priceguide->due)->format('j/m/Y') }}
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
                                <th>Ref</th>
                                <th>Name</th>
                                <th>Telephone</th>
                                <th>Email</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>{{ $booking->angler->ref }}</strong></td>
                                <td><strong>{{ $booking->angler->firstName }} {{ $booking->angler->lastName }}</strong></td>
                                <td><strong>{{ $booking->angler->telephone }}</strong></td>
                                <td><strong>{{ $booking->angler->user->email }}</strong></td>
                                <td class="text-right">
                                    <button class="button success small" wire:click="selectAngler('{{ $booking->angler->id }}')">Update</button>
                                </td>
                            </tr>
                            @foreach($booking->guests as $guest)
                            <tr>
                                <td>{{ $guest->ref }}</td>
                                <td>{{ $guest->firstName }} {{ $guest->lastName }}</td>
                                <td>{{ $guest->telephone }}</td>
                                <td>N/A</td>
                                <td class="text-right">
                                    <button class="button success small" wire:click="selectAngler('{{ $guest->id }}')">Update</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                    @if($booking->guests()->count() < 4)
                    <div class="cell small-12 text-center">
                        <button class="button success" wire:click="$set('mode', 3)">Add Angler</button>  
                    </div><!-- End of cell-->
                    @endif
                    <div class="table-scroll">
                        <table>
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Payee</th>
                                    <th>Amount</th>
                                    <th>Method</th>
                                    <th class="text-center">Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($booking->payments as $payment)
                                <tr>
                                    <td>{{ date('j/m/y', strtotime ($payment->created_at)) }}</td>
                                    <td>{{ $payment->angler->firstName }} {{ $payment->angler->lastName }}</td>
                                    <td>£{{ $payment->total / 100 }}</td>
                                    <td>{{ $payment->paymethod->name }}</td>
                                    <td class="text-center">
                                        @if($payment->status == 1)
                                            <i class="fas fa-check-circle"></i> 
                                        @else 
                                            <span class="error"><i class="fas fa-exclamation"></i></span> 
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        @if($payment->status != 1)
                                            <a href="/admin/payment/{{ $payment->id }}" class="button success small">View Payment</a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="table-scroll">
                        <table>
                            <thead>
                                <tr>
                                    <th>Email</th>
                                    <th>Recipient</th>
                                    <th>Sent</th>
                                    <th>Delivered</th>
                                    <th>Opened</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($booking->maillogs as $log)
                                <tr>
                                    <td>{{ Str::ucFirst($log->type) }}</td>
                                    <td>{{ $log->recipient }}</td>
                                    <td>{{ date('j/m/y H:i', strtotime ($log->sent)) }}</td>
                                    <td>
                                        @isset($log->delivered)
                                            {{ date('j/m/y H:i', strtotime ($log->delivered)) }}
                                        @else
                                            <strong>Not delivered</strong>
                                        @endisset
                                    </td>
                                    <td>
                                        @isset($log->opened)
                                            {{ date('j/m/y H:i', strtotime ($log->opened)) }}
                                        @endisset
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="text-center">
                        <button class="button success" wire:click="dispatchBookingConfirmation">Booking Confirmation</button>
                        <button class="button success" wire:click="dispatchPaymentReminder">Payment Reminder</button>
                        <button class="button success" wire:click="dispatchOverdueReminder">Overdue Reminder</button>
                        <button class="button success" wire:click="dispatchGuestReminder">Guest Reminder</button>
                        <button class="button success" wire:click="dispatchWelcomeEmail">Welcome Email</button>
                        <button class="button success" wire:click="dispatchReviewRequest">Review Request</button>

                    </div>
                </div>
            </div><!-- End of cell-->
            @elseif($mode == 2)
            <div class="cell small-12 medium-8 large-6 medium-offset-2 large-offset-3">
                <label for="">Angler
                @error('angler')
                    <span class="error">{{ $message }}</span>
                @enderror
                </label>
                <select id="" wire:model="angler">
                    <option value="">Please Select</option>
                    <option value="{{ $booking->angler->id }}">{{ $booking->angler->firstName }} {{ $booking->angler->lastName }}</option>
                    @foreach($booking->guests as $guest)
                    <option value="{{ $guest->id }}">{{ $guest->firstName }} {{ $guest->lastName }}</option>
                    @endforeach
                 
                </select>

                <label for="">Amount £
                    @error('amount')
                        <span class="error">{{ $message }}</span>
                    @enderror
                    </label>
                <input type="text" wire:model="amount">

                <button class="button success" wire:click="confirmTransfer">Save Payment</button>
            </div>
            @elseif($mode == 3)
            <div class="cell small-12 medium-8 large-6 medium-offset-2 large-offset-3">
                <h5 class="info-bar">Create Angler</h5>
                <p>Please add the names and contact details for all members of your party</p>
                <label for="">First Name
                    @error('firstName')<span class="error">{{ $message }}</span>@enderror
                </label>
                <input type="text" placeholder="" wire:model="firstName">
                <label for="">Last Name
                    @error('lastName')<span class="error">{{ $message }}</span>@enderror
                </label>
                <input type="text" placeholder="" wire:model="lastName">

                <label for="">Telephone
                    @error('telephone')<span class="error">{{ $message }}</span>@enderror
                </label>
                <input type="text" placeholder="" wire:model="telephone">

                <label for="">Email
                    @error('email')<span class="error">{{ $message }}</span>@enderror
                </label>
                <input type="text" placeholder="" wire:model="email">
                <label for="">Confirm Email</label>
                <input type="text" placeholder="" wire:model="email_confirmation">

                <button class="button success" wire:click="saveAngler">Add Angler</button>

            </div>

            @elseif($mode == 4)
            <div class="cell small-12 medium-8 large-6 medium-offset-2 large-offset-3">
                <h5 class="info-bar">Update Angler</h5>
                <p>Updating details for {{ $selectedAngler->firstName }} {{ $selectedAngler->lastName }}</p>
                <label for="">First Name</label>
                <input type="text" placeholder="" wire:model="firstName">
                <label for="">Last Name</label>
                <input type="text" placeholder="" wire:model="lastName">

                <label for="">Telephone</label>
                <input type="text" placeholder="" wire:model="telephone">
                <div class="button-group">
                    <button class="button success" wire:click="saveAnglerChanges">Save Angler</button>
                    @unless($booking->angler_id == $selectedAngler->id) 
                    <button class="button alert" wire:click="deleteAngler">Delete Angler</button>
                    @endunless
                </div>
                  
            </div><!-- End of cell-->

            @elseif($mode == 5)
            <div class="cell small-12 medium-10 medium-offset-1">
                <div class="grid-x grid-padding-x">
                    <div class="cell small-12 medium-6 text-center">
                        <div class="action-tile">
                            <i class="far fa-edit"></i>
                        </div>
                        <button class="button expanded" wire:click="modifyInfo">Update Info</button>  
                    </div><!-- End of cell-->
                    <div class="cell small-12 medium-6 text-center">
                        <div class="action-tile">
                            <i class="fas fa-sync-alt"></i>
                        </div>
                        <button class="button expanded warning" wire:click="moveBooking">Move Booking</button>  
                    </div><!-- End of cell-->
                    <div class="cell small-12 medium-6 text-center medium-offset-3">
                        <div class="action-tile">
                            <i class="fas fa-ban"></i>
                        </div>
                        <button class="button expanded alert" wire:click="$set('mode', 8)">Cancel Booking</button>  
                    </div><!-- End of cell-->
                </div><!--end of grid-x -->
            </div><!-- End of cell-->
            @elseif($mode == 6)
            <div class="cell small-12">
                <div class="grid-x grid-padding-x">
                    <div class="cell small-12 medium-6">
                        <select id="" wire:model="selectedMonth">
                            <option value="">Select Month</option>
                            <option value="01">January</option>
                            <option value="02">Febuary</option>
                            <option value="03">March</option>
                            <option value="04">April</option>
                            <option value="05">May</option>
                            <option value="06">June</option>
                            <option value="07">July</option>
                            <option value="08">August</option>
                            <option value="09">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select>
                    </div><!-- End of cell-->
                    <div class="cell small-12 medium-6">
                        <select id="" wire:model="selectedYear">
                            <option value="">Select Year</option>
                            <option value="{{ Carbon\Carbon::now()->format('Y') }}">{{ Carbon\Carbon::now()->format('Y') }}</option>
                            <option value="{{ Carbon\Carbon::now()->addyear()->format('Y') }}">{{ Carbon\Carbon::now()->addyear()->format('Y') }}</option>  
                        </select>   
                    </div><!-- End of cell-->
                </div><!--end of grid-x -->
                <div class="grid-x grid-padding-x">
                @if($filteredRange)
                <div class="cell small-12 text-center">
                    <div class="grid-x grid-padding-x">
                        @if($filteredDates->count() > 0)
                            @foreach($filteredDates as $date)
                                @if(Carbon\Carbon::parse($date['date'])->format('Y-m') == Carbon\Carbon::parse($selectedDate)->format('Y-m'))
                                <div class="cell small-6 medium-4 ml-3 text-center">
                                    
                                    <div class="date-container">
                                        <div class="date-tile">
                                            <p>{{ Carbon\Carbon::parse($date['date'])->format('F') }}</p>
                                            <h3>{{ Carbon\Carbon::parse($date['date'])->format('j') }}</h3>
                                            <p>{{ Carbon\Carbon::parse($date['date'])->format('Y') }}</p>
                                        </div>
                                        @if($bookings->where('arrival', Carbon\Carbon::parse($date['date'])->format('Y-m-d'))->count() > 0)
                                            <button class="button disabled expanded" disabled>Unavailable</button>
                                        @elseif($placeholders->where('date', Carbon\Carbon::parse($date['date'])->format('Y-m-d'))->count() > 0)
                                            <button class="button disabled expanded" disabled>Unavailable</button>
                                        @else
                                            <button class="button success expanded" wire:click="changeDate('{{ $date['date'] }}')">Select Date</button>
                                        
                                        @endif
                                    </div>
                               
                                </div><!-- End of cell--> 
                                @endif
                            @endforeach
                        @else
                            <div class="cell small-12 text-center">
                                <br>
                                <p><strong>No dates available</strong></p>      
                            </div><!-- End of cell-->
                        @endif  
                    </div><!--end of grid-x -->
                </div>
                @endif 
            </div><!-- End of cell-->
            @elseif($mode == 7)
            <div class="cell small-12 medium-10 medium-offset-1">
                <label for="">Total Cost</label>
                <input type="text" placeholder="" wire:model="total">

                <label for="">Lead Angler</label>
                <select id="" wire:model="lead">
                    <option value="{{ $booking->angler->id }}">{{ $booking->angler->firstName }} {{ $booking->angler->lastName }}</option>
                    @foreach($booking->guests as $guest)
                    <option value="{{ $guest->id }}">{{ $guest->firstName }} {{ $guest->lastName }}</option>
                    @endforeach
                    <option value="new">New Lead</option> 
                </select>

                @if($lead == 'new')
                <label for="">First Name</label>
                <input type="text" placeholder="" wire:model="firstName">
                <label for="">Last Name</label>
                <input type="text" placeholder="" wire:model="lastName">
                <label for="">Telephone</label>
                <input type="text" placeholder="" wire:model="telephone">
                <label for="">Email</label>
                <input type="text" placeholder="" wire:model="email">
                @endif

                <div class="button-group">
                    <button class="button success expanded" wire:click="saveBookingChanges">Save Changes</button>
                    <button class="button alert expanded" wire:click="$set('mode', 5)">Cancel</button>
                </div>

            @elseif($mode == 8)
            <div class="cell small-12 medium-10 medium-offset-1 text-center">
                <h1>Are you sure you wish to cancel this booking?</h1>
                <p>Once cancelled this date will be availble for others to book</p>
                <div class="button-group">
                    <button class="button success" wire:click="cancelBooking">Cancel Booking</button>
                    <button class="button alert" wire:click="$set('mode', 5)">Go Back</button>
                </div>
            </div>
            @elseif($mode == 9)
            <div class="cell small-12 medium-10 medium-offset-1 text-center">
                <h1>Are you sure you wish to move this booking?</h1>
                <p>Moving booking from <strong>{{ date('j/m/y', strtotime ($booking->arrival)) }}</strong> to <strong>{{ date('j/m/y', strtotime ($newdate)) }}</strong>.
                <p>This change will take effect immediately.</p>
                <div class="button-group text-center">
                    <button class="button success" wire:click="modifyBooking">Update Booking</button>
                    <button class="button alert" wire:click="$set('mode', 5)">Go Back</button>
                </div>
              
            </div>
            @endif
        </div><!--end of grid-x -->
    </div><!--End of grid container-->
</div>

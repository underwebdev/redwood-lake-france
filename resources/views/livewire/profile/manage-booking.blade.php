<div>
    <div class="grid-container">
        <div class="grid-x grid-padding-x">
            @if($mode == 1)
            <div class="cell small-12">
                <h5 class="info-bar">Bookings</h5>
                <div class="table-scroll">
                    <table>
                        <thead>
                            <tr>
                                <th>Arrival</th>
                                <th>Departure</th>
                                <th class="text-center">Anglers</th>
                                <th>Total</th>
                                <th>Payments</th>
                                <th>Balance</th>
                                <th>Due</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ date('j/m/y H:i', strtotime ($booking->arrival)) }}</td>
                                <td>{{ date('j/m/y H:i', strtotime ($booking->departure)) }}</td>
                                <td class="text-center">{{ $booking->anglers }}</td>
                                <td>£{{ $booking->total / 100 }}</td>
                                <td>£{{ $booking->payments->sum('total') / 100 }}</td>
                                <td>£{{ ($booking->total - $booking->payments()->sum('total')) / 100 }}</td>
                                <td>{{ Carbon\Carbon::parse($booking->arrival)->subDays($booking->priceguide->due)->format('j/m/Y') }}</td>
                                <td class="text-right"><button class="button success small" wire:click="$set('mode', 4)">Make Payment</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <h5 class="info-bar">Anglers</h5>
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
                @if($booking->guests()->count() < 5)
                <button class="button success" wire:click="$set('mode', 2)">Add Angler</button>
                @endif
                          
            </div><!-- End of cell-->
            @elseif($mode == 2)
            <div class="cell small-12 medium-8 large-6 medium-offset-2 large-offset-3">
                <h5 class="info-bar">Create Angler</h5>
                <p>Please add the names and contact details for all members of your party</p>
                <label for="">First Name</label>
                <input type="text" placeholder="" wire:model="firstName">
                <label for="">Last Name</label>
                <input type="text" placeholder="" wire:model="lastName">

                <label for="">Telephone</label>
                <input type="text" placeholder="" wire:model="telephone">
                <button class="button success" wire:click="saveAngler">Add Angler</button>

            </div>
            @elseif($mode == 3)
            <div class="cell small-12 medium-8 large-6 medium-offset-2 large-offset-3">
                <h5 class="info-bar">Update Angler</h5>
                <p>Updating details for {{ $selectedAngler->firstName }} {{ $selectedAngler->lastName }}</p>
                <label for="">First Name</label>
                <input type="text" placeholder="" wire:model="firstName">
                <label for="">Last Name</label>
                <input type="text" placeholder="" wire:model="lastName">

                <label for="">Telephone</label>
                <input type="text" placeholder="" wire:model="telephone">
                <button class="button success" wire:click="saveAnglerChanges">Save Angler</button>
                  
            </div><!-- End of cell-->
            @elseif($mode == 4)
            <div class="cell small-12 medium-8 large-6 medium-offset-2 large-offset-3">
                <div class="center-border">
                    <div class="center-border-header text-center">
                        <img src="/img/logo/RedwoodLogo.png" width="200px">
                    </div>
                    <div class="center-border-content">
                        <label for="">Payment Method
                            @error('paymentMethod')<span class="error">{{ $message }}</span>@enderror
                        </label>
                        <select id="" wire:model="paymentMethod">
                            <option value="">Please Select</option>
                            <option value="1">Bank Transfer</option>
                            <option value="2">Credit/Debit</option> 
                        </select>

                        <p><strong>Final balance of £{{ ($booking->total - $booking->payments()->sum('total')) / 100 }} due on or before {{ Carbon\Carbon::parse($booking->arrival)->subDays($booking->priceguide->due)->format('j/m/Y') }}</strong></p>

                        <label for="">Payment Amount
                            @error('paymentAmount')<span class="error">{{ $message }}</span>@enderror
                        </label>
                        <select id="" wire:model="paymentAmount">
                            <option value="">Please Select</option>
                            <option value="1">Remaining Balance</option>
                            <option value="2">Other Amount</option> 
                        </select>

                        @if($paymentAmount == 2)
                        <label for="">Enter Amount £
                            @error('amountToPay')<span class="error">{{ $message }}</span>@enderror
                        </label>
                        <input type="text" placeholder="" wire:model="amountToPay">
                        @endif

                        <div class="button-group">
                            <button class="button success expanded" wire:click="calculatePayment">Proceed To Payment</button>
                            <button class="button alert expanded" wire:click="back">Go Back</button>
                        </div>
                    </div>
                </div>
            </div>
            @elseif($mode == 5)
            <div class="cell small-12 medium-8 large-6 medium-offset-2 large-offset-3">
                <div class="center-border">
                    <div class="center-border-header text-center">
                        <img src="/img/logo/RedwoodLogo.png" width="200px">
                    </div>
                    <div class="center-border-content">
                        <h4 class="text-center"><strong>Confirm Your Payment <br>£{{ $amountToPay / 100}}</strong></h4>
                        <p><strong>Payee:</strong> Account Name<br>
                        <strong>Reference:</strong> {{ $booking->id }}-{{ Auth::user()->angler->lastName }}<br>
                        <strong>Account Number:</strong> 00000000<br>
                        <strong>Sort Code:</strong> 00-00-00</p>

                        <div class="grid-x">
                            @error('confirm')
                            <div class="cell small-12">
                                <span class="error">Please confirm you have transfered funds to the account listed above</span>      
                            </div><!-- End of cell-->
                            @enderror
                            <div class="cell small-1">
                                <input wire:model="confirm" id="checkbox1" type="checkbox" value="1" required> 
                            </div>
                            <div class="cell small-11">
                                <label for="confirm"><span class="error">I confirm I have ALREADY transfered £{{ $amountToPay / 100 }} to the above bank account.</span></label>
                            </div>
                        </div>
                        <br>
                        <p><strong>You must transfer funds <u>BEFORE</u> you click confirm below, we cannot automatically take funds from your bank account. You will receive a payment receipt once we confirm we have received the funds.</strong></p>

                        <div class="button-group">
                        @if($confirm)
                        <button class="button success expanded" wire:click="confirmTransfer">Confirm Transfer</button>
                        @endif
                        <button class="button alert expanded" wire:click="backToMethod">Go Back</button>
                        </div>
                        
                    </div>
                </div>
            </div>

            @elseif($mode == 6)
            <div class="cell small-12 medium-8 large-6 medium-offset-2 large-offset-3">
                <div class="center-border">
                    <div class="center-border-header text-center">
                        <img src="/img/logo/RedwoodLogo.png" width="200px">
                    </div>
                    <div class="center-border-content">
                        <h4 class="text-center">Payment</h4>

                            <h5 class="text-center"><strong>£{{ $intent->amount / 100 }}</strong></h5>
                            <form id="payment-form" class="text-left">
                                <div class="card-body">  
                                <label>Cardholder Name</label>
                                <input id="card-holder-name" type="text" class="report-input" required>

                                <!-- Stripe Elements Placeholder -->
                                <div id="card-element" style="height: 50px; border-radius: 8px; line-height:27px; padding-top:13px;"></div>

                                <div id="card-errors" class="text-center" role="alert"></div>

                                <button id="card-button" class="button expanded radius success" data-secret="{{ $intent->client_secret }}">
                                <strong>Confirm Payment £{{ $intent->amount / 100 }}</strong>
                                </button>
                                </div>
                            </form>
                            
                            <button class="button alert hollow expanded" wire:click="backToMethod">Go Back</button>

                            @include('scripts.stripe')
                        
                    </div>
                </div>
            </div>
            @elseif($mode == 7)







            @endif
            
        </div><!--end of grid-x -->
    </div><!--End of grid container-->
</div>

<div>
    <div class="grid-container">
        <div class="grid-x grid-padding-x">
            <div class="cell small-12 medium-8 large-6 medium-offset-2 large-offset-3">
                <div class="center-border">
                    <div class="center-border-header">
                        <h3 class="text-center">Redwood Lake Booking</h3>
                    </div>
                    <div class="center-border-content">
                        @if($step == 1)
                            <h4 class="text-center">Booking Date<br> {{ Carbon\Carbon::parse($date)->format('j/m/y') }}</h4>

                            <p>Please read and confirm you have read the booking terms & conditions before proceeding with your booking.</p>

                            <p>Once clicking "start booking" your chosen date will be held for 15 mins, whilst you enter your details and make payment.</p> 

                            <p>Please Note: If the payment process is not completed in the 15 minuite time frame, then the date will become available again for other anglers to book.</p>

                            <input type="checkbox" wire:model="terms"> <strong>Please confirm you have read all the <a href="/booking-terms">booking terms and conditions</a> by checking the box to the left before proceeding.</strong>
                            <br><br>

                            <div class="button-group">
                                @if($terms)
                                <button class="button success expanded" wire:click="start">Start Booking</button>
                                @endif
                                <a href="/booking" class="button hollow alert expanded">Go Back</a>
                            </div>

                        @elseif($step == 2)
                            <h4 class="text-center">Lead Booking Details</h4>
                
                            <h5 class="text-center">
                                {{ gmdate("i:s", Carbon\Carbon::parse($expiry)->diffInSeconds()) }}
                            </h5>
                   
                            
                            <label for="">First Name
                                @error('firstName')<span class="error">This field is required</span>@enderror
                            </label>
                            <input type="text" placeholder="" wire:model="firstName">

                            <label for="">Last Name
                                @error('lastName')<span class="error">This field is required</span>@enderror
                            </label>
                            <input type="text" placeholder="" wire:model="lastName">

                            <label for="">Email
                                @error('email')<span class="error">This field is required</span>@enderror
                            </label>
                            <input type="text" placeholder="" wire:model="email">

                            <label for="">Confirm Email
                                @error('')<span class="error">This field is required</span>@enderror
                            </label>
                            <input type="text" placeholder="" wire:model="">

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
                            <div class="button-group">
                                <button class="button success expanded" wire:click="steptwo">Next Step 2/3</button>
                                <button class="button alert hollow expanded" wire:click="cancel">Cancel</button>
                            </div>
                        @elseif($step == 3)
                            <h4 class="text-center">Booking Details</h4>
                            
                                <h5 class="text-center">
                                    {{ gmdate("i:s", Carbon\Carbon::parse($expiry)->diffInSeconds()) }}
                                </h5>
                          
                            <p class="text-center">Please review the details you have entered</p>
                            <p><strong>Arriving:</strong>  {{ Carbon\Carbon::parse($date)->format('D jS M Y') }} - 14:00<br>
                            <strong>Leaving:</strong>  {{ Carbon\Carbon::parse($date)->addDays(7)->format('D jS M Y') }} - 11:00<br>
                            <strong>Anglers:</strong> {{ $anglers }} <br>
                            <strong>Name:</strong>  {{ $firstName }} {{ $lastName }}<br>
                            <strong>Email:</strong>  {{ $email }}<br>
                            <strong>Telephone:</strong>  {{ $telephone }}<br>
                            <strong>Address:</strong>  {{ $address1 }}, {{ $address2 }} @if($address3) {{ $address3 }} @endif {{ $postcode }}</p>


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

                            <label for="">Payment</label>
                            <select id=""wire:model="payment">
                                <option value="">Please select</option>
                                <option value="1">Pay Deposit</option>
                                <option value="2">Pay Full Balance</option> 
                            </select>

                            <div class="button-group">
                                @isset($payment)
                                <button class="button expanded success" wire:click="calculate">Proceed To Payment</button>
                                @endisset
                                <button class="button expanded alert hollow" wire:click="$set('step', 2)">Go Back</button>
                            </div>

                        @elseif($step == 4)
                            <h4 class="text-center">Payment</h4>

                            
                                <h5 class="text-center"><strong>£{{ $intent->amount / 100 }}</strong></h5>
                                @if($payment == 1)
                                    <p class="text-center">The remaining balance of £.... is due by {{ date('j/m/y', strtotime ($duedate)) }}</p>
                                @endif

                            
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
                            
                            <button class="button alert hollow expanded" wire:click="$set('step', 3)">Go Back</button>

                            @include('scripts.stripe')
                            
                        @endif
                    </div>
                </div>  
            </div><!-- End of cell-->
        </div><!--end of grid-x -->
    </div><!--End of grid container-->
</div>

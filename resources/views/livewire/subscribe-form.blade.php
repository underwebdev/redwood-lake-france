<div>
<div class="grid-container">
    <div class="grid-x grid-padding-x">
        <div class="cell small-12 medium-8 large-6 medium-offset-2 large-offset-3">
            @if($sent) 
                <h4 class="text-center">Thank You For Subscribing!</h4>
            @else
                <h4 class="text-center">Subscribe For Updates</h4>
                <p>We occasionally have weeks become available at short notice, these will usually be offered at a discounted rate, to get email notifications when these places become available enter your name and email below.</p>
                <label for="">First Name
                    @error('firstName')<span class="error">{{ $message }}</span>@enderror
                </label>
                <input type="text" placeholder="" wire:model="firstName">
                <label for="">Email
                    @error('email')<span class="error">{{ $message }}</span>@enderror
                </label>
                <input type="text" placeholder="" wire:model="email">
                <button class="button expanded secondary hollow" wire:click="subscribe">Get Notified</button>
            @endif
        </div><!-- End of cell-->
    </div><!--end of grid-x -->
</div><!--End of grid container-->
</div>

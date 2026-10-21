<div>
    @if(Auth::user()->reset == 1)
    <div class="grid-x grid-padding-x">
    <div class="cell small-12">
        <div class="callout alert text-center">
            <p><strong>You must update your password before continuing.</strong></p>
        </div>
    </div>
    </div><!--end of grid-x -->
    @endif 
    <div class="grid-container">
        <div class="grid-x grid-padding-x">
            <div class="cell small-12 medium-8 large-6 medium-offset-2 large-offset-3">
            @if($mode == 1)
               
                    <h5 class="info-bar">Personal Information</h5>
                    {{ Auth::user()->angler->firstName }} {{ Auth::user()->angler->lastName }}<br>
                    <strong>Angler Ref:</strong> {{ Auth::user()->angler->ref }}
                    <p>
                    <h5 class="info-bar">Contact Information</h5>
                    <p><strong>Email:</strong> {{ Auth::user()->email }}<br>
                        <strong>Telephone:</strong> {{ Auth::user()->angler->telephone }}</p>
                    <button class="button success" wire:click="$set('mode', 3)">Update Details</button>
                

                
                    <h5 class="info-bar">Mailing List</h5>
                    @if($maillist == 1)
                        <p>You are subscribed to the mailing list for updates</p>
                        <button class="button alert" wire:click="maillist('0')">Opt Out</button>
                    @else
                        <p>you are not on the mailing list to be notified about latest news and discounts</p>
                        <button class="button success" wire:click="maillist('1')">Opt In</button>
                    @endif
               

                
                    <h5 class="info-bar">Password</h5>
                    <p><strong>Password:</strong> ******</p>
                    <button class="button success" wire:click="$set('mode', 2)">Update Password</button>

               
    
            @elseif($mode == 2)
                
                    <label for="">New Password (min 6 characters)
                        @error('password')<span class="error">{{ $message }} </span>@enderror
                    </label>
                    <input type="password" placeholder="" wire:model.live="password">
                    <label for="">Confirm Password
                        @error('password_confirmed')<span class="error">{{ $message }} </span>@enderror
                    </label>
                    <input type="password" placeholder="" wire:model.live="password_confirmation">
                    <div class="button-group">
                        <button class="button success" wire:click="savePassword">Save Password</button>
                        <button class="button alert" wire:click="$set('mode', 1)">Cancel</button>
                    </div>
               
            @elseif($mode == 3)
              
                    <label for="">New Email
                        @error('email')<span class="error">{{ $message }} </span>@enderror
                    </label>
                    <input type="text" placeholder="" wire:model.live="email">
                    <label for="">Confirm email
                        @error('email_confirmed')<span class="error">{{ $message }} </span>@enderror
                    </label>
                    <input type="text" placeholder="" wire:model.live="email_confirmation">

                    <label for="">Telephone
                        @error('telephone')<span class="error">{{ $message }}</span>@enderror
                    </label>
                    <input type="text" wire:model.live="telephone">
                    <div class="button-group">
                        <button class="button success" wire:click="saveContact">Save Password</button>
                        <button class="button alert" wire:click="$set('mode', 1)">Cancel</button>
                    </div>
              

            @endif
            </div>
          
        </div><!--end of grid-x -->
    </div><!--End of grid container-->
</div>

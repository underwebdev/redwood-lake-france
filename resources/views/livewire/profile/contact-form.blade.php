<div>
    <div class="grid-container">
        <div class="grid-x grid-padding-x">
            <div class="cell small-12 medium-8 large-6 medium-offset-2 large-offset-3">
                @if($sent)
                    <h4 class="text-center">Message Sent!</h4>
                    <p class="text-center">Thank you for your message. We aim to reply within 24 hours</p>
                @else
                    <h5 class="info-bar">Contact Us</h5>
                    <p>If you have any queries or questions about your booking or in general please use the form below to write a message, your account information will automatically be attach to the message</p>

                    <label for="profile-contact-type">Enquiry Type</label>
                    <select id="profile-contact-type" wire:model.live="type">
                        <option value="0">General</option>
                        @foreach($bookings as $booking)
                        <option value="{{ $booking->id }}">Booking {{ date('j/m/y', strtotime ($booking->arrival)) }}</option>
                        @endforeach 
                    </select>

                    <label for="profile-contact-message">Message
                        @error('message')<span class="error">{{ $message }}</span>@enderror
                    </label>
                    <textarea id="profile-contact-message" wire:model.live="message" cols="50" rows="10"></textarea>

                    <button class="button success" wire:click="sendMessage">Send Message</button>
                @endif
                  
            </div><!-- End of cell-->
        </div><!--end of grid-x -->
    </div><!--End of grid container-->
</div>

<div>
    @if($sent)

        <h4 class="text-center">Message Sent!</h4>
        <p class="text-center">Thank you for your message. We aim to reply within 24 hours</p>

    @else
        <label for="contact-name">Name
            @error('name')<span class="error">{{ $message }}</span>@endif
        </label>
        <input type="text" id="contact-name" placeholder="" wire:model="name">

        <label for="contact-email">Email
            @error('email')<span class="error">{{ $message }}</span>@endif
        </label>
        <input type="text" id="contact-email" placeholder="" wire:model="email">

        <label for="contact-telephone">Telephone
            @error('telephone')<span class="error">{{ $message }}</span>@endif
        </label>
        <input type="text" id="contact-telephone" placeholder="" wire:model="telephone">

        <label for="contact-message">Message
            @error('message')<span class="error">{{ $message }}</span>@endif
        </label>
        <textarea id="contact-message" wire:model="message" cols="50" rows="10"></textarea>

        <div class="grid-x grid-padding-x">
            <div class="cell small-12 medium-1 ">
                <input type="checkbox" id="contact-gdpr" wire:model="gdpr" value="1"> 
            </div>
            <div class="cell small-10 medium-11 ">
                @error('gdpr')<span class="error">{{ $message }}</span>@endif
                <label id="contact-gdpr-label" for="contact-gdpr" class="middle">I consent to this website storing this message and my details so that I can be contacted regarding my enquiry</label>
            </div>
        </div>

        <input type="checkbox" wire:model="fax" value="1" style="display:none !important" tabindex="-1" autocomplete="off">

        <button class="button success large" wire:click="send">Send Message</button>
    @endif
</div>

<?php

namespace App\Http\Livewire\Profile;

use Livewire\Component;
use App\Models\Contact;
use Auth;

class ContactForm extends Component
{
    public $sent;
    public $type = 0;
    public $message;
    public $selectedBooking;

    public function sendMessage()
    {
        $data = $this->validate([
            'type' => 'required|numeric',
            'message' => 'required'
        ]);

        if($data['type'] == 0)
        {
            $booking = Null;
        } else {
            $booking = $data['type'];
        }

        Contact::create([
            'name' => Auth::user()->angler->firstName . ' ' . Auth::user()->angler->lastName,
            'email' => Auth::user()->email,
            'telephone' => Auth::user()->angler->telephone,
            'message' => $data['message'],
            'booking_id' => $booking
        ]);

        $this->reset();

        $this->sent = true;


    }
    public function render()
    {
        return view('livewire.profile.contact-form', [
            'bookings' => Auth::user()->angler->bookings
        ]);
    }
}

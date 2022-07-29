<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Contact;

class ContactForm extends Component
{
    public $name;
    public $email;
    public $telephone;
    public $message;
    public $gdpr;
    public $fax;
    public $sent;

    public function send()
    {
        $data = $this->validate([
            'name' => 'required',
            'email' => 'required|email',
            'telephone' => 'required|numeric',
            'message' => 'required',
            'gdpr' => 'required'
        ]);

        if($this->fax == '1')
        {
            $this->sent = true;
        } else {

            Contact::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'telephone' => $data['telephone'],
                'message' => $data['message']
            ]);

            $this->sent = true;

        }
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}

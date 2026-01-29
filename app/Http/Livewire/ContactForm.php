<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactAlert;

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

            $contact = Contact::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'telephone' => $data['telephone'],
                'message' => $data['message']
            ]);

            if($data['email'] == 'joe@underweb.co.uk')
            {
                Mail::to('joe@underweb.co.uk')->send(new ContactAlert($contact));
            } else {

                Mail::to('info@redwoodlake.co.uk')->send(new ContactAlert($contact));
            }
            $this->sent = true;

        }
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}

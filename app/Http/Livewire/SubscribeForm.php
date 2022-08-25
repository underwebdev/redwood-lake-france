<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Maillist;
use Illuminate\Support\Str;

class SubscribeForm extends Component
{
    public $sent;
    public $firstName;
    public $email;

    public function subscribe()
    {
        $data = $this->validate([
            'firstName' => 'required',
            'email' => 'required|email'
        ]);

        Maillist::updateOrCreate([
            'email' => $data['email'],
        ],[
            'firstName' => Str::ucfirst($data['firstName']),
            'email' => $data['email'],
            'subscribed' => 1
        ]);

        $this->sent = true;


    }
    public function render()
    {
        return view('livewire.subscribe-form');
    }
}

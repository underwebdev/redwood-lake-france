<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Carbon\Carbon;

class PayDeposit extends Component
{
    public $step = 1;
    public $terms;
    public $expiry;
    public $firstName;
    public $lastName;
    public $email;
    public $telephone;
    public $address1;
    public $address2;
    public $address3;
    public $postcode;
    public $anglers;
    public $payment;


    public function start()
    {
        $this->expiry = Carbon::now()->addMinutes(15);
        $this->step = 2;
    }

    public function steptwo()
    {
        $data = $this->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required',
            'telephone' => 'required',
            'address1' => 'required',
            'address2' => 'required',
            'address3' => 'nullable',
            'postcode' => 'required',
            'anglers' => 'required|numeric'
        ]);

        $this->step = 3;
    }

    public function stepthree()
    {
        $this->step = 4;
    }

    public function cancel()
    {
        redirect()->to('booking');
    }

    public function render()
    {
        return view('livewire.pay-deposit');
    }
}

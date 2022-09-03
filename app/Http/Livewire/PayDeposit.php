<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\Placeholder;
use App\Models\Voucher;
use App\Jobs\PlaceholderCleanup;

class PayDeposit extends Component
{
    public $date;
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

    public $placeholder;
    public $discountcode;
    public $validcode;
    public $invalidcode;
    public $voucher;


    public function start()
    {
        $this->expiry = Carbon::now()->addMinutes(15);

        $this->placeholder = Placeholder::create([
            'date' => $this->date,
            'expiry' => $this->expiry,
            'session_id' => 1
        ]);

        session(['placeholder' => $this->placeholder->id]);

        $placeholder = $this->placeholder;

        PlaceholderCleanup::dispatch($placeholder)->delay(Carbon::now()->addMinutes(15));

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

    public function updatedDiscountcode()
    {
        if(Voucher::where('code', $this->discountcode)->exists())
        {
            $this->invalidcode = false;
            $this->validcode = true;
            $this->voucher = Voucher::where('code', $this->discountcode)->first();
        } else {
            $this->invalidcode = true;
            $this->validcode = false;
        }
    }

    public function removeVoucher()
    {
        $this->reset(['invalidcode', 'voucher', 'discountcode']);
        $this->validcode = false;
    }

    public function stepthree()
    {
        $this->step = 4;
    }

    public function cancel()
    {
        if($this->placeholder)
        {
            $this->placeholder->delete();
        }

        redirect()->to('booking');
    }

    public function render()
    {
        if($this->expiry)
        {
            if(Carbon::now() > $this->expiry)
            {
                redirect()->to('/booking')->with('failure', 'Time limit expired!');
            }
        }
        

        return view('livewire.pay-deposit');
    }
}

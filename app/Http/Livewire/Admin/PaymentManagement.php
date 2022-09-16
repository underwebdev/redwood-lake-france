<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\Mail;
use App\Mail\PaymentReceipt;

class PaymentManagement extends Component
{
    public $payment;

    public function confirmPayment()
    {
        $this->payment->update([
            'status' => 1
        ]);

        Mail::to($this->payment->angler->user->email)->send(new PaymentReceipt($this->payment));

        session()->flash('success', 'Payment Confirmed');
    }
    public function render()
    {
        return view('livewire.admin.payment-management');
    }
}

<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class PaymentManagement extends Component
{
    public $payment;

    public function confirmPayment()
    {
        $this->payment->update([
            'status' => 1
        ]);

        session()->flash('success', 'Payment Confirmed');
    }
    public function render()
    {
        return view('livewire.admin.payment-management');
    }
}

<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Payment;

class PaymentDashboard extends Component
{
    public $mode = 1;
    public $lookup;

    public function render()
    {
        return view('livewire.admin.payment-dashboard',[
            'payments' => Payment::latest()->paginate(50)
        ]);
    }
}

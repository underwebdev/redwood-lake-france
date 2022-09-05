<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Booking;
use App\Models\Payment;

class AdminDashboard extends Component
{
    public $mode = 1;
    
    public function render()
    {
        return view('livewire.admin.admin-dashboard',[
            'bookings' => Booking::latest()->limit(5),
            'payments' => Payment::latest()->limit(10)
        ]);
    }
}

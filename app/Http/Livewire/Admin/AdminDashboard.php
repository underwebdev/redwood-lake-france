<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Booking;
use App\Models\Payment;
use Carbon\Carbon;

class AdminDashboard extends Component
{
    public $mode = 1;
    
    public function render()
    {
        return view('livewire.admin.admin-dashboard',[
            'bookings' => Booking::latest()->limit(5)->get(),
            'payments' => Payment::latest()->limit(10)->get(),
            'current' => Booking::where('departure', '>', Carbon::now())->where('arrival', '<', Carbon::now())->first(),
            'next' => Booking::where('arrival', '>', Carbon::now())->orderBy('arrival', 'asc')->first()
        ]);
    }
}

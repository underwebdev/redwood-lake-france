<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Booking;
use Carbon\Carbon;

class BookingDashboard extends Component
{
    public $mode = 1;
    public $lookup;

    public function render()
    {
        return view('livewire.admin.booking-dashboard',[
            'bookings' => Booking::where('arrival', '>', Carbon::today()->subDays(7))->orderBy('arrival', 'desc')->get()
        ]);
    }
}

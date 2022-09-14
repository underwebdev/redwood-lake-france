<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Payment;
use App\Models\Booking;
use Carbon\Carbon;

class PaymentDashboard extends Component
{
    public $mode = 1;
    public $lookup;
    public $booking;
    public $angler;
    public $amount;

    public function updatedBooking()
    {
        $this->selectedBooking = Booking::findOrFail($this->booking);
    }

    public function confirmTransfer()
    {
        $data = $this->validate([
            'booking' => 'required',
            'angler' => 'required',
            'amount' => 'required|numeric'
        ]);

        Payment::create([
            'booking_id' => $data['booking'],
            'angler_id' => $data['angler'],
            'total' => $data['amount'] * 100,
            'net' => $data['amount'] * 100,
            'paymethod_id' => 2,
            'status' => 1
        ]);

        $this->reset();

        session()->flash('success', 'Bank Transfer Confirmed!');
    }

    public function back()
    {
        $this->reset();
    }

    public function render()
    {
        return view('livewire.admin.payment-dashboard',[
            'payments' => Payment::latest()->paginate(50),
            'bookings' => Booking::where('arrival', '>', Carbon::now())->orderBy('arrival', 'asc')->get()
        ]);
    }
}

<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Booking;
use App\Models\Placeholder;
use Carbon\Carbon;

class BookingDashboard extends Component
{
    public $mode = 1;
    public $lookup;
    public $date;
    public $notes;
    public $invalidDate;
    public $unavailableDate;
    public $angler;
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
    public $discountcode;
    public $validcode;
    public $invalidcode;
    public $voucher;
    public $duedate;

    public function savePlaceholder()
    {
        $data = $this->validate([
            'date' => 'required|date',
            'notes' => 'nullable'
        ]);

        if($this->invalidDate == false)
        {
            Placeholder::create([
                'date' => Carbon::parse($data['date'])->format('Y-m-d'),
                'notes' => $data['notes'],
                'session_id' => 1
            ]);

            $this->reset();

            session()->flash('success', 'Placeholder Created!');
        }

    }

    public function deletePlaceholder($id)
    {   
        Placeholder::findOrFail($id)->delete();

        $this->reset();

        session()->flash('success', 'Placeholder Deleted!');
    }

    public function updatedDate()
    {
        $date = Carbon::parse($this->date);

        if($date->dayOfWeek != 6)
        {
            $this->invalidDate = true;
        } else {
            $this->invalidDate = false;
        }

    }

    public function updatedMode()
    {
        $this->dispatchBrowserEvent('activate-datepicker');
    }

    public function back()
    {
        $this->reset();
    }

    public function render()
    {
        return view('livewire.admin.booking-dashboard',[
            'bookings' => Booking::where('arrival', '>', Carbon::today()->subDays(7))->orderBy('arrival', 'desc')->get(),
            'adminplaceholders' => Placeholder::whereNull('expiry')->where('date', '>', Carbon::today())->get(),
            'placeholders' => Placeholder::where('date', '>', Carbon::today())->get()
        ]);
    }
}

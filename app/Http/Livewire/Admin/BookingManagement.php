<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingAmendment;
use App\Mail\PaymentReceipt;
use App\Models\Booking;
use App\Models\Placeholder;
use App\Models\Angler;
use App\Models\Payment;
use App\Models\Priceguide;
use Carbon\Carbon;
use Carbon\CarbonInterval;

class BookingManagement extends Component
{
    public $booking;
    public $mode = 1;
    public $angler;
    public $amount;
    public $selectedAngler;
    public $firstName;
    public $lastName;
    public $telephone;

    public $bookingdates;
    public $bookingyears;
    public $selectedMonth;
    public $selectedYear;
    public $filteredRange;
    public $firstdate;
    public $latestdate;
    public $selectedDate;
    public $filteredDates;
    public $newdate;

    public $lead;
    public $total;
    public $email;


    public function confirmTransfer()
    {
        $data = $this->validate([
            'angler' => 'required',
            'amount' => 'required|numeric'
        ]);

        $payment = $this->booking->payments()->create([
            'angler_id' => $data['angler'],
            'total' => $data['amount'] * 100,
            'net' => $data['amount'] * 100,
            'paymethod_id' => 2,
            'status' => 1
        ]);

        Mail::to($payment->angler->user->email)->send(new PaymentReceipt($payment));

        $this->resetExcept('booking');

        $this->booking->refresh();

        session()->flash('success', 'Bank Transfer Confirmed!');
    }

    public function saveAngler()
    {
        $data = $this->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'telephone' => 'required|numeric'
        ]);

        $ref = Angler::latest()->pluck('ref')->first();

        $angler = Angler::create([
            'firstName' => $data['firstName'],
            'lastName' => $data['lastName'],
            'telephone' => $data['telephone'],
            'ref' => $ref + 1
        ]);

        $this->booking->guests()->attach($angler->id);

        $this->booking->refresh();

        $this->resetExcept('booking');

        session()->flash('success', 'Angler Saved!');
    }

    public function selectAngler($id)
    {
        $this->selectedAngler = Angler::findOrFail($id);

        $this->firstName = $this->selectedAngler->firstName;
        $this->lastName = $this->selectedAngler->lastName;
        $this->telephone = $this->selectedAngler->telephone;

        $this->mode = 4;
    }

    public function saveAnglerChanges()
    {
        $data = $this->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'telephone' => 'required|numeric'
        ]);

        $this->selectedAngler->update([
            'firstName' => $data['firstName'],
            'lastName' => $data['lastName'],
            'telephone' => $data['telephone']
        ]);

        $this->booking->refresh();

        $this->resetExcept('booking');

        session()->flash('success', 'Angler Updated');
    }

    public function deleteAngler()
    {
        $this->booking->guests()->detach($this->selectedAngler->id);

        $this->resetExcept('booking');

        $this->booking->refresh();

        session()->flash('success', 'Angler Removed!');
    }

    public function cancelBooking()
    {
        $this->booking->cancellation->create([
            'date' => $this->booking->arrival
        ]);

        $this->booking->update([
            'arrival' => '1970-01-01 00:00:00',
            'departure' => '1970-01-01 00:00:00'
        ]);

        $this->booking->refresh();

        $this->resetExcept('booking');
    }

    public function modifyInfo()
    {
        $this->lead = $this->booking->angler->id;
        $this->total = $this->booking->total / 100;
        $this->mode = 7;
    }

    public function saveBookingChanges()
    {
        $data = $this->validate([
            'total' => 'required|numeric',
            'lead' => 'required|numeric'
        ]);

        $this->booking->update([
            'total' => $data['total'] * 100,
            'angler_id' => $data['lead'] 
        ]);

        $this->resetExcept('booking');

        $this->booking->refresh();

        session()->flash('success', 'Booking Updated!');
    }

    public function moveBooking()
    {
        $this->firstdate = Priceguide::where('end', '>', Carbon::today())->orderBy('start', 'asc')->pluck('start')->first();
        $this->latestdate = Priceguide::orderBy('end', 'desc')->pluck('end')->first();

        $this->bookingdates = Collect(CarbonInterval::days(7)->toPeriod($this->firstdate, $this->latestdate));
        $this->bookingyears = Collect(CarbonInterval::years(1)->toPeriod($this->firstdate, $this->latestdate));

        $this->mode = 6;
    }

    public function updatedSelectedMonth()
    {
        if($this->selectedYear > 0 && $this->selectedMonth > 0)
        {
            $this->selectedDate = '01-' . $this->selectedMonth . '-' . $this->selectedYear;
            
            $filtered = Collect([]);

            foreach($this->bookingdates as $date)
            {
                $my = Carbon::parse($date)->format('Y-m');

                if($my == $this->selectedYear . '-' . $this->selectedMonth)
                {

                    $filtered->push(['date' => $date]);
                }
            }

            $this->filteredDates = $filtered;

            $this->filteredRange = true;
            
        }
        
    }

    public function updatedSelectedYear()
    {
        if($this->selectedMonth && $this->selectedYear > 0)
        {
            $this->selectedDate = '01-' . $this->selectedMonth . '-' . $this->selectedYear;
            
            $filtered = Collect([]);

            foreach($this->bookingdates as $date)
            {
                $my = Carbon::parse($date)->format('Y-m');

                if($my == $this->selectedYear . '-' . $this->selectedMonth)
                {
                    $filtered->push(['date' => $date]);
                }
            }

            $this->filteredDates = $filtered;
            $this->filteredRange = true;
        }
    }

    public function changeDate($date)
    {
        $this->newdate = $date;
        $this->mode = 9;
    }

    public function modifyBooking()
    {
        
        $this->booking->update([
            'arrival' => Carbon::parse($this->newdate)->format('Y-m-d') . ' 14:00:00',
            'departure' => Carbon::parse($this->newdate)->addDays(7)->format('Y-m-d') . ' 11:00:00'
        ]);

        Mail::to($this->booking->angler->user->email)->send(new BookingAmendment($this->booking));

        $this->resetExcept('booking');

        $this->booking->refresh();

        session()->flash('success', 'Booking Date Changed!');

    }

    public function back()
    {
        $this->resetExcept('booking');
    }

    public function render()
    {
        return view('livewire.admin.booking-management',[
            'bookings' => Booking::where('arrival', '>', Carbon::today()->subDays(7))->orderBy('arrival', 'desc')->get(),
            'placeholders' => Placeholder::where('date', '>', Carbon::today())->get()
        ]);
    }
}

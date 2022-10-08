<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\AccountCreated;
use App\Mail\BookingReceipt;
use App\Models\Booking;
use App\Models\Placeholder;
use App\Models\Angler;
use App\Models\Priceguide;
use App\Models\User;
use Carbon\Carbon;

class BookingDashboard extends Component
{
    public $mode = 1;
    public $lookup;
    public $date;
    public $notes;
    public $invalidDate;
    public $unavailableDate;
    public $angler = 'new';
    public $firstName;
    public $lastName;
    public $email;
    public $email_confirmation;
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
    public $amount;

    public function saveBooking()
    {
        $data = $this->validate([
            'date' => 'required',
            'angler' => 'required',
            'anglers' => 'required',
            'firstName' => 'required_if:angler,new',
            'lastName' => 'required_if:angler,new',
            'telephone' => 'required_if:angler,new',
            'email' => 'required_if:angler,new',
            'address1' => 'required_if:angler,new',
            'address2' => 'nullable',
            'address3' => 'nullable',
            'postcode' => 'required_if:angler,new',
            'payment' => 'required',
            'amount' => 'required_if:payment,1',
        ]);

        if($data['angler'] == 'new')
        {
            $newPWD = Str::random(8);

            $user = User::create([
                'email' => $data['email'],
                'password' => bcrypt($newPWD),
                'permission' => '2',
                'reset' => '1'
            ]);

            $ref = Angler::latest()->pluck('ref')->first();

            $angler = $user->angler()->create([
                'firstName' => $data['firstName'],
                'lastName' => $data['lastName'],
                'telephone' => $data['telephone'],
                'ref' => $ref + 1
            ]);

            $angler->address()->create([
                'address1' => $data['address1'],
                'address2' => $data['address2'],
                'address3' => $data['address3'],
                'postcode' => $data['postcode']
            ]);

            Mail::to($user->email)->send(new AccountCreated($user));
        } else {
            $angler = Angler::find($data['angler']);

            $user = User::where('email', $angler->user->email)->first();
        }

        $bookingdate = Carbon::parse($data['date'])->toDateString();

        $priceguide = Priceguide::where('end', '>=', $bookingdate)->where('start', '<=', $bookingdate)->first();

        $booking = $user->angler->bookings()->create([
            'anglers' => $data['anglers'],
            'arrival' => $bookingdate . ' 14:00:00',
            'departure' => Carbon::parse($bookingdate)->addDays(7)->format('Y-m-d') . ' 11:00:00',
            'total' => $priceguide->price,
            'priceguide_id' => $priceguide->id
        ]);

        if($data['payment'] == 1)
        {
            $booking->payments()->create([
                'angler_id' => $user->angler->id,
                'total' => $data['amount'] * 100,
                'net' => $data['amount'] * 100,
                'paymethod_id' => 2,
                'status' => 1
            ]);

            if($angler->user()->exists())
            {
                Mail::to($user->email)->send(new BookingReceipt($booking));
            }
        }

        $this->reset();

        session()->flash('success', 'Booking Created!');
    }

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

        $booking = Carbon::parse($this->date)->toDateString();

        if($date->dayOfWeek != 6)
        {
            $this->invalidDate = true;
        } else {
            $this->invalidDate = false;
        }

        if(Booking::where('arrival', $booking . ' 14:00:00')->exists() OR Placeholder::where('date', $booking)->exists())
        {
            $this->unavailableDate = true;
        } else {
            $this->unavailableDate = false;
        }

        if(Priceguide::where('end', '>=', $booking)->where('start', '<=', $booking)->doesntExist())
        {
            $this->unavailableDate = true;
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
        $lookup = $this->lookup;

        return view('livewire.admin.booking-dashboard',[
            'bookings' => Booking::where('arrival', '>', Carbon::today()->subDays(7))->join('anglers', 'bookings.angler_id', '=', 'anglers.id')->orderBy('arrival', 'asc')->when($lookup, function ($query) use ($lookup) {
                    return $query->where('lastName', 'like', '%' . $lookup . '%')->orWhere('firstName', 'like', '%' . $lookup . '%')->orWhere('ref', 'like', '%' . $lookup . '%');
                })->get(),
            'adminplaceholders' => Placeholder::whereNull('expiry')->where('date', '>', Carbon::today())->get(),
            'placeholders' => Placeholder::where('date', '>', Carbon::today())->get(),
            'guests' => Angler::all()
        ]);
    }
}

<?php

namespace App\Http\Livewire\Profile;

use Livewire\Component;
use Stripe\{Stripe, PaymentIntent};
use Illuminate\Support\Facades\Mail;
use App\Mail\PaymentNotification;
use App\Models\Payment;
use App\Models\Angler;
use Auth;

class ManageBooking extends Component
{
    public $booking;
    public $mode = 1;
    public $paymentMethod;
    public $paymentAmount;
    public $amountToPay = 0;
    public $confirm;

    public $firstName;
    public $lastName;
    public $telephone;
    public $selectedAngler;

    public $connect;
    public $pk;
    protected $intent = [];

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

        $this->reset(['mode', 'firstName', 'lastName', 'telephone']);

        session()->flash('success', 'Angler Saved!');
    }

    public function selectAngler($id)
    {
        $this->selectedAngler = Angler::findOrFail($id);

        $this->firstName = $this->selectedAngler->firstName;
        $this->lastName = $this->selectedAngler->lastName;
        $this->telephone = $this->selectedAngler->telephone;

        $this->mode = 3;
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

        $this->reset(['mode', 'firstName', 'lastName', 'telephone']);

        session()->flash('success', 'Angler Updated');
    }

    public function calculatePayment()
    {
        $data = $this->validate([
            'paymentMethod' => 'required',
            'paymentAmount' => 'required',
            'amountToPay' => 'numeric|required_if:paymentAmount,2',
        ]);

        $totalBalance = $this->booking->total - $this->booking->payments->sum('total');

        if($data['paymentAmount'] == 1)
        {
            $amountToPay = $totalBalance;
        } elseif($data['paymentAmount'] == 2)
        {
            $amountToPay = $data['amountToPay'] * 100;
        }
        
        if($amountToPay > $totalBalance)
        {
            session('flash' ,'Payment amount cannot be greater than the total balance remaining');
        } elseif($data['paymentMethod'] == 1) {
            $this->amountToPay = $amountToPay;
            $this->mode = 5;

        } elseif($data['paymentMethod'] == 2) {
            $percentage = 1.6;
            $fee = 10;
            $applicationFee = ($percentage / 100) * $amountToPay + $fee;

            Stripe::setApiKey(config('services.stripe.secret'));

            $this->pk = config('services.stripe.key');
            $this->connect = config('services.stripe.connect');

            $this->intent = PaymentIntent::create([
                'amount' => $amountToPay,
                'currency' => 'gbp',
                'payment_method_types' => ['card'],
                'setup_future_usage' => 'on_session',
                'application_fee_amount' => round($applicationFee),
                'metadata' => [
                    'type' => 'payment',
                    'booking_id' => $this->booking->id,
                    'angler_id' => Auth::user()->angler->id
                ],
                'statement_descriptor_suffix' => 'Redwood Lake'
            ], ['stripe_account' => $this->connect]);
            $this->mode = 6;

        }
    }

    public function confirmTransfer()
    {
        $data = $this->validate(['confirm' => 'required']);

        $payment = $this->booking->payments()->create([
            'angler_id' => Auth::user()->angler->id,
            'total' => $this->amountToPay,
            'net' => $this->amountToPay,
            'paymethod_id' => 2
        ]);

        Mail::to('joe@underweb.co.uk')->send(new PaymentNotification($payment));

        $this->mode = 7;
    }

    public function backToMethod()
    {
        $this->mode = 4;
        $this->amountToPay = $this->amountToPay / 100;
    }

    public function back()
    {
        $this->reset(['amountToPay', 'paymentAmount','paymentMethod', 'mode']);
    }

    public function render()
    {
        $paymentIntent = $this->intent;

        return view('livewire.profile.manage-booking',[
            'intent' => $paymentIntent
        ]);
    }
}

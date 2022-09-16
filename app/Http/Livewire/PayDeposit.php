<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Stripe\{Stripe, PaymentIntent};
use App\Models\Placeholder;
use App\Models\Voucher;
use App\Models\Priceguide;
use App\Jobs\PlaceholderCleanup;
use Carbon\Carbon;
use Session;

class PayDeposit extends Component
{
    public $date;
    public $step = 1;
    public $terms;
    public $expiry;
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

    public $placeholder;
    public $discountcode;
    public $validcode;
    public $invalidcode;
    public $voucher;
    public $duedate;
    public $balance;
    public $connect;
    public $pk;
    protected $intent = [];


    public function start()
    {
        $this->expiry = Carbon::now()->addMinutes(15);

        $this->placeholder = Placeholder::create([
            'date' => $this->date,
            'expiry' => $this->expiry,
            'session_id' => 1
        ]);

        session(['placeholder' => $this->placeholder->id]);

        $placeholder = $this->placeholder;

        PlaceholderCleanup::dispatch($placeholder)->delay(Carbon::now()->addMinutes(15));

        $this->step = 2;
    }

    public function steptwo()
    {
        $data = $this->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|confirmed',
            'telephone' => 'required',
            'address1' => 'required',
            'address2' => 'required',
            'address3' => 'nullable',
            'postcode' => 'required',
            'anglers' => 'required|numeric'
        ]);

        $this->step = 3;
    }

    public function updatedDiscountcode()
    {
        if(Voucher::where('code', $this->discountcode)->exists())
        {
            $this->invalidcode = false;
            $this->validcode = true;
            $this->voucher = Voucher::where('code', $this->discountcode)->first();
        } else {
            $this->invalidcode = true;
            $this->validcode = false;
        }
    }

    public function removeVoucher()
    {
        $this->reset(['invalidcode', 'voucher', 'discountcode']);
        $this->validcode = false;
    }

    public function calculate()
    {
        $data = $this->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required',
            'telephone' => 'required',
            'address1' => 'required',
            'address2' => 'required',
            'address3' => 'nullable',
            'postcode' => 'required',
            'anglers' => 'required|numeric',
            'payment' => 'required|numeric'
        ]);

        $bookingdate = Carbon::parse($this->date)->toDateString();

        $priceguide = Priceguide::where('end', '>=', $bookingdate)->where('start', '<=', $bookingdate)->first();

        $total = $priceguide->price;
        $deposit = $priceguide->deposit;

        if($this->validcode)
        {
            $total = $total - $this->voucher->amount;
            $voucher = $this->voucher->idl
        } else {
            $voucher = 0;
        }

        if($data['payment'] == 1)
        {
            $toPay = $deposit;
            $this->duedate = Carbon::parse($this->date)->subdays($priceguide->due);
            $this->balance = $total - $deposit;

        } elseif($data['payment'] == 2)
        {
            $toPay = $total;
        }

        $percentage = 1.6;
        $fee = 10;
        $applicationFee = ($percentage / 100) * $toPay + $fee;

        Stripe::setApiKey(config('services.stripe.secret'));

        $this->pk = config('services.stripe.key');
        $this->connect = config('services.stripe.connect');

        $this->intent = PaymentIntent::create([
            'amount' => $toPay,
            'currency' => 'gbp',
            'payment_method_types' => ['card'],
            'setup_future_usage' => 'on_session',
            'application_fee_amount' => round($applicationFee),
            'metadata' => [
                'type' => 'booking',
                'firstName' => $data['firstName'],
                'lastName' => $data['lastName'],
                'email' => $data['email'],
                'telephone' => $data['telephone'],
                'address1' => $data['address1'],
                'address2' => $data['address2'],
                'address3' => $data['address3'],
                'postcode' => $data['postcode'],
                'arrival' => $bookingdate,
                'anglers' => $data['anglers'],
                'total' => $total,
                'priceguide' => $priceguide->id,
                'voucher' => $voucher
            ],
            'statement_descriptor_suffix' => 'Redwood Lake'
        ], ['stripe_account' => $this->connect]);

        $this->step = 4;
    }

    public function cancel()
    {
        if($this->placeholder)
        {
            $this->placeholder->delete();
        }

        redirect()->to('booking');
    }

    public function expired()
    {
        if($this->expiry)
        {
            if(Carbon::now() > $this->expiry)
            {
                redirect()->to('/booking')->with('failure', 'Time limit expired!');
            }
        }
    }

    public function render()
    {
        if($this->expiry)
        {
            if(Carbon::now() > $this->expiry)
            {
                redirect()->to('/booking')->with('failure', 'Time limit expired!');
            }
        }
        
        $paymentIntent = $this->intent;

        return view('livewire.pay-deposit',[
            'intent' => $paymentIntent
        ]);
    }
}

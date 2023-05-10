<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\AccountCreated;
use App\Mail\BookingReceipt;
use App\Mail\BookingNotification;
use App\Mail\BookingUpdated;
use App\Mail\PaymentReceipt;
use App\Mail\PaymentNotification;
use App\Models\Payout;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\User;
use App\Models\Angler;
use App\Models\Voucher;
use Carbon\Carbon;
use Stripe\{Stripe};

class WebhookController extends Controller
{
    public function handle(Request $request)
    {
        $key = config('services.stripe.signature');
        $endpoint_secret = $key;

        $payload = @file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];

        try
        {
            $event = \Stripe\Webhook::constructEvent($payload, $sig_header, $endpoint_secret);
        } 
        catch(\UnexpectedValueException $e)
        {
                // Invalid payload
                return response()->json([
                    'message' => 'Invalid payload',
                ], 200);
        }
        catch(\Stripe\Exception\SignatureVerificationException $e)
        {
            // Invalid signature
            return response()->json([
                'message' => 'Invalid signature',
            ], 200);
        }

        $account = config('services.stripe.connect');

        if($event->account == $account)
        {
            if($event->type == "charge.succeeded")
            {

                $intent = $event->data->object;

                $stripe = Stripe::setApiKey(config('services.stripe.secret'));

                $balancetransaction = \Stripe\BalanceTransaction::retrieve(
                    $intent->balance_transaction,
                    ['stripe_account' => $connect]
                );

                $paid = $balancetransaction->amount;
                $net = $balancetransaction->net;

                if($intent->metadata->type == 'booking')
                {

                    if(User::where('email', $intent->metadata->email)->exists())
                    {
                        $user = User::where('email', $intent->metadata->email)->first();


                    } else {
                        $newPWD = Str::random(8);

                        $user = User::create([
                            'email' => $intent->metadata->email,
                            'password' => bcrypt($newPWD),
                            'permission' => '2',
                            'reset' => '1'
                        ]);

                        $ref = Angler::latest()->pluck('ref')->first();

                        $user->angler()->create([
                            'firstName' => Str::of($intent->metadata->firstName)->ucfirst(),
                            'lastName' => Str::of($intent->metadata->lastName)->ucfirst(),
                            'telephone' => $intent->metadata->telephone,
                            'ref' => $ref + 1
                        ]);

                        $data = [
                            'firstName' => $user->angler->firstName,
                            'password' => $newPWD,
                            'email' => $user->email
                        ];

                        Mail::to($user->email)->send(new AccountCreated($data));
                    }

                    $booking = $user->angler->bookings()->create([
                        'anglers' => $intent->metadata->anglers,
                        'arrival' => $intent->metadata->arrival . ' 14:00:00',
                        'departure' => Carbon::parse($intent->metadata->arrival)->addDays(7)->format('Y-m-d') . ' 11:00:00',
                        'total' => $paid,
                        'priceguide_id' => $intent->metadata->priceguide
                    ]);

                    $user->angler->address()->updateOrCreate([
                        'angler_id' => $user->angler->id ],[
                        'address1' => $intent->metadata->address1,
                        'address2' => $intent->metadata->address2,
                        'address3' => $intent->metadata->address3,
                        'postcode' => $intent->metadata->postcode
                    ]);

                    if(Payment::where('transaction_id', $intent->id)->doesntExist())
                    {
                        $booking->payments()->create([
                            'angler_id' => $user->angler->id,
                            'total' => $paid,
                            'net' => $net,
                            'transaction_id' => $intent->id,
                            'paymethod_id' => 1,
                            'status' => 1
                        ]);

                        if($intent->metadata->voucher > 0)
                        {
                            $voucher = Voucher::find($intent->metadata->voucher);

                            $voucher->update([
                                'used' => $voucher->used + 1
                            ]);

                            if($voucher->used >= $voucher->limit)
                            {
                                $voucher->update([
                                    'active' => 0
                                ]);
                            }

                            $booking->voucher()->attach($voucher->id);  
                        }

                        Mail::to($user->email)->send(new BookingReceipt($booking));
                        Mail::to('info@redwoodlake.co.uk')->send(new BookingNotification($booking));
                    }
                } elseif($intent->metadata->type == 'payment')
                {
                    $angler = Angler::find($intent->metadata->angler_id);
                    $booking = Booking::find($intent->metadata->booking_id);

                    if(Payment::where('transaction_id', $intent->id)->doesntExist())
                    {
                        $payment = $booking->payments()->create([
                            'angler_id' => $angler->id,
                            'total' => $paid,
                            'net' => $net,
                            'transaction_id' => $intent->id,
                            'paymethod_id' => 1,
                            'status' => 1
                        ]);

                        Mail::to($angler->user->email)->send(new PaymentReceipt($payment));
                        Mail::to('info@redwoodlake.co.uk')->send(new BookingNotification($booking));
                    }

                }

            }

            if ($event->type == "payment_intent.payment_failed")
            {
                
            }

            if($event->type == 'payout.created')
            {
                $payout = $event->data->object;
                $due = Carbon::createFromTimestamp($payout->arrival_date)->toDateString();

                $newpayout = Payout::create([
                    'payout' => $payout->id,
                    'amount' => $payout->amount,
                    'created' => Carbon::createFromTimestamp($payout->created)->toDateString(),
                    'due' => $due,
                    'status' => $payout->status,
                    'account' => $event->account
                ]);

                $stripe = Stripe::setApiKey(config('services.stripe.secret'));

                $bt = \Stripe\BalanceTransaction::all(
                    ['payout' => $payout->id],
                    ['stripe_account' => $event->account]
                );

                foreach($bt['data'] as $d)
                {
                    if($d['type'] == 'charge')
                    {
                        if(Payment::where('transaction_id', $d['source'])->exists())
                        {
                            $payment = Payment::where('transaction_id', $d['source'])->first();

                            $newpayout->payments()->attach($payment->id);

                        } elseif(Payment::where('transaction_id', $d['source'])->exists())
                        {
                            $payment = Payment::where('transaction_id', $d['source'])->first();

                            $newpayout->payments()->attach($payment->id);
                        }
                    }   
                }
            }

            if($event->type == 'payout.updated')
            {
                $payout = $event->data->object;

                Payout::where('payout', $payout->id)->update([
                    'status' => $payout->status
                ]);
            }

            if($event->type == 'payout.paid')
            {
                $payout = $event->data->object;

                Payout::where('payout', $payout->id)->update([
                    'status' => $payout->status
                ]);
            } 

        } else {
            return response()->json([
                    'message' => 'Account id doesnt not match',
                ], 200);

        }   
    }
}
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
use Carbon\Carbon;
use Stripe\{Stripe};

class WebhookController extends Controller
{
    public function handle(Request $request)
    {
        $key = env('STRIPE_WEBHOOK_SECRET');
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

        if ($event->type == "charge.succeeded")
        {

            $intent = $event->data->object;

            if($intent->metadata->type == 'booking')
            {

                $paid = $intent->amount;
                $percentage = 3;
                $fee = 30;
                $applicationFee = ($percentage / 100) * $paid + $fee;
                $roundedFee = round($applicationFee); 
                $net = $paid - $roundedFee;

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
                        'firstName' => $intent->metadata->firstName,
                        'lastName' => $intent->metadata->lastName,
                        'telephone' => $intent->metadata->telephone,
                        'ref' => $ref + 1
                    ]);

                    $data = [
                        'firstName' => $user->angler->firstName,
                        'password' => $plainPWD,
                        'email' => $newPWD
                    ];

                    Mail::to($user->email)->send(new AccountCreated($user));
                }

                $booking = $user->angler->bookings()->create([
                    'address1' => $intent->metadata->address1,
                    'address2' => $intent->metadata->address2,
                    'address3' => $intent->metadata->address3,
                    'postcode' => $intent->metadata->postcode,
                    'anglers' => $intent->metadata->anglers,
                    'arrival' => $intent->metadata->arrival . ' 14:00:00',
                    'departure' => Carbon::parse($intent->metadata->arrival)->addDays(7)->format('Y-m-d') . ' 11:00:00',
                    'total' => $intent->metadata->total,
                    'priceguide_id' => $intent->metadata->priceguide
                ]);

                $booking->payments()->create([
                    'angler_id' => $user->angler->id,
                    'total' => $paid,
                    'net' => $net,
                    'transaction_id' => $intent->id,
                    'paymethod_id' => 1,
                    'status' => 1
                ]);

                Mail::to($user->email)->send(new BookingReceipt($booking));
                Mail::to('joe@underweb.co.uk')->send(new BookingNotification($booking));
            }

            if($intent->metadata->type == 'payment')
            {
                $booking = booking::find($intent->metadata->ref);

                $paid = $intent->amount;
                $percentage = 3;
                $fee = 30;
                $applicationFee = ($percentage / 100) * $paid + $fee;
                $roundedFee = round($applicationFee); 
                $net = $paid - $roundedFee;

                $payment = $booking->payments()->create([
                    'angler_id' => $intent->metadata->angler,
                    'total' => $paid,
                    'net' => $net,
                    'transaction_id' => $intent->id,
                    'paymethod_id' => 1,
                    'status' => 1
                ]);

                $angler = Angler::findOrFail($intent->metadata->angler);

                Mail::to($angler->user->email)->send(new PaymentReceipt($payment));
                Mail::to($booking->angler->user->email)->send(new BookingUpdated($payment));
                
                Mail::to('toby@croxleyhallfisheries.co.uk')->cc('scott@croxleyhallfisheries.co.uk')->send(new PaymentNotification($payment));
            }

        }

        if ($event->type == "payment_intent.payment_failed")
        {
            //Payment failed to be completed
            
            $intent = $event->data->object;
            $error_message = $intent->last_payment_error ? $intent->last_payment_error->message : "";

            if($intent->metadata->type == 'guest')
            {
                $booking = Booking::firstOrFail($intent->metadata->booking_id);

                $booking->guests()->delete();

                $booking->delete();

            }   

            //Mail::to($booking->member->email)->send(new PaymentFailed ($order));

            return response()->json([
                'intentId' => $intent->id,
                'message' => 'Payment failed. send and email: '.$error_message
            ], 400); 
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
                    if(Ticket::where('transaction_id', $d['source'])->exists())
                    {
                        $ticket = Ticket::where('transaction_id', $d['source'])->first();

                        $newpayout->tickets()->attach($ticket->id);

                    } elseif(Booking::where('transaction_id', $d['source'])->exists())
                    {
                        $booking = Booking::where('transaction_id', $d['source'])->first();

                        $newpayout->bookings()->attach($booking->id);
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
        
    }
}
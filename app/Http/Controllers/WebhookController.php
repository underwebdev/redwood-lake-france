<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Payout;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\User;

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

            if($intent->metadata->type == 'deposit')
            {
                $booking = Booking::find($intent->metadata->booking_id);

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
                }

                $booking->update([
                    'total' => $intent->amount,
                    'transaction_id' => $intent->id,
                    'paymethod_id' => 1,
                    'status' => 1,
                    'net' => $net
                ]);

                Mail::to($booking->member->user->email)->send(new GuestReceipt($booking));
                Mail::to('toby@croxleyhallfisheries.co.uk')->cc('scott@croxleyhallfisheries.co.uk')->send(new GuestNotification($booking));
            }

            if($intent->metadata->type == 'payment')
            {
                $member = Member::find($intent->metadata->member);
                $ticket = Option::find($intent->metadata->ticket);
                $season = Season::where('status_id', 1)->first();

                $paid = $intent->amount;
                $percentage = 3;
                $fee = 30;
                $applicationFee = ($percentage / 100) * $paid + $fee;
                $roundedFee = round($applicationFee); 
                $net = $paid - $roundedFee;

                $ticket = $member->tickets()->create([
                    'season_id' => $season->id,
                    'syndicate_id' => $ticket->syndicate->id,
                    'option_id' => $ticket->id,
                    'paymethod_id' => 1,
                    'amount' => $intent->amount,
                    'net' => $net,
                    'payment_confirmed' => 1,
                    'transaction_id' => $intent->id
                ]);

                if($ticket->syndicate_id == 1)
                {
                    if($ticket->member->croxleywaiting()->exists())
                    {
                        $ticket->member->croxleywaiting()->delete();
                    }
                }

                if($member->syndicate_id == $ticket->syndicate_id)
                {
                    Mail::to($ticket->member->user->email)->send(new MembershipReceipt($ticket));

                } else {
                    Mail::to($ticket->member->user->email)->send(new PaymentReceipt($ticket));
                }
                
                Mail::to('toby@croxleyhallfisheries.co.uk')->cc('scott@croxleyhallfisheries.co.uk')->send(new MembershipNotification($ticket));
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

                    }elseif(Booking::where('transaction_id', $d['source'])->exists())
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
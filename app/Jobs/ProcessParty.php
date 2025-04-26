<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\AnglerAccount;
use App\Models\Booking;
use App\Models\Angler;
use Carbon\Carbon;

class ProcessParty implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $guest;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Angler $guest, Booking $booking)
    {
        $this->guest = $guest;
        $this->booking = $booking;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        
        
            $newPWD = Str::random(8);

            $user = $this->guest->user()->create([
                'email' => $this->guest->email,
                'password' => bcrypt($newPWD),
                'permission' => '2',
                'reset' => '1'
            ]);

            $data = [
                'firstName' => $user->angler->firstName,
                'email' => $user->email,
                'password' => $newPWD
            ];

            $mailable = Mail::to($user->email)->send(new AnglerAccount($data));

            $this->booking->maillogs()->create([
                'type' => 'account-created',
                'recipient' => $user->email,
                'webhook_id' => $mailable->getMessageId(),
                'sent' => Carbon::now()
            ]);

        
    }
}

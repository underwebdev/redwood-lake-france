<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeEmail;
use App\Mail\AnglerAccount;
use App\Models\Booking;
use App\Models\User;
use Carbon\Carbon;

class ProcessParty implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $booking;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = [
            'firstName' => $this->booking->angler->firstName,
            'arrival' => $this->booking->arrival,
            'departure' => $this->booking->departure,
        ];

        Mail::to($this->booking->angler->user->email)->send(new WelcomeEmail($data));

        foreach($this->booking->guests as $guest)
        {
            if(User::where('email', $guest->email)->doesntExist())
            {
                $newPWD = Str::random(8);

                $user = User::create([
                    'email' => $guest->email,
                    'password' => bcrypt($newPWD),
                    'permission' => '2',
                    'reset' => '1'
                ]);

                $data = [
                    'firstName' => $user->angler->firstName,
                    'email' => $user->email,
                    'password' => $newPWD
                ];

                Mail::to($user->email)->send(new AnglerAccount($data));
            }

            $data = [
                'firstName' => $this->guest->firstName,
                'arrival' => $this->booking->arrival,
                'departure' => $this->booking->departure,
            ];

            Mail::to($user->email)->send(new WelcomeEmail($data));
        }
    }
}

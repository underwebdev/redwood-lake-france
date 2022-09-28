<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReviewRequest;
use App\Models\Booking;
use Carbon\Carbon;

class RequestReview implements ShouldQueue
{
    public $booking;

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

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
            'email' => $this->booking->angler->user->email
        ];

        Mail::to($data['email'])->send(new ReviewRequest($data));

        foreach($this->booking->guests as $guest)
        {
            $data = [
                'firstName' => $guest->firstName,
                'email' => $guest->email
            ];

            Mail::to($data['email'])->send(new ReviewRequest($data));
        }
    }
}

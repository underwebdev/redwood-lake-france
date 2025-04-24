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

class SendReviewRequest implements ShouldQueue
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
        $mailable = Mail::to($this->booking->angler->user->email)->send(new ReviewRequest($this->booking->angler));

        $this->booking->maillogs()->create([
            'type' => 'review',
            'recipient' => $this->booking->angler->user->email,
            'webhook_id' => $mailable->getMessageId(),
            'sent' => Carbon::now()
        ]);

        foreach($this->booking->guests as $guest)
        {
            if($guest->user()->exists())
            {
                $mailable = Mail::to($guest->user->email)->send(new ReviewRequest($guest));

                $this->booking->maillogs()->create([
                    'type' => 'review',
                    'recipient' => $guest->user->email,
                    'webhook_id' => $mailable->getMessageId(),
                    'sent' => Carbon::now()
                ]);
            }
        }
    }
}

<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingReceipt;
use App\Models\Booking;
use Carbon\Carbon;

class SendBookingConfirmation implements ShouldQueue
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
        $mailable = Mail::to($this->booking->angler->user->email)->bcc('joe@underweb.co.uk')->send(new BookingReceipt($this->booking));

        $this->booking->maillogs()->create([
            'type' => 'booking-confirmation',
            'recipient' => $this->booking->angler->user->email,
            'webhook_id' => $mailable->getMessageId(),
            'sent' => Carbon::now()
        ]);
    }
}

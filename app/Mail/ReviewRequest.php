<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Angler;

class ReviewRequest extends Mailable
{
    use Queueable, SerializesModels;

    public $angler;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Angler $angler)
    {
        $this->angler = $angler;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('bookings@redwoodlake.co.uk', 'Redwood Lake')->subject('Let us know your feedback')->replyto('info@redwoodlake.co.uk')->markdown('emails.review-request');
    }
}

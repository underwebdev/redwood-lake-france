<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Mailshot;

class PromoEmail extends Mailable
{
    public $mailshot;

    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Mailshot $mailshot)
    {
        $this->mailshot = $mailshot;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('announcment@redwoodlake.co.uk', 'Redwood Lake')->subject($this->mailshot['subject'])->replyto('info@redwoodlake.co.uk')->markdown('emails.promo-email')->with('mailshot', $this->mailshot);
    }
}

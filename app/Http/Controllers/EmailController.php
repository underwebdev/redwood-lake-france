<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Mail\PaymentReminder;
use App\Mail\PaymentOverdue;
use App\Mail\GuestInfo;
use App\Mail\WelcomeEmail;
use App\Mail\ReviewRequest;

use App\Models\Booking;
use Carbon\Carbon;

class EmailController extends Controller
{
    public function index()
    {
        return view('emails.index');
    }

    public function paymentreminder()
    {
        $booking = Booking::where('arrival', '>', Carbon::now())->orderBy('arrival', 'asc')->first();
        
        return new PaymentReminder($booking);
    }

    public function overdue()
    {
        $booking = Booking::where('arrival', '>', Carbon::now())->orderBy('arrival', 'asc')->first();
        
        return new PaymentOverdue($booking);
    }

    public function guestinfo()
    {
        $booking = Booking::where('arrival', '>', Carbon::now())->orderBy('arrival', 'asc')->first();

        return new GuestInfo($booking);
    }

    public function welcome()
    {
        $booking = Booking::where('arrival', '>', Carbon::now())->orderBy('arrival', 'asc')->first();

        return new WelcomeEmail($booking);
    }

    public function review()
    {
        $booking = Booking::where('departure', '<', Carbon::now())->orderBy('arrival', 'desc')->first();

        return new ReviewRequest($booking->angler);
    }
}

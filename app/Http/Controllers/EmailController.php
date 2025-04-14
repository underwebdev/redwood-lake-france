<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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

    public function welcome()
    {
        $booking = Booking::where('arrival', '>', Carbon::now())->orderBy('arrival', 'asc')->first();

        $data = [
            'firstName' => $booking->angler->firstName,
            'arrival' => $booking->arrival,
            'departure' => $booking->departure,
        ];

        return new WelcomeEmail($data);
    }

    public function review()
    {
        $booking = Booking::where('departure', '<', Carbon::now())->orderBy('arrival', 'desc')->first();

        $data = [
            'firstName' => $booking->angler->firstName,
            'arrival' => $booking->arrival,
            'departure' => $booking->departure,
        ];

        return new ReviewRequest($data);
    }
}

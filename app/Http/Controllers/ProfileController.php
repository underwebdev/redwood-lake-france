<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if($user->reset == 1)
        {
            return redirect('/my-account/settings')->with('failure', 'Please update your password before continuing!');
        }

        return view('profile.index', compact('user'));
    }

    public function bookings()
    {
        $user = Auth::user();

        if($user->reset == 1)
        {
            return redirect('/my-account/settings')->with('failure', 'Please update your password before continuing!');
        }

        return view('profile.bookings', compact('user'));
    }

    public function booking($booking)
    {
        $user = Auth::user();

        if($user->reset == 1)
        {
            return redirect('/my-account/settings')->with('failure', 'Please update your password before continuing!');
        }

        $booking = Booking::findOrFail($booking);

        if($booking->angler_id != $user->angler->id)
        {
            return redirect('/my-account/bookings');
        }

        return view('profile.booking', compact('booking'));
    }

    public function payment()
    {
        $user = Auth::user();

        if($user->reset == 1)
        {
            return redirect('/my-account/settings')->with('failure', 'Please update your password before continuing!');
        }
    }

    public function reports()
    {
        $user = Auth::user();

        if($user->reset == 1)
        {
            return redirect('/my-account/settings')->with('failure', 'Please update your password before continuing!');
        }

        return view('profile.reports');
    }

    public function myreports()
    {
        $user = Auth::user();

        if($user->reset == 1)
        {
            return redirect('/my-account/settings')->with('failure', 'Please update your password before continuing!');
        }

        return view('profile.myreports');
    }

    public function uploadreport()
    {
        $user = Auth::user();

        if($user->reset == 1)
        {
            return redirect('/my-account/settings')->with('failure', 'Please update your password before continuing!');
        }

        return view('profile.uploadreport');
    }

    public function settings()
    {
        return view('profile.settings');
    }

    public function updatePassword()
    {
        
    }

    public function contact()
    {
        return view('profile.contact');
    }
}

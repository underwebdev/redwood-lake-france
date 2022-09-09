<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if($user->reset == 1)
        {
            return redirect('/settings')->with('failure', 'Please update your password!');
        }

        return view('profile.index', compact('user'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgotPassword;
use Carbon\Carbon;

class LoginController extends Controller
{
	public function login()
	{
		return view('auth.login');
	}

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if(Auth::user()->permission == 2)
            {
                Auth::user()->update([
                    'last_login' => Carbon::now()
                ]);

                return redirect()->intended('/my-account');
                
            } elseif(Auth::user()->permission == 1)
            {
                Auth::user()->update([
                    'last_login' => Carbon::now()
                ]);
                
                return redirect()->intended('/admin/dashboard');
            }
            
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
	{
	    Auth::logout();

	    $request->session()->invalidate();

	    $request->session()->regenerateToken();

	    return redirect('/');
	}

    public function forgot()
    {
        return view('auth.forgot');
    }

    public function reset()
    {
        $data = request()->validate([
            'email' => 'required|email'
        ]);

        $email = $data['email'];

        $angler = User::where('email', $email)->count();
        
        if($angler == Null)
        {
           return redirect('/forgot-password')->with('failure', 'Details provided to not match our records, if this is incorrect please contact email');
        } elseif(User::where('email', $email)->exists())
        {
            $user = User::where('email', $email)->first();

            $newPWD = Str::random(8);
            $user->update([
                'password' => bcrypt($newPWD)
            ]);

            $data = [
                'firstName' => $user->angler->firstName,
                'password' => $newPWD,
                'email' => $user->email
            ];

            Mail::to($user->email)->send(new ForgotPassword($data));

            return redirect('/login')->with('success', 'Password successfully reset! Please check your email for your new password');
        }

    }
}

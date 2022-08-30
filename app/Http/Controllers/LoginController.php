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
		return view('login.login');
	}

    public function claim()
    {
        $years = range(Carbon::now()->subYears(12)->year, 1920);

    	return view('login.claim', compact('years'));
    }

    public function register()
    {
    	$data = request()->validate([
            'memberNo' => 'required|numeric',
            'firstName' => 'required|alpha',
            'lastName' => 'required',
            'dd' => 'required|numeric',
            'mm' => 'required|numeric',
            'yy' => 'required|numeric',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
            'consent' => 'required',
            'post' => 'nullable',
            'gdpremail' => 'nullable'
        ]);

        $dob = $data['yy'] . '-' . $data['mm'] . '-' . $data['dd'];

        $memberNo = $data['memberNo'];
        $firstName = Str::ucfirst($data['firstName']);
        $lastName = Str::ucfirst($data['lastName']);  

        $checkMember = Member::where('memberNo', $memberNo)->where('is_active', 1)->first();

        if($checkMember == Null)
        {
           return redirect('/claim-account')->with('failure', 'Details do not match our records'); 
        }

        if($checkMember->user()->exists())
        {
            return redirect('/claim-account')->with('failure', 'Account for this member has already been created');
        }

        if($checkMember->lastName == $lastName)
        {
            $user = User::create([
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'permission' => 2
            ]);

            $checkMember->update([
                'user_id' => $user->id,
                'firstName' => $firstName,
                'dob' => $dob,
                'post' => request('post'),
                'email' => request('gdpremail')

            ]);

            return redirect('/login')->with('success', 'You have successfully activated your account, you can now log in below.');


        } else {
            return redirect('/claim-account')->with('failure', 'Details do not match our records');
        }
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

                Auth::user()->member->weblogs()->create([
                    'mode' => 'in'
                ]);

                return redirect()->intended('/members-area');
                
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
        if(Auth::user()->permission == 2)
        {
            Auth::user()->member->weblogs()->create([
                'mode' => 'out'
            ]);
        }

	    Auth::logout();

	    $request->session()->invalidate();

	    $request->session()->regenerateToken();

	    return redirect('/');
	}

    public function forgot()
    {
        return view('login.forgot');
    }

    public function reset()
    {
        $data = request()->validate([
            'memberNo' => 'required|numeric',
            'email' => 'required|email'
        ]);

        $memberNo = $data['memberNo'];
        $email = $data['email'];

        $member = Member::where('memberNo', $memberNo)->count();
        
        if($member == Null)
        {
           return redirect('/forgot-password')->with('failure', 'Details provided to not match our records, if this is incorrect please contact paulst@croxleyhall.co.uk');
        } else {
            $member = Member::where('memberNo', $memberNo)->first();
        }

        if($member->user()->exists())
        {
            if($member->user->email == $email)
            {
                $newPWD = Str::random(8);
                $member->user()->update([
                    'password' => bcrypt($newPWD)
                ]);

                $member->pwd = $newPWD;

                Mail::to($member->user->email)->send(new ForgotPassword($member));

                return redirect('/login')->with('success', 'Password successfully reset! Please check your email for your new password');
            } else {
                return redirect('/forgot-password')->with('failure', 'Email does not match that membership number. Please try again or contact paulst@croxleyhall.co.uk');
            }
        } else {

            return redirect('/forgot-password')->with('failure', 'Details provided to not match our records, if this is incorrect please contact paulst@croxleyhall.co.uk');
        }

    }
}

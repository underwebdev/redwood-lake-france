<?php

namespace App\Http\Livewire\Profile;

use Livewire\Component;
use App\Models\Maillist;
use Auth;

class AccountSettings extends Component
{
    public $mode;
    public $password;
    public $password_confirmation;
    public $email;
    public $email_confirmation;
    public $telephone;
    public $maillist;

    public function mount()
    {
        if(Auth::user()->reset == 1)
        {
            $this->mode = 2;
        } else {
            $this->mode = 1;
        }

        if(Maillist::where('email', Auth::user()->email)->where('subscribed', 1)->exists())
        {
            $this->maillist = 1;
        } else {
            $this->maillist = 0;
        }

        $this->telephone = Auth::user()->angler->telephone;
    }

    public function savePassword()
    {
        $data = $this->validate([
            'password' => 'required|confirmed|min:6',
        ]);

        Auth::user()->update([
            'password' => bcrypt($data['password']),
            'reset' => Null
        ]);

        $this->reset(['password', 'password_confirmation']);

        redirect()->to('my-account');
    }

    public function saveContact()
    {
        $data = $this->validate([
            'email' => 'required|email|confirmed',
            'telephone' => 'required|numeric'
        ]);

        Auth::user()->update(['email' => $data['email']]);
        Auth::user()->angler->update(['telephone' => $data['telephone']]);

        $this->reset(['email', 'email_confirmation']);

        $this->mode = 1;

        session()->flash('success', 'Contact information has been updated!');
    }

    public function maillist($id)
    {   
        if($id == 1)
        {
            Maillist::updateOrCreate([
                'email' => Auth::user()->email
            ],['email' => Auth::user()->email,
                'firstName' => Auth::user()->angler->firstName,
                'subscribed' => 1]);

            $this->maillist = 1;
        } else {
            Maillist::where('email', Auth::user()->email)->update(['subscribed' => Null]);
            $this->maillist = 0;
        }
        session()->flash('success', 'Your mail preferences have been updated!');
    }

    public function render()
    {
        return view('livewire.profile.account-settings');
    }
}

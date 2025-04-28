<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\AnglerAccount;
use App\Models\Angler;

class AnglerDashboard extends Component
{
    public $mode = 1;
    public $firstName;
    public $lastName;
    public $telephone;
    public $ref;
    public $account;
    public $email;
    public $email_confirmation;
    public $lookup;
    public $selectedAngler;

    public function selectAngler($id)
    {
        $this->selectedAngler = Angler::findOrFail($id);
        $this->firstName = $this->selectedAngler->firstName;
        $this->lastName = $this->selectedAngler->lastName;
        $this->telephone = $this->selectedAngler->telephone;
        $this->mode = 3;

    }

    public function saveAngler()
    {
        $data = $this->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'telephone' => 'nullable|numeric',
            'account' => 'required',
            'email' => 'exclude_unless:account,1|required|unique:users|confirmed',
        ]);

        $ref = Angler::latest()->pluck('ref')->first();

        $angler = Angler::create([
            'firstName' => Str::ucfirst($data['firstName']),
            'lastName' => Str::ucfirst($data['lastName']),
            'telephone' => $data['telephone'],
            'ref' => $ref + 1
        ]);

        if($this->account == 1)
        {
            $password = Str::random(8);

            $user = $angler->user()->create([
                'email' => $data['email'],
                'password' => bcrypt($password),
                'permission' => 2,
                'reset' => 1
            ]);

            $data = [
                'firstName' => $angler->firstName,
                'password' => $password,
                'email' => $data['email']
            ];

            $angler->update(['user_id' => $user->id]);

            Mail::to($data['email'])->send(new AnglerAccount($data));
        }

        $this->reset();

        session()->flash('success', 'Angler Created!');
    }

    public function saveAnglerChanges()
    {
        $data = $this->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'telephone' => 'nullable|numeric',
        ]);

        $this->selectedAngler->update([
            'firstName' => $data['firstName'],
            'lastName' => $data['lastName'],
            'telephone' => $data['telephone']
        ]);

        $this->mode = 3;

        session()->flash('success', 'Details Updated');
    }

    public function saveAnglerEmail()
    {
        $data = $this->validate([
            'email' => 'required|email|confirmed|unique:users'
        ]);

        $password = Str::random(8);

        $user = $this->selectedAngler->user()->create([
            'email' => $data['email'],
            'password' => bcrypt($password),
            'permission' => 2,
            'reset' => 1
        ]);

        $data = [
            'firstName' => $this->selectedAngler->firstName,
            'password' => $password,
            'email' => $data['email']
        ];

        $this->selectedAngler->update(['user_id' => $user->id]);

        $this->selectedAngler->refresh();

        Mail::to($data['email'])->send(new AnglerAccount($data));

        $this->mode = 3;

        session()->flash('success', 'Details Updated');
    }

    public function resetpassword()
    {
        $password = Str::random(8);

        $user = $this->selectedAngler->user()->update([
            'password' => bcrypt($password),
            'reset' => 1
        ]);

        $data = [
            'firstName' => $this->selectedAngler->firstName,
            'password' => $password,
            'email' => $this->selectedAngler->user->email
        ];

        Mail::to($this->selectedAngler->user->email)->bcc('tobylc33@gmail.com')->send(new AnglerAccount($data));

        session()->flash('success', 'Password Reset');
    }

    public function back()
    {
        $this->reset();
    }

    public function render()
    {
        $lookup = '%'.$this->lookup.'%';

        return view('livewire.admin.angler-dashboard',[
            'anglers' => Angler::when($lookup, function ($query) use ($lookup) {
                    return $query->where('lastName', 'like', '%' . $lookup . '%')->orWhere('firstName', 'like', '%' . $lookup . '%')->orWhere('ref', 'like', '%' . $lookup . '%');
                })->get()
        ]);
    }
}

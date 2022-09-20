<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\AccountCreated;
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
            $password = Str::random(6);

            $angler->user()->create([
                'email' => $data['email'],
                'password' => bcrypt($password),
                'permission' => 2
            ]);

            $data = [
                'firstName' => $angler->firstName,
                'password' => $password,
                'email' => $data['email']
            ];

            Mail::to($data['email'])->send(new AccountCreated($data));
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

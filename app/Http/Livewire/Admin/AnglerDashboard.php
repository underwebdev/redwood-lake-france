<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
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
            'email' => 'exclude_unless:account,1|required|unique:users',
        ]);

        $ref = 1;

        $angler = Angler::create([
            'firstName' => Str::ucfirst($data['firstName']),
            'lastName' => Str::ucfirst($data['lastName']),
            'telephone' => $data['telephone'],
            'ref' => $ref
        ]);

        if($this->account == 1)
        {
            $password = Str::random(6);

            $angler->user()->create([
                'email' => $data['email'],
                'password' => bcrpyt($password)
            ]);
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
        return view('livewire.admin.angler-dashboard',[
            'anglers' => Angler::all()
        ]);
    }
}

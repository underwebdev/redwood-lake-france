<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Package;
use App\Models\Breakdown;
use App\Models\Priceguide;
use Carbon\Carbon;

class PackageDashboard extends Component
{
    public $mode = 1;
    public $name;
    public $selectedPackage;
    public $breakdown;
    public $selectedBreakdown;
    public $package;
    public $start;
    public $end;
    public $price;
    public $deposit;
    public $due;
    public $featured;
    public $selectedPriceguide;

    public function savePackage()
    {
        $data = $this->validate([
            'name' => 'required'
        ]);

        $this->selectedPackage = Package::create([
            'name' => $data['name']
        ]);

        $this->mode = 3;
    }

    public function selectPackage($id)
    {
        $this->selectedPackage = Package::findOrFail($id);

        $this->mode = 3;
    }

    public function deactivatePackage()
    {
        $this->selectedPackage->update([
            'active' => 0
        ]);
    }

    public function activatePackage()
    {
        $this->selectedPackage->update([
            'active' => 1
        ]);
    }

    public function saveBreakdown()
    {
        $data = $this->validate([
            'breakdown' => 'required'
        ]);

        $this->selectedPackage->breakdowns()->create([
            'body' => $data['breakdown']
        ]);

        $this->reset('breakdown');

        $this->selectedPackage->refresh();

        session()->flash('success', 'Feature Saved!');

    }

    public function selectBreakdown($id)
    {
        $this->selectedBreakdown = Breakdown::findOrFail($id);
        $this->breakdown = $this->selectedBreakdown->body;
    }

    public function saveBreakdownChanges()
    {
        $data = $this->validate([
            'breakdown' => 'required'
        ]);

        $this->selectedBreakdown->update([
            'body' => $data['breakdown']
        ]);

        $this->selectedPackage->refresh();

        $this->reset(['selectedBreakdown', 'breakdown']);

        session()->flash('success', 'Feature Updated');
    }

    public function deleteBreakdown($id)
    {
        Breakdown::findOrFail($id)->delete();

        $this->selectedPackage->refresh();

        session()->flash('success', 'Feature Deleted!');
    }

    public function savePriceguide()
    {
        $data = $this->validate([
            'package' => 'required',
            'name' => 'nullable',
            'start' => 'required|date',
            'end' => 'required|date',
            'price' => 'required|numeric',
            'deposit' => 'required|numeric',
            'due' => 'required|numeric',
            'featured' => 'nullable'
        ]);

        Priceguide::create([
            'package_id' => $data['package'],
            'name' => $data['name'],
            'start' => Carbon::parse($data['start'])->format('Y-m-d'),
            'end' => Carbon::parse($data['end'])->format('Y-m-d'),
            'price' => $data['price'] * 100,
            'deposit' => $data['deposit'] * 100,
            'due' => $data['due'],
            'featured' => $data['featured']
        ]);

        $this->reset();

        session()->flash('success', 'Priceguide Saved');
    }

    public function selectPriceguide($id)
    {
        $this->selectedPriceguide = Priceguide::findOrFail($id);

        $this->package = $this->selectedPriceguide->package_id;
        $this->name = $this->selectedPriceguide->name;
        $this->start = Carbon::parse($this->selectedPriceguide->start)->format('Y-m-d');
        $this->end = Carbon::parse($this->selectedPriceguide->end)->format('Y-m-d');
        $this->price = $this->selectedPriceguide->price / 100;
        $this->deposit = $this->selectedPriceguide->deposit / 100;
        $this->due = $this->selectedPriceguide->due;
        $this->featured = $this->selectedPriceguide->featured;

        $this->dispatch('activate-datepicker');
        $this->mode = 4;
    }

    public function savePriceguideChanges()
    {
        $data = $this->validate([
            'package' => 'required',
            'name' => 'nullable',
            'start' => 'required|date',
            'end' => 'required|date',
            'price' => 'required|numeric',
            'deposit' => 'required|numeric',
            'due' => 'required|numeric',
            'featured' => 'numeric'
        ]);

        $this->selectedPriceguide->update([
            'package_id' => $data['package'],
            'name' => $data['name'],
            'start' => Carbon::parse($data['start'])->format('Y-m-d'),
            'end' => Carbon::parse($data['end'])->format('Y-m-d'),
            'price' => $data['price'] * 100,
            'deposit' => $data['deposit'] * 100,
            'due' => $data['due'],
            'featured' => $data['featured']
        ]);

        $this->reset();

        session()->flash('success', 'Priceguide Updated!');
    }

    public function deletePriceguide()
    {
        $this->selectedPriceguide->delete();

        $this->reset();

        session()->flash('success', 'Priceguide Deleted');

    }

    public function updatedMode()
    {
        if($this->mode == 4)
        {
            $this->dispatch('activate-datepicker');
        }
    }

    public function back()
    {
        $this->reset();
    }

    public function render()
    {
        return view('livewire.admin.package-dashboard',[
            'packages' => Package::all(),
            'priceguides' => Priceguide::all()
        ]);
    }
}

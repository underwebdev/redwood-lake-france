<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Stocking;
use App\Models\Farm;
use App\Models\Specimen;
use Carbon\Carbon;

class StockingDashboard extends Component
{
    public $mode = 1;
    public $date;
    public $selectedFarm;
    public $name;

    public $selectedStocking;
    public $number;
    public $lbs;
    public $oz;
    public $class;
    public $species;
    public $price;
    public $sideone;
    public $sidetwo;

    public $gallery;
    public $selectedFish;

    public function selectStocking($id)
    {
        $this->selectedStocking = Stocking::findOrFail($id);

        $this->mode = 2;
    }

    public function saveStocking()
    {
        $data = $this->validate([
            'date' => 'required|date',
            'selectedFarm' => 'required|numeric'
        ]);

        $this->selectedStocking = Stocking::create([
            'date' => Carbon::parse($data['date'])->format('Y-m-d'),
            'farm_id' => $data['selectedFarm']
        ]);

        $this->mode = 2;

    }

    public function saveFish()
    {
        $data = $this->validate([
            'number' => 'required',
        ]);

        $this->selectedStocking->items()->create([
        ]);
    }    

    public function saveFarm()
    {
        $data = $this->validate([
            'name' => 'required'
        ]);

        $farm = Farm::create([
            'name' => $data['name']
        ]);

        $this->selectedFarm = $farm->id;
    }

    public function updatedMode()
    {
        $this->dispatchBrowserEvent('activate-datepicker');
    }

    public function back()
    {
        $this->reset();
    }

    public function render()
    {
        return view('livewire.admin.stocking-dashboard',[
            'stockings' => Stocking::all(),
            'farms' => Farm::all(),
            'specimens' => Specimen::all()
        ]);
    }
}

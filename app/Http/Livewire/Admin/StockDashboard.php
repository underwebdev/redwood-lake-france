<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Stock;
use App\Models\Report;

class StockDashboard extends Component
{
    public $mode = 1;
    public $selectedReport;
    public $name;
    public $description;
    public $destock;
    public $selectedSpecies;
    public $selectedFish;
    public $selectedWeight;
    public $symbol;

    public function selectReport($id)
    {
        $this->selectedReport = Report::findOrFail($id);

        $this->mode = 3;
    }

    public function saveFish()
    {
        $data = $this->validate([
            'name' => 'nullable',
            'description' => 'nullable',
            'destock' => 'nullable'
        ]);

        $stock = Stock::create([
            'name' => $data['name'],
            'description' => $data['description'],
            'lbs' => $this->selectedReport->lbs,
            'oz' => $this->selectedReport->oz,
            'specimen_id' => $this->selectedReport->specimen_id,
            'sideone' => $this->selectedReport->sideone,
            'sideonethumb' => $this->selectedReport->sideonethumb,
            'sidetwo' => $this->selectedReport->sidetwo,
            'sidetwothumb' => $this->selectedReport->sidetwothumb,
            'alive' => 1
        ]);

        $this->selectedReport->update([
            'stock_id' => $stock->id
        ]);

        if($data['destock'] == 1)
        {
            $stock->destock()->create();
        }

        $this->reset();

        $this->mode = 2;

        session()->flash('success', 'Fish Saved');
    }

    public function attachReport($id)
    {
        $this->selectedReport->update([
            'stock_id' => $id 
        ]);

        $this->mode = 2;

        session()->flash('success', 'Report Matched!');
    }

    public function selectFish($id)
    {
        $this->selectedFish = Stock::findOrFail($id);
        $this->mode = 5;
    }

    public function weightFilter($weight, $symbol)
    {
        $this->selectedWeight = $weight;
        $this->symbol = $symbol;
    }

    public function speciesFilter($id)
    {
        $this->selectedSpecies = $id;
    }

    public function clearWeightFilter()
    {
        $this->reset(['selectedWeight', 'symbol']);
    }

    public function clearSpeciesFilter()
    {
        $this->reset('selectedSpecies');
    }

    public function back()
    {
        $this->reset();
    }

    public function render()
    {
        $specimen = $this->selectedSpecies;
        $weight = $this->selectedWeight;

        return view('livewire.admin.stock-dashboard',[
            'reports' => Report::whereNull('stock_id')->get(),
            'stock' => Stock::whereNotNull('alive')->get(),
            'fishlist' => Stock::whereNotNull('alive')->when($specimen, function ($query) use ($specimen) {
                    return $query->where('specimen_id', $specimen);
                })->when($weight, function ($query) use ($weight) {
                    return $query->where('lbs', $this->symbol, $weight);
                })->get()
        ]);
    }
}

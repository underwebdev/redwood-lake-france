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
    public $setPhoto = false;

    public function selectReport($id)
    {
        $this->selectedReport = Report::findOrFail($id);

        $this->mode = 3;
        $this->dispatchBrowserEvent('activate-foundation');
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
        $fish = Fish::findOrFail($id);

        if($this->selectedReport->lbs > $fish->lbs)
        {
            $lbs = $this->selectedReport->lbs;
            $oz = $this->selectedReport->oz;
        } elseif($this->selectedReport->lbs == $fish->lbs AND $this->selectedReport->oz > $fish->oz)
        {
            $lbs = $this->selectedReport->lbs;
            $oz = $this->selectedReport->oz;
        } else {
            $lbs = $fish->lbs;
            $oz = $fish->oz;
        }

        $this->selectedReport->update([
            'stock_id' => $id,
            'lbs' => $lbs,
            'oz' => $oz 
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

    public function primary($id)
    {
        $report = Report::findOrFail($id);

        $this->selectedFish->update([
            'sideone' => $report->sideone,
            'sideonethumb' => $report->sideonethumb
        ]);

        $this->selectedFish->refresh();
    }

    public function secondary($id)
    {
        $report = Report::findOrFail($id);

        $this->selectedFish->update([
            'sidetwo' => $report->sidetwo,
            'sidetwothumb' => $report->sidetwothumb
        ]);

        $this->selectedFish->refresh();
    }

    public function detach($id)
    {
        $report = Report::findOrFail($id);

        $report->update([
            'stock_id' => Null
        ]);

        $this->selectedFish->refresh();
    }

    public function deactivate()
    {
        $this->selectedFish->update([
            'alive' => Null
        ]);

        $this->reset();

        session()->flash('success', 'Fish deactivated');
    }

    public function reactivate()
    {
        $this->selectedFish->update([
            'alive' => 1
        ]);

        $this->reset();

        session()->flash('success', 'Fish reactivated');
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
                })->orderBy('lbs', 'desc')->orderBy('oz', 'desc')->get(),
            'deadlist' => Stock::whereNull('alive')->orderBy('lbs', 'desc')->orderBy('oz', 'desc')->get()
        ]);
    }
}

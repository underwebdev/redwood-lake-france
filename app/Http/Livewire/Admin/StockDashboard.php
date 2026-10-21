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
    public $limit = 10;

    public function selectReport($id)
    {
        $this->selectedReport = Report::findOrFail($id);

        $this->mode = 3;
        $this->dispatch('activate-foundation');
    }

    public function updatedMode($value)
    {
        if ((int) $value === 3) {
            $this->dispatch('activate-foundation');
        }
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
        $fish = Stock::findOrFail($id);

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
        ]);

        $fish->update([
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
        dd($id);

        $report = Report::findOrFail($id);

        $this->selectedFish->update([
            'sideone' => $report->sideone,
            'sideonethumb' => $report->sideonethumb
        ]);

        $this->selectedFish->refresh();
    }

    public function secondary($id)
    {
        dd($id);
        $report = Report::findOrFail($id);

        $this->selectedFish->update([
            'sidetwo' => $report->sidetwo,
            'sidetwothumb' => $report->sidetwothumb
        ]);

        $this->selectedFish->refresh();
    }

    public function selectphoto($main, $thumb, $side)
    {
        if($side == 1)
        {
            $this->selectedFish->update([
                'sideone' => $main,
                'sideonethumb' => $thumb
            ]);
        } elseif($side == 2)
        {
            $this->selectedFish->update([
                'sidetwo' => $main,
                'sidetwothumb' => $thumb
            ]);
        }

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

    public function selectname()
    {
        $this->name = $this->selectedFish->name;

        $this->mode = 7;
    }

    public function setname()
    {
        $data = $this->validate([
            'name' => 'nullable'
        ]);

        $this->selectedFish->update([
            'name' => $data['name']
        ]);

        $this->selectedFish->refresh();

        $this->mode = 5;
    }

    public function selectdescription()
    {
        $this->description = $this->selectedFish->description;

        $this->mode = 8;
    }

    public function setdescription()
    {
        $data = $this->validate([
            'description' => 'nullable'
        ]);

        $this->selectedFish->update([
            'description' => $data['description']
        ]);

        $this->selectedFish->refresh();

        $this->mode = 5;        
    }

    public function viewmore()
	{
		$this->limit = $this->limit + 10; 
	}

	public function viewless()
	{
		$this->limit = $this->limit - 10;
	}

    public function render()
    {
        $specimen = $this->selectedSpecies;
        $weight = $this->selectedWeight;

        return view('livewire.admin.stock-dashboard',[
            
            'stock' => Stock::whereNotNull('alive')->orderBy('lbs', 'desc')->orderBy('oz', 'desc')->get(),
            'fishlist' => Stock::whereNotNull('alive')->when($specimen, function ($query) use ($specimen) {
                    return $query->where('specimen_id', $specimen);
                })->when($weight, function ($query) use ($weight) {
                    return $query->where('lbs', $this->symbol, $weight);
                })->orderBy('lbs', 'desc')->orderBy('oz', 'desc')->simplePaginate(20),
            'deadlist' => Stock::whereNull('alive')->orderBy('lbs', 'desc')->orderBy('oz', 'desc')->get(),
            'reports' => Report::whereNull('stock_id')->whereNotNull('sideone')->get(),
        ]);
    }
}

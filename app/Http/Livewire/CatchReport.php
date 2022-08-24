<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Report;
use App\Models\Specimen;
use App\Models\Swim;

class CatchReport extends Component
{
    public $selectedSpecies;
    public $selectedWeight;
    public $selectedSwim;
    
    public function render()
    {
        return view('livewire.catch-report',[
            'reports' => Report::all(),
            'specimens' => Specimen::all(),
            'swims' => Swim::all()
        ]);
    }
}

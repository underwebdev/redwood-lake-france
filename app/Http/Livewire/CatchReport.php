<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Report;
use App\Models\Specimen;
use App\Models\Swim;

class CatchReport extends Component
{
    protected $paginationTheme = 'bootstrap';
    
    public $selectedSpecies;
    public $selectedWeight;
    public $selectedSwim;
    
    public function render()
    {
        $specimen = $this->selectedSpecies;
        $weight = $this->selectedWeight;
        $swim = $this->selectedSwim;

        return view('livewire.catch-report',[
            'reports' => Report::where('lbs', '>', '15')->when($specimen, function ($query) use ($specimen) {
                    return $query->where('specimen_id', $specimen);
                })->when($weight, function ($query) use ($weight) {
                    return $query->where('lbs', '>', $weight);
                })->when($swim, function ($query) use ($swim) {
                    return $query->where('swim_id', $swim);
                })->paginate(50),
            'specimens' => Specimen::all(),
            'swims' => Swim::all()
        ]);
    }
}

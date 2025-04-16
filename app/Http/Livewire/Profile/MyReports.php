<?php

namespace App\Http\Livewire\Profile;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Specimen;
use App\Models\Swim;
use Auth;

class MyReports extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $selectedSpecies;
    public $selectedWeight;
    public $selectedSwim;

    public function render()
    {
        $specimen = $this->selectedSpecies;
        $weight = $this->selectedWeight;
        $swim = $this->selectedSwim;

        return view('livewire.profile.my-reports',[
            'reports' => Auth::user()->angler->reports()->when($specimen, function ($query) use ($specimen) {
                    return $query->where('specimen_id', $specimen);
                })->when($weight, function ($query) use ($weight) {
                    return $query->where('lbs', '>', $weight);
                })->when($swim, function ($query) use ($swim) {
                    return $query->where('swim_id', $swim);
                })->orderby('date', 'desc')->paginate(50),
            'species' => Specimen::all(),
            'swims' => Swim::all()
        ]);
    }
}

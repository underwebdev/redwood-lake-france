<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Lake;
use App\Models\Swim;

class LakeMap extends Component
{
    public $selectedSwim;

    public function selectSwim($id)
    {
        $this->selectedSwim = Swim::findOrFail($id);
    }

    public function back()
    {
        $this->reset();
    }

    public function render()
    {
        return view('livewire.lake-map',[
            'lake' => Lake::findOrFail(1)
        ]);
    }
}

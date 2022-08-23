<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Lake;

class LakeMap extends Component
{
    public $selectedSwim;

    public function selectedSwim($id)
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

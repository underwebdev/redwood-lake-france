<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Lake;
use App\Models\Swim;

class LakeDashboard extends Component
{
    public $mode = 1;
    public $size;
    public $rodlimit;
    public $open;
    public $lrcommon;
    public $lrmirror;
    public $stock;
    public $avgsize;
    public $selectedSwim;
    public $name;
    public $shortname;

    public function selectLake()
    {
        $lake = Lake::find(1);

        $this->size = $lake->size;
        $this->rodlimit = $lake->rodlimit;
        $this->open = $lake->open;
        $this->lrcommon = $lake->lrcommon;
        $this->lrmirror = $lake->lrmirror;
        $this->stock = $lake->stock;
        $this->avgsize = $lake->avgsize;

        $this->mode = 2;
    }

    public function saveLakeChanges()
    {
        $data = $this->validate([
            'size' => 'required',
            'rodlimit' => 'required',
            'open' => 'required',
            'lrcommon' => 'required',
            'lrmirror' => 'required',
            'stock' => 'required',
            'avgsize' => 'required'
        ]);

        $lake = Lake::find(1);

        $lake->update([
            'size' => $data['size'],
            'rodlimit' => $data['rodlimit'],
            'open' => $data['open'],
            'lrcommon' => $data['lrcommon'],
            'lrmirror' => $data['lrmirror'],
            'stock' => $data['stock'],
            'avgsize' => $data['avgsize']
        ]);

        $this->reset();

        session()->flash('success', 'Lake Info Updated!');
    }

    public function selectSwim($id)
    {
        $this->selectedSwim = Swim::findOrFail($id);
        $this->name = $this->selectedSwim->name;
        $this->shortname = $this->selectedSwim->shortname;
        $this->mode = 3;
    }

    public function saveSwim()
    {
        $data = $this->validate([
            'name' => 'required',
            'shortname' => 'required'
        ]);

        Swim::create([
            'name' => $data['name'],
            'shortname' => $data['shortname']
        ]);

        $this->reset();

        session()->flash('success', 'Swim Saved!');
    }

    public function saveSwimChanges()
    {
        $data = $this->validate([
            'name' => 'required',
            'shortname' => 'required'
        ]);

        $this->selectedSwim->update([
            'name' => $data['name'],
            'shortname' => $data['shortname']
        ]);

        $this->reset();

        session()->flash('success', 'Swim Updated!');
    }

    public function back()
    {
        $this->reset();
    }

    public function render()
    {
        return view('livewire.admin.lake-dashboard',[
            'lake' => Lake::find(1)
        ]);
    }
}

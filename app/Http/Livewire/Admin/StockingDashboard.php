<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Stocking;
use App\Models\Farm;
use App\Models\Specimen;
use App\Models\Item;
use Carbon\Carbon;
use Image;

class StockingDashboard extends Component
{
    use WithFileUploads;

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
    public $editfish = false;

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
            'lbs' => 'required|numeric',
            'oz' => 'required|numeric',
            'class' => 'required',
            'species' => 'required',
            'price' => 'required|numeric'
        ]);

        $sideone = Image::make($this->sideone);
        $sidetwo = Image::make($this->sidetwo);

        $sideonename = uniqid() .'.' . $this->sideone->getClientOriginalExtension();
        $sidetwoname = uniqid() .'.' . $this->sideone->getClientOriginalExtension();

        $directory = 'public/stockings/';
        Storage::makeDirectory($directory);

        $photoone = $sideone->resize(600, null, function($constraint) 
        {
            $constraint->aspectRatio();
        });

        $phototwo = $sidetwo->resize(600, null, function($constraint) 
        {
            $constraint->aspectRatio();
        });

        Storage::put($directory . '/' . $sideonename, $photoone->stream());
        Storage::put($directory . '/' . $sidetwoname, $phototwo->stream());

        $item = $this->selectedStocking->items()->create([
            'number' => $data['number'],
            'lbs' => $data['lbs'],
            'oz' => $data['oz'],
            'class' => $data['class'],
            'specimen_id' => $data['species'],
            'side1' => '/storage/stockings/'. $sideonename,
            'side2' => '/storage/stockings/'. $sidetwoname,
            'price' => $data['price'] * $data['lbs']
        ]);

        $item->stock()->create([
            'lbs' => $data['lbs'],
            'oz' => $data['oz'],
            'specimen_id' => $data['species'],
            'sideone' => '/storage/stockings/'. $sideonename,
            'sideonethumb' => '/storage/stockings/'. $sideonename,
            'sidetwo' => '/storage/stockings/'. $sidetwoname,
            'sidetwothumb' => '/storage/stockings/'. $sidetwoname,
            'alive' => 1
        ]);

        session()->flash('success', 'Fish uploaded');

        $this->reset();

        $this->mode = 4;
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

    public function selectFish($id)
    {
        $this->selectedFish = Item::findOrFail($id);

        $this->number = $this->selectedFish->number;
        $this->lbs = $this->selectedFish->lbs;
        $this->oz = $this->selectedFish->oz;
        $this->species = $this->selectedFish->specimen_id;
        $this->class = $this->selectedFish->class;
        $this->price = $this->selectedFish->price;

        $this->mode = 5;
    }

    public function deleteStocking()
    {
        $this->selectedStocking->delete();

        $this->reset();

        session()->flash('success', 'Stocking Deleted');
    }

    public function updatedSideone()
    {
        if($this->editfish)
        {
            $sideone = Image::make($this->sideone);
            $sideonename = uniqid() .'.' . $this->sideone->getClientOriginalExtension();

            $photoone = $sideone->resize(600, null, function($constraint) 
            {
                $constraint->aspectRatio();
            });

            $directory = 'public/stockings/';

            Storage::put($directory . '/' . $sideonename, $photoone->stream());

            $imageToDelete = Str::after($this->selectedFish->side1, '/storage/');

            Storage::delete('public/' . $imageToDelete);

            $this->selectedFish->update([
                'side1' => '/storage/stockings/'. $sideonename
            ]);

            $this->selectedFish->refresh();


        }
    }

    public function updatedSidetwo()
    {
        if($this->editfish)
        {
            $sideone = Image::make($this->sidetwo);
            $sideonename = uniqid() .'.' . $this->sidetwo->getClientOriginalExtension();

            $photoone = $sideone->resize(600, null, function($constraint) 
            {
                $constraint->aspectRatio();
            });

            $directory = 'public/stockings/';

            Storage::put($directory . '/' . $sideonename, $photoone->stream());

            $imageToDelete = Str::after($this->selectedFish->side2, '/storage/');

            Storage::delete('public/' . $imageToDelete);

            $this->selectedFish->update([
                'side2' => '/storage/stockings/'. $sideonename
            ]);

            $this->selectedFish->refresh();


        }
    }

    public function saveFishChanges()
    {
        $data = $this->validate([
            'number' => 'required',
            'lbs' => 'required|numeric',
            'oz' => 'required|numeric',
            'class' => 'required',
            'species' => 'required',
            'price' => 'required|numeric'
        ]);

        $this->selectedFish->update([
            'number' => $data['number'],
            'lbs' => $data['lbs'],
            'oz' => $data['oz'],
            'class' => $data['class'],
            'specimen_id' => $data['species'],
            'price' => $data['price']
        ]);

        $this->editfish = false;

        $this->selectedFish->refresh();

        session()->flash('success', 'Data updated');
    }

    public function deleteFish()
    {
        $this->selectedFish->stock()->update([
            'item_id' => Null
        ]);

        $this->selectedFish->delete();

        $this->reset();

        session()->flash('success', 'Fish deleted');
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

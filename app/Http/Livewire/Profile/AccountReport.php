<?php

namespace App\Http\Livewire\Profile;

use Livewire\Component;
use App\Models\Report;
use App\Models\Specimen;
use App\Models\Swim;
use Auth;


class AccountReport extends Component
{
    public $mode = 1;
    public $selectedSpecies;
    public $selectedWeight;
    public $selectedSwim;
    public $lbs;
    public $oz;
    public $specimen;
    public $date;
    public $swim;
    public $bait;
    public $notes;
    public $sideone;
    public $sidetwo;

    public function saveReport()
    {
        $data = $this->validate([
            'lbs' => 'required',
            'oz' => 'required',
            'specimen' => 'required',
            'date' => 'required',
            'swim' => 'nullable',
            'bait' => 'nullable',
            'notes' => 'nullable',
            'sideone' => 'nullable|image|mimes:png,jpg,jpeg|max:12288',
            'sidetwo' => 'nullable|image|mimes:png,jpg,jpeg|max:12288'
        ]);

        if($this->sideone)
        {
            $photoOne = $this->sideone;

            $sideOneName = uniqid() .'.' . $photoOne->getClientOriginalExtension();
            $sideOneThumbName = 'thumb-' . uniqid() . '.' . $photoOne->getClientOriginalExtension();

            $directory = 'public/reports/';
            $thumbDirectory = 'public/reports/thumbnails/';

            Storage::makeDirectory($directory);
            Storage::makeDirectory($thumbDirectory);

            $photoOne = Image::make($this->sideone);
            $thumbOne = Image::make($this->sideone);

            $sideOne = $photoOne->resize(700, null, function($constraint) 
            {
                $constraint->aspectRatio();
            });

            $sideOneThumb = $thumbOne->resize(450, null, function($constraint) 
            {
                $constraint->aspectRatio();
            });

            $onePath = Storage::put($directory.$sideOneName, $sideOne->stream());
            $oneThumbPath = Storage::put($thumbDirectory.$sideOneThumbName, $sideOneThumb->stream());
        }

        if($this->sidetwo)
        {
            $photoTwo = $this->sidetwo;

            $sideTwoName = uniqid() .'.' . $photoTwo->getClientOriginalExtension();
            $sideTwoThumbName = 'thumb-' . uniqid() . '.' . $photoTwo->getClientOriginalExtension();

            $directory = 'public/reports/';
            $thumbDirectory = 'public/reports/thumbnails/';

            Storage::makeDirectory($directory);
            Storage::makeDirectory($thumbDirectory);


            $photoTwo = Image::make($this->sidetwo);
            $thumbTwo = Image::make($this->sidetwo);


            $sideTwo = $photoTwo->resize(700, null, function($constraint) 
            {
                $constraint->aspectRatio();
            });

            $sideTwoThumb = $thumbTwo->resize(450, null, function($constraint) 
            {
                $constraint->aspectRatio();
            });

            
            $twoPath = Storage::put($directory.$sideTwoName, $sideTwo->stream());
            $twoThumbPath = Storage::put($thumbDirectory.$sideTwoThumbName, $sideTwoThumb->stream());
        }


        Auth::user()->angler->reports()->create([
            'lbs' => $data['lbs'],
            'oz' => $data['oz'],
            'specimen_id' => $data['specimen'],
            'date' => Carbon::parse($data['date'])->format('Y-m-d'),
            'swim_id' => $data['swim'],
            'bait' => $data['bait'],
            'notes' => $data['notes'],
            'sideone' => '/storage/reports/'.$sideOneName,
            'sideonethumb' => '/storage/reports/thumbnails/'.$sideOneThumbName,
            'sidetwo' => '/storage/reports/'.$sideTwoName,
            'sidetwothumb' => '/storage/reports/thumbnails/'.$sideTwoThumbName,
        ]);

        $this->reset();

        session()->flash('success', 'Report Uploaded');
    }

    public function updatedMode()
    {
        $this->dispatchBrowserEvent('activate-datepicker');
    }

    public function back()
    {
        $this->reset();
    }

    public function render()
    {
        $specimen = $this->selectedSpecies;
        $weight = $this->selectedWeight;
        $swim = $this->selectedSwim;

        return view('livewire.profile.account-report',[
            'reports' => Report::when($specimen, function ($query) use ($specimen) {
                    return $query->where('specimen_id', $specimen);
                })->when($weight, function ($query) use ($weight) {
                    return $query->where('lbs', '>', $weight);
                })->when($swim, function ($query) use ($swim) {
                    return $query->where('swim_id', $swim);
                })->paginate(50),
            'species' => Specimen::all(),
            'swims' => Swim::all()
        ]);
    }
}

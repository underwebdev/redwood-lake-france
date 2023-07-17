<?php

namespace App\Http\Livewire\Profile;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Report;
use App\Models\Specimen;
use App\Models\Swim;
use Carbon\Carbon;
use Image;
use Auth;


class AccountReport extends Component
{
    use WithFileUploads;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

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

            $sideOnePath = Storage::put($directory.$sideOneName, $sideOne->stream());
            $sideOneThumbPath = Storage::put($thumbDirectory.$sideOneThumbName, $sideOneThumb->stream());

            $sideTwoPath = '/storage/reports/'.$sideOneName;
            $sideTwoThumbPath = '/storage/reports/thumbnails/'.$sideOneThumbName;
        } else {
            $sideOnePath = Null;
            $sideOneThumbPath = Null;
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

            $sideTwoPath = '/storage/reports/'.$sideTwoName;
            $sideTwoThumbPath = '/storage/reports/thumbnails/'.$sideTwoThumbName;
        } else {
            $sideTwoPath = Null;
            $sideTwoThumbPath = Null;
        }


        Auth::user()->angler->reports()->create([
            'lbs' => $data['lbs'],
            'oz' => $data['oz'],
            'specimen_id' => $data['specimen'],
            'date' => Carbon::parse($data['date'])->format('Y-m-d'),
            'swim_id' => $data['swim'],
            'bait' => $data['bait'],
            'notes' => $data['notes'],
            'sideone' => $sideOnePath,
            'sideonethumb' => $sideOneThumbPath,
            'sidetwo' => $sideTwoPath,
            'sidetwothumb' => $sideTwoThumbPath,
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
                })->orderby('date', 'desc')->paginate(50),
            'species' => Specimen::all(),
            'swims' => Swim::all()
        ]);
    }
}

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
use App\Support\Image;
use Auth;

class ReportUpdate extends Component
{
    use WithFileUploads;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $report;

    public $lbs;
    public $oz;
    public $specimen;
    public $date;
    public $swim;
    public $bait;
    public $notes;

    public $sideone;
    public $sidetwo;

    public function mount(Report $report)
    {
        $this->fill([
            
            'lbs' => $report->lbs,
            'oz' => $report->oz,
            'specimen' => $report->specimen_id,
            'date' => Carbon::parse($report->date)->format('D M d Y'),
            'swim' => $report->swim_id,
            'bait' => $report->bait,
            'notes' => $report->notes
        ]);

        $this->report = $report;
    }

    public function updatedSideone()
    {
        $data = $this->validate([
            'sideone' => 'nullable|image|mimes:png,jpg,jpeg|max:12288'
        ]);

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

        $sideOnePath = '/storage/reports/'.$sideOneName;
        $sideOneThumbPath = '/storage/reports/thumbnails/'.$sideOneThumbName;

        $this->report->update([
            'sideone' => $sideOnePath,
            'sideonethumb' => $sideOneThumbPath,
        ]);

    }

    public function updatedSidetwo()
    {
        $data = $this->validate([
            'sidetwo' => 'nullable|image|mimes:png,jpg,jpeg|max:12288'
        ]);

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

        $this->report->update([
            'sidetwo' => $sideTwoPath,
            'sidetwothumb' => $sideTwoThumbPath
        ]);

    }

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
        ]);

        $this->report->update([
            'lbs' => $data['lbs'],
            'oz' => $data['oz'],
            'specimen_id' => $data['specimen'],
            'date' => Carbon::parse($data['date'])->format('Y-m-d'),
            'swim_id' => $data['swim'],
            'bait' => $data['bait'],
            'notes' => $data['notes'],
        ]);

        return redirect()->to('/my-account/my-reports')->with('success', 'Report updated');


    }

    public function render()
    {
        return view('livewire.profile.report-update',[
            'species' => Specimen::all(),
            'swims' => Swim::all()
        ]);
    }
}

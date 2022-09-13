<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\withPagination;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Report;
use App\Models\Angler;
use App\Models\Specimen;
use App\Models\Swim;
use App\Models\Francereport;
use Carbon\Carbon;
use Image;

class CatchreportDashboard extends Component
{
    use WithFileUploads;
    use withPagination;
    protected $paginationTheme = 'bootstrap';

    public $mode = 1;
    public $view;
    public $anglerLookup;
    public $angler;
    public $lbs;
    public $oz;
    public $specimen;
    public $date;
    public $swim;
    public $bait;
    public $notes;
    public $sideone;
    public $sidetwo;
    public $selectedReport;

    public function copy()
    {
        $reports = Francereport::get();

        foreach($reports as $report)
        {
            Report::create([
                'angler_id' => 1,
                'lbs' => $report->lbs,
                'oz' => $report->oz,
                'specimen_id' => $report->specimen_id,
                'date' => $report->date,
                'sideone' => $report->sideone,
                'sideonethumb' => $report->sideoneThumb,
                'sidetwo' => $report->sidetwo,
                'sidetwothumb' => $report->sidetwoThumb,
                'notes' => $report->notes
            ]);
        }

        session()->flash('success', 'Copy Complete!');
    }

    public function saveReport()
    {
        $data = $this->validate([
            'angler' => 'required',
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


        Report::create([
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
            'angler_id' => $data['angler']
        ]);

        $this->reset(['mode', 'lbs', 'oz', 'specimen','date', 'notes', 'sideone', 'sidetwo']);

        session()->flash('success', 'Report Uploaded');
    }

    public function selectReport($id)
    {
        $this->selectedReport = Report::findOrFail($id);

        $this->angler = $this->selectedReport->angler_id;
        $this->lbs = $this->selectedReport->lbs;
        $this->oz = $this->selectedReport->oz;
        $this->specimen = $this->selectedReport->specimen_id;
        $this->date = Carbon::parse($this->selectedReport->date)->format('Y-m-d');
        $this->swim = $this->selectedReport->swim_id;
        $this->bait = $this->selectedReport->bait;
        $this->notes = $this->selectedReport->notes;
        $this->sideone = $this->selectedReport->sideone;
        $this->sidetwo = $this->selectedReport->sidetwo;

        $this->dispatchBrowserEvent('activate-datepicker');

        $this->mode = 3;
    }

    public function saveReportChanges()
    {
        $data = $this->validate([
            'angler' => 'required',
            'lbs' => 'required',
            'oz' => 'required',
            'specimen' => 'required',
            'date' => 'required',
            'swim' => 'nullable',
            'bait' => 'nullable',
            'notes' => 'nullable',
        ]);

        if($data['swim'] > 0)
        {
            $swim = $data['swim'];
        } else {
            $swim = Null;
        }


        $this->selectedReport->update([
            'angler_id' => $data['angler'],
            'lbs' => $data['lbs'],
            'oz' => $data['oz'],
            'specimen_id' => $data['specimen'],
            'date' => Carbon::parse($data['date'])->format('Y-m-d'),
            'swim_id' => $swim,
            'bait' => $data['bait'],
            'notes' => $data['notes'],
        ]);

        $this->reset(['mode', 'lbs', 'oz', 'specimen','date', 'notes', 'sideone', 'sidetwo']);

        session()->flash('success', 'Report Updated');
    }

    public function updatedSideone()
    {
        if($this->mode == 3)
        {
            $photoOne = $this->sideone;

            $sideOneName = uniqid() .'.' . $photoOne->getClientOriginalExtension();
            $sideOneThumbName = 'thumb-' . uniqid() . '.' . $photoOne->getClientOriginalExtension();

            $directory = 'public/reports/';
            $thumbDirectory = 'public/reports/thumbnails/';

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

            $this->selectedReport->update([
                'sideone' => '/storage/reports/'.$sideOneName,
                'sideoneThumb' => '/storage/reports/thumbnails/'.$sideOneThumbName,
            ]);
        }
    }

    public function updatedSidetwo()
    {
        if($this->mode == 3)
        {
            $photoOne = $this->sidetwo;

            $sideOneName = uniqid() .'.' . $photoOne->getClientOriginalExtension();
            $sideOneThumbName = 'thumb-' . uniqid() . '.' . $photoOne->getClientOriginalExtension();

            $directory = 'public/reports/';
            $thumbDirectory = 'public/reports/thumbnails/';

            $photoOne = Image::make($this->sidetwo);
            $thumbOne = Image::make($this->sidetwo);

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

            $this->selectedReport->update([
                'sidetwo' => '/storage/reports/'.$sideOneName,
                'sidetwoThumb' => '/storage/reports/thumbnails/'.$sideOneThumbName,
            ]);
        }
    }

    public function rotate($side)
    {
        if($side == 1)
        {
            $photoToRotate = Str::after($this->selectedReport->sideone, '/storage/');
            $thumbToRotate = Str::after($this->selectedReport->sideoneThumb, '/storage/');
        } elseif($side == 2)
        {
            $photoToRotate = Str::after($this->selectedReport->sidetwo, '/storage/');
            $thumbToRotate = Str::after($this->selectedReport->sidetwoThumb, '/storage/');
        }

        $photo = Storage::get('public/'. $photoToRotate);
        $thumbnail = Storage::get('public/'. $thumbToRotate);

        $img = Image::make($photo);
        $thumb = Image::make($thumbnail);

        $rotatedPhoto = $img->rotate(-90);
        $rotatedThumb = $thumb->rotate(-90);

        Storage::put('public/'.$photoToRotate, $rotatedPhoto->stream());
        Storage::put('public/'.$thumbToRotate, $rotatedThumb->stream());

        $this->selectedReport->update([
            'updated_at' => Carbon::now()
        ]);
    }

    public function deleteImage($id)
    {
        if($id == 1)
        {
            $image = Str::after($this->selectedReport->sideone, '/storage/');
            $thumb = Str::after($this->selectedReport->sideoneThumb, '/storage/');

            $this->selectedReport->update([
                'sideone' => Null,
                'sideoneThumb' => Null
            ]);
            
        } elseif($id == 2)
        {
            $image = Str::after($this->selectedReport->sidetwo, '/storage/');
            $thumb = Str::after($this->selectedReport->sidetwoThumb, '/storage/');

            $this->selectedReport->update([
                'sidetwo' => Null,
                'sidetwoThumb' => Null
            ]);
        }

        Storage::delete(['public/'.$image, 'public/'.$thumb]);
        
        session()->flash('success', 'Image Deleted');
    }

    public function deleteReport($id)
    {
        $report = Report::findOrFail($id);

        $image = Str::after($report->sideone, '/storage/');
        $thumb = Str::after($report->sideoneThumb, '/storage/');

        $imagetwo = Str::after($report->sidetwo, '/storage/');
        $thumbtwo = Str::after($report->sidetwoThumb, '/storage/');

        Storage::delete(['public/'.$image, 'public/'.$thumb, 'public/'.$imagetwo, 'public/'.$thumbtwo]);

        $report->delete();

        $this->reset(['mode']);

        session()->flash('success', 'Report Deleted');
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
        $year = Carbon::now()->format('Y');

        $lookup = '%'.$this->anglerLookup.'%';

        return view('livewire.admin.catchreport-dashboard',[
            'anglers' => Angler::when($lookup, function ($query) use ($lookup) {
                    return $query->where('lastName', 'like', '%' . $lookup . '%')->orWhere('firstName', 'like', '%' . $lookup . '%');
                })->orderBy('lastName', 'asc')->get(),
            'species' => Specimen::all(),
            'swims' => Swim::all(),
            'reports' => Report::orderBy('date', 'desc')->paginate(50),
            'janstats' => Report::whereYear('date', $year)->whereMonth('date', '01')->get(),
            'febstats' => Report::whereYear('date', $year)->whereMonth('date', '02')->get(),
            'marstats' => Report::whereYear('date', $year)->whereMonth('date', '03')->get(),
            'aprstats' => Report::whereYear('date', $year)->whereMonth('date', '04')->get(),
            'maystats' => Report::whereYear('date', $year)->whereMonth('date', '05')->get(),
            'junstats' => Report::whereYear('date', $year)->whereMonth('date', '06')->get(),
            'julstats' => Report::whereYear('date', $year)->whereMonth('date', '07')->get(),
            'augstats' => Report::whereYear('date', $year)->whereMonth('date', '08')->get(),
            'sepstats' => Report::whereYear('date', $year)->whereMonth('date', '08')->get(),
            'octstats' => Report::whereYear('date', $year)->whereMonth('date', '10')->get(),
            'novstats' => Report::whereYear('date', $year)->whereMonth('date', '11')->get(),
            'decstats' => Report::whereYear('date', $year)->whereMonth('date', '12')->get()
        ]);
    }
}

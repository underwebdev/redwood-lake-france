<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Report;

class StorageDashboard extends Component
{
    public function movePhotos()
    {
        $photos = Storage::allFiles('public/France');

        foreach($photos as $photo)
        {
            $newdir = Str::replace('France', 'reports', $photo);
            $filedir = Str::remove('public/', $newdir);

            Storage::move($photo, $newdir);
        }

        session()->flash('success', 'Files Moved!');
   
    }

    public function cleanupDatabase()
    {
        $reports = Report::all();

        foreach($reports as $report)
        {
            $sideone = Str::remove('/france', $report->sideone);
            $sideonethumb = Str::remove('/france', $report->sideonethumb);
            $sidetwo = Str::remove('/france', $report->sidetwo);
            $sidetwothumb = Str::remove('/france', $report->sidetwothumb);

            $report->update([
                'sideone' => $sideone,
                'sideonethumb' => $sideonethumb,
                'sidetwo' => $sidetwo,
                'sidetwothumb' => $sidetwothumb
            ]);
        }

        session()->flash('success', 'Database Updated');
    }

    public function cleanupSpecies()
    {
        $reports = Report::where('date', '<', '2022-07-05')->get();

        foreach($reports as $report)
        {
            if($report->specimen_id == 1)
            {
                $report->update([
                    'specimen_id' => 2
                ]);
            } elseif($report->specimen_id == 2) {
                $report->update([
                    'specimen_id' => 1
                ]);
            }
        }
    }

    public function render()
    {
        return view('livewire.admin.storage-dashboard', [
            'photos' => Storage::allFiles('public/France')
        ]);
    }
}

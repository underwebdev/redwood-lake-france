<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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

    public function render()
    {
        return view('livewire.admin.storage-dashboard', [
            'photos' => Storage::allFiles('public/France')
        ]);
    }
}

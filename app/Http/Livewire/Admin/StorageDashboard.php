<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\Storage;

class StorageDashboard extends Component
{
    public function movePhotos()
    {
        $photos = Storage::allFiles('public/France');

        foreach($photos as $photo)
        {

        }

        Storage::move('old/file.jpg', 'new/file.jpg');
    }

    public function moveThumbnails()
    {

    }

    public function render()
    {
        return view('livewire.admin.storage-dashboard', [
            'photos' => Storage::allFiles('public/france'),
            'thumbnails' => Storage::allFiles('public/france/thumbnails')
        ]);
    }
}

<?php

namespace App\Http\Livewire;

use Livewire\Component;

class FeatureGallery extends Component
{
    public $page;
    public $featured;

    public function mount()
    {
        $this->featured = $this->page->gallery()->first();
    }

    public function selectImage($id)
    {
        $this->featured = $this->page->gallery()->where('id', $id)->first();
    }

    public function render()
    {
        return view('livewire.feature-gallery',[
            'thumbnails' => $this->page->gallery()->where('id', '!=', $this->featured)->get()
        ]);
    }
}

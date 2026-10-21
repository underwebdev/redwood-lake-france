<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Page;
use App\Models\Module;
use App\Support\Image;

class ContentDashboard extends Component
{
    use withFileUploads;

    public $mode = 1;
    public $name;
    public $metatitle;
    public $metadesc;
    public $metakeywords;
    public $heading;
    public $subheading;
    public $ctabutton;
    public $ctalink;
    public $url;
    public $selectedPage;

    public $module;
    public $title;
    public $content;
    public $selectedModule;

    public $photo;
    public $alt;

    public function selectPage($id)
    {
        $this->selectedPage = Page::findOrFail($id);

        $this->name = $this->selectedPage->name;
        $this->metatitle = $this->selectedPage->metatitle;
        $this->metadesc = $this->selectedPage->metadescription;
        $this->metakeywords = $this->selectedPage->metakeywords;
        $this->heading = $this->selectedPage->heading;
        $this->subheading = $this->selectedPage->subheading;
        $this->ctabutton = $this->selectedPage->ctabutton;
        $this->ctalink = $this->selectedPage->ctalink;
        $this->url = $this->selectedPage->url;

        $this->mode = 3;
    }

    public function savePage()
    {
        $data = $this->validate([
            'name' => 'required',
            'metatitle' => 'required',
            'metadesc' => 'required',
            'metakeywords' => 'required',
            'heading' => 'required',
            'subheading' => 'nullable',
            'ctabutton' => 'nullable',
            'ctalink' => 'nullable',
            'url' => 'required'
        ]);

        Page::create([
            'name' => $data['name'],
            'metatitle' => $data['metatitle'],
            'metadescription' => $data['metadesc'],
            'metakeywords' => $data['metakeywords'],
            'heading' => $data['heading'],
            'subheading' => $data['subheading'],
            'ctabutton' => $data['ctabutton'],
            'ctalink' => $data['ctalink'],
            'url' => $data['url']
        ]);

        $this->reset(['mode', 'name', 'metatitle', 'metadesc', 'metakeywords', 'heading', 'subheading', 'ctabutton', 'ctalink']);

        session()->flash('success', 'Page Created');
    }

    public function savePageChanges()
    {
        $data = $this->validate([
            'name' => 'required',
            'metatitle' => 'required',
            'metadesc' => 'required',
            'metakeywords' => 'required',
            'heading' => 'required',
            'subheading' => 'nullable',
            'ctabutton' => 'nullable',
            'ctalink' => 'nullable',
            'url' => 'required'
        ]);

        $this->selectedPage->update([
            'name' => $data['name'],
            'metatitle' => $data['metatitle'],
            'metadescription' => $data['metadesc'],
            'metakeywords' => $data['metakeywords'],
            'heading' => $data['heading'],
            'subheading' => $data['subheading'],
            'ctabutton' => $data['ctabutton'],
            'ctalink' => $data['ctalink'],
            'url' => $data['url']
        ]);

        session()->flash('success', 'Changes Saved!');

        $this->mode = 3;
    }

    public function selectModule($id)
    {
        $this->selectedModule = Module::findOrFail($id);

        $this->title = $this->selectedModule->title;
        $this->content = $this->selectedModule->content;

        $this->mode = 5;
    }

    public function saveModule()
    {
        if($this->selectedPage->modules()->doesntExist())
        {
            $order = 0;
        } else {
            $order = $this->selectedPage->modules()->orderBy('order', 'desc')->pluck('order')->first();
        }
        
        $data = $this->validate([
            'title' => 'required',
            'content' => 'required'
        ]);

        $this->selectedPage->modules()->create([
            'title' => $data['title'],
            'content' => $data['content'],
            'order' => $order + 1
        ]);

        $this->reset(['module', 'title', 'content']);

        $this->selectedPage->refresh();

        session()->flash('success', 'Module created!');
    }

    public function saveModuleChanges()
    {
        $data = $this->validate([
            'title' => 'required',
            'content' => 'required'
        ]);

        $this->selectedModule->update([
            'title' => $data['title'],
            'content' => $data['content']
        ]);

        $this->reset(['selectedModule', 'title', 'content']);

        $this->selectedPage->refresh();

        $this->mode = 3;

        session()->flash('success', 'Module updated!');
    }

    public function saveImage()
    {
        $data = $this->validate([
            'photo' => 'required',
            'alt' => 'required'
        ]);

        $photo = $this->photo;

        $photoName = uniqid() .'.' . $photo->getClientOriginalExtension();

        $directory = 'public/gallery';
        $thumbDirectory = 'public/gallery/thumb';
        $mobileDirectory = 'public/gallery/mobile';

        Storage::makeDirectory($directory);
        Storage::makeDirectory($thumbDirectory);
        Storage::makeDirectory($mobileDirectory);

        $main = Image::make($photo)->resize(1400, 750);
        $thumb = Image::make($photo)->resize(750, 325);
        $mobile = Image::make($photo)->resize(500, 250);

        $pathMain = $directory . '/' . $photoName;
        $pathThumb =  $thumbDirectory . '/' . $photoName;
        $pathMobile =  $mobileDirectory . '/' . $photoName;

        Storage::put($pathMain, $main->stream());
        Storage::put($pathThumb, $thumb->stream());
        Storage::put($pathMobile, $mobile->stream());

        $dbDirectory = '/storage/gallery/'.$photoName;
        $dbThumbDirectory = '/storage/gallery/thumb/'.$photoName;
        $dbMobileDirectory = '/storage/gallery/mobile/'.$photoName;

        $this->selectedPage->gallery()->create([
            'image' => $dbDirectory,
            'thumbnail' => $dbThumbDirectory,
            'mobile' => $dbMobileDirectory,
            'alt' => $data['alt'],
            'order' => 1
        ]);

        $this->mode = 3;

        $this->selectedPage->refresh();

        session()->flash('success', 'Image Uploaded!');
    }

    public function deleteImage($id)
    {
        $image = $this->selectedPage->gallery()->findOrFail($id);

        $imageToDelete = Str::after($image->image, '/storage');
        $thumbToDelete = Str::after($image->thumbnail, '/storage');
        $mobileToDelete = Str::after($image->mobile, '/storage');

        Storage::delete(['public/'.$imageToDelete, 'public/'.$thumbToDelete, 'public/'.$mobileToDelete]);

        $image->delete();

        $this->selectedPage->refresh();

        session()->flash('success', 'Photo Deleted!');
    }

    public function back()
    {
        $this->reset();
    }

    public function render()
    {
        return view('livewire.admin.content-dashboard',[
            'pages' => Page::all()
        ]);
    }
}

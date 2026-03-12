<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Image;

class ArticleDashboard extends Component
{
    use WithFileUploads;

    public $mode = 1;
    public $article;
    public $title;
    public $body;
    public $gallery;
    public $cover;
    public $metatitle;
    public $metadesc;
    public $metakeywords;
    public $url;

    public $createBreadcrumb = false;
    public $breadcrumbtitle, $breadcrumburl;


    public function mount()
    {
        $this->title = $this->article->title;
        $this->body = $this->article->body;
        $this->url = $this->article->url;
        $this->metatitle = $this->article->metatitle;
        $this->metadesc = $this->article->metadescription;
        $this->metakeywords = $this->article->metakeywords;
    }

    public function saveChanges()
    {
        $data = $this->validate([
            'title' => 'required',
            'body' => 'required',
            'metatitle' => 'nullable',
            'metadesc' => 'nullable',
            'metakeywords' => 'nullable',
            'url' => 'nullable'
        ]);

        $this->article->update([
            'title' => $data['title'],
            'body' => $data['body'],
            'url' => $data['url'],
            'metatitle' => $data['metatitle'],
            'metadescription' => $data['metadesc'],
            'metakeywords' => $data['metakeywords']
        ]);

        $this->reset(['mode']);

        session()->flash('success', 'News article updated!');

    }

    public function updatedCover()
    {
        if($this->article->cover != Null)
        {
            $coverToDelete = Str::after($this->article->cover, '/storage');
            $thumbToDelete = Str::after($this->article->thumbnail, '/storage');

            Storage::delete(['public/'.$coverToDelete, 'public/'.$thumbToDelete]);
        }

        $photo = $this->cover;

        $photoName = uniqid() .'.' . $photo->getClientOriginalExtension();

        $directory = 'public/articles/img';
        $thumbDirectory = 'public/articles/img/thumb';

        Storage::makeDirectory($directory);
        Storage::makeDirectory($thumbDirectory);

        $newPhoto = Image::make($photo)->orientate();
        $newThumb = Image::make($photo)->orientate();

        $main = $newPhoto->resize(750, null, function($constraint) 
        {
            $constraint->aspectRatio();
        });

        $thumb = $newThumb->resize(400, null, function($constraint) 
        {
            $constraint->aspectRatio();
        });

        $pathMain = $directory . '/' . $photoName;
        $pathThumb =  $thumbDirectory . '/' . $photoName;

        Storage::put($pathMain, $main->stream());
        Storage::put($pathThumb, $thumb->stream());

        $dbDirectory = '/storage/articles/img/'.$photoName;
        $dbThumbDirectory = '/storage/articles/img/thumb/'.$photoName;

        $this->article->update([
            'cover' => $dbDirectory,
            'thumbnail' => $dbThumbDirectory
        ]);

        $this->reset(['cover']);

        $this->article->refresh();

        session()->flash('success', 'Cover Photo Updated!');
    }

    public function updatedGallery()
    {
        $photo = $this->gallery;

        $photoName = uniqid() .'.' . $photo->getClientOriginalExtension();

        $directory = 'public/articles/img';
        $thumbDirectory = 'public/articles/img/thumb';

        Storage::makeDirectory($directory);
        Storage::makeDirectory($thumbDirectory);

        $newPhoto = Image::make($photo)->orientate();
        $newThumb = Image::make($photo)->orientate();

        $main = $newPhoto->resize(750, null, function($constraint) 
        {
            $constraint->aspectRatio();
        });

        $thumb = $newThumb->resize(400, null, function($constraint) 
        {
            $constraint->aspectRatio();
        });

        $pathMain = $directory . '/' . $photoName;
        $pathThumb =  $thumbDirectory . '/' . $photoName;

        Storage::put($pathMain, $main->stream());
        Storage::put($pathThumb, $thumb->stream());

        $dbDirectory = '/storage/articles/img/'.$photoName;
        $dbThumbDirectory = '/storage/articles/img/thumb/'.$photoName;

        $this->article->images()->create([
            'image' => $dbDirectory,
            'thumbnail' => $dbThumbDirectory
        ]);

        $this->reset(['gallery']);

        $this->article->refresh();
    } 

    public function deleteFromGallery($id)
    {
        $image = $this->article->images()->findOrFail($id);

        $imageToDelete = Str::after($image->path, '/storage');
        $thumbToDelete = Str::after($image->thumbnail, '/storage');

        Storage::delete(['public/'.$imageToDelete, 'public/'.$thumbToDelete]);

        $image->delete();

        $this->article->refresh();

        session()->flash('success', 'Photo Deleted!');
    }

    public function unpublish()
    {
        $this->article->update([
            'draft' => 1
        ]);

        session()->flash('success', 'Article no longer visible publicly');
    }

    public function publish()
    {
        $this->article->update([
            'draft' => Null
        ]);

        session()->flash('success', 'Article published');
    }

    public function delete()
    {
        if($this->article->cover != Null)
        {
            $coverToDelete = Str::after($this->article->cover, '/storage');
            $thumbToDelete = Str::after($this->article->thumbnail, '/storage');

            Storage::delete(['public/'.$coverToDelete, 'public/'.$thumbToDelete]);
        }

        $images = $this->article->images();

        foreach($images as $image)
        {
            $imageToDelete = Str::after($image->path, '/storage');
            $thumbToDelete = Str::after($image->thumbnail, '/storage');

            Storage::delete(['public/'.$imageToDelete, 'public/'.$thumbToDelete]);
        }

        $this->article->delete();

        return redirect()->to('admin/news')->with('success', 'Article Deleted'); 

    }

    public function saveBreadcrumb()
    {
        $data = $this->validate([
            'breadcrumbtitle' => 'required',
            'breadcrumburl' => 'required'
        ]);

        $this->article->breadcrumbs()->create([
            'title' => $data['breadcrumbtitle'],
            'url' => $data['breadcrumburl'],
            'order' => $this->article->breadcrumbs()->count() + 1
        ]);

        $this->article->refresh();

        $this->reset(['breadcrumbtitle', 'breadcrumburl', 'createBreadcrumb']);

        session()->flash('success', 'Breadcrumb Saved!');
    }

    public function deleteBreadcrumb($id)
    {
        $breadcrumb = $this->article->breadcrumbs()->findOrFail($id);
        $breadcrumb->delete();

        $this->article->refresh();

        session()->flash('success', 'Breadcrumb Deleted!');
    }

    public function render()
    {
        return view('livewire.admin.article-dashboard');
    }
}

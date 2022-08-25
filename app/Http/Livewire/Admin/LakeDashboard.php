<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Lake;
use App\Models\Swim;
use App\Models\Fishgallery;
use Image;

class LakeDashboard extends Component
{
    use WithFileUploads;

    public $mode = 1;
    public $size;
    public $rodlimit;
    public $open;
    public $lrcommon;
    public $lrmirror;
    public $stock;
    public $avgsize;
    public $selectedSwim;
    public $name;
    public $shortname;
    public $photo;
    public $selectedFish;
    public $fishphoto;

    public function selectLake()
    {
        $lake = Lake::find(1);

        $this->size = $lake->size;
        $this->rodlimit = $lake->rodlimit;
        $this->open = $lake->open;
        $this->lrcommon = $lake->lrcommon;
        $this->lrmirror = $lake->lrmirror;
        $this->stock = $lake->stock;
        $this->avgsize = $lake->avgsize;

        $this->mode = 2;
    }

    public function saveLakeChanges()
    {
        $data = $this->validate([
            'size' => 'required',
            'rodlimit' => 'required',
            'open' => 'required',
            'lrcommon' => 'required',
            'lrmirror' => 'required',
            'stock' => 'required',
            'avgsize' => 'required'
        ]);

        $lake = Lake::find(1);

        $lake->update([
            'size' => $data['size'],
            'rodlimit' => $data['rodlimit'],
            'open' => $data['open'],
            'lrcommon' => $data['lrcommon'],
            'lrmirror' => $data['lrmirror'],
            'stock' => $data['stock'],
            'avgsize' => $data['avgsize']
        ]);

        $this->reset();

        session()->flash('success', 'Lake Info Updated!');
    }

    public function selectSwim($id)
    {
        $this->selectedSwim = Swim::findOrFail($id);
        $this->name = $this->selectedSwim->name;
        $this->shortname = $this->selectedSwim->shortname;
        $this->mode = 3;
    }

    public function saveSwim()
    {
        $data = $this->validate([
            'name' => 'required',
            'shortname' => 'required'
        ]);

        $lake = Lake::find(1);

        $lake->swims()->create([
            'name' => $data['name'],
            'shortname' => $data['shortname']
        ]);

        $this->reset();

        session()->flash('success', 'Swim Saved!');
    }

    public function saveSwimChanges()
    {
        $data = $this->validate([
            'name' => 'required',
            'shortname' => 'required'
        ]);

        $this->selectedSwim->update([
            'name' => $data['name'],
            'shortname' => $data['shortname']
        ]);

        $this->reset();

        session()->flash('success', 'Swim Updated!');
    }

    public function updatedPhoto()
    {
        if($this->mode == 3)
        {
            $photo = $this->photo;

            $swimName = uniqid() .'.' . $photo->getClientOriginalExtension();
            $swimThumbName = 'thumb-' . uniqid() . '.' . $photo->getClientOriginalExtension();

            $directory = 'public/swims/';
            $thumbDirectory = 'public/swims/thumbnails/';

            $photo = Image::make($this->photo);
            $thumbOne = Image::make($this->photo);

            $swim = $photo->resize(1400, null, function($constraint) 
            {
                $constraint->aspectRatio();
            });

            $swimThumb = $thumbOne->resize(600, null, function($constraint) 
            {
                $constraint->aspectRatio();
            });

            $onePath = Storage::put($directory.$swimName, $swim->stream());
            $oneThumbPath = Storage::put($thumbDirectory.$swimThumbName, $swimThumb->stream());

            $this->selectedSwim->update([
                'photo' => '/storage/swims/'.$swimName,
                'thumbnail' => '/storage/swims/thumbnails/'.$swimThumbName,
            ]);

            session()->flash('success', 'Photo Uploaded!');

            $this->reset('photo');
        } elseif($mode == 5)
        {

        }
    }

    public function saveFish()
    {
        $lake = Lake::find(1);

        $photo = $this->fishphoto;

        $fishName = uniqid() .'.' . $photo->getClientOriginalExtension();
        $fishThumbName = 'thumb-' . uniqid() . '.' . $photo->getClientOriginalExtension();

        $directory = 'public/fish/';
        $thumbDirectory = 'public/fish/thumbnails/';

        $photo = Image::make($this->fishphoto);
        $thumb = Image::make($this->fishphoto);

        $fish = $photo->resize(700, null, function($constraint) 
        {
            $constraint->aspectRatio();
        });

        $fishThumb = $thumb->resize(450, null, function($constraint) 
        {
            $constraint->aspectRatio();
        });

        $onePath = Storage::put($directory.$fishName, $fish->stream());
        $oneThumbPath = Storage::put($thumbDirectory.$fishThumbName, $fishThumb->stream());

        if($lake->images()->exists())
        {
            $order = $lake->images()->orderBy('order', 'desc')->pluck('order')->first();
            $order = $order + 1;
        } else {
            $order = 1;
        }

        if($this->selectedFish)
        {
            $this->selectedFish->update([
                'photo' => '/storage/fish/'.$fishName,
                'thumbnail' => '/storage/fish/thumbnails/'.$fishThumbName,
            ]);
        } else {
            $lake->images()->create([
                'photo' => '/storage/fish/'.$fishName,
                'thumbnail' => '/storage/fish/thumbnails/'.$fishThumbName,
                'order' => $order
            ]);
        }

        

        $this->reset();

        session()->flash('success', 'Catch Photo Uploaded');
    }

    public function selectFish($id)
    {
        $this->selectedFish = Fishgallery::findOrFail($id);

        $this->mode = 5;
    }

    public function back()
    {
        $this->reset();
    }

    public function render()
    {
        return view('livewire.admin.lake-dashboard',[
            'lake' => Lake::find(1)
        ]);
    }
}

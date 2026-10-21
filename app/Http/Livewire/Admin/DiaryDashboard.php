<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use App\Models\Photodiary;
use Carbon\Carbon;
use App\Support\Image;

class DiaryDashboard extends Component
{
    use WithFileUploads;

    public $mode;
    public $photo;
    public $caption;
    public $date;

    public $diary;

    public function mode($id)
    {
        if($id == 1)
        {
            $this->mode = 1;

            $this->dispatch('activate-datepicker');
        } elseif($id == 2)
        {
            $this->diary = Photodiary::findOrFail($photo);
            $this->mode = 2;
            $this->date = $this->diary->date;
            $this->caption = $this->caption;
            $this->dispatch('activate-datepicker');

        } elseif($id == 3)
        {
            $this->diary = Photodiary::findOrFail($photo);
            $this->mode = 3;
        }
        
    }

    public function savePost()
    {
        $data = $this->validate([
            'caption' => 'nullable',
            'photo' => 'required'
        ]);

        $date = Carbon::parse($this->date)->format('Y-m-d');

        $photo = $this->photo;

        $photoName = uniqid() .'.' . $photo->getClientOriginalExtension();

        $directory = 'public/diary';
        $thumbDirectory = 'public/diary/thumb';

        Storage::makeDirectory($directory);
        Storage::makeDirectory($thumbDirectory);

        $newPhoto = Image::make($photo)->orientate();
        $newThumb = Image::make($photo)->orientate();

        if($newPhoto->height() > $newPhoto->width())
        {
            $orientation = 1;

            $main = $newPhoto->resize(null, 1200, function($constraint) 
            {
                $constraint->aspectRatio();
            });

            $thumb = $newThumb->resize(null, 600, function($constraint) 
            {
                $constraint->aspectRatio();
            });
        } else {
            $orientation = 2;

            $main = $newPhoto->resize(1200, null, function($constraint) 
            {
                $constraint->aspectRatio();
            });

            $thumb = $newThumb->resize(600, null, function($constraint) 
            {
                $constraint->aspectRatio();
            });
        }

        $pathMain = $directory . '/' . $photoName;
        $pathThumb = $thumbDirectory . '/' . $photoName;

        Storage::put($pathMain, $main->stream());
        Storage::put($pathThumb, $thumb->stream());

        $dbDirectory = '/storage/diary/'.$photoName;
        $dbThumbDirectory = '/storage/diary/thumb/'.$photoName;

        Photodiary::create([
            'photo' => $dbDirectory,
            'thumbnail' => $dbThumbDirectory,
            'date' => $date,
            'caption' => $data['caption'],
            'is_featured' => 0,
            'orientation' => $orientation,
        ]);

        session()->flash('success', 'Post Sucessfully Uploaded!');

        $this->reset(['photo', 'caption', 'date', 'mode']);

    }

    public function setmode($id, $photo)
    {
       if($id == 2)
        {
            $this->diary = Photodiary::findOrFail($photo);
            $this->mode = 2;

        } elseif($id == 3)
        {
            $this->diary = Photodiary::findOrFail($photo);
            $this->mode = 3;
        }
    }

    public function feature($id)
    {
        Photodiary::where('is_featured', 1)->update([
            'is_featured' => Null
        ]);

        Photodiary::find($id)->update([
            'is_featured' => 1
        ]);

        session()->flash('success', 'Feature Photo Set!');

        $this->reset('mode');
    }

    public function secondary($id)
    {
        Photodiary::where('is_featured', 2)->update([
            'is_featured' => Null
        ]);

        Photodiary::find($id)->update([
            'is_featured' => 2
        ]);

        session()->flash('success', 'Secondary Photo Set!');

        $this->reset('mode');

    }

    public function update($id)
    {

    }

    public function delete()
    {
        $this->diary->delete();

        session()->flash('success', 'Photo Deleted!');

        $this->reset(['mode', 'diary']);
    }

    public function render()
    {

        return view('livewire.admin.diary-dashboard',[
            'photos' => Photodiary::orderBy('date', 'desc')->get(),
            'featured' => Photodiary::where('is_featured', '1')->first(),
            'secondary' => Photodiary::where('is_featured', '2')->first()
        ]);
       
    }
}

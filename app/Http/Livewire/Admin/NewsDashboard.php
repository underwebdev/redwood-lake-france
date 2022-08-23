<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use App\Models\Article;
use Image;
use Auth;

class NewsDashboard extends Component
{
    use WithFileUploads;

	public $mode;
    public $title;
    public $body;
    public $cover;
    public $attachment;
    public $lodge;
    public $metatitle;
    public $metadesc;
    public $metakeywords;
    public $url;
    public $status;

    public $total;
    public $count = '1';

    public function saveArticle()
    {
        $data = $this->validate([
            'title' => 'required',
            'cover' => 'sometimes',
            'body' => 'required',
            'attachment' => 'sometimes',
            'status' => 'nullable',
            'metatitle' => 'exclude_unless:status,1|required',
            'metadesc' => 'exclude_unless:status,1|required',
            'metakeywords' => 'exclude_unless:status,1|required',
            'url' => 'exclude_unless:status,1|required|unique:articles'
        ]);

        if($this->cover) 
        {
            $photo = $this->cover;

            $photoName = uniqid() .'.' . $photo->getClientOriginalExtension();

            $directory = 'public/articles/img';
            $thumbDirectory = 'public/articles/img/thumb';

            Storage::makeDirectory($directory);
            Storage::makeDirectory($thumbDirectory);

            $newPhoto = Image::make($photo)->orientate();
            $newThumb = Image::make($photo)->orientate();

            $main = $newPhoto->resize(1200, null, function($constraint) 
            {
                $constraint->aspectRatio();
            });

            $thumb = $newThumb->resize(400, null, function($constraint) 
            {
                $constraint->aspectRatio();
            });

            $pathMain = $directory . '/' . $photoName;
            $pathThumb = $thumbDirectory . '/' . $photoName;

            Storage::put($pathMain, $main->stream());
            Storage::put($pathThumb, $thumb->stream());

            $dbDirectory = '/storage/articles/img/'.$photoName;
            $dbThumbDirectory = '/storage/articles/img/thumb/'.$photoName;

        } else {
            $dbDirectory = Null;
            $dbThumbDirectory = Null;
        }

        if($data['attachment'])
        {
            $fileDirectory = '/' . Storage::put('pdfs', $this->attachment);

        } else {
            $fileDirectory = Null;
        }

        Auth::user()->admin->articles()->create([
            'title' => $data['title'],
            'cover' => $dbDirectory,
            'thumbnail' => $dbThumbDirectory,
            'body' => $data['body'],
            'attachment' => $fileDirectory,
            'metatitle' => $data['metatitle'],
            'metadescription' => $data['metadesc'],
            'metakeywords' => $data['metakeywords'],
            'url' => $data['url']
        ]);

        $this->reset(['title', 'cover', 'body', 'attachment', 'mode']);
    }

    public function render()
    {
        return view('livewire.admin.news-dashboard',[
        	'articles' => Article::latest()->paginate(24),
        ]);
    }
}

<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Review;

class ReviewDashboard extends Component
{
    public $mode = 1;
    public $body;
    public $name;
    public $featured;
    public $selectedReview;

    public function saveReview()
    {
        $data = $this->validate([
            'body' => 'required',
            'name' => 'required',
            'featured' => 'nullable'
        ]);

        if($data['featured'] == 1)
        {
            Review::where('featured', 1)->update([
                'featured' => Null
            ]);
        }

        Review::create([
            'body' => $data['body'],
            'name' => $data['name'],
            'featured' => $data['featured']
        ]);

        $this->reset();

        session()->flash('success', 'Review Saved!');
    }

    public function selectReview($id)
    {
        $this->selectedReview = Review::findOrFail($id);

        $this->body = $this->selectedReview->body;
        $this->name = $this->selectedReview->name;
        $this->featured = $this->selectedReview->featured;

        $this->mode = 3; 
    }

    public function saveReviewChanges()
    {
        $data = $this->validate([
            'body' => 'required',
            'name' => 'required',
            'featured' => 'nullable'
        ]);

        if($data['featured'] == 1)
        {
            Review::where('featured', 1)->update([
                'featured' => Null
            ]);
        }

        $this->selectedReview->update([
            'body' => $data['body'],
            'name' => $data['name'],
            'featured' => $data['featured']
        ]);

        $this->reset();

        session()->flash('success', 'Review Saved!');
    }

    public function deleteReview()
    {
        $this->selectedReview->delete();

        $this->reset();

        session()->flash('success', 'Review Deleted!');
    }

    public function back()
    {
        $this->reset();
    }

    public function render()
    {
        return view('livewire.admin.review-dashboard', [
            'reviews' => Review::latest()->get()
        ]);
    }
}

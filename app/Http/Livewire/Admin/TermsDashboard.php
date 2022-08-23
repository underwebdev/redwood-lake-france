<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Term;

class TermsDashboard extends Component
{
    public $mode = 1;
    public $body;
    public $selectedTerm;

    public function selectTerm($id)
    {
        $this->selectedTerm = Term::findOrFail($id);
        $this->body = $this->selectedTerm->body;
        $this->mode = 3;
    }

    public function saveTerm()
    {
        $data = $this->validate([
            'body' => 'required'
        ]);

        if(Term::count() < 1)
        {
            $order = 0;
        } else {
            $order = Term::orderBy('order', 'desc')->pluck('order')->first();
        }

        Term::create([
            'body' => $data['body'],
            'order' => $order + 1
        ]);

        $this->reset(['mode', 'body']);

        session()->flash('success', 'Term Updated!');
    }

    public function saveTermChanges()
    {
        $data = $this->validate([
            'body' => 'required'
        ]);

        $this->selectedTerm->update([
            'body' => $data['body']
        ]);

        $this->reset(['mode', 'body']);

        session()->flash('success', 'Term Updated!');

    }

    public function back()
    {
        $this->reset();
    }

    public function delete($id)
    {
        Term::findOrFail($id)->delete();

        $this->reset();

        session()->flash('success', 'Rule Deleted!');
    }

    public function render()
    {
        return view('livewire.admin.terms-dashboard',[
            'terms' => Term::orderBy('order', 'asc')->get()
        ]);
    }
}

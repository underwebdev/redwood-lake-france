<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Rule;

class RuleDashboard extends Component
{
    public $mode = 1;
    public $body;
    public $selectedRule;

    public function selectRule($id)
    {
        $this->selectedRule = Rule::findOrFail($id);
        $this->body = $this->selectedRule->body;
        $this->mode = 3;
    }

    public function saveRule()
    {
        $data = $this->validate([
            'body' => 'required'
        ]);

        if(Rule::count() < 1)
        {
            $order = 0;
        } else {
            $order = Rule::orderBy('order', 'desc')->pluck('order')->first();
        }

        Rule::create([
            'body' => $data['body'],
            'order' => $order + 1
        ]);

        $this->reset(['mode', 'body']);

        session()->flash('success', 'Rule Updated!');
    }

    public function saveRuleChanges()
    {
        $data = $this->validate([
            'body' => 'required'
        ]);

        $this->selectedRule->update([
            'body' => $data['body']
        ]);

        $this->reset(['mode', 'body']);

        session()->flash('success', 'Rule Updated!');

    }

    public function back()
    {
        $this->reset();
    }

    public function delete($id)
    {
        Rule::findOrFail($id)->delete();

        $this->reset();

        session()->flash('success', 'Rule Deleted!');
    }

    public function render()
    {
        return view('livewire.admin.rule-dashboard',[
            'rules' => Rule::orderBy('order', 'asc')->get()
        ]);
    }
}

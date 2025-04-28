<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Contact;

class InboxDashboard extends Component
{
    public $mode = 1;
    public $selectedMessage;

    public function selectMessage($id)
    {
        $this->selectedMessage = Contact::findOrFail($id);
        $this->mode = 3;
    }

    public function archiveMessage($id)
    {
        $this->selectedMessage->update([
            'archive' => 1
        ]);

        $this->reset();

        session()->flash('success', 'Message Archived!');
    }

    public function unarchive($id)
    {
        $this->selectedMessage->update([
            'archive' => Null 
        ]);

        $this->reset();

        session()->flash('success', 'Message Unarchived!');
    }

    public function deleteMessage($id)
    {
        Contact::findOrFail($id)->delete();

        $this->reset();

        session()->flash('success', 'Message Deleted!');
    }

    public function render()
    {
        return view('livewire.admin.inbox-dashboard',[
            'messages' => Contact::whereNull('archive')->latest()->get(),
            'archives' => Contact::whereNotNull('archive')->get()
        ]);
    }
}

<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Maillist;
use App\Models\Mailshot;
use Illuminate\Support\Facades\Mail;
use App\Mail\PromoEmail;
use App\Jobs\ProcessMailshot;
use Carbon\Carbon;

class MailshotDashboard extends Component
{
    public $mode;
    public $members;
    public $maillist;

    public $title;
    public $subject;
    public $body;
    public $link;

    public $mailshot;
    public $date;
    public $time;

    public $edit;

    public function mode($id)
    {
        $this->mode = $id;
    }

    public function mailshotToReview($id)
    {
        $this->mailshot = Mailshot::findOrFail($id);

        $this->mode = 2;

        $this->dispatchBrowserEvent('activate-datepicker');
    }

    public function selectList($id)
    {
        if($id == 1)
        {
            $this->maillist = Member::whereNotNull('memberNo')->where('email', 1)->orderBy('joined', 'asc')->get();

        } elseif($id == 2)
        {
            $this->maillist = Member::whereNotNull('memberNo')->where('post', 1)->orderBy('joined', 'asc')->get();

        } elseif($id == 3)
        {
            $this->maillist = Member::whereNotNull('memberNo')->whereNull('post')->whereNull('email')->orderBy('joined', 'asc')->get();
        }

    }

    public function resetlist()
    {
        $this->reset('maillist');
    }

    public function saveMailshot()
    {
        $data = $this->validate([
            'subject' => 'required',
            'title' => 'required',
            'body' => 'required',
            'link' => 'nullable'
        ]);

        $this->mailshot = Mailshot::create([
            'subject' => $data['subject'],
            'title' => $data['title'],
            'body' => $data['body'],
            'link' => $data['link']
        ]);

        $this->mode = 2;

        $this->dispatchBrowserEvent('activate-datepicker');
    }

    public function scheduleEmail()
    {
        $this->validate([
            'time' => 'required'
        ]);

        $datetime = Carbon::parse($this->date)->toDateString() .' '. $this->time;

        $this->mailshot->update([
            'scheduled' => $datetime
        ]);

        session()->flash('success', 'Email Schedule Set!');

    }

    public function rescheduleEmail()
    {
        $this->mailshot->update([
            'scheduled' => Null
        ]);

        $this->dispatchBrowserEvent('activate-datepicker');
    }

    public function editMail()
    {
        $this->title = $this->mailshot->title;
        $this->subject = $this->mailshot->subject;
        $this->body = $this->mailshot->body;
        $this->link = $this->mailshot->link;

        $this->edit = true;
    }

    public function updateMail()
    {
        $data = $this->validate([
            'subject' => 'required',
            'title' => 'required',
            'body' => 'required',
            'link' => 'nullable'
        ]);

        $this->mailshot->update([
            'subject' => $data['subject'],
            'title' => $data['title'],
            'body' => $data['body'],
            'link' => $data['link']
        ]);

        $this->reset('edit');
    }

    public function delete($id)
    {
        $mailshot = Mailshot::findOrFail($id);

        $mailshot->delete();
    }

    public function processMailshot()
    {
        $this->mailshot->update([
            'sent' => Carbon::now()
        ]);

        ProcessMailshot::dispatch($this->mailshot);
    }

    public function render()
    {
        return view('livewire.admin.mailshot-dashboard',[
            'mailshots' => Mailshot::latest()->get(),
            'subscribers' => Maillist::whereNotNull('subscribed')->get(),
            'unsubs' => Maillist::whereNull('subscribed')->get()
        ]);
    }
}

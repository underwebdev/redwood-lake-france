<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Page;
use App\Models\Module;

class ContentDashboard extends Component
{
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

    public function selectPage($id)
    {
        $this->selectedPage = Page::findOrFail($id);

        $this->name = $this->selectedPage->name;
        $this->metatitle = $this->selectedPage->metatitle;
        $this->metadesc = $this->selectedPage->metadescription;
        $this->metakeywords = $this->selectedPage->metakeywords;
        $this->heading = $this->selectedPage->heading;
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

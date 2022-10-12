<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Payout;

class PayoutDashboard extends Component
{
    public $mode = 1;
    public $selectedpayout;

    public function selectPayout($id)
    {
        $this->selectedpayout = Payout::findOrFail($id);
        $this->mode = 2;
    }

    public function back()
    {
        $this->reset();
    }
    
    public function render()
    {
        return view('livewire.admin.payout-dashboard',[
            'payouts' => Payout::orderBy('due', 'desc')->get()
        ]);
    }
}

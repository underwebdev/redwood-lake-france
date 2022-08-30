<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class FinancialDashboard extends Component
{
    public $mode = 1;
    
    public function render()
    {
        return view('livewire.admin.financial-dashboard');
    }
}

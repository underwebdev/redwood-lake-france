<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Voucher;
use Carbon\Carbon;

class VoucherDashboard extends Component
{
    public $mode = 1;
    public $code;
    public $amount;
    public $limit;
    public $start;
    public $validity;
    public $end;
    public $status;
    public $selectedVoucher;
    public $lookup;

    public function saveVoucher()
    {
        $data = $this->validate([
            'code' => 'required|min:4',
            'amount' => 'required|numeric',
            'limit' => 'required|numeric',
            'start' => 'required|date',
            'validity' => 'nullable',
            'end' => 'exclude_unless:validity,1|required|date',
        ]);

        if($data['validity'] == 1)
        {
            $end = $data['end'];
        } else {
            $end = $data['start'];
        }

        Voucher::create([
            'code' => $data['code'],
            'amount' => $data['amount'] * 100,
            'limit' => $data['limit'],
            'start' => Carbon::parse($data['start'])->format('Y-m-d'),
            'end' => Carbon::parse($end)->format('Y-m-d'),
            'active' => 1
        ]);

        $this->reset();

        session()->flash('success', 'Voucher Saved!');

    }

    public function selectVoucher($id)
    {
        $this->selectedVoucher = Voucher::findOrFail($id);

        $this->code = $this->selectedVoucher->code;
        $this->amount = $this->selectedVoucher->amount / 100;
        $this->limit = $this->selectedVoucher->limit;
        $this->start = Carbon::parse($this->selectedVoucher->start)->format('d-m-Y');

        if($this->selectedVoucher->end > $this->selectedVoucher->start)
        {
            $this->validity = 1;
            $this->end = Carbon::parse($this->selectedVoucher->end)->format('d-m-Y');

            
        }

        $this->status = $this->selectedVoucher->active;

        $this->dispatchBrowserEvent('activate-datepicker');

        $this->mode = 2;

    }

    public function saveVoucherChanges()
    {
        $data = $this->validate([
            'code' => 'required|min:4',
            'amount' => 'required|numeric',
            'limit' => 'required|numeric',
            'start' => 'required|date',
            'validity' => 'nullable',
            'end' => 'exclude_unless:validity,1|required|date',
            'status' => 'nullable'
        ]);

        if($data['validity'] == 1)
        {
            $end = $data['end'];
        } else {
            $end = $data['start'];
        }

        $this->selectedVoucher->update([
            'code' => $data['code'],
            'amount' => $data['amount'] * 100,
            'limit' => $data['limit'],
            'start' => Carbon::parse($data['start'])->format('Y-m-d'),
            'end' => Carbon::parse($end)->format('Y-m-d'),
            'active' => $data['status']
        ]);

        $this->reset();

        session()->flash('success', 'Voucher Updated!');
    }

    public function updatedValidity()
    {
        if($this->validity != 1)
        {
            $this->reset(['end']);
        }

        $this->dispatchBrowserEvent('activate-datepicker');
    }

    public function updatedMode()
    {
        $this->dispatchBrowserEvent('activate-datepicker');
    }

    public function back()
    {
        $this->reset();
    }

    public function render()
    {
        $lookup = $this->lookup;

        return view('livewire.admin.voucher-dashboard',[
            'vouchers' => Voucher::when($lookup, function ($query) use ($lookup) {
                    return $query->where('code', 'like', '%' . $lookup . '%');
                })->get()
        ]);
    }
}

<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Priceguide;
use App\Models\Booking;
use App\Models\Placeholder;
use Carbon\Carbon;
use Carbon\CarbonInterval;

class BookingCalendar extends Component
{
    public $firstdate;
    public $latestdate;
    public $bookingdates; 
    public $bookingmonths;
    public $selectedMonth;
    public $selectedYear;
    public $filteredRange;
    public $filteredDates;

    public function mount()
    {

        $this->firstdate = Priceguide::where('end', '>', Carbon::today())->orderBy('start', 'asc')->pluck('start')->first();

        $this->latestdate = Priceguide::orderBy('end', 'desc')->pluck('end')->first();

        $this->bookingdates = Collect(CarbonInterval::days(7)->toPeriod($this->firstdate, $this->latestdate));
        $this->bookingmonths = Collect(CarbonInterval::months(1)->toPeriod(Carbon::parse($this->firstdate)->startOfMonth(), $this->latestdate));
        $this->bookingyears = Collect(CarbonInterval::years(1)->toPeriod($this->firstdate, $this->latestdate));

        

    }

    public function updatedSelectedMonth()
    {
        if($this->selectedYear > 0 && $this->selectedMonth > 0)
        {
            $this->selectedDate = '01-' . $this->selectedMonth . '-' . $this->selectedYear;
            
            $filtered = Collect([]);

            foreach($this->bookingdates as $date)
            {
                $my = Carbon::parse($date)->format('Y-m');

                if($my == $this->selectedYear . '-' . $this->selectedMonth)
                {
                    $filtered->push(['date' => $date]);
                }
            }

            $this->filteredDates = $filtered;

            $this->filteredRange = true;
            
        }

        $this->dispatchBrowserEvent('activate-gsap');

        
    }

    public function updatedSelectedYear()
    {
        if($this->selectedMonth && $this->selectedYear > 0)
        {
            $this->selectedDate = '01-' . $this->selectedMonth . '-' . $this->selectedYear;
            
            $filtered = Collect([]);

            foreach($this->bookingdates as $date)
            {
                $my = Carbon::parse($date)->format('Y-m');

                if($my == $this->selectedYear . '-' . $this->selectedMonth)
                {
                    $filtered->push(['date' => $date]);
                }
            }

            $this->filteredDates = $filtered;
            $this->filteredRange = true;
        }

        $this->dispatchBrowserEvent('activate-gsap');
    }

    public function clearFilter()
    {
        $this->reset(['selectedMonth', 'selectedYear', 'filteredRange']);
        $this->dispatchBrowserEvent('activate-gsap');
    }

    public function render()
    {
        return view('livewire.booking-calendar',[
            'placeholders' => Placeholder::all(),
            'bookings' => Booking::where('arrival', '>=', Carbon::today())->get(),
        ]);
    }
}

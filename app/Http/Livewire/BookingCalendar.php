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

    public function mount()
    {

        $this->firstdate = Priceguide::where('end', '>', Carbon::today())->orderBy('start', 'asc')->pluck('start')->first();

        $this->latestdate = Priceguide::orderBy('end', 'desc')->pluck('end')->first();

        $this->bookingdates = Collect(CarbonInterval::days(7)->toPeriod($this->firstdate, $this->latestdate));
        $this->bookingmonths = Collect(CarbonInterval::months(1)->toPeriod($this->firstdate, $this->latestdate));
        $this->bookingyears = Collect(CarbonInterval::years(1)->toPeriod($this->firstdate, $this->latestdate));

    }

    public function render()
    {
        return view('livewire.booking-calendar',[
            'placeholders' => Placeholder::all(),
            'bookings' => Booking::where('arrival', '>=', $this->firstdate)->where('arrival', '<=', $this->latestdate)->get()->pluck('arrival'),
        ]);
    }
}

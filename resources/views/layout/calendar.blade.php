@foreach($bookingmonths as $month)
@if(Carbon\Carbon::parse($month)->format('Y-m') >= Carbon\Carbon::now()->format('Y-m') AND $loop->index < 6)
    <div class="cell small-12 text-center">
        <h5 class="month-bar">{{ Carbon\Carbon::parse($month)->format('F Y') }}</h5>  
    </div><!-- End of cell-->
    @foreach($bookingdates as $date)
    @if($date > Carbon\Carbon::now())
        @if(Carbon\Carbon::parse($date)->format('Y-m') == Carbon\Carbon::parse($month)->format('Y-m'))
        <div class="cell small-6 medium-4 large-3 text-center">
            <div wire:ignore>
            <div class="date-container">
                <div class="date-tile">
                    <p>{{ Carbon\Carbon::parse($date)->format('F') }}</p>
                    <h3>{{ Carbon\Carbon::parse($date)->format('j') }}</h3>
                    <p>{{ Carbon\Carbon::parse($date)->format('Y') }}</p>
                </div>
                @if($bookings->where('arrival', Carbon\Carbon::parse($date)->format('Y-m-d'))->count() > 0)
                    <button class="button disabled expanded" disabled>Unavailable</button>
                @elseif($placeholders->where('date', Carbon\Carbon::parse($date)->format('Y-m-d'))->count() > 0)
                    <button class="button disabled expanded" disabled>Unavailable</button>
                @else
                <div wire:ignore>
                    <a href="/deposit/{{ Carbon\Carbon::parse($date)->format('d-m-Y') }}" class="button success expanded">Book Now</a>
                </div>
                @endif
            </div>
            </div>
        </div><!-- End of cell-->
        @endif
    @endif
    @endforeach
@endif
@endforeach

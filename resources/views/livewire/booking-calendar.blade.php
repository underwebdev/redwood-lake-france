<div>
<div class="grid-container">
    <div class="grid-x grid-padding-x">
        <div class="cell small-12 text-center">
            <h4 id="bookingcalender"><span class="weighted">Booking</span> Availabillity</h4>
            <p>We are currently taking bookings up until {{ Carbon\Carbon::parse($latestdate)->format('F Y') }}. All bookings run from 2pm Saturday to 10am Saturday. Please check for availability below.</p>
            <p><span class="error">Bookings at Redwood Lake are currently available to Croxley Hall Syndicate members only.</span></p>
        </div>
    </div>
    <div class="grid-x grid-padding-x">
        <div class="cell small-12 medium-6">
            <select id="" wire:model="selectedMonth">
                <option value="">Select Month</option>
                <option value="01">January</option>
                <option value="02">Febuary</option>
                <option value="03">March</option>
                <option value="04">April</option>
                <option value="05">May</option>
                <option value="06">June</option>
                <option value="07">July</option>
                <option value="08">August</option>
                <option value="09">September</option>
                <option value="10">October</option>
                <option value="11">November</option>
                <option value="12">December</option>
            </select>
        </div><!-- End of cell--> 
        <div class="cell small-12 medium-6">
            <select id="" wire:model="selectedYear">
                <option value="">Select Year</option>
                <option value="{{ Carbon\Carbon::now()->format('Y') }}">{{ Carbon\Carbon::now()->format('Y') }}</option>
                <option value="{{ Carbon\Carbon::now()->addyear()->format('Y') }}">{{ Carbon\Carbon::now()->addyear()->format('Y') }}</option>  
            </select>        
        </div><!-- End of cell-->
    </div><!--end of grid-x -->
    <div class="grid-x grid-padding-x">
        @if($filteredRange)
        <div class="cell small-12 text-center">
            <h5 class="month-bar">{{ Carbon\Carbon::parse($selectedDate)->format('F Y') }}</h5>
            <div class="grid-x grid-padding-x">
                @if($filteredDates->count() > 0)
                    @foreach($filteredDates as $date)
                        @if(Carbon\Carbon::parse($date['date'])->format('Y-m') == Carbon\Carbon::parse($selectedDate)->format('Y-m'))
                        <div class="cell small-6 medium-4 ml-3 text-center">
                            
                            <div class="date-container">
                                <div class="date-tile">
                                    <p>{{ Carbon\Carbon::parse($date['date'])->format('F') }}</p>
                                    <h3>{{ Carbon\Carbon::parse($date['date'])->format('j') }}</h3>
                                    <p>{{ Carbon\Carbon::parse($date['date'])->format('Y') }}</p>
                                </div>
                                @if($bookings->where('arrival', Carbon\Carbon::parse($date['date'])->format('Y-m-d'))->count() > 0)
                                    <button class="button disabled expanded" disabled>Unavailable</button>
                                @elseif($placeholders->where('date', Carbon\Carbon::parse($date['date'])->format('Y-m-d'))->count() > 0)
                                    <button class="button disabled expanded" disabled>Unavailable</button>
                                @else
                                    <a href="/deposit/{{ Carbon\Carbon::parse($date['date'])->format('d-m-Y') }}" class="button success expanded">Book Now</a>
                                
                                @endif
                            </div>
                       
                        </div><!-- End of cell--> 
                        @endif
                    @endforeach
                @else
                    <div class="cell small-12 text-center">
                        <br>
                        <p><strong>No dates available</strong></p>      
                    </div><!-- End of cell-->
                @endif
               
            
                @if($filteredRange)
                <div class="cell small-12 text-center">
                    <br>
                    <button class="button" wire:click="clearFilter">View All Dates</button>       
                </div><!-- End of cell-->
                @endif    
            </div><!--end of grid-x -->
        </div> 

        
        @else
            @foreach($bookingmonths as $month)
            @if(Carbon\Carbon::parse($month)->format('Y-m') >= Carbon\Carbon::now()->format('Y-m'))
                <div class="cell small-12 ml-6 text-center">
                    <h5 class="month-bar">{{ Carbon\Carbon::parse($month)->format('F Y') }}</h5>  
                
                <div class="grid-x grid-padding-x">
                @foreach($bookingdates as $date)
                @if($date > Carbon\Carbon::now())
                    @if(Carbon\Carbon::parse($date)->format('Y-m') == Carbon\Carbon::parse($month)->format('Y-m'))
                    <div class="cell small-6 ml-4 text-center">
                    
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
                           
                            <a href="/deposit/{{ Carbon\Carbon::parse($date)->format('d-m-Y') }}" class="button success expanded">Book Now</a>
                          
                            @endif
                        </div>
                     
                    </div><!-- End of cell-->
                    @endif
                @endif
                @endforeach         
                </div><!--end of grid-x -->
                </div><!-- End of cell-->
            @endif
            @endforeach
        @endif
    </div><!--end of grid-x -->
</div><!--End of grid container-->
</div>

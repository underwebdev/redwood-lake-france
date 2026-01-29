<div>
    <div class="grid-container">
        <div class="grid-x grid-padding-x">
            <div class="cell small-12 medium-4">
                <select wire:model="selectedSpecies">
                    <option value="">Select Species</option>
                    @foreach($specimens as $specimen)
                    <option value="{{ $specimen->id }}">{{ $specimen->name }}</option>
                    @endforeach
                </select>  
            </div><!-- End of cell-->
            <div class="cell small-12 medium-4">
               <select wire:model="selectedWeight">
                    <option value="">Select Weight</option>
                    <option value="10">10+</option>
                    <option value="20">20+</option>
                    <option value="30">30+</option>
                    <option value="40">40+</option> 
                </select>        
            </div><!-- End of cell-->
            <div class="cell small-12 medium-4">
                <select wire:model="selectedSwim">
                    <option value="">Select Swim</option>
                    @foreach($swims as $swim)
                    <option value="{{ $swim->id }}">{{ $swim->name }}</option>
                    @endforeach
                </select>      
            </div><!-- End of cell-->
        </div><!--end of grid-x -->
    </div><!--End of grid container-->

    <div class="grid-container">
        @if($mode == 1)
        <div class="grid-x grid-padding-x">
            <div class="cell small-12">
                <div class="table-scroll">
                    <table>
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Name</th>
                                <th class="tspace">Weight</th>
                                <th>Species</th>
                                <th></th>
                                <th></th>
                                <th class="text-center">Swim</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reports as $report)
                            <tr>
                                <td>{{ date('j/m/y', strtotime ($report->date)) }}</td>
                                <td>{{ $report->angler->firstName }} {{ $report->angler->lastName }}</td>
                                <td width="200" class="bluereport ">{{ $report->lbs }}lb {{ $report->oz }}oz</td>
                                <td>{{ $report->specimen->name }}</td>
                                <td class="text-center">
                                    @isset($report->sideone)
                                        <a href="/assets/catch-reports/sideone/{{ $report->id }}.{{ Str::afterLast($report->sideone, '.') }}" data-lity>
                                            @include('icons.camera')
                                        </a>
                                    @endisset
                                </td>
                                <td class="text-center">
                                    @isset($report->sidetwo)
                                        <a href="/assets/catch-reports/sidetwo/{{ $report->id }}.{{ Str::afterLast($report->sidetwo, '.') }}" data-lity>
                                            @include('icons.camera')
                                        </a>
                                    @endisset
                                </td>
                                <td class="text-center">
                                    @isset($report->swim_id)
                                        {{ $report->swim->shortname }}
                                    @else
                                        N/A
                                    @endisset 
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="text-center">
                    {{ $reports->links() }}
                </div>
                <div class="text-center">
                    <button class="button success" wire:click="$set('mode', 2)">Gallery View</button>
                </div>
            </div><!-- End of cell-->
        </div><!--end of grid-x -->
        @else
            <div class="grid-x grid-padding-x">
                @foreach($reports->whereNotNull('sideone') as $report)
                <div class="cell small-6 medium-4 ml-3">
                    <div class="report-polaroid">
                        <a href="/assets/catch-reports/sideone/{{ $report->id }}.{{ Str::afterLast($report->sideone, '.') }}" data-lity>
                            <img src="/assets/catch-reports/sideone/{{ $report->id }}">
                        </a>
                        <p class="text-center">{{ $report->lbs }}lb {{ $report->oz }}oz</p>
                    </div>
                </div><!-- End of cell-->
                @endforeach         
            </div><!--end of grid-x -->
            <div class="grid-x grid-padding-x">
                <div class="cell small-12">
                    <div class="text-center">
                        {{ $reports->links() }}
                    </div> 
                </div><!-- End of cell-->
                <div class="cell small-12">
                    <div class="text-center">
                        <button class="button success" wire:click="$set('mode', 1)">Table View</button>
                    </div>
                </div><!-- End of cell-->      
            </div><!--end of grid-x -->
            @endif
        
    </div><!--End of grid container-->
</div>

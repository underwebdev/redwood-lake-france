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
                                        <a href="{{ $report->sideone }}" data-lity><i class="fas fa-camera"></i></a>
                                    @endisset
                                    @isset($report->sidetwo)
                                        <a href="{{ $report->sidetwo }}" data-lity><i class="fas fa-camera"></i></a>
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
            </div><!-- End of cell-->
        </div><!--end of grid-x -->
    </div><!--End of grid container-->
</div>

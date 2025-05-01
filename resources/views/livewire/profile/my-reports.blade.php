<div>
    <div class="grid-container">
        @include('layout.alerts')
        <div class="grid-x grid-padding-x">
            <div class="cell small-12">
                <h5 class="info-bar">Your Reports</h5>
                <div class="table-scroll">
                    <table>
                        <thead>
                            <tr>
                                <th>Reports</th>
                                <th>Common</th>
                                <th>Mirror</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ Auth::user()->angler->reports()->count() }}</td>
                                <td>{{ Auth::user()->angler->reports()->where('specimen_id', 1)->count() }}</td>
                                <td>{{ Auth::user()->angler->reports()->where('specimen_id', 2)->count() }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="text-center">
                    <a href="/my-account/upload-report" class="button success">Add Report</a>
                </div>
                    
                <div class="grid-x grid-padding-x">
                    <div class="cell small-12 medium-4">
                        <select wire:model="selectedSpecies">
                            <option value="">Select Species</option>
                            @foreach($species as $specimen)
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
                                    <th></th>
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
                                    <td class="text-right">
                                        <a href="/my-account/update-report/{{ $report->id }}" class="button success small">Update</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                        <div class="text-center">
                            {{ $reports->links() }}
                        </div>  
                    </div><!-- End of cell-->
            </div><!-- End of cell-->
        </div><!--end of grid-x -->
    </div><!--End of grid container-->
</div>

<div>
    <div class="grid-container">
        <div class="grid-x grid-padding-x">
            @if($mode == 1)
            <div class="cell small-12">

                <h5 class="info-bar">Latest Reports</h5>
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
                                            <a href="/assets/catch-reports/sideone/{{ $report->id }}.{{ Str::afterLast($report->sideone, '.') }}" data-lity>@include('icons.camera')</a>
                                          
                                        @endisset
                                        @isset($report->sidetwo)
                                            <a href="/assets/catch-reports/sidetwo/{{ $report->id }}.{{ Str::afterLast($report->sidetwo, '.') }}" data-lity>@include('icons.camera')</a>
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
                    </div><!-- End of cell-->
                </div><!--end of grid-x -->
            </div><!-- End of cell-->
            @elseif($mode == 2)
            <div class="cell small-12 medium-8 large-6 medium-offset-2 large-offset-3">
                <h5 class="info-bar">Upload Catch Report</h5>
                <div class="grid-x grid-padding-x">
                    <div class="cell small-6">
                        <label for="">lbs
                        @error('lbs')
                            <span class="error">{{ $message }}</span>
                        @enderror</label>
                        <input type="text" placeholder="" wire:model="lbs">      
                    </div><!-- End of cell-->
                    <div class="cell small-6">
                        <label for="">oz
                            @error('oz')
                                <span class="error">{{ $message }}</span>
                            @enderror</label>
                        <input type="text" placeholder="" wire:model="oz">
                    </div><!-- End of cell-->
                </div><!--end of grid-x -->

                <label for="">Species
                    @error('specimen')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </label>
                <select id="" wire:model="specimen">
                    <option value="">Select a species</option>
                    @foreach($species as $specimen)
                    <option value="{{ $specimen->id }}">{{ $specimen->name }}</option>
                    @endforeach 
                </select>
                
                <label for="">Date
                    @error('date')
                        <span class="error">{{ $message }}</span>
                    @enderror</label>
                <input type="text" id="datepicker" readonly wire:model.lazy="date">

                <label for="">Swim</label>
                <select id="" wire:model="swim">
                    <option value="">Please Select</option>
                    @foreach($swims as $swim)
                    <option value="{{ $swim->id }}">{{ $swim->name }}</option>
                    @endforeach 
                </select>

                <label for="">Bait (optional)</label>
                <input type="text" placeholder="" wire:model="bait">

                <label for="">Notes (optional)
                <textarea wire:model="notes" cols="50" rows="10"></textarea>

                <div class="grid-x grid-padding-x">
                    <div class="cell small-12 medium-6">
                        <label for="">Side One
                            @error('sideone')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </label>
                        <input type="file" wire:model="sideone">
                        @if($sideone)
                        <div class="photo-preview">
                            <img src="{{ $sideone->temporaryUrl() }}">
                        </div>
                        @endif
                          
                    </div><!-- End of cell-->
                    <div class="cell small-12 medium-6">
                        <label for="">Side Two
                            @error('sidetwo')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </label>
                        <input type="file" wire:model="sidetwo">
                        @if($sidetwo)
                        <div class="photo-preview">
                            <img src="{{ $sidetwo->temporaryUrl() }}">
                        </div>
                        @endif
                    </div><!-- End of cell-->
                    <div class="cell small-12 text-center" wire:loading>
                        <strong>Please Wait ....</strong>
                    </div>
                </div><!--end of grid-x -->
                <br>
                <div class="button-group" wire:loading.remove>
                    <button class="button success" wire:click="saveReport">Upload Report</button>
                    <button class="button alert" wire:click="back">Cancel</button>
                </div>
                  
            </div><!-- End of cell-->

            @endif
        </div><!--end of grid-x -->
    </div><!--End of grid container-->
</div>

<div>
    <div class="grid-container full">
        <div class="grid-x grid-padding-x">
            <div class="cell small-12">
                <div class="admin-title-panel">
                    <div class="grid-x">
                        <div class="cell small-12 medium-6">
                            <h1>Catch Reports</h1>
                        </div>
                        <div class="cell small-12 medium-6 text-right align-self-middle">
                            @if($mode == 1)
                                <button class="button warning" wire:click="$toggle('view')">
                                    @if($view)
                                        Table View 
                                    @else 
                                        Gallery View
                                    @endif
                                </button>
                                <button class="button success" wire:click="$set('mode', 2)">New Report</button>
                            @else

                                <button class="button warning" wire:click="back">Go Back</button>
                                @isset($selectedReport)
                                <button class="button alert" wire:click="deleteReport('{{ $selectedReport->id }}')">Delete Report</button>
                                @endisset
                            @endif
                        </div><!-- End of cell-->
                    </div>
                </div>
            </div><!-- End of cell-->
        </div><!--end of grid-x -->
        @include('layout.alerts')
    </div><!--End of grid container-->
    <div class="grid-container full">
        <div class="grid-x grid-padding-x">
            @if($mode == 1)
                @if($view)
                    @foreach($reports as $report)
                    <div class="cell small-12 medium-6 ml-4 large-4 xlarge-3 text-center">
                        <div class="photo-border-block">
                            <a href="{{ $report->sideone }}" data-lity>
                            <img src="{{ $report->sideonethumb }}?{{ $report->updated_at }}">
                            </a>
                        </div>
                        <div class="photo-border-block">
                            <a href="{{ $report->sidetwo }}" data-lity>
                            <img src="{{ $report->sidetwothumb }}?{{ $report->updated_at }}">
                            </a>
                        </div>
                        <p>{{ $report->lbs }}lbs {{ $report->oz }}oz<br>
                        {{ date('j/m/y', strtotime ($report->date)) }}</p>
                        <button class="button expanded alert" wire:click="selectReport('{{ $report->id }}')">Update Report</button> 
                    </div><!-- End of cell-->
                    @endforeach
                @else
                <div class="cell small-12">
                    <div class="table-scroll">
                        <table>
                            <thead>
                                <tr>
                                    <td>This Week</td>
                                    <td>This Month</td>
                                    <td>Last Week</td>
                                    <td>Last Month</td>
                                    <td>Year Total</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>   
    
                    <div class="table-scroll">
                        <table>
                            <thead>
                                <tr>
                                    <td>Date</td>
                                    <td>Angler</td>
                                    <td class="text-center">Weight</td>
                                    <td class="text-center">Species</td>
                                    <td class="text-center"></td>
                                    <td class="text-center">Swim</td>
                                    <td>Bait</td>
                                    <td>Notes</td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reports as $report)
                                <tr>
                                    <td>{{ date('j/m/y', strtotime ($report->date)) }}</td>
                                    <td>{{ $report->angler->firstName }} {{ $report->angler->lastName }}</td>
                                    <td class="text-center">{{ $report->lbs }}lb {{ $report->oz }}oz</td>
                                    <td class="text-center">{{ $report->specimen->name }}</td>
                                    <td class="text-center">
                                        @isset($report->sideone)
                                        <a href="{{ $report->sideone }}" data-lity>
                                            <i class="fas fa-camera"></i>
                                        </a>
                                        @endisset
                                        @isset($report->sidetwo)
                                        <a href="{{ $report->sidetwo }}" data-lity>
                                            <i class="fas fa-camera"></i>
                                        </a>
                                        @endisset
                                    </td>
                                    <td class="text-center">{{ $report->swim_id }}</td>
                                    <td>{{ $report->bait }}</td>
                                    <td>{{ $report->notes }}</td>
                                    <td class="text-right">
                                        <button class="button alert small" wire:click="selectReport('{{ $report->id }}')">Update Report</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td class="text-center">{{ $reports->sum('lbs') + ($reports->sum('oz') / 16) }}lb</td>
                                    <td class="text-center">Average: lb</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="text-center">
                        {{ $reports->links() }}
                    </div>
                    <div class="table-scroll">
                        <table>
                            <thead>
                                <tr>
                                    <td></td>
                                    <td class="text-center">Jan</td>
                                    <td class="text-center">Feb</td>
                                    <td class="text-center">Mar</td>
                                    <td class="text-center">Apr</td>
                                    <td class="text-center">May</td>
                                    <td class="text-center">Jun</td>
                                    <td class="text-center">Jul</td>
                                    <td class="text-center">Aug</td>
                                    <td class="text-center">Sep</td>
                                    <td class="text-center">Oct</td>
                                    <td class="text-center">Nov</td>
                                    <td class="text-center">Dec</td>
                                    <td class="text-center">Total</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Captures</td>
                                    <td class="text-center">{{ $janstats->count() }}</td>
                                    <td class="text-center">{{ $febstats->count() }}</td>
                                    <td class="text-center">{{ $marstats->count() }}</td>
                                    <td class="text-center">{{ $aprstats->count() }}</td>
                                    <td class="text-center">{{ $maystats->count() }}</td>
                                    <td class="text-center">{{ $junstats->count() }}</td>
                                    <td class="text-center">{{ $julstats->count() }}</td>
                                    <td class="text-center">{{ $augstats->count() }}</td>
                                    <td class="text-center">{{ $sepstats->count() }}</td>
                                    <td class="text-center">{{ $octstats->count() }}</td>
                                    <td class="text-center">{{ $novstats->count() }}</td>
                                    <td class="text-center">{{ $decstats->count() }}</td>
                                    <td class="text-center">{{ $reports->count() }}</td>
                                </tr>
                                <tr>
                                    <td>Weight</td>
                                    <td class="text-center">{{ round($janstats->sum('lbs') + ($janstats->sum('oz') / 16), 2) }}lb</td>
                                    <td class="text-center">{{ round($febstats->sum('lbs') + ($febstats->sum('oz') / 16), 2) }}lb</td>
                                    <td class="text-center">{{ round($marstats->sum('lbs') + ($marstats->sum('oz') / 16), 2) }}lb</td>
                                    <td class="text-center">{{ round($aprstats->sum('lbs') + ($aprstats->sum('oz') / 16), 2) }}lb</td>
                                    <td class="text-center">{{ round($maystats->sum('lbs') + ($maystats->sum('oz') / 16), 2) }}lb</td>
                                    <td class="text-center">{{ round($junstats->sum('lbs') + ($junstats->sum('oz') / 16), 2) }}lb</td>
                                    <td class="text-center">{{ round($julstats->sum('lbs') + ($julstats->sum('oz') / 16), 2) }}lb</td>
                                    <td class="text-center">{{ round($augstats->sum('lbs') + ($augstats->sum('oz') / 16), 2) }}lb</td>
                                    <td class="text-center">{{ round($sepstats->sum('lbs') + ($sepstats->sum('oz') / 16), 2) }}lb</td>
                                    <td class="text-center">{{ round($octstats->sum('lbs') + ($octstats->sum('oz') / 16), 2) }}lb</td>
                                    <td class="text-center">{{ round($novstats->sum('lbs') + ($novstats->sum('oz') / 16), 2) }}lb</td>
                                    <td class="text-center">{{ round($decstats->sum('lbs') + ($decstats->sum('oz') / 16), 2) }}lb</td>
                                    <td class="text-center">{{ round($reports->sum('lbs') + ($reports->sum('oz') / 16), 2) }}lb</td>    
                                </tr>
                                <tr>
                                    <td>Avg</td>
                                    <td class="text-center">
                                        @if($janstats->count() == 0)
                                            N/A
                                        @else
                                            {{ round($janstats->sum('lbs') / $janstats->count(), 2) }}lb
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($febstats->count() == 0)
                                            N/A
                                        @else
                                            {{ round($febstats->sum('lbs') / $febstats->count(), 2) }}lb
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($marstats->count() == 0)
                                            N/A
                                        @else
                                            {{ round($marstats->sum('lbs') / $marstats->count(), 2) }}lb
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($aprstats->count() == 0)
                                            N/A
                                        @else
                                            {{ round($aprstats->sum('lbs') / $aprstats->count(), 2) }}lb
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($maystats->count() == 0)
                                            N/A
                                        @else
                                            {{ round($maystats->sum('lbs') / $maystats->count(), 2) }}lb
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($junstats->count() == 0)
                                            N/A
                                        @else
                                            {{ round($junstats->sum('lbs') / $junstats->count(), 2) }}lb
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($julstats->count() == 0)
                                            N/A
                                        @else
                                            {{ round($julstats->sum('lbs') / $julstats->count(), 2) }}lb
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($augstats->count() == 0)
                                            N/A
                                        @else
                                            {{ round($augstats->sum('lbs') / $augstats->count(), 2) }}lb
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($sepstats->count() == 0)
                                            N/A
                                        @else
                                            {{ round($sepstats->sum('lbs') / $sepstats->count(), 2) }}lb
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($octstats->count() == 0)
                                            N/A
                                        @else
                                            {{ round($octstats->sum('lbs') / $octstats->count(), 2) }}lb
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($novstats->count() == 0)
                                            N/A
                                        @else
                                            {{ round($novstats->sum('lbs') / $novstats->count(), 2) }}lb
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($decstats->count() == 0)
                                            N/A
                                        @else
                                            {{ round($decstats->sum('lbs') / $decstats->count(), 2) }}lb
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($reports->count() == 0)
                                            N/A
                                        @else
                                            {{ round($reports->sum('lbs') / $reports->count(), 2)}} lb
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div> 
                </div><!-- End of cell-->
                @endif
            
            @elseif($mode == 2)
            <div class="cell small-12 medium-8 large-6 medium-offset-2 large-offset-3">
                <label for="">Search Angler</label>
                <input type="text" placeholder="" wire:model="anglerLookup">

                <label for="">Angler
                    @error('angler')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </label>
                <select id="" wire:model="angler">
                    <option value="">Please select</option>
                    @foreach($anglers as $angler)
                    <option value="{{ $angler->id }}">{{ $angler->firstName }} {{ $angler->lastName }}</option>
                    @endforeach 
                </select>

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
                <input type="text" id="datepicker" wire:model.lazy="date">

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
                        <div wire:loading wire:target="sideone">
                            Uploading photo...
                        </div>
                          
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
                        <div wire:loading wire:target="sidetwo">
                            Uploading photo...
                        </div>
                    </div><!-- End of cell-->
                </div><!--end of grid-x -->
                <br>
                <div class="button-group" wire:loading.remove>
                    <button class="button success"  wire:click="saveReport">Upload Report</button>
                    <button class="button alert" wire:click="cancel">Cancel</button>
                </div>
                  
            </div><!-- End of cell-->
            @elseif($mode == 3)
            <div class="cell small-12 medium-8 large-6 medium-offset-2 large-offset-3">
                <label for="">Search Angler</label>
                <input type="text" placeholder="" wire:model="anglerLookup">

                <label for="">Angler
                    @error('angler')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </label>
                <select id="" wire:model="angler">
                    <option value="">Please select</option>
                    @foreach($anglers as $angler)
                    <option value="{{ $angler->id }}">{{ $angler->firstName }} {{ $angler->lastName }}</option>
                    @endforeach 
                </select>

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
                    @error('species')
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
                <input type="text" id="datepicker" wire:model.lazy="date">

                <label for="">Swim</label>
                <select id="" wire:model="swim">
                    <option value="">Please Select</option>
                    @foreach($swims as $swim)
                    <option value="{{ $swim->id }}">{{ $swim->name }}</option>
                    @endforeach 
                </select>

                <label for="">Bait</label>
                <input type="text" placeholder="" wire:model="bait">

                <label for="">Notes (optional)
                <textarea wire:model="notes" cols="50" rows="10"></textarea>

                <button class="button success" wire:click="saveReportChanges">Save Changes</button>

                <div class="grid-x grid-padding-x">
                    <div class="cell small-12 medium-6">
                        @if($selectedReport->sideone != Null)
                            <img src="{{ $selectedReport->sideone }}?{{ $selectedReport->updated_at }}">
                            <div class="button-group">
                                <button class="button expanded warning" wire:click="rotate('1')">Rotate Image</button>
                                <button class="button expanded alert" wire:click="deleteImage('1')">Delete Photo</button>
                            </div>
                        @else
                            <label for="">Side One
                            @error('sideone')
                                <span class="error">{{ $message }}</span>
                            @enderror
                            </label>
                            <input type="file" wire:model="sideone">
                        @endif
                    </div><!-- End of cell-->
                    <div class="cell small-12 medium-6">
                        @if($selectedReport->sidetwo != Null)
                            <img src="{{ $selectedReport->sidetwo }}?{{ $selectedReport->updated_at }}">
                            <div class="button-group">
                                <button class="button expanded warning" wire:click="rotate('2')">Rotate Image</button>
                                <button class="button expanded alert" wire:click="deleteImage('2')">Delete Photo</button>
                            </div>
                        @else
                            <label for="">Side Two
                            @error('sidetwo')
                                <span class="error">{{ $message }}</span>
                            @enderror
                            </label>
                            <input type="file" wire:model="sidetwo">
                        @endif
                    </div><!-- End of cell-->
                </div>
            </div><!-- End of cell-->
            @endif
        </div><!--end of grid-x -->
    </div><!--End of grid container-->
</div>

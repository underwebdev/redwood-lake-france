<div>
    <div class="grid-container full">
        <div class="grid-x grid-padding-x">
            <div class="cell small-12 medium-8 large-6 medium-offset-2 large-offset-3">
                <h5 class="info-bar">Update Catch Report</h5>
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
                        @elseif($report->sideone)
                        <div class="photo-preview">
                            <img src="/assets/catch-reports/sideone/{{ $report->id }}.{{ Str::afterLast($report->sideone, '.') }}">
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
                        @elseif($report->sidetwo)
                        <div class="photo-preview">
                            <img src="/assets/catch-reports/sidetwo/{{ $report->id }}.{{ Str::afterLast($report->sidetwo, '.') }}">
                        </div>
                        @endif
                    </div><!-- End of cell-->
                    <div class="cell small-12 text-center" wire:loading>
                        <strong>Processing ....</strong>
                    </div>
                </div><!--end of grid-x -->
                <br>
                <div class="button-group" wire:loading.remove>
                    <button class="button success" wire:click="saveReport">Save Changes</button>
                    <a href="/my-account/my-reports" class="button alert hollow">Go Back</a>
                </div>
                  
            </div><!-- End of cell-->
        </div><!--end of grid-x -->
    </div><!--End of grid container-->
</div>

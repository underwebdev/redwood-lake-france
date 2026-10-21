<div>
    <div class="grid-container full">
        <div class="grid-x grid-padding-x">
            <div class="cell small-12">
                <div class="admin-title-panel">
                    <div class="grid-x">
                        <div class="cell small-12 medium-6">
                            <h1>Stocking Diary</h1>
                        </div>
                        <div class="cell small-12 medium-6 text-right align-self-middle">
                            @if($mode == 1)
                                <button class="button success" wire:click="$set('mode', 3)">New Stocking</button>
                            @else
                                @if($mode == 2)
                                <button class="button success" wire:click="$set('mode', 4)">Add Fish</button>

                                
                                <button class="button warning" wire:click="$toggle('gallery')">
                                    @if($gallery)
                                        Table View
                                    @else
                                        Gallery View
                                    @endif
                                </button>
                                @elseif($mode == 5)
                                    <button class="button warning" wire:click="$toggle('editfish')">Edit Fish</button>
                                @endif

                                <button class="button alert" wire:click="back">Cancel</button>
                            @endif

                        </div><!-- End of cell-->
                    </div>
                </div>
            </div><!-- End of cell-->
        </div><!--end of grid-x -->
        @include('layout.alerts')
    </div><!--End of grid container-->

    <div class="grid-container">
        <div class="grid-x grid-padding-x">
        @if($mode == 1)
            <div class="cell small-12">
                <div class="table-scroll">
                <table>
                    <thead>
                        <tr>
                            <td>Date</td>
                            <td>Farm</td>
                            <td class="text-center">Commons</td>
                            <td class="text-center">Mirrors</td>
                            <td class="text-center">Total</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($stockings as $stocking)
                            <tr>
                                <td>{{ date('j/m/y', strtotime ($stocking->date)) }}</td>
                                <td>{{ $stocking->farm->name }}</td>
                                <td class="text-center">{{ $stocking->items()->where('specimen_id', 1)->count() }}</td>
                                <td class="text-center">{{ $stocking->items()->where('specimen_id', 2)->count() }}</td>
                                <td class="text-center">{{ $stocking->items()->count() }}</td>
                                <td class="text-right">
                                    <button class="button" wire:click="selectStocking('{{ $stocking->id }}')">View Stocking</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div><!-- End of cell-->
        @elseif($mode == 2)
            <div class="cell small-12">
                <div class="table-scroll">
                    <table>
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Supplier</th>
                                <th class="text-center">Commons</th>
                                <th class="text-center">Mirrors</th>
                                <th class="text-center">Total Fish</th>
                                <th class="text-center">Total Weight</th>
                                <th class="text-center">Cost</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ Carbon\Carbon::parse($selectedStocking->date)->format('d/m/Y') }}</td>
                                <td>{{ $selectedStocking->farm->name }}</td>
                                <td class="text-center">{{ $selectedStocking->items()->where('specimen_id', 1)->count() }}</td>
                                <td class="text-center">{{ $selectedStocking->items()->where('specimen_id', 2)->count() }}</td>
                                <td class="text-center">{{ $selectedStocking->items()->count() }}</td>
                                <td class="text-center">{{ $selectedStocking->items()->sum('lbs') }}lbs</td>
                                <td class="text-center">£{{ $selectedStocking->items()->sum('price') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div><!-- End of cell-->
            
                @if($gallery)
                
                    @foreach($selectedStocking->items as $fish)
                    <div class="cell small-12 medium-6 large-4">
                        <div class="fish-photo">
                            <img src="/assets/stocking/side1/{{ $fish->id }}.{{ Str::afterLast($fish->side1, '.') }}">
                        </div>
                        <div class="fish-photo">
                            <img src="/assets/stocking/side2/{{ $fish->id }}.{{ Str::afterLast($fish->side2, '.') }}">
                        </div>
                        <button class="button success expanded" wire:click="selectFish('{{ $fish->id }}')">View Fish</button>
                    </div><!-- End of cell-->
                    @endforeach
                
                @else
                <div class="cell small-12">
                    <div class="table-scroll">
                        <table>
                            <thead>
                                <tr>
                                    <th>Number</th>
                                    <th>Weight</th>
                                    <th>Class</td>
                                    <th>Species</th>
                                    <th class="text-center">Photos</th>
                                    <th>Captures</th>
                                    <th>£</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($selectedStocking->items as $fish)
                                <tr>
                                    <td>{{ $fish->number }}</td>
                                    <td>{{ $fish->lbs }}lb {{ $fish->oz }}oz</td>
                                    <td>{{ $fish->class }}</td>
                                    <td>{{ $fish->specimen->name }}</td>
                                    <td class="text-center">
                                        <a href="/assets/stocking/side1/{{ $fish->id }}.{{ Str::afterLast($fish->side1, '.') }}" data-lity>
                                            <i class="fas fa-camera"></i>
                                        </a>
                                        <a href="/assets/stocking/side2/{{ $fish->id }}.{{ Str::afterLast($fish->side2, '.') }}" data-lity>
                                            <i class="fas fa-camera"></i>
                                        </a>
                                    </td>
                                    <td>
                                       
                                    </td>
                                    <td>£{{ $fish->price }}</td>
                                    <td class="text-right">
                                        <button class="button success" wire:click="selectFish('{{ $fish->id }}')">View Fish</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div><!-- End of cell-->
                @endif

            @if($selectedStocking->items()->count() < 1)
            <div class="cell small-12 text-center">
                <button class="button alert" wire:click="deleteStocking">Delete Stocking</button>
            </div><!-- End of cell-->
            @endif
        @elseif($mode == 3)
            <div class="cell small-12 medium-8 large-6 medium-offset-2 large-offset-3">
                <label for="">Date
                    @error('date')<span class="error">{{ $message }} @enderror
                </label>
                <input type="text" id="datepicker" wire:model.lazy="date">

                <label for="">Fish Farm
                    @error('farm')<span class="error">{{ $message }}</span>@enderror
                </label>
                <select id="" wire:model.live="selectedFarm">
                    <option value="">Please Select</option>
                    @foreach($farms as $farm)
                    <option value="{{ $farm->id }}">{{ $farm->name }}</option>
                    @endforeach
                    <option value="create">New Farm</option> 
                </select>

                @if($selectedFarm == 'create')
                <label for="">Farm Name</label>
                <input type="text" wire:model.live="name">
                <button class="button success" wire:click="saveFarm">Save Farm</button>
                @else
                <button class="button success" wire:click="saveStocking">Create Stocking</button>
                @endif
            </div>
        @elseif($mode == 4)
            <div class="cell small-12 medium-8 large-6 medium-offset-2 large-offset-3">
                <label for="">Number</label>
                <input type="text" wire:model.live="number">
                    <div class="grid-x grid-padding-x">
                        <div class="cell small-6">
                            <label for="">lbs</label>
                            <input type="text" wire:model.live="lbs">  
                        </div><!-- End of cell-->
                        <div class="cell small-6">
                            <label for="">oz</label>
                            <input type="text" wire:model.live="oz">    
                        </div><!-- End of cell-->
                    </div><!--end of grid-x -->
                <label for="">Class</label>
                <select id=""wire:model.live="class">
                    <option value="">Please select</option>
                    <option value="C1">C1</option>
                    <option value="C2">C2</option>
                    <option value="C3">C3</option> 
                    <option value="C4">C4</option> 
                    <option value="C5">C5</option> 
                    <option value="C6">C6</option>  
                </select>
                <label for="">Species</label>
                <select id=""wire:model.live="species">
                    <option value="">Please select</option>
                    @foreach($specimens as $specimen)
                        <option value="{{ $specimen->id }}">{{ $specimen->name }}</option>
                    @endforeach
                </select>

                <label for="">Price per lb</label>
                <input type="text" wire:model.live="price">

                <label for="">Side 1
                    @error('sideone')<span class="error">{{ $message }}</span>@enderror
                </label>
                <input type="file" wire:model.live="sideone">
                <label for="">Side 2
                    @error('sidetwo')<span class="error">{{ $message }}</span>@enderror
                </label>
                <input type="file" wire:model.live="sidetwo">

                <div class="grid-x grid-padding-x">
                    <div class="cell small-12 medium-6">
                        @if($sideone)
                        <div class="photo-preview">
                            <img src="{{ $sideone->temporaryUrl() }}">
                        </div>
                        @endif
                    </div><!-- End of cell-->
                    <div class="cell small-12 medium-6">
                        @if($sidetwo)
                        <div class="photo-preview">
                            <img src="{{ $sidetwo->temporaryUrl() }}">
                        </div>
                        @endif
                    </div><!-- End of cell-->
                </div><!--end of grid-x -->

                <div wire:loading wire:target="sideone">
                    Uploading photo one...
                </div>

                <div wire:loading wire:target="sidetwo">
                    Uploading photo two...
                </div>

                <div class="button-group">
                    <button class="button success" wire:click="saveFish" wire:loading.attr="disabled">Save Fish</button>
                    <button class="button warning" wire:click="back">Cancel</button>
                </div>
            </div>
        @elseif($mode == 5)
            <div class="cell small-12 medium-4">
                <div class="fish-photo">
                    <img src="/assets/stock/sideone/{{ $selectedFish->id }}">
                </div>

                <div class="fish-photo">
                    <img src="/assets/stock/sidetwo/{{ $selectedFish->id }}">
                </div>

                <button class="button alert expanded" wire:click="$set('mode', 2)">Go Back</button>
                  
            </div><!-- End of cell-->
            <div class="cell small-12 medium-8">
                @if($editfish)
                    <label for="">Number</label>
                    <input type="text" wire:model.live="number">
                        <div class="grid-x grid-padding-x">
                            <div class="cell small-6">
                                <label for="">lbs</label>
                                <input type="text" wire:model.live="lbs">  
                            </div><!-- End of cell-->
                            <div class="cell small-6">
                                <label for="">oz</label>
                                <input type="text" wire:model.live="oz">    
                            </div><!-- End of cell-->
                        </div><!--end of grid-x -->
                    <label for="">Class</label>
                    <select id=""wire:model.live="class">
                        <option value="">Please select</option>
                        <option value="C1">C1</option>
                        <option value="C2">C2</option>
                        <option value="C3">C3</option> 
                        <option value="C4">C4</option> 
                        <option value="C5">C5</option> 
                        <option value="C6">C6</option>  
                    </select>
                    <label for="">Species</label>
                    <select id=""wire:model.live="species">
                        <option value="">Please select</option>
                        @foreach($specimens as $specimen)
                            <option value="{{ $specimen->id }}">{{ $specimen->name }}</option>
                        @endforeach
                    </select>

                    <label for="">Price</label>
                    <input type="text" wire:model.live="price">

                    <label for="">Side 1</label>
                    <input type="file" wire:model.live="sideone">
                    <label for="">Side 2</label>
                    <input type="file" wire:model.live="sidetwo">

                    <div wire:loading wire:target="sideone">
                        Uploading photo one...
                    </div>

                    <div wire:loading wire:target="sidetwo">
                        Uploading photo two...
                    </div>

                    <div class="button-group">
                        <button class="button success expanded" wire:click="saveFishChanges" wire:loading.attr="disabled">Save Fish</button>
                        <button class="button warning expanded" wire:click="$toggle('editfish')">Cancel</button>
                    </div>


                @else
                <div class="table-scroll">
                    <table>
                        <thead>
                            <tr>
                                <th>Number</th>
                                <th>Weight</th>
                                <th>Class</th>
                                <th>Species</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $selectedFish->number }}</td>
                                <td>{{ $selectedFish->lbs }}lbs {{ $selectedFish->oz }}oz</td>
                                <td>{{ $selectedFish->class }}</td>
                                <td>{{ $selectedFish->specimen->name }}</td>
                                <td>£{{ $selectedFish->price }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="text-center">
                    <button class="button alert" wire:click="deleteFish">Delete</button>
                </div>
                @endif
            </div><!-- End of cell-->
        @endif
        </div><!--end of grid-x -->
    </div><!--End of grid container-->
</div>

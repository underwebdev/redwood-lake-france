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

                                @if($selectedFish)
                                    <button class="button warning" wire:click="$toggle('selectedFish')">Back To Stocking</button>
                                @else 
                                    <button class="button warning" wire:click="$toggle('gallery')">
                                        @if($gallery)
                                            Table View
                                        @else
                                            Gallery View
                                        @endif
                                    </button>
                                @endif
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
                                <td class="text-center">{{ $stocking->items()->where('specimen_id', 2)->count() }}</td>
                                <td class="text-center">{{ $stocking->items()->where('specimen_id', 1)->count() }}</td>
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
                                <th class="text-center">Mirrors</th>
                                <th class="text-center">Commons</th>
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
                                <td class="text-center">{{ $selectedStocking->items()->sum('lbs') }}</td>
                                <td class="text-center">£{{ $selectedStocking->items()->sum('price') / 100 }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div><!-- End of cell-->
            @if($selectedFish)
            <div class="grid-x grid-padding-x">
                <div class="cell small-12">
                    <div class="table-scroll">
                        <table>
                            <thead>
                                <tr>
                                    <th>Number</th>
                                    <th>Weight</th>
                                    <th>Class</th>
                                    <th>Species</th>
                                    <th>Date</th>
                                    <th>Farm</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $selectedFish->number }}</td>
                                    <td>{{ $selectedFish->lbs }}lb {{ $selectedFish->oz }}oz</td>
                                    <td>{{ $selectedFish->class }}</td>
                                    <td>{{ $selectedFish->species->name }}</td>
                                    <td>{{ date('j/m/y', strtotime ($selectedStocking->date)) }}</td>
                                    <td>{{ $selectedStocking->farm->name }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div><!-- End of cell-->
                <div class="grid-x grid-padding-x">
                    <div class="cell small-12 medium-4">
                        <img src="{{ $selectedFish->sideone }}">
                    </div><!-- End of cell-->
                    <div class="cell small-12 medium-4">
                        <img src="{{ $selectedFish->sidetwo }}">
                    </div><!-- End of cell-->
                    <div class="cell small-12 medium-4">
                        <img src="">
                    </div><!-- End of cell-->
                </div><!--end of grid-x --> 
            </div><!--end of grid-x -->
            @else
                @if($gallery)
                <div class="grid-x grid-padding-x">
                    @foreach($selectedStocking->items as $fish)
                    <div class="cell small-12 medium-6 large-4">
                        <img src="{{ $item->sideone }}">
                        <img src="{{ $item->sidetwo }}">
                        <button class="button success expanded" wire:click="">View Fish</button>
                    </div><!-- End of cell-->
                    @endforeach
                </div><!--end of grid-x -->
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
                                    <th>Photos</th>
                                    <th>Captures</th>
                                    <th>£</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($selectedStocking->items as $fish)
                                <tr>
                                    <td>{{ $fish->number }}</td>
                                    <td>{{ $fish->lbs }}lb {{ $fish->oz }}oz }}</td>
                                    <td>{{ $fish->class }}</td>
                                    <td>{{ $fish->specimen->name }}</td>
                                    <td></td>
                                    <td></td>
                                    <td>£{{ $fish->price * $fish->lbs / 100 }}</td>
                                    <td><button class="button success" wire:click="">View Fish</button></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div><!-- End of cell-->
                @endif
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
                <select id="" wire:model="selectedFarm">
                    <option value="">Please Select</option>
                    @foreach($farms as $farm)
                    <option value="{{ $farm->id }}">{{ $farm->name }}</option>
                    @endforeach
                    <option value="create">New Farm</option> 
                </select>

                @if($selectedFarm == 'create')
                <label for="">Farm Name</label>
                <input type="text" wire:model="name">
                <button class="button success" wire:click="saveFarm">Save Farm</button>
                @else
                <button class="button success" wire:click="saveStocking">Create Stocking</button>
                @endif
            </div>
        @elseif($mode == 4)
            <div class="cell small-12 medium-8 large-6 medium-offset-2 large-offset-3">
                <label for="">Number</label>
                <input type="text" wire:model="number">
                    <div class="grid-x grid-padding-x">
                        <div class="cell small-6">
                            <label for="">lbs</label>
                            <input type="text" wire:model="lbs">  
                        </div><!-- End of cell-->
                        <div class="cell small-6">
                            <label for="">oz</label>
                            <input type="text" wire:model="oz">    
                        </div><!-- End of cell-->
                    </div><!--end of grid-x -->
                <label for="">Class</label>
                <select id=""wire:model="class">
                    <option value="C1">C1</option>
                    <option value="C2">C2</option>
                    <option value="C3">C3</option> 
                    <option value="C4">C4</option> 
                    <option value="C5">C5</option> 
                    <option value="C6">C6</option>  
                </select>
                <label for="">Species</label>
                <select id=""wire:model="species">
                    @foreach($specimens as $specimen)
                        <option value="{{ $specimen->id }}">{{ $specimen->name }}</option>
                    @endforeach
                </select>

                <label for="">Price per lb</label>
                <input type="text" wire:model="price">

                <label for="">Side 1</label>
                <input type="file" wire:model="sideone">
                <label for="">Side 2</label>
                <input type="file" wire:model="sidetwo">

                <div class="button-group">
                    <button class="button success" wire:click="saveFish">Save Fish</button>
                    <button class="button warning" wire:click="$set('mode', 2)">Cancel</button>
                </div>
            </div>
        @endif
        </div><!--end of grid-x -->
    </div><!--End of grid container-->
</div>

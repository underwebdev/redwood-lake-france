<div>
    <div class="grid-container full" id="admin-nav">
        <div class="grid-x grid-padding-x">
            <div class="cell small-12">
                <div class="admin-title-panel">
                    <div class="grid-x">
                        <div class="cell small-12 medium-6">
                            <h1>Fish Stock</h1>
                        </div>
                        <div class="cell small-12 medium-6 text-right align-self-middle">
                            @if($mode == 1)
                                <button class="button warning" wire:click="$set('mode', 2)">Unmatched</button>
                                <button class="button alert" wire:click="$set('mode', 6)">Inactive</button>      
                            @else
                                @if($selectedFish AND $selectedFish->alive == 1)
                                    <button class="button alert" wire:click="deactivate">Deactivate</button>
                                @elseif($selectedFish AND $selectedFish->alive == Null)
                                    <button class="button success" wire:click="reactivate">Reactivate</button>
                                @endif
                                <button class="button warning" wire:click="back">Go Back</button>
                            @endif
                        </div><!-- End of cell-->
                    </div>
                </div>
            </div><!-- End of cell-->
        </div><!--end of grid-x -->
        @include('layout.alerts')
    </div><!--End of grid container-->
    <div class="grid-container full">
        @if($mode == 1)
        <div class="grid-x grid-padding-x">
        <div class="cell small-12">
            <div class="table-scroll">
                <table>
                    <thead>
                        <tr>
                            <td class="text-center">Common</td>
                            <td class="text-center">Mirror</td>
                            <td class="text-center">Total</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">
                                <button wire:click="speciesFilter('1')">
                                    {{ $stock->where('specimen_id', 1)->count() }}
                                </button>
                            </td>
                            <td class="text-center">
                                <button wire:click="speciesFilter('2')">
                                    {{ $stock->where('specimen_id', 2)->count() }}
                                </button>
                            </td>
                            <td class="text-center">
                                <button wire:click="clearSpeciesFilter">
                                    {{ $stock->count() }}
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="table-scroll">
                <table>
                    <thead>
                        <tr>
                            <th>Total</th>
                            <th>55+</th>
                            <th>50+</th>
                            <th>45+</th>
                            <th>40+</th>
                            <th>35+</th>
                            <th>30+</th>
                            <th>25+</th>
                            <th>20+</th>
                            <th>20<</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <button wire:click="clearWeightFilter">
                                    @if($selectedSpecies)
                                        {{ $stock->where('specimen_id', $selectedSpecies)->count() }}
                                    @else
                                        {{ $stock->count() }}
                                    @endif

                                </button>
                            <td>
                                <button wire:click="weightFilter('54', '>')">
                                    @if($selectedSpecies)
                                        {{ $stock->where('lbs', '>', 54)->where('specimen_id', $selectedSpecies)->count() }}
                                    @else
                                        {{ $stock->where('lbs', '>', 54)->count() }}
                                    @endif
                                </button>
                            </td>
                            <td>
                                <button wire:click="weightFilter('49', '>')">
                                    @if($selectedSpecies)
                                        {{ $stock->where('lbs', '>', 49)->where('specimen_id', $selectedSpecies)->count() }}
                                    @else
                                        {{ $stock->where('lbs', '>', 49)->count() }}
                                    @endif
                                </button>
                            </td>
                            <td>
                                <button wire:click="weightFilter('44', '>')">
                                    @if($selectedSpecies)
                                        {{ $stock->where('lbs', '>', 44)->where('specimen_id', $selectedSpecies)->count() }}
                                    @else
                                        {{ $stock->where('lbs', '>', 44)->count() }}
                                    @endif
                                </button>
                            </td>
                            <td>
                                <button wire:click="weightFilter('39', '>')">
                                    @if($selectedSpecies)
                                        {{ $stock->where('lbs', '>', 39)->where('specimen_id', $selectedSpecies)->count() }}
                                    @else
                                        {{ $stock->where('lbs', '>', 39)->count() }}
                                    @endif
                                </button>
                            </td>
                            <td>
                                <button wire:click="weightFilter('34', '>')">
                                    @if($selectedSpecies)
                                        {{ $stock->where('lbs', '>', 34)->where('specimen_id', $selectedSpecies)->count() }}
                                    @else
                                        {{ $stock->where('lbs', '>', 34)->count() }}
                                    @endif
                                </button>
                            </td>
                            <td>
                                <button wire:click="weightFilter('29', '>')">
                                    @if($selectedSpecies)
                                        {{ $stock->where('lbs', '>', 29)->where('specimen_id', $selectedSpecies)->count() }}
                                    @else
                                        {{ $stock->where('lbs', '>', 29)->count() }}
                                    @endif
                                </button>
                            </td>
                            <td>
                                <button wire:click="weightFilter('24', '>')">
                                    @if($selectedSpecies)
                                        {{ $stock->where('lbs', '>', 24)->where('specimen_id', $selectedSpecies)->count() }}
                                    @else
                                        {{ $stock->where('lbs', '>', 24)->count() }}
                                    @endif
                                </button>
                            </td>
                            <td>
                                <button wire:click="weightFilter('19', '>')">
                                    @if($selectedSpecies)
                                        {{ $stock->where('lbs', '>', 19)->where('specimen_id', $selectedSpecies)->count() }}
                                    @else
                                        {{ $stock->where('lbs', '>', 19)->count() }}
                                    @endif
                                </button>
                            </td>
                            <td>
                                <button wire:click="weightFilter('20', '<')">
                                    @if($selectedSpecies)
                                        {{ $stock->where('lbs', '<', 20)->where('specimen_id', $selectedSpecies)->count() }}
                                    @else
                                        {{ $stock->where('lbs', '<', 20)->count() }}
                                    @endif
                                </button>
                                </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
            @foreach($fishlist as $fish)
            <div class="cell small-12 medium-4 large-3">
                <img src="{{ $fish->sideone }}">
                @isset($fish->name)<strong>{{ $fish->name }}</strong><br>@endisset
                <strong>Top Weight:</strong> {{ $fish->lbs }}lb {{ $fish->oz }}oz<br>
                <strong>Last Capture:</strong> 
                @foreach($fish->reports as $report)
                    @if($loop->first)
                        {{ date('j/m/y', strtotime ($report->date)) }}<br>
                    @endif
                @endforeach
                @if($fish->reports->count() < 1)
                    N/A <br>
                @endif
                <strong>Captures:</strong>{{ $fish->reports()->count() }}
                <button class="button success expanded" wire:click="selectFish('{{ $fish->id }}')">View Fish</button>
            </div><!-- End of cell-->
            @endforeach
        </div>
        @elseif($mode == 2)
        <div class="grid-x grid-padding-x">
            @foreach($reports as $report)
            <div class="cell small-12 medium-4 large-3 text-center">
                <img src="{{ $report->sideone }}">
                <strong>{{ $report->lbs }}lb {{ $report->oz }}oz</strong>
                <button class="button success expanded" wire:click="selectReport('{{ $report->id }}')">Look Up</button>
            </div><!-- End of cell-->
            @endforeach
        </div><!--end of grid-x -->
        @elseif($mode == 3)
        <div class="grid-x grid-padding-x">
            <div class="cell small-12 medium-4" data-sticky-container>
                <div class="sticky" data-sticky data-top-anchor="admin-nav:bottom" data-btm-anchor="bottom-anchor:bottom">
                    <img src="{{ $selectedReport->sideonethumb }}">
                    @isset($selectedReport->sidetwothumb)
                    <img src="{{ $selectedReport->sidetwothumb }}">
                    @endisset
                    <div class="button-group">
                        <button class="button success expanded" wire:click="$set('mode', 4)">Create Fish</button>
                        <button class="button warning expanded" wire:click="$set('mode', 2)">Back To Unmatched</button>
                    </div>
                </div>
            </div><!-- End of cell-->
            <div class="cell small-12 medium-8" >
                <div class="grid-x grid-padding-x">
                    @foreach($stock->where('specimen_id', $selectedReport->specimen_id) as $fish)
                    <div class="cell small-12 medium-6 text-center" >
                        <img src="{{ $fish->sideonethumb }}">
                        <strong>{{ $fish->lbs }}lbs {{ $fish->oz }}oz</strong>
                        <button class="button success expanded" @if($loop->last) id="bottom-anchor" @endif wire:click="attachReport('{{ $fish->id }}')">Attach Fish</button>
                    </div><!-- End of cell-->
                    <div class="cell small-12 medium-6">
                        @isset($fish->sidetwothumb)
                        <img src="{{ $fish->sidetwothumb }}">
                        @else
                            <p class="text-center"><strong>Not Available</strong></p>
                        @endisset
                    </div><!-- End of cell-->
                    @endforeach
                </div><!--end of grid-x -->
            </div><!-- End of cell-->
        </div><!--end of grid-x -->
        @elseif($mode == 4)
        <div class="grid-x grid-padding-x">
            <div class="cell small-12">
                <h4>Create new fish</h4>
                <img src="{{ $selectedReport->sideonethumb }}">
                <img src="{{ $selectedReport->sidetwothumb }}">
                <strong>Weight:</strong> {{ $selectedReport->lbs }}lb {{ $selectedReport->oz }}oz<br>
                <strong>Species:</strong> {{ $selectedReport->specimen->name }}
                <label for="">Name (optional)</label>
                <input type="text" placeholder="" wire:model="name">
                <label for=""></label>
                <textarea wire:model="description" cols="50" rows="10"></textarea>
                <label for="">Destock</label>
                <select id="" wire:model="destock">
                    <option value="0">No</option>
                    <option value="1">Yes</option> 
                </select>
                <button class="button success" wire:click="saveFish">Save Fish</button>
                <button class="button alert" wire:click="$set('mode', 3)">Cancel</button>
                  
            </div><!-- End of cell-->
        </div><!--end of grid-x -->
        @elseif($mode == 5)
        <div class="grid-x grid-padding-x">
            <div class="cell small-12">
                <div class="table-scroll">
                <table>
                    <thead>
                        <tr>
                            <td>Name</td>
                            <td>Species</td>
                            <td>Top Weight</td>
                            <td>Last Capture</td>
                            <td class="text-center">Captures</td>
                            <td>Description</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                @isset($selectedFish->name)
                                    <button wire:click="selectname">{{ $selectedFish->name }}</button>
                                @else
                                    <button wire:click="selectname">Set Name</button>
                                @endisset
                            </td>
                            <td>{{$selectedFish->specimen->name }}</td>
                            <td>{{ $selectedFish->lbs }}lb {{ $selectedFish->oz }}oz</td>
                            <td>
                                @foreach($selectedFish->reports as $report)
                                    @if($loop->first)
                                        {{ date('j/m/y', strtotime ($report->date)) }}<br>
                                    @endif
                                @endforeach
                            </td>
                            <td class="text-center">{{ $selectedFish->reports->count() }}</td>
                            <td>
                                @isset($selectedFish->description)
                                    {{ $selectedFish->description }}<br>
                                @endisset

                                <button wire:click="selectdescription">Set Description</a>
                                
                            </td>
                        </tr>
                    </tbody>
                </table>
                </div>
            </div><!-- End of cell-->
        </div><!--end of grid-x -->
        <div class="grid-x grid-padding-x">
            <div class="cell small-12 medium-4">
                <div class="cell small-12 text-center" data-sticky-container>
                <div class="sticky" data-sticky data-top-anchor="dark-container:bottom">
                    <div class="photo-border-block">
                        <a href="{{ $selectedFish->sideone }}" data-lity>
                        <img src="{{ $selectedFish->sideone }}">
                        </a>
                    </div>
                    @isset($selectedFish->sidetwo)
                    <div class="photo-border-block">
                        <a href="{{ $selectedFish->sidetwo }}" data-lity>
                        <img src="{{ $selectedFish->sidetwo }}">
                        </a>
                    </div>
                    @endisset

                    @unless($setPhoto)
                    <button class="button success expanded" wire:click="$toggle('setPhoto')">Set Photo</button>
                    @else
                    <button class="button alert expanded" wire:click="$toggle('setPhoto')">Cancel</button>
                    @endunless
                </div>
                </div><!-- End of cell-->
                  
            </div><!-- End of cell-->
            <div class="cell small-12 medium-8">
                @unless($setPhoto)
                <div class="table-scroll">
                    <table>
                        <thead>
                            <tr>
                                <td>jan</td>
                                <td>feb</td>
                                <td>mar</td>
                                <td>apr</td>
                                <td>may</td>
                                <td>jun</td>
                                <td>jul</td>
                                <td>aug</td>
                                <td>sep</td>
                                <td>oct</td>
                                <td>nov</td>
                                <td>dec</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $selectedFish->reports()->whereMonth('date', '=', date('01'))->count() }} </td>
                                <td>{{ $selectedFish->reports()->whereMonth('date', '=', date('02'))->count() }}</td>
                                <td>{{ $selectedFish->reports()->whereMonth('date', '=', date('03'))->count() }}</td>
                                <td>{{ $selectedFish->reports()->whereMonth('date', '=', date('04'))->count() }}</td>
                                <td>{{ $selectedFish->reports()->whereMonth('date', '=', date('05'))->count() }}</td>
                                <td>{{ $selectedFish->reports()->whereMonth('date', '=', date('06'))->count() }}</td>
                                <td>{{ $selectedFish->reports()->whereMonth('date', '=', date('07'))->count() }}</td>
                                <td>{{ $selectedFish->reports()->whereMonth('date', '=', date('08'))->count() }}</td>
                                <td>{{ $selectedFish->reports()->whereMonth('date', '=', date('09'))->count() }}</td>
                                <td>{{ $selectedFish->reports()->whereMonth('date', '=', date('010'))->count() }}</td>
                                <td>{{ $selectedFish->reports()->whereMonth('date', '=', date('11'))->count() }}</td>
                                <td>{{ $selectedFish->reports()->whereMonth('date', '=', date('12'))->count() }}</td>
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
                                <td>Weight</td>
                                <td class="text-center">Photo</td>
                                <td>Bait</td>
                                <td>Notes</td>
                
                                <td></td>
                                
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($selectedFish->reports as $report)
                            <tr>
                                <td>{{ date('j/m/y', strtotime ($report->date)) }}</td>
                                <td>{{ $report->angler->firstName }} {{ $report->angler->lastName }}</td>
                                <td>{{ $report->lbs }}lb {{ $report->oz }}oz</td>
                                
                                <td class="text-center">
                                    @isset($report->sideone)
                                        <a href="{{ $report->sideone }}" data-lity>
                                            <i class="fas fa-camera"></i>
                                        </a>
                                    @endif
                                    @isset($report->sidetwo)
                                        <a href="{{ $report->sidetwo }}" data-lity>
                                            <i class="fas fa-camera"></i>
                                        </a>
                                    @endif
                                </td>
                                <td>{{ $report->bait }}</td>
                                <td>{{ $report->notes }}</td>
                                
                                <td class="text-right">
                                    <button class="button alert small" wire:click="detach('{{ $report->id }}')">Remove</button>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                        @isset($selectedFish->item_id)
                        <tfoot>
                            <tr>
                                <td>{{ date('j/m/y', strtotime ($selectedFish->item->stocking->date)) }}</td>
                                <td>Stocked</td>
                                <td>{{ $selectedFish->item->lbs }}lbs {{ $selectedFish->item->oz }}oz</td>
                                <td class="text-center">
                                    <a href="{{ $selectedFish->item->side1 }}" data-lity>
                                        <i class="fas fa-camera"></i>
                                    </a>
                                    <a href="{{ $selectedFish->item->side2 }}" data-lity>
                                        <i class="fas fa-camera"></i>
                                    </a>    
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tfoot>
                        @endisset
                    </table>
                </div>
                @else
                <div class="grid-x grid-padding-x">
                    @foreach($selectedFish->reports as $report)
                        @isset($report->sideone)
                        <div class="cell small-12 medium-6">
                            <div class="photo-border-block">
                                <img src="{{ $report->sideonethumb }}">
                            </div>
                            <div class="button-group">
                                <button class="button expanded" wire:click="primary('{{ $report->id }}')">Primary</button>
                                <button class="button expanded hollow" wire:click="secondary('{{ $report->id }}')">Secondary</button>
                            </div>
                              
                        </div><!-- End of cell-->
                        @endisset
                        @isset($report->sidetwo)
                        <div class="cell small-12 medium-6">
                            <div class="photo-border-block">
                                <img src="{{ $report->sidetwothumb }}">
                            </div>
                            <div class="button-group">
                                <button class="button expanded" wire:click="primary('{{ $report->id }}')">Primary</button>
                                <button class="button expanded hollow" wire:click="secondary('{{ $report->id }}')">Secondary</button>
                            </div>  
                        </div><!-- End of cell-->
                        @endisset
                    @endforeach
                </div><!--end of grid-x -->
                @endif
            </div><!-- End of cell-->
        </div><!--end of grid-x -->
        @elseif($mode == 6)
        <div class="grid-x grid-padding-x">
            @foreach($deadlist as $fish)
            <div class="cell small-12 medium-4 large-3">
                <img src="{{ $fish->sideone }}">
                @isset($fish->name)<strong>{{ $fish->name }}</strong>@endisset
                <strong>Top Weight:</strong> {{ $fish->lbs }}lb {{ $fish->oz }}oz<br>
                <strong>Last Capture:</strong> 
                @foreach($fish->reports as $report)
                    @if($loop->first)
                        {{ date('j/m/y', strtotime ($report->date)) }}<br>
                    @endif
                @endforeach
                @if($fish->reports->count() < 1)
                    N/A <br>
                @endif
                <strong>Captures:</strong>{{ $fish->reports()->count() }}
                <button class="button success expanded" wire:click="selectFish('{{ $fish->id }}')">View Fish</button>
            </div><!-- End of cell-->
            @endforeach
          
        </div><!--end of grid-x -->
        @elseif($mode == 7)
        <div class="grid-x grid-padding-x">
            <div class="cell small-12 medium-8 large-6 medium-offset-2 large-offset-3">
                <label for="">
                    Name                            
                    @error('Name')<span class="error">{{ $message }}</span>@enderror
                </label>
                <input type="text" placeholder="" wire:model="name">

                <button class="button expanded success" wire:click="setname">Save Name</button>
            </div><!-- End of cell-->
        </div><!--end of grid-x -->
        @elseif($mode == 8)
        <div class="grid-x grid-padding-x">
            <div class="cell small-12 medium-8 large-6 medium-offset-2 large-offset-3">
                <label for="">Description</label>
                <textarea wire:model="description" cols="50" rows="10"></textarea>

                <button class="button expanded success" wire:click="setdescription">Save Description</button>
            </div><!-- End of cell-->
        </div><!--end of grid-x -->
        @endif
    </div><!--End of grid container-->
</div>

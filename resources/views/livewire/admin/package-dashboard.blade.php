<div>
    <div class="grid-container full">
        <div class="grid-x grid-padding-x">
            <div class="cell small-12">
                <div class="admin-title-panel">
                    <div class="grid-x">
                        <div class="cell small-12 medium-6">
                            <h1>Packages/ Pricing</h1>
                        </div>
                        <div class="cell small-12 medium-6 text-right align-self-middle">
                            @if($mode == 1)
                            <button class="button" wire:click="$set('mode', 2)">New Package</button>
                            <button class="button success" wire:click="$set('mode', 4)">Set Pricing</button>
                            @else
                                @if($mode == 3)
                                    @if($selectedPackage->active == 1)
                                        <button class="button alert" wire:click="deactivatePackage">Deactivate</button>
                                    @else
                                        <button class="button success" wire:click="activatePackage">Activate</button>
                                    @endif
                                @elseif($mode == 4)
                                    @if($selectedPriceguide)
                                        @if($selectedPriceguide->bookings()->doesntExist())
                                        <button class="button alert" wire:click="deletePriceguide">Delete</button>
                                        @else
                                        <button class="button alert disabled">Delete</button>
                                        @endif
                                    @endif
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
    <div class="grid-container">
        <div class="grid-x grid-padding-x">
            @if($mode == 1)
            <div class="cell small-12">
                <div class="table-scroll">
                    <table>
                        <thead>
                            <tr>
                                <th>Package</th>
                                <th>Status</th>
                                <th class="text-center">Price Guides</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($packages as $package)
                            <tr>
                                <td>{{ $package->name }}</td>
                                <td>
                                    @isset($package->active)
                                        Active
                                    @else 
                                        Inactive
                                    @endisset
                                </td>
                                <td class="text-center">{{ $package->priceguides()->count() }}</td>
                                <td class="text-right">
                                    <button class="button" wire:click="selectPackage('{{ $package->id }}')">Update</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="table-scroll">
                    <table>
                        <thead>
                            <tr>
                                <th>Price Guides</th>
                                <td>Start</td>
                                <td>End</td>
                                <td>Price</td>
                                <td>Deposit</td>
                                <td>Due</td>
                                <td></td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($priceguides as $priceguide)
                            <tr>
                                <td>{{ $priceguide->package->name }} @isset($priceguide->name)({{ $priceguide->name }}) @endisset</td>
                                <td>{{ date('j/m/y', strtotime ($priceguide->start)) }}</td>
                                <td>{{ date('j/m/y', strtotime ($priceguide->end)) }}</td>
                                <td>£{{ number_format($priceguide->price / 100, 2) }}</td>
                                <td>£{{ number_format($priceguide->deposit / 100, 2) }}</td>
                                <td>{{ $priceguide->due }} days</td>
                                <td>@isset($priceguide->featured)<i class="fas fa-check-circle"></i>@endisset</td>
                                <td class="text-right"><button class="button success" wire:click="selectPriceguide('{{ $priceguide->id }}')">Update</button></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div><!-- End of cell-->
            @elseif($mode == 2)
            <div class="cell small-12 medium-8 large-6 medium-offset-2 large-offset-3">
                <label for="">Package Name</label>
                <input type="text" placeholder="" wire:model="name">

                <button class="button success" wire:click="savePackage">Save Package</button>
            </div>
            @elseif($mode == 3)
            <div class="cell small-12 medium-8 large-6 medium-offset-2 large-offset-3">
                <h4>{{ $selectedPackage->name }}</h4>
                <label for="">Feature</label>
                <input type="text" placeholder="" wire:model="breakdown">

                @if($selectedBreakdown)
                <button class="button success" wire:click="saveBreakdownChanges">Save Changes</button>
                @else
                <button class="button success" wire:click="saveBreakdown">Save Feature</button>
                @endif

                @foreach($selectedPackage->breakdowns as $breakdown)
                <p>{{ $breakdown->body }}</p>
                <div class="button-group small">
                    <button class="button warning" wire:click="selectBreakdown('{{ $breakdown->id }}')">Update</button>
                    <button class="button alert" wire:click="deleteBreakdown('{{ $breakdown->id }}')">Delete</button>
                </div>
                @endforeach

            </div>
            @elseif($mode == 4)
            <div class="cell small-12 medium-8 large-6 medium-offset-2 large-offset-3">
                <label for="">Package
                    @error('package')<span class="error">{{ $message }}</span>@enderror
                </label>
                <select id="" wire:model="package">
                    <option value="">Please Select</option>
                    @foreach($packages as $package)
                    <option value="{{ $package->id }}">{{ $package->name }}</option>
                    @endforeach 
                </select>

                <label for="">Name (optional)</label>
                <input type="text" placeholder="" wire:model="name">

                <label for="">Valid From
                    @error('start')<span class="error">{{ $message }}</span>@enderror
                </label>
                <input type="text" id="datepicker" wire:model.lazy="start">

                <label for="">Valid To
                    @error('end')<span class="error">{{ $message }}</span>@enderror
                </label>
                <input type="text" id="datepicker2" wire:model.lazy="end">

                <label for="">Price
                    @error('price')<span class="error">{{ $message }}</span>@enderror
                </label>
                <input type="text" placeholder="" wire:model="price">

                <label for="">Deposit £
                    @error('deposit')<span class="error">{{ $message }}</span>@enderror
                </label>
                <input type="text" placeholder="" wire:model="deposit">

                <label for="">Balance Due (days before departure)
                    @error('due')<span class="error">{{ $message }}</span>@enderror
                </label>
                <input type="text" placeholder="" wire:model="due">

                <label for="">Feature On Website</label>
                <select id="" wire:model="featured">
                    <option value="">Please select</option>
                    <option value="">No</option>
                    <option value="1">Yes</option> 
                </select>

                @if($selectedPriceguide)
                    <button class="button success" wire:click="savePriceguideChanges">Save Changes</button> 
                @else
                    <button class="button success" wire:click="savePriceguide">Save Prices</button>
                @endif  

            </div>
            @endif
        </div><!--end of grid-x -->
    </div><!--End of grid container-->
</div>

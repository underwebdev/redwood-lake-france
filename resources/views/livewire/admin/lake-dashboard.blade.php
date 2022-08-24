<div>
    <div class="grid-container full">
        <div class="grid-x grid-padding-x">
            <div class="cell small-12">
                <div class="admin-title-panel">
                    <div class="grid-x">
                        <div class="cell small-12 medium-6">
                            <h1>Lake Info</h1>
                        </div>
                        <div class="cell small-12 medium-6 text-right align-self-middle">
                            @if($mode == 1)
                            @if($lake->images()->count() < 6)
                                <button class="button" wire:click="$set('mode', 5)">Add Fish</button>   
                            @endif
                            <button class="button success" wire:click="$set('mode', 2)">New Swim</button>
                            @else
                            <button class="button alert" wire:click="back">Go Back</button>
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
            <div class="cell small-12 medium-8">
                  
            </div><!-- End of cell-->
            <div class="cell small-12 medium-4">
                <p><strong>Size:</strong> {{ $lake->size}}<br>
                <strong>Swims: </strong> {{ $lake->swims()->count() }}<br>
                <strong>Rod Limit: </strong> {{ $lake->rodlimit }}<br>
                <strong>Open:</strong> {{ $lake->open }}<br>
                <strong>Common: </strong>{{ $lake->lrcommon }}<br>
                <strong>Mirror: </strong>{{ $lake->lrmirror }}<br>
                <strong>Total fish: </strong>{{ $lake->stock }}<br>
                <strong>Average size: </strong>{{ $lake->avgsize }}</p>
                <button class="button" wire:click="selectLake">Update Info</button>
            </div><!-- End of cell-->
        </div><!--end of grid-x -->

        <div class="grid-x grid-padding-x">
            @foreach($lake->swims as $swim)
            <div class="cell small-12 medium-4 large-3">
                @isset($swim->thumbnail)<img src="{{ $swim->thumbnail }}">@endisset
                <h5 class="text-center">{{ $swim->name }}</h5>
                <button class="button warning expanded" wire:click="selectSwim('{{ $swim->id }}')">Update Swim</button>  
            </div><!-- End of cell-->
            @endforeach
        </div><!--end of grid-x -->
        <div class="grid-x grid-padding-x">
            @foreach($lake->images as $image)
            <div class="cell small-12 medium-6 large-4">
                <img src="{{ $image->photo }}">
                <button class="button expanded warning" wire:click="selectFish('{{ $image->id }}')">Update Image</button>
            </div><!-- End of cell-->
            @endforeach
        </div><!--end of grid-x -->
        @elseif($mode == 2)
        <div class="grid-x grid-padding-x">
            <div class="cell small-12 medium-8 large-6 medium-offset-2 large-offset-3">
                <label for="">Size</label>
                <input type="text" placeholder="" wire:model="size">
                <label for="">Rod Limit</label>
                <input type="text" placeholder="" wire:model="rodlimit">
                <label for="">Open</label>
                <input type="text" placeholder="" wire:model="open">
                <label for="">Lake Record Common</label>
                <input type="text" placeholder="" wire:model="lrcommon">
                <label for="">Lake Record Mirror</label>
                <input type="text" placeholder="" wire:model="lrmirror">
                <label for="">Total Fish</label>
                <input type="text" placeholder="" wire:model="stock">
                <label for="">Average Size</label>
                <input type="text" placeholder="" wire:model="avgsize">
                <button class="button success" wire:click="saveLakeChanges">Save Changes</button>
            </div>
        </div><!--end of grid-x -->
        @elseif($mode == 3)
        <div class="grid-x grid-padding-x">
            <div class="cell small-12 medium-8 large-6 medium-offset-2 large-offset-3">
                <label for="">Swim Name</label>
                <input type="text" placeholder="" wire:model="name">
                <label for="">Short Name</label>
                <input type="text" placeholder="" wire:model="shortname">

                <button class="button success" wire:click="saveSwimChanges">Save Changes</button>

                @isset($selectedSwim->photo)
                <img src="{{ $selectedSwim->thumbnail }}">
                @endisset

                <input type="file" wire:model="photo">
            </div>
         </div><!--end of grid-x -->
        @elseif($mode == 4)
        <div class="grid-x grid-padding-x">
            <div class="cell small-12 medium-8 large-6 medium-offset-2 large-offset-3">
                create new swim
            </div>
        </div><!--end of grid-x -->
        @elseif($mode == 5)
        <div class="grid-x grid-padding-x">
            <div class="cell small-12 medium-8 large-6 medium-offset-2 large-offset-3">
                <input type="file" wire:model="fishphoto">
                @if($selectedFish)
                <img src="{{ $selectedFish->photo }}">
                @endif
                <button class="button success" wire:click="saveFish">Save Photo</button>              
            </div><!-- End of cell-->
        </div><!--end of grid-x -->
        @endif
    </div><!--End of grid container-->
</div>

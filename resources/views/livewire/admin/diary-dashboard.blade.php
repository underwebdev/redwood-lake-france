<div>
    <div class="grid-container full">
        <div class="grid-x grid-padding-x">
            <div class="cell small-12">
                <div class="admin-title-panel">
                    <div class="grid-x">
                        <div class="cell small-12 medium-6">
                            <h1>Photo Diary</h1>
                        </div>
                        <div class="cell small-12 medium-6 text-right align-self-middle">
                            @unless($mode)
                                <button class="button success" wire:click="mode('1')">New Post</button>
                            @endunless
                            @isset($mode)
                                <button class="button alert" wire:click="$set('mode', null)">Cancel</button>
                            @endif
                        </div><!-- End of cell-->
                    </div>
                </div>
            </div><!-- End of cell-->
        </div><!--end of grid-x -->
        @include('layout.alerts')
    </div><!--End of grid container-->

    @if($mode == 1)
    <div class="grid-container">
        <div class="grid-x grid-padding-x">
            <div class="cell small-12">
                <form wire:submit.prevent="savePost">
                    @error('photo')<label><span class="error">{{ $message }}</span></label>@enderror
                    <input type="file" wire:model.live="photo">

                    <label for="">Caption @error('caption')<span class="error">{{ $message }}</span>@enderror</label>
                    <input type="text" placeholder="Photo caption" wire:model.live="caption">

                    <label for="">Date @error('date')<span class="error">{{ $message }}</span>@enderror</label>
                    <input type="text" id="datepicker" placeholder="dd/mm/yyyy" wire:model.lazy="date">

                    <button class="button expanded success">Upload Post</button>
                </form>
            </div><!-- End of cell-->
        </div><!--end of grid-x -->
    </div><!--End of grid container-->
    @elseif($mode == 2)
    <div class="grid-container">
        <div class="grid-x grid-padding-x">
            <div class="cell small-12">
                <form wire:submit.prevent="savePost">
                    @if($photo)
                        <img src="{{ $photo->temporaryUrl() }}">
                    @else
                        <img src="/assets/photo-diary/{{ $diary->id }}">
                    @endif
                    @error('photo')<label><span class="error">{{ $message }}</span></label>@enderror
                    <input type="file" wire:model.live="photo">

                    <label for="">Caption @error('caption')<span class="error">{{ $message }}</span>@enderror</label>
                    <input type="text" placeholder="Photo caption" wire:model.live="caption">

                    <label for="">Date @error('date')<span class="error">{{ $message }}</span>@enderror</label>
                    <input type="text" id="datepicker" placeholder="dd/mm/yyyy" wire:model.live="date">

                    <button class="button expanded success">Update Post</button>
                </form>
            </div><!-- End of cell-->
        </div><!--end of grid-x -->
    </div><!--End of grid container-->
    @elseif($mode == 3)
    <div class="grid-container">
        <div class="grid-x grid-padding-x">
            <div class="cell small-12 text-center">
                <h3>Are you sure you want to delete this photo?</h3>
                <p><span class="error">This acton can not be undone.</span></p>
                <img src="/assets/photo-diary/{{ $diary->id }}">
                <div class="button-group text-center">
                    <button class="button alert" wire:click="delete">Delete Image</button>
                    <button class="button warning" wire:click="$set('mode', null)">Cancel</button>
                </div>
            </div><!-- End of cell-->
        </div><!--end of grid-x -->
    </div><!--End of grid container-->
    @else
    <div class="grid-container full">
        <div class="grid-x grid-padding-x">
            <div class="cell small-12 large-6">
                @isset($featured)
                    <img src="/assets/photo-diary/{{ $featured->id }}" class="news-feature">
                    <p class="text-center"><strong>{{ $featured->caption }} - {{ date('j/m/y', strtotime ($featured->date)) }}</strong></p>
                @endif 
            </div>

            <div class="cell small-12 large-6">
                @isset($secondary)
                    <img src="/assets/photo-diary/{{ $secondary->id }}" class="news-feature">
                    <p class="text-center"><strong>{{ $secondary->caption }} - {{ date('j/m/y', strtotime ($secondary->date)) }}</strong></p>
                @endif
            </div>
        </div><!--end of grid-x -->
        <div class="grid-x grid-padding-x">
        @foreach($photos as $photo)
            @unless($photo->is_featured != Null)
            <div class="cell small-12 medium-6 ml-4 large-4 xlarge-3 text-center">
                <div class="photo-border-block">
                    <a href="/assets/photo-diary/{{ $photo->id }}.{{ Str::afterLast($photo->photo, '.') }}" data-lity>
                    <img src="/assets/photo-diary/{{ $photo->id }}">
                    </a>
                </div>
                <p>{{ $photo->caption }} - {{ date('j/m/y', strtotime ($photo->date)) }}</p>
                @unless($photo->is_featured == 1)
                    <button class="button success expanded" wire:click="feature('{{ $photo->id }}')">Feature</button>
                @else
                    <button class="button success expanded" disabled>Feature</button>
                @endunless

                @unless($photo->is_featured == 2)
                    <button class="button expanded" wire:click="secondary('{{ $photo->id }}')">Secondary</button>
                @else
                    <button class="button expanded" disabled>Secondary</button>
                @endunless
                <button class="button warning expanded" wire:click="setmode('2', {{ $photo->id }})">Update</button>
                <button class="button alert expanded" wire:click="setmode('3','{{ $photo->id }}')">Delete</button>
            </div><!-- End of cell-->
            @endunless
        @endforeach
        </div><!--end of grid-x -->
    </div><!--End of grid container-->
    @endif
</div>

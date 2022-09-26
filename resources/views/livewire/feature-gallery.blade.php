<div>
    <div class="grid-container">
        <div class="grid-x grid-padding-x">
            <div class="cell small-12 show-for-ml">
                <div class="gallery-block">
                    <img src="{{ $featured->image }}" alt="{{ $featured->alt }}">
                </div>
            </div><!-- End of cell-->
        </div><!--end of grid-x -->
        <div class="grid-x grid-padding-x">
            <br class="hide-for-medium">
            @foreach($thumbnails as $thumbnail)
            <div class="cell large-3">
                <div class="gallery-block">
                    <button wire:click="selectImage('{{ $thumbnail->id }}')"><img src="{{ $thumbnail->mobile }}"></button>
                </div>
            </div><!-- End of cell-->
            @endforeach
        </div><!--end of grid-x -->
    </div><!--End of grid container-->
</div>

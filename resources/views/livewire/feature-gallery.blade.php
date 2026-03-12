<div>
    <div class="grid-container">
        <div class="grid-x grid-padding-x">
            <div class="cell small-12 show-for-ml">
                <div class="gallery-block">
                    <img src="/assets/feature-gallery/{{ $featured->id }}" alt="{{ $featured->alt }}" width="100%">
                </div>
            </div><!-- End of cell-->
        </div><!--end of grid-x -->
        <div class="grid-x grid-padding-x">
            <br class="hide-for-medium">
            @foreach($thumbnails as $thumbnail)
            <div class="cell large-3">
                <div class="gallery-block">
                    <button wire:click="selectImage('{{ $thumbnail->id }}')"><img src="/assets/feature-gallery/{{ $thumbnail->id }}" alt="{{ $thumbnail->alt }}"></button>
                </div>
            </div><!-- End of cell-->
            @endforeach
        </div><!--end of grid-x -->
    </div><!--End of grid container-->
</div>

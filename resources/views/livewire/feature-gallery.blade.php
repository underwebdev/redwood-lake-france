<div>
    <div class="hide-for-large" wire:ignore>
        <section class="horizSlider">
        @foreach($thumbnails as $image)
          <div class="slide">
            <h2 class="slideText"></h2>
            <img width="1000" height="500" class="slideImage" src="{{ $image->thumbnail }}" alt="{{ $image->alt }}">
          </div>
        @endforeach
        </section>

        <div class="grid-x grid-padding-x">
            <div class="cell small-12 text-center">
                <br>
                <p><span class="show-for-large">Scroll</span><span class="hide-for-large">Swipe</span> for more<i class="fas fa-arrow-alt-circle-right wobble"></i></p>
            </div><!-- End of cell-->
        </div><!--end of grid-x -->
    </div>

    <div class="grid-container show-for-large">
        <div class="grid-x grid-padding-x">
            <div class="cell small-12">
                <div class="gallery-block">
                    <img src="{{ $featured->image }}" alt="{{ $featured->alt }}">
                </div>
            </div><!-- End of cell-->
        </div><!--end of grid-x -->
        <div class="grid-x grid-padding-x">
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

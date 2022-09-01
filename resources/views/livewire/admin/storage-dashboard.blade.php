<div>
    <div class="grid-container">
        <div class="grid-x grid-padding-x">
            <div class="cell small-12">
                @foreach($photos as $photo)
                    {{ $photo }}<br>
                @endforeach

                <button class="button" wire:click="movePhotos">Move Files</button>

                <button class="button" wire:click="cleanupDatabase">Clean DB</button>

                <button class="button" wire:click="cleanupSpecies">Clean species</button>
            </div><!-- End of cell-->
        </div><!--end of grid-x -->
    </div><!--End of grid container-->
</div>

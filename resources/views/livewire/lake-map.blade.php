<div>
    <div class="grid-x grid-padding-x">
        <div class="cell small-12 medium-8">
            @if($selectedSwim)
                @isset($selectedSwim->photo)
                    <img src="{{ $selectedSwim->photo }}">
                @else
                    <div class="cell small-12 align-self-middle text-center">
                        <strong>Coming Soon</strong>
                    </div>
                @endisset
            @else
                <img src="/img/lake-map.png" height="800px">
            @endif
        </div><!-- End of cell-->
        <div class="cell small-12 medium-4">
            <div class="grid-x grid-padding-x">
                <div class="cell small-6 medium-6 ml-3 large-6">
                    <h3 class="heading-font yellow">Info</h3>
                      <p><strong>Size:</strong> 7 acres<br>
                      <strong>Swims: </strong> 9<br>
                      <strong>Rod Limit: </strong> 3<br>
                      <strong>Open:</strong> All Year</p>
                </div><!-- End of cell-->
                <div class="cell small-6 medium-6 ml-3 large-6">
                    <h3 class="heading-font yellow">Records</h3>
                      <p><strong>Common: </strong>39lb 0oz<br>
                      <strong>Mirror: </strong>39lb 0oz<br>
                      <strong>Total fish: </strong>350<br>
                      <strong>Average size: </strong>20lb</p>
                     </p>    
                </div><!-- End of cell-->
                <div class="cell small-12">
                    <div class="swim-list">
                        <h3>Swims</h3>
                        <p><i class="fas fa-info-circle"></i> Click the swim names to see the lake from each swim.</p>
                        <div class="grid-x grid-padding-x">
                            <div class="cell small-12 medium-6">

                                @foreach($lake->swims as $swim)
                                    @if($loop->index < 5)
                                    <button wire:click="selectSwim('{{ $swim->id }}')">
                                        <i class="fas fa-map-signs"></i> {{ $swim->name }}
                                    </button><br>
                                    @endif
                                @endforeach
                            </div><!-- End of cell-->
                            <div class="cell small-12 medium-6">
                                @foreach($lake->swims as $swim)
                                    @if($loop->index > 4)
                                    <button wire:click="selectSwim('{{ $swim->id }}')">
                                        <i class="fas fa-map-signs"></i> {{ $swim->name }}
                                    </button><br>
                                    @endif
                                @endforeach
                                @if($selectedSwim)
                                    <button wire:click="back"><i class="fas fa-map"></i>Back To Map</button> 
                                @endif
                            </div><!-- End of cell-->
                        </div><!--end of grid-x -->
                    </div>
                </div><!-- End of cell-->
                <div class="cell small-12">
                    <div class="button-group">
                        <a href="/rules" class="button success expanded">Lake Rules</a>
                        <a href="/fishing-in-france" class="button warning expanded">French Fishing Regulation</a>
                    </div>
                </div><!-- End of cell-->
            </div>
        </div><!-- End of cell-->
    </div><!--end of grid-x -->
</div>

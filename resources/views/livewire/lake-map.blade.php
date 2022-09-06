<div>
    <div class="grid-x grid-padding-x">
        <div class="cell small-12 large-8">
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
        <div class="cell small-12 large-4">
            <div class="grid-x grid-padding-x">
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
                            </div><!-- End of cell-->
                            @if($selectedSwim)
                            <div class="cell small-12 text-center">
                                <button wire:click="back"><i class="fas fa-map"></i>Back To Map</button> 
                            </div><!-- End of cell-->
                            @endif
                        </div><!--end of grid-x -->
                    </div>
                </div><!-- End of cell-->
                <div class="cell small-12 medium-6">
                    <h3 class="heading-font yellow">Info</h3>
                      <p><strong>Size:</strong> {{ $lake->size }}<br>
                      <strong>Swims: </strong> {{ $lake->swims->count() }}<br>
                      <strong>Rod Limit: </strong> {{ $lake->rodlimit }}<br>
                      <strong>Open:</strong> All Year</p>
                </div><!-- End of cell-->
                <div class="cell small-12 medium-6">
                    <h3 class="heading-font yellow">Records</h3>
                      <p><strong>Common: </strong>{{ $lake->lrcommon }}<br>
                      <strong>Mirror: </strong>{{ $lake->lrmirror }}<br>
                      <strong>Total fish: </strong>{{ $lake->stock }}<br>
                      <strong>Average size: </strong>{{ $lake->avgsize }}</p>
                     </p>    
                </div><!-- End of cell-->
                <div class="cell small-12">
                    <div class="button-group">
                        <a href="/rules" class="button success expanded">Lake Rules</a>
                    </div>
                </div><!-- End of cell-->
            </div>
        </div><!-- End of cell-->
    </div><!--end of grid-x -->
</div>

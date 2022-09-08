<div>
    <div class="grid-x grid-padding-x">
        <div class="cell small-12 large-8">
            @if($selectedSwim)
                @isset($selectedSwim->photo)
                    <img src="{{ $selectedSwim->photo }}" class="lake-map">
                @endisset
            @else
                <img src="/img/lake-map.png" class="lake-map">
            @endif
        </div><!-- End of cell-->
        <div class="cell small-12 large-4">
            <div class="grid-x grid-padding-x">
                <div class="cell small-12">
                    <div class="swim-list">
                        <h5 class="info-bar">Swims</h5>
                        <p><i class="fas fa-info-circle secondary"></i> Click the swim names to see the lake from each swim.</p>

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
            </div>
            <div class="grid-x grid-padding-x">
                <div class="cell small-12 medium-6">
                    <h5 class="info-bar">Info</h5>
                      <p><strong><span class="weighted">Size:</span></strong> {{ $lake->size }}<br>
                      <strong><span class="weighted">Swims:</span> </strong> {{ $lake->swims->count() }}<br>
                      <strong><span class="weighted">Rod Limit:</span> </strong> {{ $lake->rodlimit }}<br>
                      <strong><span class="weighted">Open:</span></strong> All Year</p>
                </div><!-- End of cell-->
                <div class="cell small-12 medium-6">
                    <h5 class="info-bar">Records</h5>
                      <p><strong><span class="weighted">Common:</span> </strong>{{ $lake->lrcommon }}<br>
                      <strong><span class="weighted">Mirror:</span> </strong>{{ $lake->lrmirror }}<br>
                      <strong><span class="weighted">Total fish:</span> </strong>{{ $lake->stock }}<br>
                      <strong><span class="weighted">Average size:</span> </strong>{{ $lake->avgsize }}</p>
                     </p>    
                </div><!-- End of cell-->
            </div>
            <div class="grid-x grid-padding-x">
                <div class="cell small-12">
                    <div class="button-group">
                        <a href="/rules" class="button success expanded">Lake Rules</a>
                    </div>
                </div><!-- End of cell-->
            </div>
        </div><!-- End of cell-->
    </div><!--end of grid-x -->
</div>

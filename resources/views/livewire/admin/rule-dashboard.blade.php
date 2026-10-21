<div>
    <div class="grid-container full">
        <div class="grid-x grid-padding-x">
            <div class="cell small-12">
                <div class="admin-title-panel">
                    <div class="grid-x">
                        <div class="cell small-12 medium-6">
                            <h1>Rules</h1>
                        </div>
                        <div class="cell small-12 medium-6 text-right align-self-middle">
                            @if($mode == 1)
                            <button class="button success" wire:click="$set('mode', 2)">New Rule</button>
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
    <div class="grid-container">
        <div class="grid-x grid-padding-x">
            @if($mode == 1)
            <div class="cell small-12">
                <div class="table-scroll">
                    <table>
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>Rule</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rules as $rule)
                            <tr>
                                <td>{{ $rule->order }}</td>
                                <td>{{ $rule->body }}</td>
                                <td class="text-right">
                                    <button class="button" wire:click="selectRule('{{ $rule->id }}')">Update</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                  
            </div><!-- End of cell-->
            @elseif($mode == 2)
            <div class="cell small-12 medium-8 large-6 medium-offset-2 large-offset-3">
                <label for="">Rule</label>
                <textarea wire:model.live="body" cols="50" rows="10"></textarea>
                <button class="button success" wire:click="saveRule">Save Rule</button>
                <button class="button alert" wire:click="$set('mode', 1)">Cancel</button>
            </div><!-- End of cell-->
            @elseif($mode == 3)
            <div class="cell small-12 medium-8 large-6 medium-offset-2 large-offset-3">
                <label for="">Rule</label>
                <textarea wire:model.live="body" cols="50" rows="10"></textarea>
                <button class="button success" wire:click="saveRuleChanges">Save Rule</button>
                <button class="button alert" wire:click="delete('{{ $selectedRule->id }}')">Delete</button>
            </div><!-- End of cell-->
            @endif
        </div><!--end of grid-x -->
    </div><!--End of grid container-->
</div>

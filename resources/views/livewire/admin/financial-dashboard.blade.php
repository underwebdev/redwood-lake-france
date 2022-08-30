<div>
    <div class="grid-container full">
        <div class="grid-x grid-padding-x">
            <div class="cell small-12">
                <div class="admin-title-panel">
                    <div class="grid-x">
                        <div class="cell small-12 medium-6">
                            <h1>Financial Report</h1>
                        </div>
                        <div class="cell small-12 medium-6 text-right align-self-middle">
                            @if($mode == 1)
                           
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
        <div class="grid-x grid-padding-x">
            <div class="cell small-12">
                <div class="table-scroll">
                    <table>
                        <thead>
                            <tr>
                                <td></td>
                                <td>{{ Carbon\Carbon::now()->englishMonth }}</td>
                                <td>{{ Carbon\Carbon::now()->subMonth()->englishMonth }}</td>
                                <td>Q1</td>
                                <td>Q2</td>
                                <td>Q3</td>
                                <td>Q4</td>
                                <td>{{ Carbon\Carbon::now()->year }}</td>
                                <td>{{ Carbon\Carbon::now()->subYear()->year }}</td>
                                <td class="text-right">All Time</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Income</td>
                                <td>£</td>
                                <td>£</td>
                                <td>£</td>
                                <td>£</td>
                                <td>£</td>
                                <td>£</td>
                                <td>£</td>
                                <td>£</td>
                                <td class="text-right">£</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div><!-- End of cell-->
        </div><!--end of grid-x -->
    </div><!--End of grid container-->
</div>

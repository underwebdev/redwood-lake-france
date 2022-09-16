<div>
    <div class="grid-container full">
        <div class="grid-x grid-padding-x">
            <div class="cell small-12">
                <div class="admin-title-panel">
                    <div class="grid-x">
                        <div class="cell small-12 medium-6">
                            <h1>Vouchers/ Discounts</h1>
                        </div>
                        <div class="cell small-12 medium-6 text-right align-self-middle">
                            @if($mode == 1)
                            <button class="button success" wire:click="$set('mode', 2)">New Voucher</button>
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
                <input type="text" placeholder="search voucher by code" wire:model="lookup">
                <div class="table-scroll">
                    <table>
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Amount</th>
                                <td class="text-center">Limit</td>
                                <td>Used</td>
                                <td>Valid</td>
                                <td>Status</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($vouchers as $voucher)
                            <tr>
                                <td>{{ $voucher->code }}</td>
                                <td>£{{ $voucher->amount / 100 }}</td>
                                <td class="text-center">{{ $voucher->limit }}</td>
                                <td>{{ $voucher->used }}</td>
                                <td>
                                    {{ date('j/m/y', strtotime ($voucher->start)) }}
                                    @if($voucher->end > $voucher->start)
                                        - {{ date('j/m/y', strtotime ($voucher->end)) }}
                                    @endif
                                </td>
                                <td>
                                    @if(Carbon\Carbon::today() > $voucher->end)
                                        <span class="error">Expired</span>
                                    @elseif($voucher->active == 1)
                                        Active
                                    @else
                                        Inactive
                                    @endif
                                </td>
                                <td class="text-right"><button class="button warning small" wire:click="selectVoucher('{{ $voucher->id }}')">Update</button></td>                            
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>             
            </div><!-- End of cell-->
            @elseif($mode == 2)
            <div class="cell small-12 medium-8 large-6 medium-offset-2 large-offset-3">
                <label for="">Code
                    @error('code')<span class="error">{{ $message }}</span>@enderror
                </label>
                <input type="text" placeholder="" wire:model="code">

                <label for="">Discount Amount
                    @error('amount')<span class="error">{{ $message }}</span>@enderror
                </label>
                <input type="text" placeholder="" wire:model="amount">

                <label for="">Discount Usage Limit
                    @error('limit')<span class="error">{{ $message }}</span>@enderror
                </label>
                <input type="text" placeholder="" wire:model="limit">

                <label for="">Valid On
                    @error('start')<span class="error">{{ $message }}</span>@enderror
                </label>
                <input type="text" id="datepicker" wire:model.lazy="start">

                <label for="">Will the discount be valid for more than one date?
                    @error('validity')<span class="error">{{ $message }}</span>@enderror
                </label>
                <select id="" wire:model="validity">
                    <option value="">No</option>
                    <option value="1">Yes</option> 
                </select>

                @if($validity == 1)
                <label for="">Discount Expiry (Discount will be valid on and between the two dates entered)
                    @error('end')<span class="error">{{ $message }}</span>@enderror
                </label>
                <input type="text" id="datepicker2" wire:model.lazy="end">
                @endif

                @if($selectedVoucher)
                    <button class="button success" wire:click="saveVoucherChanges">Save Changes</button>        

                @else
                    <button class="button success" wire:click="saveVoucher">Save Voucher</button>
                @endif
            </div>
            @endif
          
        </div><!--end of grid-x -->
    </div><!--End of grid container-->
</div>

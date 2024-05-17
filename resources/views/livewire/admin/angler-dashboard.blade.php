<div>
    <div class="grid-container full">
        <div class="grid-x grid-padding-x">
            <div class="cell small-12">
                <div class="admin-title-panel">
                    <div class="grid-x">
                        <div class="cell small-12 medium-6">
                            <h1>Anglers</h1>
                        </div>
                        <div class="cell small-12 medium-6 text-right align-self-middle">
                            @if($mode == 1)
                            <button class="button success" wire:click="$set('mode', 2)">New Angler</button>
                            @else
                            <button class="button warning" wire:click="resetpassword" wire:loading.attr="disabled">Reset Password</button>
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
            @if($mode == 1)
            <div class="cell small-12">
                <input type="text" wire:model="lookup" placeholder="Search angler by first or last name">
                <div class="table-scroll">
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Telephone</th>
                                <th>Email</th>
                                <th>Last Login</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($anglers as $angler)
                            <tr>
                                <td>{{ $angler->ref }}</td>
                                <td>{{ $angler->firstName }} {{ $angler->lastName }}</td>
                                <td>@isset($angler->telephone) {{ $angler->telephone }} @else N/A @endisset</td>
                                <td>
                                    @if($angler->user()->exists())
                                        {{ $angler->user->email }}
                                    @else 
                                        N/A
                                    @endif
                                </td>
                                <td>
                                    @if($angler->user()->exists())
                                        {{ date('j/m/y H:i', strtotime ($angler->user->last_login)) }}
                                    @else 
                                        N/A
                                    @endif
                                    
                                </td>
                                <td class="text-right">
                                    <button class="button small" wire:click="selectAngler('{{ $angler->id }}')">View</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div><!-- End of cell-->
            @elseif($mode == 2)
            <div class="cell small-12 medium-8 large-6 medium-offset-2 large-offset-3">
                <label for="">First Name
                    @error('firstName')<span class="error">{{ $message }}</span>@enderror
                </label>
                <input type="text" placeholder="" wire:model="firstName">
                <label for="">Last Name
                    @error('lastName')<span class="error">{{ $message }}</span>@enderror
                </label>
                <input type="text" placeholder="" wire:model="lastName">
                <label for="">Telephone
                    @error('telephone')<span class="error">{{ $message }}</span>@enderror
                </label>
                <input type="text" placeholder="" wire:model="telephone">
                <label for="">Create A login for this angler?
                    @error('account')<span class="error">{{ $message }}</span>@enderror
                </label>
                <select id="" wire:model="account">
                    <option value="">Please select</option>
                    <option value="1">Yes</option>
                    <option value="2">No</option> 
                </select>
                @if($account == 1)
                <label for="">Email
                    @error('email')<span class="error">{{ $message }}</span>@enderror
                </label>
                <input type="text" placeholder="" wire:model="email">
                <label for="">Confirm email</label>
                <input type="text" placeholder="" wire:model="email_confirmation">
                @endif
                <button class="button success" wire:click="saveAngler">Create Angler</button>
            </div><!-- End of cell-->
            @elseif($mode == 3)
            <div class="cell small-12">
                <div class="table-scroll">
                    <table>
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Telephone</th>
                                <th>Email</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $selectedAngler->firstName }} {{ $selectedAngler->lastName }}</td>
                                <td>@isset($selectedAngler->telephone) {{ $selectedAngler->telephone }} @else N/A @endisset</td>
                                <td>
                                    @if($selectedAngler->user()->exists())
                                        {{ $selectedAngler->user->email }}
                                    @else 
                                        <button wire:click="$set('mode', 5)">Add Email</button>
                                    @endif
                                </td>
                                <td class="text-right">
                                    <button class="button small warning" wire:click="$set('mode', 4)">Update</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                  
            </div><!-- End of cell-->
            @elseif($mode == 4)
            <div class="cell small-12 medium-8 large-6 medium-offset-2 large-offset-3">
                <label for="">First Name
                    @error('firstName')<span class="error">{{ $message }}</span>@enderror
                </label>
                <input type="text" placeholder="" wire:model="firstName">
                <label for="">Last Name
                    @error('lastName')<span class="error">{{ $message }}</span>@enderror
                </label>
                <input type="text" placeholder="" wire:model="lastName">
                <label for="">Telephone
                    @error('telephone')<span class="error">{{ $message }}</span>@enderror
                </label>
                <input type="text" placeholder="" wire:model="telephone">
                <button class="button success" wire:click="saveAnglerChanges">Save Changes</button>
            </div><!-- End of cell-->
            @elseif($mode == 5)
            <div class="cell small-12 medium-8 large-6 medium-offset-2 large-offset-3">
                <label for="">Email
                    @error('email')<span class="error">{{ $message }}</span>@enderror
                </label>
                <input type="text" placeholder="" wire:model="email">
                <label for="">Confirm Email</label>
                <input type="text" placeholder="" wire:model="email_confirmation">
                <button class="button success" wire:click="saveAnglerEmail">Save Email</button>
            </div>
            @endif
        </div><!--end of grid-x -->
    </div><!--End of grid container-->
</div>

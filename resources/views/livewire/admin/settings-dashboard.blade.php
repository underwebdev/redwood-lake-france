<div>
	<div class="grid-container full">
	    <div class="grid-x grid-padding-x">
	        <div class="cell small-12">
	            <div class="admin-title-panel">
	                <div class="grid-x">
	                    <div class="cell small-12 medium-6">
	                        <h1>Settings</h1>
	                    </div>
	                    <div class="cell small-12 medium-6 text-right align-self-middle">
	                    	@unless($mode)
	                        	<button class="button success" wire:click="$set('mode', 2)">New Admin</button>
                        	@endunless
	                        @isset($mode)
	                        	<button class="button alert" wire:click="$set('mode', null)">Cancel</button>
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
					<table class="striped">
						<thead>
							<tr>
								<td>Name</td>
								<td>Email</td>
								<td class="text-center">Last Login</td>
								<td></td>
								<td></td>
							</tr>
						</thead>
						<tbody>
							@foreach($admins as $admin)
							<tr>
								<td>{{ $admin->firstName }} {{ $admin->lastName }}</td>
								<td>{{ $admin->user->email }}</td>
								<td class="text-center">
									@isset($admin->user->last_login)
										{{ date('j/m/y', strtotime ($admin->user->last_login)) }}
									@else
										N/A
									@endisset
								</td>
								<td>
									<button wire:click="adminToReset('{{ $admin->id }}')">Reset Password</button>
								</td>
								<td class="text-right">
									@if($admins->count() > 1)
									<button wire:click="deleteAdmin('{{ $admin->user->id }}')">Delete</button>
									@endif
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>	 
			</div><!-- End of cell-->
			@elseif($mode == 2)
			<div class="cell small-12 medium-8 large-6 medium-offset-2 large-offset-3">
				<form wire:submit.prevent="saveAdmin">
					<label for="">First Name @error('firstName')<span class="error">{{ $message }}</span>@enderror</label> 
					<input type="text" placeholder="" wire:model.live="firstName">

					<label for="">Last Name @error('lastName')<span class="error">{{ $message }}</span>@enderror</label> 
					<input type="text" placeholder="" wire:model.live="lastName">

					<label for="">Email @error('email')<span class="error">{{ $message }}</span>@enderror</label> 
					<input type="text" placeholder="" wire:model.live="email">

					<label for="">Password @error('passtype')<span class="error">{{ $message }}</span>@enderror</label> 
					<select id="" wire:model.live="passtype">
						<option value="">Please Select</option>
						<option value="1">Enter Manually</option>
						<option value="2">Generate Random Password</option> 
					</select>

					@if($passtype == 1)
					<label for="">Password @error('password')<span class="error">{{ $message }}</span>@enderror</label> 
					<input type="password" placeholder="" wire:model.live="password">

					<label for="">Confirm Password</label>
					<input type="password" placeholder="" wire:model.live="password_confirmation">
					@elseif($passtype == 2)
						<p><span class="error">A password will be generated and emailed to the user</span></p>
					@endif
					<button class="button success">Create Admin</button>
				</form>
			</div>
			@elseif($mode == 3)
				
			@elseif($mode == 4)
			<div class="cell small-12 medium-8 large-6 medium-offset-2 large-offset-3">
				<label for="">Password @error('passtype')<span class="error">{{ $message }}</span>@enderror</label> 
				<select id="" wire:model.live="passtype">
					<option value="">Please Select</option>
					<option value="1">Enter Manually</option>
					<option value="2">Generate Random Password</option> 
				</select>

				@if($passtype == 1)
				<label for="">Password @error('password')<span class="error">{{ $message }}</span>@enderror</label> 
				<input type="password" placeholder="" wire:model.live="password">

				<label for="">Confirm Password</label>
				<input type="password" placeholder="" wire:model.live="password_confirmation">
				@elseif($passtype == 2)
					<p><span class="error">A password will be generated and emailed to the user</span></p>
				@endif
				<button class="button success" wire:click="resetPassword()">Reset Password</button>
			</div>
			@endif   
		</div><!--end of grid-x -->
	</div><!--End of grid container-->
</div>

<x-modal>
	<x-slot name="title">
		Add Employer <span class="text-xs">({{ $step }}/2)</span>
	</x-slot>

	<x-slot name="content">
		@if ($step == 1)
		<div>
			<div class="w-full relative my-5">
				<input disabled
					class="w-full uppercase input border-gray-400 rounded text-base text-gray-500 focus:text-empex-green focus:border-green-600 focus:outline-none focus:ring-green-600 bg-gray-100 cursor-not-allowed"
					type="text" placeholder="Organization Category*" wire:model.lazy='organizationCategoryName' />
				<label class="tracking-wide text-gray-500 text-xs label">
					Organization Category*
				</label>
			</div>

			<div class="w-full relative my-5">
				<input disabled
					class="w-full uppercase input border-gray-400 rounded text-base text-gray-500 focus:text-empex-green focus:border-green-600 focus:outline-none focus:ring-green-600 bg-gray-100 cursor-not-allowed"
					type="text" placeholder="Organization Type*" wire:model.lazy='organizationTypeName' />
				<label class="tracking-wide text-gray-500 text-xs label">
					Organization Type*
				</label>
			</div>

			<div class="w-full relative my-5">
				<select wire:model.lazy='department'
					class="w-full input border-gray-400 rounded text-base text-gray-500 focus:text-empex-green focus:border-green-600 focus:outline-none focus:ring-green-600">
					<option value="">Select Department</option>
					@foreach ($departments as $dept)
					<option value="{{ $dept->id }}">{{ $dept->name }}</option>
					@endforeach
				</select>
				<label class="tracking-wide text-gray-500 text-xs label">
					Department Name*
				</label>
				@error('department')
				<p class="text-red-500 text-xs italic">{{ $message }}</p>
				@enderror
			</div>

			<div class="w-full relative my-5">
				<select wire:model.lazy='sector'
					class="w-full input border-gray-400 rounded text-base text-gray-500 focus:text-empex-green focus:border-green-600 focus:outline-none focus:ring-green-600">
					<option value="">Select Sector</option>
					@foreach ($sectors as $sect)
					<option value="{{ $sect->id }}">{{ $sect->name }}</option>
					@endforeach
				</select>
				<label class="tracking-wide text-gray-500 text-xs label" for="sector">
					Sector*
				</label>
				@error('sector')
				<p class="text-red-500 text-xs italic">{{ $message }}</p>
				@enderror
			</div>
		</div>
		@else
		<div>
			<div class="w-full relative my-5">
				<input
					class="w-full input border-gray-400 rounded text-base text-gray-500 focus:text-empex-green focus:border-green-600 focus:outline-none focus:ring-green-600"
					type="email" placeholder="Email*" wire:model.lazy='email' required />
				<label class="tracking-wide text-gray-500 text-xs label">
					Email*
				</label>
				<div class="text-left">
					@error('email') <span class="text-sm text-empex-red">{{ $message }}</span> @enderror
				</div>
			</div>

			<div class="w-full relative my-5">
				<input wire:model.lazy='password'
					class="w-full input border-gray-400 rounded text-base text-gray-500 focus:text-empex-green focus:border-green-600 focus:outline-none focus:ring-green-600"
					type="password" placeholder="password (minimum 6 characters)" required />
				<label class="tracking-wide text-gray-500 text-xs label">
					Password*
				</label>
				<div class="text-left">
					@error('password') <span class="text-sm text-empex-red">{{ $message }}</span> @enderror
				</div>
			</div>

			<div class="w-full relative my-5">
				<input wire:model.lazy='password_confirmation'
					class="w-full input border-gray-400 rounded text-base text-gray-500 focus:text-empex-green focus:border-green-600 focus:outline-none focus:ring-green-600"
					type="password" placeholder="Password Confirmation*" required />
				<label class="tracking-wide text-gray-500 text-xs label">
					Password Confirmation*
				</label>
				<div class="text-left">
					@error('password_confirmation') <span class="text-sm text-empex-red">{{ $message }}</span> @enderror
				</div>
			</div>
		</div>
		@endif
	</x-slot>

	<x-slot name="buttons">
		@if ($step == 1)
		<x-jet-secondary-button wire:click="$emit('closeModal')">
			{{ __('Close') }}
		</x-jet-secondary-button>
		<x-jet-button wire:click="step2" wire:loading.attr="disabled" wire:loading.class='bg-gray-100'>
			{{ __('Next') }}
		</x-jet-button>
		@else
		<x-jet-secondary-button wire:click="backStep1">
			{{ __('Back') }}
		</x-jet-secondary-button>
		<x-jet-button class="ml-2" wire:click="submit" wire:loading.attr="disabled" wire:loading.class='bg-gray-100'>
			{{ __('Save') }}
		</x-jet-button>
		@endif
	</x-slot>
</x-modal>
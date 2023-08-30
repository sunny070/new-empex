<x-modal>
	<x-slot name="title">
		Add New
	</x-slot>

	<x-slot name="content">
		<div class="grid grid-cols-1 gap-4">
			<div>
				<input required wire:model.lazy='name'
					class="w-full px-4 py-3 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-green-500 text-sm focus:outline-none focus:border-green-400 focus:bg-white mb-0"
					type="text" placeholder="Name" autofocus />
				@error('name')<span class="text-xs text-empex-red">{{ $message }}</span>@enderror
			</div>

			<div>
				<input required wire:model.lazy='email'
					class="w-full px-4 py-3 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-green-500 text-sm focus:outline-none focus:border-green-400 focus:bg-white"
					type="email" placeholder="Email" name="email" />
				@error('email')<span class="text-xs text-empex-red">{{ $message }}</span>@enderror
			</div>

			<div>
				<input required wire:model.lazy='contact'
					class="w-full px-4 py-3 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-green-500 text-sm focus:outline-none focus:border-green-400 focus:bg-white"
					type="number" placeholder="Contact" />
				@error('contact')<span class="text-xs text-empex-red">{{ $message }}</span>@enderror
			</div>

			<div>
				<input required wire:model.lazy='password'
					class="w-full px-4 py-3 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-green-500 text-sm focus:outline-none focus:border-green-400 focus:bg-white"
					type="password" placeholder="Password" />
				@error('password')<span class="text-xs text-empex-red">{{ $message }}</span>@enderror
			</div>

			<div>
				<select required wire:model.lazy='role'
					class="w-full px-4 py-3 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-green-500 text-sm focus:outline-none focus:border-green-400 focus:bg-white">
					<option value>--Role--</option>
					@foreach ($roles as $rle)
					<option value="{{ $rle->id }}">{{ $rle->name }}</option>
					@endforeach
				</select>
				@error('role')<span class="text-xs text-empex-red">{{ $message }}</span>@enderror
			</div>

			<div>
				<select id="district" multiple wire:model='district'>
					@foreach ($districts as $dist)
					<option value="{{ $dist->id }}">{{ $dist->name }}</option>
					@endforeach
				</select>
				@error('district')<span class="text-xs text-empex-red">{{ $message }}</span>@enderror
			</div>
		</div>

		<script>
			$(document).ready(function() {
					window.initSelect2=()=>{
						$("#district").select2({
							allowClear: true,
							placeholder:"Select District(multiple)"
						});
					}
		
					initSelect2();
					
					$('#district').on('change', function (e) {
						@this.set('district', $(this).val());
					});
		
					window.livewire.on('select2AutoInit',()=>{
						initSelect2();
					});
				});
		</script>
	</x-slot>

	<x-slot name="buttons">
		<div class="flex justify-end">
			<x-jet-secondary-button wire:click="$emit('closeModal')">
				{{ __('Close') }}
			</x-jet-secondary-button>
			<x-jet-button class="ml-2" wire:click="submit" wire:loading.attr="disabled" wire:loading.class='bg-gray-100'>
				{{ __('Save') }}
			</x-jet-button>
		</div>
	</x-slot>
</x-modal>
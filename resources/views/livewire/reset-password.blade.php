<x-modal>
	<x-slot name="title">
		Forgot Password?
	</x-slot>

	<x-slot name="content">
		<div class="mb-4 text-sm text-gray-600">
			{{ __('Forgot your password? No problem. Just let us know your email address and we will email you a
			password reset link that will allow you to choose a new one.') }}
		</div>

		<div class="block">
			<x-jet-label for="email" value="{{ __('Email') }}" />
			<x-jet-input id="email" class="block mt-1 w-full" type="email" wire:model.lazy="email" required autofocus />
		</div>
		@error('email')<span class="text-xs text-empex-red">{{ $message }}</span>@enderror

		@if (Session('success'))
		<div class="text-empex-green">{{ session('success') }}</div>
		@endif
	</x-slot>

	<x-slot name="buttons">
		<div class="flex justify-end">
			<x-jet-secondary-button wire:click="$emit('closeModal')">
				{{ __('Close') }}
			</x-jet-secondary-button>
			<x-jet-button class="ml-2" wire:click="submit" wire:loading.attr="disabled" wire:loading.class='bg-gray-100'>
				{{ __('Email Reset Link') }}
			</x-jet-button>
		</div>
	</x-slot>
</x-modal>
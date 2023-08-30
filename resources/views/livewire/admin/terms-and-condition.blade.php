<x-modal>
	<x-slot name="title">
		Terms & Condition
	</x-slot>

	<x-slot name="content">
		<div>
			{!! $terms->content ?? "Terms & Condition" !!}
		</div>
	</x-slot>

	<x-slot name="buttons">
		<x-jet-secondary-button wire:click="$emit('closeModal')">
			{{ __('Close') }}
		</x-jet-secondary-button>
	</x-slot>
</x-modal>
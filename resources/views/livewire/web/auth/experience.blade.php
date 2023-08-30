<div>
    <x-loading-indicator />
	<form class="w-full md:w-3/4 mx-auto">
		<div class="flex flex-wrap -mx-3 mt-3">
			<div class="w-full md:w-1/2 px-3">
				<label class="block uppercase tracking-wide text-sm md:text-md font-bold mb-2">
					Work Experience?
					<label class="inline-flex ml-5 text-xs">
						<input type="checkbox" class="form-checkbox text-empex-green focus:outline-none focus:ring-0"
							wire:model.lazy='hasExperience' wire:click.prevent='toggleExperience'>
						<span class="ml-2">{{ $expText }}</span>
					</label>
				</label>
			</div>
		</div>

		@if ($errors->any())
		<div class="text-empex-red" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">
			Please enter all field marked with *
		</div>
		@endif

		@if ($hasExperience)
		@foreach ($workExperiences as $expIndex => $experience)
		<div class=" font-normal my-3">Experience - {{ $expIndex + 1 }}</div>
		<div class="grid grid-cols-1 gap-4 md:grid-cols-2">
			<div class="w-full relative">
				<input wire:model.lazy='workExperiences.{{ $expIndex }}.designation'
					class="input w-full border-gray-400 text-base text-gray-500 focus:text-empex-green focus:border-empex-green focus:outline-none focus:ring-empex-green rounded"
					type="text" placeholder="Designation*">
				<label class="tracking-wide text-gray-500 text-xs label" for="designation">
					Designation*
				</label>
				@error('workExperiences.{{ $expIndex }}.designation')
				<p class="text-empex-red text-xs italic">{{ $message }}</p>
				@enderror
			</div>

			<div class="w-full">
				<label class="inline-flex items-center text-gray-600">
					<input type="checkbox" class="form-checkbox text-empex-green focus:outline-none focus:ring-0"
						wire:click.prevent='currentlyWorking({{ $expIndex }})'
						wire:model.lazy='workExperiences.{{ $expIndex }}.is_working'>
					<span class="ml-2">Currently working here?</span>
				</label>
			</div>

			<div class="w-full relative">
				<input wire:model.lazy='workExperiences.{{ $expIndex }}.durationFrom'
					class="input w-full border-gray-400 text-base text-gray-500 focus:text-empex-green focus:border-empex-green focus:outline-none focus:ring-empex-green rounded"
					type="date" placeholder="Duration From*">
				<label class="tracking-wide text-gray-500 text-xs label" for="from">
					Duration From*
				</label>
				@error('workExperiences.{{ $expIndex }}.durationFrom')
				<p class="text-empex-red text-xs italic">{{ $message }}</p>
				@enderror
			</div>

			<div class="w-full relative">
				<input wire:model.lazy='workExperiences.{{ $expIndex }}.durationTo' {{
					$workExperiences[$expIndex]['is_working']==true ? 'disabled' : '' }}
					class="input w-full border-gray-400 text-base text-gray-500 focus:text-empex-green focus:border-empex-green focus:outline-none focus:ring-empex-green rounded {{ $workExperiences[$expIndex]['is_working'] == true ? 'cursor-not-allowed bg-gray-100' : '' }}"
					type="date" placeholder="Duration To">
				<label class="tracking-wide text-gray-500 text-xs label" for="to">
					Duration To
				</label>
				@error('workExperiences.{{ $expIndex }}.durationTo')
				<p class="text-empex-red text-xs italic">{{ $message }}</p>
				@enderror
			</div>

			<div class="w-full relative">
				<input wire:model.lazy='workExperiences.{{ $expIndex }}.company'
					class="input w-full border-gray-400 text-base text-gray-500 focus:text-empex-green focus:border-empex-green focus:outline-none focus:ring-empex-green rounded"
					type="text" placeholder="Department/Company*">
				<label class="tracking-wide text-gray-500 text-xs label" for="company">
					Department/Company*
				</label>
				@error('workExperiences.{{ $expIndex }}.company')
				<p class="text-empex-red text-xs italic">{{ $message }}</p>
				@enderror
			</div>

			<div class="w-full relative">
				<input wire:model.lazy='workExperiences.{{ $expIndex }}.total'
					class="input w-full border-gray-400 text-base text-gray-500 focus:text-empex-green focus:border-empex-green focus:outline-none focus:ring-empex-green rounded"
					type="number" placeholder="Total Emolument in Rs.*">
				<label class="tracking-wide text-gray-500 text-xs label" for="total">
					Total Emolument in Rs.*
				</label>
				@error('workExperiences.{{ $expIndex }}.total')
				<p class="text-empex-red text-xs italic">{{ $message }}</p>
				@enderror
			</div>

			<div class="w-full relative md:col-span-2">
				<input wire:model.lazy='workExperiences.{{ $expIndex }}.leaveReason'
					class="input w-full border-gray-400 text-base text-gray-500 focus:text-empex-green focus:border-empex-green focus:outline-none focus:ring-empex-green rounded"
					type="text" placeholder="Reason for leaving">
				<label class="tracking-wide text-gray-500 text-xs label" for="leave">
					Reason For Leaving
				</label>
				@error('workExperiences.{{ $expIndex }}.leaveReason')
				<p class="text-empex-red text-xs italic">{{ $message }}</p>
				@enderror
			</div>
		</div>
		@endforeach

		<div class="flex w-full mt-5 justify-between">
			<button type="button" class="text-empex-green uppercase font-semibold text-sm"
				wire:click.prevent='addMoreExperience'>Add More</button>

			@if (count($workExperiences) > 1)
			<button type="button" class="text-empex-red uppercase font-semibold text-sm"
				onclick="openPopover(event,'confirmRemove')">Remove</button>

			<div
				class="hidden bg-white border mr-3 z-50 font-normal leading-normal text-sm max-w-xs no-underline break-words rounded-lg w-52 shadow text-center"
				id="confirmRemove">
				<div>
					<div class="text-gray-700 opacity-75 font-semibold p-3 mb-0 rounded-t-lg">
						Delete Experience - {{ array_key_last($workExperiences) + 1 }}?
					</div>
					<div class="text-gray-700 p-3 flex justify-between">
						<button type="button" class="border bg-empex-red text-white px-5 rounded-md py-1"
							wire:click.prevent='removeExperience({{ isset([array_key_last($workExperiences)][' id']) ?
							$workExperiences[array_key_last($workExperiences)][' id'] : null }})'>Yes</button>
						<button type="button" class="border bg-white text-gray-400 px-5 rounded-md py-1"
							onclick="openPopover(event,'confirmRemove')">No</button>
					</div>
				</div>
			</div>
			@endif
		</div>
		@endif
	</form>

	<div class="pb-5 pt-10">
		<div class="flex justify-between md:justify-center">
			<div class="md:mr-2 w-1/2 md:w-full text-left md:text-right">
				<button wire:click.prevent='back'
					class="uppercase focus:outline-none py-1 border-empex-green px-5 rounded text-center text-empex-green bg-white hover:bg-gray-100 font-medium border">Back</button>
			</div>

			<div class="md:ml-2 w-1/2 md:w-full text-right md:text-left">
				<button type="submit" wire:click.prevent='saveAndNext' wire:loading.attr="disabled"
					wire:loading.class="bg-gray-400" wire:loading.class.remove="bg-empex-green hover:bg-green-500"
					class="uppercase focus:outline-none border border-transparent py-1 px-5 rounded text-center text-white bg-empex-green hover:bg-green-500 font-medium">
					<span wire:loading.remove wire:target='saveAndNext'>
						Save & next
					</span>

					<span wire:loading wire:target='saveAndNext'>
						Saving...
					</span>
				</button>
			</div>
		</div>
	</div>
</div>

<div>
    <x-loading-indicator />
	@if ($canChange)
	<div class="bg-white w-full p-5 border rounded shadow">
		<form class="w-full md:w-3/4 mx-auto">
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
								wire:click.prevent='removeExperience'>Yes</button>
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
				<div class="md:mr-2 w-1/2 md:w-full text-left md:text-right mt-1">
					<a href="{{ route('auth.employee.changerequest') }}"
						class="focus:outline-none py-1 border-empex-green uppercase px-5 rounded text-center text-empex-green bg-white font-medium border">Cancel</a>
				</div>

				<div class="md:ml-2 w-1/2 md:w-full text-right md:text-left">
					<button type="submit" wire:click.prevent='submit' wire:loading.attr="disabled"
						wire:loading.class="bg-gray-400" wire:loading.class.remove="bg-empex-green hover:bg-green-500"
						class="uppercase focus:outline-none border border-transparent py-1 px-5 rounded text-center text-white bg-empex-green hover:bg-green-500 font-medium">
						<span wire:loading.remove wire:target='submit'>
							Submit
						</span>

						<span wire:loading wire:target='submit'>
							Submit...
						</span>
					</button>
				</div>
			</div>
		</div>
	</div>
	@else
	<div class="md:bg-white w-full md:p-5 md:border md:rounded md:shadow">
		<div class="w-full py-12 text-center">
			<img src="/images/auth/submitted.svg" alt="approved" class="mx-auto">
			<div class="font-semibold mt-7 text-xl">A request is still ongoing</div>
			<div class="mb-7 text-gray-400 mt-3">Please, wait for confirmation for this request</div>
			<a href="{{ route('auth.enrollment.status') }}"
				class="uppercase border border-empex-green text-empex-green hover:bg-empex-gray py-1 px-5 rounded text-center">
				ongoing application</a>
		</div>
	</div>
	@endif
</div>

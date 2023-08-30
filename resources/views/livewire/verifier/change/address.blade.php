<div>
	<div class="md:px-6 md:py-4 border-b">
		<div class="flex justify-end">
			<button
				class="border rounded bg-white focus:ring-0 focus:ring-empex-green border-empex-green px-2 text-empex-green md:mr-5"
				wire:click.prevent='compare'>{{ $compare ? 'Comparing' : 'Compare'}}</button>
		</div>
		<div class="grid grid-cols-1 md:grid-cols-2 md:gap-4 mt-2">
			<div>
				<div class="text-gray-500">Permanent Address</div>
				<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
					<div class="text-gray-400">State</div>
					<div class="font-semibold col-span-2 text-right md:text-left">{{ $permanentAddress !== null ?
						$permanentAddress->state->name : '-' }}</div>
				</div>

				<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
					<div class="text-gray-400">District</div>
					<div class="font-semibold col-span-2 text-right md:text-left">{{ $permanentAddress !== null ?
						$permanentAddress->district->name : '-' }}</div>
				</div>

				<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
					<div class="text-gray-400">City/Village</div>
					<div class="font-semibold col-span-2 text-right md:text-left">{{ $permanentAddress !== null ?
						$permanentAddress->village : '-' }}</div>
				</div>

				<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
					<div class="text-gray-400">RD Block</div>
					<div class="font-semibold col-span-2 text-right md:text-left">{{ $permanentAddress !== null ?
						$permanentAddress->rdBlock->name : '-' }}</div>
				</div>

				<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
					<div class="text-gray-400">Police Station</div>
					<div class="font-semibold col-span-2 text-right md:text-left">{{ $permanentAddress !== null ?
						$permanentAddress->policeStation->name : '-' }}</div>
				</div>

				<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
					<div class="text-gray-400">Post Office</div>
					<div class="font-semibold col-span-2 text-right md:text-left">{{ $permanentAddress !== null ?
						$permanentAddress->postOffice->name : '-' }}</div>
				</div>

				<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
					<div class="text-gray-400">Pincode</div>
					<div class="font-semibold col-span-2 text-right md:text-left">{{ $permanentAddress !== null ?
						$permanentAddress->pin_code : '-' }}</div>
				</div>

				<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
					<div class="text-gray-400">House No</div>
					<div class="font-semibold col-span-2 text-right md:text-left">{{ $permanentAddress !== null ?
						$permanentAddress->house_no : '-' }}</div>
				</div>
			</div>

			<div>
				<div class="text-gray-500">Present Address</div>
				<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
					<div class="text-gray-400">State</div>
					<div class="font-semibold col-span-2 text-right md:text-left">{{ $presentAddress != null ?
						$presentAddress->state->name : '-' }}</div>
				</div>

				<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
					<div class="text-gray-400">District</div>
					<div class="font-semibold col-span-2 text-right md:text-left">{{ $presentAddress != null ?
						$presentAddress->district->name : '-' }}</div>
				</div>

				<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
					<div class="text-gray-400">City/Village</div>
					<div class="font-semibold col-span-2 text-right md:text-left">{{ $presentAddress != null ?
						$presentAddress->village : '-' }}</div>
				</div>

				<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
					<div class="text-gray-400">RD Block</div>
					<div class="font-semibold col-span-2 text-right md:text-left">{{ $presentAddress != null ?
						$presentAddress->rdBlock->name : '-' }}</div>
				</div>

				<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
					<div class="text-gray-400">Police Station</div>
					<div class="font-semibold col-span-2 text-right md:text-left">{{ $presentAddress != null ?
						$presentAddress->policeStation->name : '-' }}</div>
				</div>

				<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
					<div class="text-gray-400">Post Office</div>
					<div class="font-semibold col-span-2 text-right md:text-left">{{ $presentAddress != null ?
						$presentAddress->postOffice->name : '-' }}</div>
				</div>

				<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
					<div class="text-gray-400">Pincode</div>
					<div class="font-semibold col-span-2 text-right md:text-left">{{ $presentAddress != null ?
						$presentAddress->pin_code : '-' }}</div>
				</div>

				<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
					<div class="text-gray-400">House No</div>
					<div class="font-semibold col-span-2 text-right md:text-left">{{ $presentAddress != null ?
						$presentAddress->house_no : '-' }}</div>
				</div>
			</div>
		</div>
	</div>

	@if ($compare)
	<div class="md:px-6 md:py-4 border-b">
		<div class="text-black text-lg">Original</div>
		<div class="grid grid-cols-1 md:grid-cols-2 md:gap-4 mt-2">
			<div>
				<div class="text-gray-500">Permanent Address</div>
				<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
					<div class="text-gray-400">State</div>
					<div class="font-semibold col-span-2 text-right md:text-left">{{ $permanentOriginal !== null ?
						$permanentOriginal->state->name : '-' }}</div>
				</div>

				<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
					<div class="text-gray-400">District</div>
					<div class="font-semibold col-span-2 text-right md:text-left">{{ $permanentOriginal !== null ?
						$permanentOriginal->district->name : '-' }}</div>
				</div>

				<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
					<div class="text-gray-400">City/Village</div>
					<div class="font-semibold col-span-2 text-right md:text-left">{{ $permanentOriginal !== null ?
						$permanentOriginal->village : '-' }}</div>
				</div>

				<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
					<div class="text-gray-400">RD Block</div>
					<div class="font-semibold col-span-2 text-right md:text-left">{{ $permanentOriginal !== null ?
						$permanentOriginal->rdBlock->name : '-' }}</div>
				</div>

				<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
					<div class="text-gray-400">Police Station</div>
					<div class="font-semibold col-span-2 text-right md:text-left">{{ $permanentOriginal !== null ?
						$permanentOriginal->policeStation->name : '-' }}</div>
				</div>

				<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
					<div class="text-gray-400">Post Office</div>
					<div class="font-semibold col-span-2 text-right md:text-left">{{ $permanentOriginal !== null ?
						$permanentOriginal->postOffice->name : '-' }}</div>
				</div>

				<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
					<div class="text-gray-400">Pincode</div>
					<div class="font-semibold col-span-2 text-right md:text-left">{{ $permanentOriginal !== null ?
						$permanentOriginal->pin_code : '-' }}</div>
				</div>

				<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
					<div class="text-gray-400">House No</div>
					<div class="font-semibold col-span-2 text-right md:text-left">{{ $permanentOriginal !== null ?
						$permanentOriginal->house_no : '-' }}</div>
				</div>
			</div>

			<div>
				<div class="text-gray-500">Present Address</div>
				<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
					<div class="text-gray-400">State</div>
					<div class="font-semibold col-span-2 text-right md:text-left">{{ $presentOriginal != null ?
						$presentOriginal->state->name : '-' }}</div>
				</div>

				<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
					<div class="text-gray-400">District</div>
					<div class="font-semibold col-span-2 text-right md:text-left">{{ $presentOriginal != null ?
						$presentOriginal->district->name : '-' }}</div>
				</div>

				<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
					<div class="text-gray-400">City/Village</div>
					<div class="font-semibold col-span-2 text-right md:text-left">{{ $presentOriginal != null ?
						$presentOriginal->village : '-' }}</div>
				</div>

				<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
					<div class="text-gray-400">RD Block</div>
					<div class="font-semibold col-span-2 text-right md:text-left">{{ $presentOriginal != null ?
						$presentOriginal->rdBlock->name : '-' }}</div>
				</div>

				<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
					<div class="text-gray-400">Police Station</div>
					<div class="font-semibold col-span-2 text-right md:text-left">{{ $presentOriginal != null ?
						$presentOriginal->policeStation->name : '-' }}</div>
				</div>

				<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
					<div class="text-gray-400">Post Office</div>
					<div class="font-semibold col-span-2 text-right md:text-left">{{ $presentOriginal != null ?
						$presentOriginal->postOffice->name : '-' }}</div>
				</div>

				<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
					<div class="text-gray-400">Pincode</div>
					<div class="font-semibold col-span-2 text-right md:text-left">{{ $presentOriginal != null ?
						$presentOriginal->pin_code : '-' }}</div>
				</div>

				<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
					<div class="text-gray-400">House No</div>
					<div class="font-semibold col-span-2 text-right md:text-left">{{ $presentOriginal != null ?
						$presentOriginal->house_no : '-' }}</div>
				</div>
			</div>
		</div>
	</div>
	@endif

	<div class="flex">
		<div class="m-auto mt-5">
			<button wire:click.prevent='openVerifyDialog'
				class="bg-green-600 hover:bg-green-500 text-white uppercase hover:text-white py-1 px-6 rounded">
				Verify
			</button>
			<button wire:click.prevent='openRejectDialog'
				class="bg-transparent hover:bg-red-500 text-red-700 uppercase hover:text-white py-1 px-6 border border-red-500 hover:border-transparent rounded">
				Reject
			</button>
			<button wire:click.prevent='goBack'
				class="bg-transparent hover:bg-gray-500 text-gray-700 uppercase hover:text-white py-1 px-6 border border-gray-500 hover:border-transparent rounded">
				Back
			</button>
		</div>
	</div>

	<x-jet-dialog-modal wire:model="verifyDialog">
		<x-slot name="title">
			Are you sure to verify?
		</x-slot>
		<x-slot name="content"></x-slot>
		<x-slot name="footer">
			<div class="flex flex-row">
				<div class="flex flex-col w-1/2">
					<button type="submit" wire:click='verifyChange'
						class="tracking-wide font-semibold bg-indigo-500 text-gray-100 w-full py-2 rounded-lg hover:bg-indigo-700 transition-all duration-300 ease-in-out flex items-center justify-center focus:shadow-outline focus:outline-none">
						<span class="ml-3">
							Verify
						</span>
					</button>
				</div>
				<div class="flex flex-col ml-4 w-1/2">
					<button type="submit" wire:click.prevent='closeVerifyDialog'
						class="tracking-wide font-semibold bg-red-500 text-gray-100 w-full py-2 rounded-lg hover:bg-red-700 transition-all duration-300 ease-in-out flex items-center justify-center focus:shadow-outline focus:outline-none">
						<span class="ml-3">
							Cancel
						</span>
					</button>
				</div>
			</div>
		</x-slot>
	</x-jet-dialog-modal>

	<x-jet-dialog-modal wire:model="rejectDialog">
		<x-slot name="title">
			Are you sure to reject?
		</x-slot>
		<x-slot name="content">
			<textarea wire:model.lazy='rejectionNote' placeholder="Rejection Note" name="notes" id="notes" cols="30" rows="3"
				class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-green-200 placeholder-empex-red text-sm focus:outline-none focus:border-green-400 focus:bg-white mb-3"></textarea>
		</x-slot>
		<x-slot name="footer">
			<div class="flex flex-row">
				<div class="flex flex-col w-1/2">
					<button type="submit" wire:click='rejectChange'
						class="tracking-wide font-semibold bg-indigo-500 text-gray-100 w-full py-2 rounded-lg hover:bg-indigo-700 transition-all duration-300 ease-in-out flex items-center justify-center focus:shadow-outline focus:outline-none">
						<span class="ml-3">
							Reject
						</span>
					</button>
				</div>
				<div class="flex flex-col ml-4 w-1/2">
					<button type="submit" wire:click.prevent='closeRejectDialog'
						class="tracking-wide font-semibold bg-red-500 text-gray-100 w-full py-2 rounded-lg hover:bg-red-700 transition-all duration-300 ease-in-out flex items-center justify-center focus:shadow-outline focus:outline-none">
						<span class="ml-3">
							Cancel
						</span>
					</button>
				</div>
			</div>
		</x-slot>
	</x-jet-dialog-modal>
</div>
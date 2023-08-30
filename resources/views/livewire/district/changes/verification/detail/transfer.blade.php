<div class="mt-10">
	<div class="grid grid-cols-1 md:grid-cols-2 md:gap-4 mt-2">
		<div>
			<div class="text-gray-500">From</div>

			<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
				<div class="text-gray-400">State</div>
				<div class="font-semibold col-span-2 text-right md:text-left">{{ $origin !== null ? $origin->state->name
					: '-'
					}}</div>
			</div>

			<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
				<div class="text-gray-400">District</div>
				<div class="font-semibold col-span-2 text-right md:text-left">{{ $origin !== null ?
					$origin->district->name :
					'-' }}</div>
			</div>

			<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
				<div class="text-gray-400">City/Village</div>
				<div class="font-semibold col-span-2 text-right md:text-left">{{ $origin !== null ?
					$origin->village : '-'
					}}</div>
			</div>

			<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
				<div class="text-gray-400">RD Block</div>
				<div class="font-semibold col-span-2 text-right md:text-left">{{ $origin !== null ?
					$origin->rdBlock->name : '-' }}</div>
			</div>

			<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
				<div class="text-gray-400">Police Station</div>
				<div class="font-semibold col-span-2 text-right md:text-left">{{ $origin !== null ?
					$origin->policeStation->name : '-' }}</div>
			</div>

			<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
				<div class="text-gray-400">Post Office</div>
				<div class="font-semibold col-span-2 text-right md:text-left">{{ $origin !== null ?
					$origin->postOffice->name : '-' }}</div>
			</div>

			<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
				<div class="text-gray-400">Pincode</div>
				<div class="font-semibold col-span-2 text-right md:text-left">{{ $origin !== null ? $origin->pin_code :
					'-' }}
				</div>
			</div>

			<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
				<div class="text-gray-400">House No</div>
				<div class="font-semibold col-span-2 text-right md:text-left">{{ $origin !== null ? $origin->house_no :
					'-' }}
				</div>
			</div>
		</div>

		<div>
			<div class="text-gray-500">To</div>

			<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
				<div class="text-gray-400">State</div>
				<div class="font-semibold col-span-2 text-right md:text-left">{{ $transfer !== null ?
					$transfer->state->name :
					'-' }}</div>
			</div>

			<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
				<div class="text-gray-400">District</div>
				<div class="font-semibold col-span-2 text-right md:text-left">{{ $transfer !== null ?
					$transfer->district->name
					: '-' }}</div>
			</div>

			<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
				<div class="text-gray-400">City/Village</div>
				<div class="font-semibold col-span-2 text-right md:text-left">{{ $transfer !== null ?
					$transfer->village :
					'-' }}</div>
			</div>

			<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
				<div class="text-gray-400">RD Block</div>
				<div class="font-semibold col-span-2 text-right md:text-left">{{ $transfer !== null ?
					$transfer->rdBlock->name : '-' }}</div>
			</div>

			<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
				<div class="text-gray-400">Police Station</div>
				<div class="font-semibold col-span-2 text-right md:text-left">{{ $transfer !== null ?
					$transfer->policeStation->name : '-' }}</div>
			</div>

			<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
				<div class="text-gray-400">Post Office</div>
				<div class="font-semibold col-span-2 text-right md:text-left">{{ $transfer !== null ?
					$transfer->postOffice->name : '-' }}</div>
			</div>

			<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
				<div class="text-gray-400">Pincode</div>
				<div class="font-semibold col-span-2 text-right md:text-left">{{ $transfer !== null ?
					$transfer->pin_code : '-'
					}}</div>
			</div>

			<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
				<div class="text-gray-400">House No</div>
				<div class="font-semibold col-span-2 text-right md:text-left">{{ $transfer !== null ?
					$transfer->house_no : '-'
					}}</div>
			</div>
		</div>
	</div>

	<div class="flex mt-5 border-t">
		<div class="m-auto mt-5">
			<button wire:click.prevent='openVerifyDialog'
				class="bg-green-600 hover:bg-green-500 text-white uppercase hover:text-white py-1 px-6 rounded">
				Verify
			</button>
			<button wire:click.prevent='openApproveDialog'
				class="bg-green-600 hover:bg-green-500 text-white uppercase hover:text-white py-1 px-6 rounded">
				Verify & Approve
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

	<x-jet-dialog-modal wire:model="approveDialog">
		<x-slot name="title">
			Are you sure?
		</x-slot>
		<x-slot name="content">
			Approved will change the experience details
		</x-slot>
		<x-slot name="footer">
			<div class="flex flex-row">
				<div class="flex flex-col w-1/2">
					<button type="submit" wire:click='approveChange'
						class="tracking-wide font-semibold bg-indigo-500 text-gray-100 w-full py-2 rounded-lg hover:bg-indigo-700 transition-all duration-300 ease-in-out flex items-center justify-center focus:shadow-outline focus:outline-none">
						<span class="ml-3">
							Approve
						</span>
					</button>
				</div>
				<div class="flex flex-col ml-4 w-1/2">
					<button type="submit" wire:click.prevent='closeApproveDialog'
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
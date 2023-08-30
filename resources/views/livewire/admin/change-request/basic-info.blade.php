<div class="mt-10">
	{{-- change request --}}
	<div class="flex justify-between">
		<div class="text-black text-lg">Change Request</div>
		<button
			class="border rounded bg-white focus:ring-0 focus:ring-empex-green border-empex-green px-2 text-empex-green md:mr-5"
			wire:click.prevent='compare'>{{ $compare ? 'Comparing' : 'Compare'}}</button>
	</div>
	<div>
		<img src="{{ asset('/storage/'.$changeInfo->avatar) }}" alt="user image"
			class="rounded-full align-middle border-none mt-3 w-32 h-32 mx-auto md:mx-0 mb-5 md:mb-0" />
	</div>
	<div class="grid grid-cols-1 md:grid-cols-2 md:gap-4 gap-1 mt-2">
		<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
			<div class="text-gray-400">Full Name</div>
			<div class="font-semibold col-span-2 text-right md:text-left">{{ $changeInfo->full_name }}</div>
		</div>

		<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
			<div class="text-gray-400">Date of Birth</div>
			<div class="font-semibold col-span-2 text-right md:text-left">{{ date('d M Y', strtotime($changeInfo->dob))
				}}</div>
		</div>

		<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
			<div class="text-gray-400">Gender</div>
			<div class="font-semibold col-span-2 text-right md:text-left">{{ $changeInfo->gender }}</div>
		</div>

		<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
			<div class="text-gray-400">Phone</div>
			<div class="font-semibold col-span-2 text-right md:text-left">{{ $changeInfo->phone_no }}</div>
		</div>

		<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
			<div class="text-gray-400">Email</div>
			<div class="font-semibold col-span-2 text-right md:text-left">{{ $changeInfo->email }}</div>
		</div>

		<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
			<div class="text-gray-400">Father/Mother</div>
			<div class="font-semibold col-span-2 text-right md:text-left">{{ $changeInfo->parents_name }}</div>
		</div>

		<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
			<div class="text-gray-400">Marital Status</div>
			<div class="font-semibold col-span-2 text-right md:text-left">{{ $changeInfo->marital_status }}</div>
		</div>

		<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
			<div class="text-gray-400">Religion</div>
			<div class="font-semibold col-span-2 text-right md:text-left">{{ $changeInfo->religion->name }}</div>
		</div>

		<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
			<div class="text-gray-400">Caste</div>
			<div class="font-semibold col-span-2 text-right md:text-left">{{ $changeInfo->caste }}</div>
		</div>

		<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
			<div class="text-gray-400">Aadhaar</div>
			<div class="font-semibold col-span-2 text-right md:text-left">{{ $changeInfo->aadhar_no ?? '-' }}</div>
		</div>

		<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
			<div class="text-gray-400">Language Spoken</div>
			<div class="font-semibold col-span-2 text-right md:text-left">
				@foreach ($changeSpokenLanguage as $cspo)
				{{ $cspo->language->name }} @if(!$loop->last), @endif
				@endforeach
			</div>
		</div>

		<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
			<div class="text-gray-400">Language Read</div>
			<div class="font-semibold col-span-2 text-right md:text-left">
				@foreach ($changeReadLanguage as $cread)
				{{ $cread->language->name }} @if(!$loop->last), @endif
				@endforeach
			</div>
		</div>

		<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
			<div class="text-gray-400">Language Write</div>
			<div class="font-semibold col-span-2 text-right md:text-left">
				@foreach ($changeWriteLanguage as $cwrite)
				{{ $cwrite->language->name }} @if(!$loop->last), @endif
				@endforeach
			</div>
		</div>

		<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
			<div class="text-gray-500">Physical Challenge</div>
			<div class="font-semibold col-span-2 text-right md:text-left">
				@forelse ($changePhysicallyChallenge as $cphy)
				{{ $cphy->physicalChallenge->name }} @if(!$loop->last), @endif
				@empty
				No
				@endforelse
			</div>
		</div>
	</div>

	{{-- original --}}
	@if ($compare)
	<div class="text-black text-lg mt-5 border-t">Original</div>
	<div>
		<img src="{{ asset('/storage/'.$original->avatar) }}" alt="user image"
			class="rounded-full align-middle border-none mt-3 w-32 h-32 mx-auto md:mx-0 mb-5 md:mb-0" />
	</div>
	<div class="grid grid-cols-1 md:grid-cols-2 md:gap-4 gap-1 pt-5">
		<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
			<div class="text-gray-400">Full Name</div>
			<div class="font-semibold col-span-2 text-right md:text-left">{{ $original->full_name }}</div>
		</div>

		<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
			<div class="text-gray-400">Date of Birth</div>
			<div class="font-semibold col-span-2 text-right md:text-left">{{ date('d M Y', strtotime($original->dob))
				}}</div>
		</div>

		<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
			<div class="text-gray-400">Gender</div>
			<div class="font-semibold col-span-2 text-right md:text-left">{{ $original->gender }}</div>
		</div>

		<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
			<div class="text-gray-400">Phone</div>
			<div class="font-semibold col-span-2 text-right md:text-left">{{ $original->phone_no }}</div>
		</div>

		<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
			<div class="text-gray-400">Email</div>
			<div class="font-semibold col-span-2 text-right md:text-left">{{ $original->email }}</div>
		</div>

		<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
			<div class="text-gray-400">Father/Mother</div>
			<div class="font-semibold col-span-2 text-right md:text-left">{{ $original->parents_name }}</div>
		</div>

		<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
			<div class="text-gray-400">Marital Status</div>
			<div class="font-semibold col-span-2 text-right md:text-left">{{ $original->marital_status }}</div>
		</div>

		<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
			<div class="text-gray-400">Religion</div>
			<div class="font-semibold col-span-2 text-right md:text-left">{{ $original->religion->name }}</div>
		</div>

		<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
			<div class="text-gray-400">Caste</div>
			<div class="font-semibold col-span-2 text-right md:text-left">{{ $original->caste }}</div>
		</div>

		<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
			<div class="text-gray-400">Aadhaar</div>
			<div class="font-semibold col-span-2 text-right md:text-left">{{ $original->aadhar_no ?? '-' }}</div>
		</div>

		<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
			<div class="text-gray-400">Language Spoken</div>
			<div class="font-semibold col-span-2 text-right md:text-left">
				@foreach ($oriSpokenLanguage as $ospo)
				{{ $ospo->language->name }} @if(!$loop->last), @endif
				@endforeach
			</div>
		</div>

		<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
			<div class="text-gray-400">Language Read</div>
			<div class="font-semibold col-span-2 text-right md:text-left">
				@foreach ($oriReadLanguage as $oread)
				{{ $oread->language->name }} @if(!$loop->last), @endif
				@endforeach
			</div>
		</div>

		<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
			<div class="text-gray-400">Language Write</div>
			<div class="font-semibold col-span-2 text-right md:text-left">
				@foreach ($oriWriteLanguage as $owrite)
				{{ $owrite->language->name }} @if(!$loop->last), @endif
				@endforeach
			</div>
		</div>

		<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
			<div class="text-gray-500">Physical Challenge</div>
			<div class="font-semibold col-span-2 text-right md:text-left">
				@forelse ($oriPhysicallyChallenge as $ophy)
				{{ $ophy->physicalChallenge->name }} @if(!$loop->last), @endif
				@empty
				No
				@endforelse
			</div>
		</div>
	</div>
	@endif

	<div class="flex mt-5 border-t">
		<div class="m-auto mt-5">
			<button wire:click.prevent='openApproveDialog'
				class="bg-green-600 hover:bg-green-500 text-white font-semibold hover:text-white py-2 px-4 rounded">
				Approve
			</button>
			<button wire:click.prevent='openRejectDialog'
				class="bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded">
				Reject
			</button>
			<button wire:click.prevent='goBack'
				class="bg-transparent hover:bg-gray-500 text-gray-700 font-semibold hover:text-white py-2 px-4 border border-gray-500 hover:border-transparent rounded">
				Back
			</button>
		</div>
	</div>

	<x-jet-dialog-modal wire:model="approveDialog">
		<x-slot name="title">
			Are you sure?
		</x-slot>
		<x-slot name="content">
			Approved will change the basic info
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
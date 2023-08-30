<div>
	<div class="md:px-6 md:py-4 border-b">
		<div class="text-gray-500 mb-3">The icon &#9432; indicates that the Subject/Stream or Major/Core is custom</div>
		<div class="flex justify-between">
			<div class="text-black text-lg">Change Request</div>
			<button
				class="border rounded bg-white focus:ring-0 focus:ring-empex-green border-empex-green px-2 text-empex-green md:mr-5"
				wire:click.prevent='compare'>{{ $compare ? 'Comparing' : 'Compare'}}</button>
		</div>
		<div class="flex flex-col mt-5">
			<div class="overflow-x-auto">
				<div class="align-middle inline-block min-w-full">
					<div class="overflow-hidden">
						<table class="min-w-full">
							<thead>
								<tr>
									<th scope="col" class="px-1 py-1 text-left text-sm text-gray-400 font-normal">Qualification</th>
									<th scope="col" class="px-1 py-1 text-left text-sm text-gray-400 font-normal">Subject /Stream</th>
									<th scope="col" class="px-1 py-1 text-left text-sm text-gray-400 font-normal">Major /Core</th>
									<th scope="col" class="px-1 py-1 text-left text-sm text-gray-400 font-normal">School /University</th>
									<th scope="col" class="px-1 py-1 text-left text-sm text-gray-400 font-normal">Division /Rank</th>
									<th scope="col" class="px-1 py-1 text-left text-sm text-gray-400 font-normal">Year</th>
									<th scope="col" class="px-1 py-1 text-left text-sm text-gray-400 font-normal">Duration</th>
									<th scope="col" class="px-1 py-1 text-left text-sm text-gray-400 font-normal">Certificate</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($changeEducations as $edu)
								<tr>
									<td class="px-1 py-1 whitespace-nowrap">{{ $edu->qualification->name }}</td>
									<td class="px-1 py-1 whitespace-nowrap">{{ $edu->subject !== null ? $edu->subject->name :
										($edu->custom_subject ?? '-') }} @if ($edu->custom_subject) &#9432; @endif</td>
									<td class="px-1 py-1 whitespace-nowrap">{{ $edu->majorCore !== null ? $edu->majorCore->name :
										($edu->custom_major_core ?? '-') }} @if ($edu->custom_major_core) &#9432; @endif</td>
									<td class="px-1 py-1 whitespace-nowrap">{{ $edu->school }}</td>
									<td class="px-1 py-1 whitespace-nowrap">{{ $edu->division }}</td>
									<td class="px-1 py-1 whitespace-nowrap">{{ $edu->year_of_passing }}</td>
									<td class="px-1 py-1 whitespace-nowrap">{{ $edu->course_duration }}</td>
									<td class="px-1 py-1 whitespace-nowrap">
										<a target="_blank" class="text-empex-green"
											href="{{ asset('storage/'.$edu->certificate) }}">View</a>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

	@if ($compare)
	<div class="md:px-6 md:py-4 border-b">
		<div class="text-black text-lg">Original</div>
		<div class="flex flex-col mt-5">
			<div class="overflow-x-auto">
				<div class="align-middle inline-block min-w-full">
					<div class="overflow-hidden">
						<table class="min-w-full">
							<thead>
								<tr>
									<th scope="col" class="px-1 py-1 text-left text-sm text-gray-400 font-normal">Qualification</th>
									<th scope="col" class="px-1 py-1 text-left text-sm text-gray-400 font-normal">Subject /Stream</th>
									<th scope="col" class="px-1 py-1 text-left text-sm text-gray-400 font-normal">Major /Core</th>
									<th scope="col" class="px-1 py-1 text-left text-sm text-gray-400 font-normal">School /University</th>
									<th scope="col" class="px-1 py-1 text-left text-sm text-gray-400 font-normal">Division /Rank</th>
									<th scope="col" class="px-1 py-1 text-left text-sm text-gray-400 font-normal">Year</th>
									<th scope="col" class="px-1 py-1 text-left text-sm text-gray-400 font-normal">Duration</th>
									<th scope="col" class="px-1 py-1 text-left text-sm text-gray-400 font-normal">Certificate</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($original as $ori)
								<tr>
									<td class="px-1 py-1 whitespace-nowrap">{{ $ori->qualification->name }}</td>
									<td class="px-1 py-1 whitespace-nowrap">{{ $ori->subject !== null ? $ori->subject->name :
										($ori->custom_subject ?? '-') }} @if ($ori->custom_subject) &#9432; @endif</td>
									<td class="px-1 py-1 whitespace-nowrap">{{ $ori->majorCore !== null ? $ori->majorCore->name :
										($ori->custom_major_core ?? '-') }} @if ($ori->custom_major_core) &#9432; @endif</td>
									<td class="px-1 py-1 whitespace-nowrap">{{ $ori->school }}</td>
									<td class="px-1 py-1 whitespace-nowrap">{{ $ori->division }}</td>
									<td class="px-1 py-1 whitespace-nowrap">{{ $ori->year_of_passing }}</td>
									<td class="px-1 py-1 whitespace-nowrap">{{ $ori->course_duration }}</td>
									<td class="px-1 py-1 whitespace-nowrap">
										<a target="_blank" class="text-empex-green"
											href="{{ asset('storage/'.$ori->certificate) }}">View</a>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endif

	<div class="flex">
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
			<div class="text-xl">Are you sure?</div>
		</x-slot>
		<x-slot name="content">
			Approved will change the educational details.
			<div class="text-gray-500 my-1">The icon &#9432; indicates that the Subject/Stream or Major/Core is custom</div>
			By approving this will add custom data to the Subject/Stream and/or Major/Core tables and will be available for
			others.
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
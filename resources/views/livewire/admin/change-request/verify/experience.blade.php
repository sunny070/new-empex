<div>
	<div class="md:px-6 md:py-4 border-b">
		<div class="flex justify-between">
			<div class="text-black text-lg">Change Request</div>
			<button class="border rounded bg-white focus:ring-0 focus:ring-empex-green border-empex-green px-2 text-empex-green md:mr-5" wire:click.prevent='compare'>{{ $compare ? 'Comparing' : 'Compare'}}</button>
		</div>
		<div class="flex flex-col mt-5">
			<div class="overflow-x-auto">
				<div class="align-middle inline-block min-w-full">
					<div class="overflow-hidden">
						<table class="min-w-full">
							<thead>
								<tr>
									<th class="px-1 py-1 text-left text-sm font-normal text-gray-400">Designation</th>
									<th class="px-1 py-1 text-left text-sm font-normal text-gray-400">From</th>
									<th class="px-1 py-1 text-left text-sm font-normal text-gray-400">To</th>
									<th class="px-1 py-1 text-left text-sm font-normal text-gray-400">Department /Company</th>
									<th class="px-1 py-1 text-left text-sm font-normal text-gray-400">Salary</th>
									<th class="px-1 py-1 text-left text-sm font-normal text-gray-400">Reason for leaving</th>
								</tr>
							</thead>
							<tbody>
								@forelse ($changeExperiences as $exp)
									<tr>
										<td class="px-1 py-1 whitespace-nowrap">{{ $exp->designation }}</td>
										<td class="px-1 py-1 whitespace-nowrap">{{ date('d M Y', strtotime($exp->from)) }}</td>
										<td class="px-1 py-1 whitespace-nowrap">
											@if ($exp->is_working == 1)
											Present
											@else
											{{ date('d M Y', strtotime($exp->to)) }}
											@endif
										</td>
										<td class="px-1 py-1 whitespace-nowrap">{{ $exp->company }}</td>
										<td class="px-1 py-1 whitespace-nowrap">{{ $exp->total_emoluments }}</td>
										<td class="px-1 py-1 whitespace-nowrap">{{ $exp->leave_reason }}</td>
									</tr>
								@empty
									<tr>
										<td colspan="6">No experiences found</td>
									</tr>
								@endforelse
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
										<th class="px-1 py-1 text-left text-sm font-normal text-gray-400">Designation</th>
										<th class="px-1 py-1 text-left text-sm font-normal text-gray-400">From</th>
										<th class="px-1 py-1 text-left text-sm font-normal text-gray-400">To</th>
										<th class="px-1 py-1 text-left text-sm font-normal text-gray-400">Department /Company</th>
										<th class="px-1 py-1 text-left text-sm font-normal text-gray-400">Salary</th>
										<th class="px-1 py-1 text-left text-sm font-normal text-gray-400">Reason for leaving</th>
									</tr>
								</thead>
								<tbody>
									@forelse ($original as $ori)
										<tr>
											<td class="px-1 py-1 whitespace-nowrap">{{ $ori->designation }}</td>
											<td class="px-1 py-1 whitespace-nowrap">{{ date('d M Y', strtotime($ori->from)) }}</td>
											<td class="px-1 py-1 whitespace-nowrap">
												@if ($ori->is_working == 1)
												Present
												@else
												{{ date('d M Y', strtotime($ori->to)) }}
												@endif
											</td>
											<td class="px-1 py-1 whitespace-nowrap">{{ $ori->company }}</td>
											<td class="px-1 py-1 whitespace-nowrap">{{ $ori->total_emoluments }}</td>
											<td class="px-1 py-1 whitespace-nowrap">{{ $ori->leave_reason }}</td>
										</tr>
									@empty
										<tr>
											<td colspan="6">No experiences found</td>
										</tr>
									@endforelse
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
      <button wire:click.prevent='openVerifyDialog' class="bg-green-600 hover:bg-green-500 text-white font-semibold hover:text-white py-2 px-4 rounded">
        Verify
      </button>
      <button wire:click.prevent='openRejectDialog' class="bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded">
        Reject
      </button>
      <button wire:click.prevent='goBack' class="bg-transparent hover:bg-gray-500 text-gray-700 font-semibold hover:text-white py-2 px-4 border border-gray-500 hover:border-transparent rounded">
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
					<button
						type="submit"
						wire:click='verifyChange'
						class="tracking-wide font-semibold bg-indigo-500 text-gray-100 w-full py-2 rounded-lg hover:bg-indigo-700 transition-all duration-300 ease-in-out flex items-center justify-center focus:shadow-outline focus:outline-none"
					>
						<span class="ml-3">
							Verify
						</span>
					</button>
				</div>
				<div class="flex flex-col ml-4 w-1/2">
					<button
						type="submit"
						wire:click.prevent='closeVerifyDialog'
						class="tracking-wide font-semibold bg-red-500 text-gray-100 w-full py-2 rounded-lg hover:bg-red-700 transition-all duration-300 ease-in-out flex items-center justify-center focus:shadow-outline focus:outline-none"
					>
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
			<textarea wire:model.lazy='rejectionNote' placeholder="Rejection Note" name="notes" id="notes" cols="30" rows="3" class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-green-200 placeholder-empex-red text-sm focus:outline-none focus:border-green-400 focus:bg-white mb-3"></textarea>
		</x-slot>
		<x-slot name="footer">
			<div class="flex flex-row">
				<div class="flex flex-col w-1/2">
					<button
						type="submit"
						wire:click='rejectChange'
						class="tracking-wide font-semibold bg-indigo-500 text-gray-100 w-full py-2 rounded-lg hover:bg-indigo-700 transition-all duration-300 ease-in-out flex items-center justify-center focus:shadow-outline focus:outline-none"
					>
						<span class="ml-3">
							Reject
						</span>
					</button>
				</div>
				<div class="flex flex-col ml-4 w-1/2">
					<button
						type="submit"
						wire:click.prevent='closeRejectDialog'
						class="tracking-wide font-semibold bg-red-500 text-gray-100 w-full py-2 rounded-lg hover:bg-red-700 transition-all duration-300 ease-in-out flex items-center justify-center focus:shadow-outline focus:outline-none"
					>
						<span class="ml-3">
							Cancel
						</span>
					</button>
				</div>
			</div>
		</x-slot>
	</x-jet-dialog-modal>
</div>

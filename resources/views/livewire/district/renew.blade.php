<div class="flex flex-col w-full">
	<div class="grid grid-cols-1 md:grid-cols-4 my-3 gap-1">
		<input wire:model='name'
			class="w-full rounded input border-gray-400 text-base text-gray-600 focus:text-empex-green focus:border-green-600 focus:outline-none focus:ring-green-600"
			type="text" placeholder="Search by name" />
		<div></div>
		<div></div>
		<select wire:model.lazy='district' style="margin-left: auto"
			class="w-full md:w-1/2 p-2 rounded input border-gray-400 text-base text-gray-600 focus:text-empex-green focus:border-green-600 focus:outline-none focus:ring-green-600">
			<option value>All District</option>
			@foreach ($districts as $dist)
			<option value="{{ $dist->id }}">{{ $dist->name }}</option>
			@endforeach
		</select>
	</div>

	<div class="flex flex-col w-full">
		<div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
			<div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
				<div class="shadow overflow-hidden border-b">
					<table class="min-w-full divide-y divide-gray-200">
						<thead>
							<tr>
								<th scope="col" class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wide">
									Name
								</th>
								<th scope="col" class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wide">
									Active From
								</th>
								<th scope="col" class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wide">
									Active Till
								</th>
								<th scope="col" class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wide">
									Status
								</th>
								<th scope="col" class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wide">
									District
								</th>
								<th scope="col" class="px-6 py-3 text-right font-medium uppercase tracking-wide">
									Action
								</th>
							</tr>
						</thead>
						<tbody class="bg-white divide-y divide-gray-200">
							@forelse($renews as $renew)
							<tr class="hover:bg-gray-50">
								<td class="px-6 py-4 whitespace-nowrap text-sm">
									{{ $renew->name }}
								</td>
								<td class="px-6 py-4 whitespace-nowrap text-sm">
									{{ $renew->active_from }}
								</td>
								<td class="px-6 py-4 whitespace-nowrap text-sm">
									{{ $renew->active_till }}
								</td>
								<td class="px-6 py-4 whitespace-nowrap text-sm">
									{{ $renew->status }}
								</td>
								<td class="px-6 py-4 whitespace-nowrap text-sm">
									{{ $renew->district->name }}
								</td>
								<td class="px-6 py-4 whitespace-nowrap text-sm text-right font-medium">
									<button wire:click="openApproveDialog({{ $renew->id }}, {{ $renew->user->id }})"
										class="text-indigo-600 dark:text-indigo-500 hover:text-indigo-900 dark:hover:text-indigo-700">Approve</button>
								</td>
							</tr>
							@empty
							<tr>
								<td class="px-6 py-4 whitespace-nowrap text-sm" colspan="6">Renew application not found
								</td>
							</tr>
							@endforelse
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<div class="py-2">
			{{ $renews->onEachSide(1)->links() }}
		</div>
	</div>

	<x-jet-dialog-modal wire:model="approveDialog">
		<x-slot name="title">
			Are you sure?
		</x-slot>
		<x-slot name="content">
			<div>Approve will change the following details</div>
			<div class="flex justify-between">
				<div>
					<span class="font-bold">Prev. Active From:</span>
					<span>{{ date('d M, Y', strtotime($preActiveFrom)) }}</span>
				</div>
				<div>
					<span class="font-bold">New Active From:</span>
					<span>{{ date('d M, Y', strtotime($newActiveFrom)) }}</span>
				</div>
			</div>

			<div class="flex justify-between">
				<div>
					<span class="font-bold">Prev. Active Till:</span>
					<span>{{ date('d M, Y', strtotime($preActiveTill)) }}</span>
				</div>
				<div>
					<span class="font-bold">New Active Till:</span>
					<span>{{ date('d M, Y', strtotime($newActiveTill)) }}</span>
				</div>
			</div>

			@if ($remainingDate > 0)
			<div>
				<span class="font-bold">Remaining Date:</span>
				<span>{{ $remainingDate }} days</span>
			</div>
			<span class="text-gray-500 text-sm">The remaining date is added to New active till dates</span>
			@endif
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
</div>
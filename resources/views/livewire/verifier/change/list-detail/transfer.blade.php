<div>
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
									Full Name
								</th>
								<th scope="col" class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wide">
									Submitted On
								</th>
								<th scope="col" class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wide">
									District
								</th>
								<th scope="col" class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wide">
									Status
								</th>
								<th scope="col" class="px-6 py-3 text-right font-medium uppercase tracking-wide">
									Action
								</th>
							</tr>
						</thead>
						<tbody class="bg-white divide-y divide-gray-200">
							@php
							$lastUserId = null;
							@endphp
							@forelse($transfers as $transfer)
							@if ($lastUserId != $transfer->user_id)
							@php
							$lastUserId = $transfer->user_id;
							@endphp
							<tr class="hover:bg-gray-50">
								<td class="px-6 py-4 whitespace-nowrap text-sm">
									{{ $transfer->user->basicInfo->full_name }}
								</td>
								<td class="px-6 py-4 whitespace-nowrap text-sm">
									{{ $transfer->created_at }}
								</td>
								<td class="px-6 py-4 whitespace-nowrap text-sm">
									{{ $transfer->user_district->name }}
								</td>
								<td class="px-6 py-4 whitespace-nowrap text-sm">
									{{ $transfer->status }}
								</td>
								<td class="px-6 py-4 whitespace-nowrap text-sm text-right font-medium">
									<a href="{{ route('verifier.change.detail', ['transfer', $transfer->id]) }}"
										class="text-indigo-600 dark:text-indigo-500 hover:text-indigo-900 dark:hover:text-indigo-700">Detail</a>
								</td>
							</tr>
							@endif
							@empty
							<tr>
								<td class="px-6 py-4 whitespace-nowrap" colspan="8">Change request not found</td>
							</tr>
							@endforelse
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
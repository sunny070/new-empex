<div class="mt-5">
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
								<th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wide">
									Image
								</th>
								<th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wide">
									Name
								</th>
								<th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wide">
									District
								</th>
								<th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wide">
									Submitted On
								</th>
								<th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wide">
									Status
								</th>
								<th scope="col" class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wide">
									Action
								</th>
							</tr>
						</thead>
						<tbody class="bg-white divide-y divide-gray-200">
							@forelse($basicInfos as $basicInfo)
							<tr class="hover:bg-gray-50">
								<td class="px-6 py-4 whitespace-nowrap">
									<img src="{{ asset('/storage/'.$basicInfo->avatar) }}" alt="avatar" class="h-8 w-8 rounded-full">
								</td>
								<td class="px-6 py-4 whitespace-nowrap">
									{{ $basicInfo->full_name }}
								</td>
								<td class="px-6 py-4 whitespace-nowrap">
									{{ $basicInfo->district->name }}
								</td>
								<td class="px-6 py-4 whitespace-nowrap">
									{{ date('d-m-Y', strtotime($basicInfo->created_at)) }}
								</td>
								<td class="px-6 py-4 whitespace-nowrap">
									{{ $basicInfo->status }}
								</td>
								<td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
									<a href="{{ route('verifier.application', $basicInfo->id) }}"
										class="text-indigo-600 dark:text-indigo-500 hover:text-indigo-900 dark:hover:text-indigo-700">View</a>
								</td>
							</tr>
							@empty
							<tr>
								<td class="px-6 py-4 whitespace-nowrap" colspan="6">Employment not found for verification</td>
							</tr>
							@endforelse
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
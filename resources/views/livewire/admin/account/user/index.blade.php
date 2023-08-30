<div class="mt-5">
	<div class="grid grid-cols-1 md:grid-cols-4 my-3 gap-1">
		<input wire:model='name'
			class="w-full rounded input border-gray-400 text-base text-gray-600 focus:text-empex-green focus:border-green-600 focus:outline-none focus:ring-green-600"
			type="text" placeholder="Search by name or emp. no" />
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
									Photo
								</th>
								<th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wide">
									Name
								</th>
								<th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wide">
									Emp. No
								</th>
								<th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wide">
									Validity
								</th>
								<th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wide">
									District
								</th>
								<th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wide">
									Is Placed
								</th>
								<th scope="col" class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wide">
									Action
								</th>
							</tr>
						</thead>
						<tbody class="bg-white divide-y divide-gray-200">
							@forelse($users as $emp)
							<tr class="hover:bg-gray-50">
								<td class="px-6 py-4 whitespace-nowrap">
									<img src="{{ asset('/storage/'.$emp->avatar) }}" alt="avatar" class="h-8 w-8 rounded-full">
								</td>
								<td class="px-6 py-4 whitespace-nowrap">
									{{ $emp->full_name }}
								</td>
								<td class="px-6 py-4 whitespace-nowrap">
									{{ $emp->employment_no }}
								</td>
								<td class="px-6 py-4 whitespace-nowrap">
									{{ date('d M Y', strtotime($emp->card_valid_from)) }} - {{ date('d M Y',
									strtotime($emp->card_valid_till)) }}
								</td>
								<td class="px-6 py-4 whitespace-nowrap">
									{{ $emp->district->name }}
								</td>
								<td class="px-6 py-4 whitespace-nowrap">
									<input class="w-5 h-5 rounded-full text-empex-green focus:outline-none cursor-pointer focus:ring-0"
										type="checkbox" id="place{{ $emp->id }}" wire:click='changeIsPlaced({{ $emp->id }})' {{
										$emp->is_placed == 1 ? 'checked' : '' }}>
									<label class="form-check-label inline-block ml-1 cursor-pointer" for="place{{ $emp->id }}">
										{{ $emp->is_placed == 1 ? 'Yes' : 'No' }}
									</label>
								</td>
								<td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
									<a href="{{ route('admin.user.detail', $emp->id) }}"
										class="text-indigo-600 dark:text-indigo-500 hover:text-indigo-900 dark:hover:text-indigo-700">Detail</a>
								</td>
							</tr>
							@empty
							<tr>
								<td class="px-6 py-4 whitespace-nowrap" colspan="7">Employment not found</td>
							</tr>
							@endforelse
						</tbody>
					</table>
				</div>
				<div class="mt-5">
					{{ $users->onEachSide(1)->links() }}
				</div>
			</div>
		</div>
	</div>
</div>
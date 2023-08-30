<div class="mt-5">
	<div class="text-lg">
		Archived User
	</div>
	<div class="grid grid-cols-1 md:grid-cols-4 my-3 gap-1">
		<input wire:model='name'
			class="w-full rounded input border-gray-400 text-base text-gray-600 focus:text-empex-green focus:border-green-600 focus:outline-none focus:ring-green-600"
			type="text" placeholder="Search by name or emp. no" />
		<div></div>
		<div></div>
		<select wire:model.lazy='year' style="margin-left: auto"
			class="w-full md:w-1/2 p-2 rounded input border-gray-400 text-base text-gray-600 focus:text-empex-green focus:border-green-600 focus:outline-none focus:ring-green-600">
			<option value>All Year</option>
			@foreach ($years as $y)
			<option value="{{ $y }}">{{ $y }}</option>
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
									DOB
								</th>
								<th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wide">
									Phone
								</th>
								<th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wide">
									Gender
								</th>
								<th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wide">
									Parent's Name
								</th>
								<th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wide">
									Expired At
								</th>
							</tr>
						</thead>
						<tbody class="bg-white divide-y divide-gray-200">
							@forelse($archivedUser as $arch)
							<tr class="hover:bg-gray-50">
								<td class="px-6 py-4 whitespace-nowrap">
									<img src="{{ asset('/storage/'.$arch->avatar) }}" alt="avatar" class="h-8 w-8 rounded-full">
								</td>
								<td class="px-6 py-4 whitespace-nowrap">
									{{ $arch->name }}
								</td>
								<td class="px-6 py-4 whitespace-nowrap">
									{{ $arch->employment_no }}
								</td>
								<td class="px-6 py-4 whitespace-nowrap">
									{{ date('d M Y', strtotime($arch->dob)) }}
								</td>
								<td class="px-6 py-4 whitespace-nowrap">
									{{ $arch->phone_no }}
								</td>
								<td class="px-6 py-4 whitespace-nowrap">
									{{ $arch->gender }}
								</td>
								<td class="px-6 py-4 whitespace-nowrap">
									{{ $arch->parents_name }}
								</td>
								<td class="px-6 py-4 whitespace-nowrap">
									{{ date('d M Y', strtotime($arch->card_valid_till)) }}
								</td>
							</tr>
							@empty
							<tr>
								<td class="px-6 py-4 whitespace-nowrap" colspan="7">Archive user not found</td>
							</tr>
							@endforelse
						</tbody>
					</table>
				</div>
				<div class="mt-5">
					{{ $archivedUser->onEachSide(1)->links() }}
				</div>
			</div>
		</div>
	</div>
</div>
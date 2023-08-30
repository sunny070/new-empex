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
								<th scope="col" class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wide">
									Photo
								</th>
								<th scope="col" class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wide">
									Name
								</th>
								<th scope="col" class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wide">
									District
								</th>
								<th scope="col" class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wide">
									Submitted on
								</th>
								<th scope="col" class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wide">
									Status
								</th>
								<th scope="col" class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wide">
									Note
								</th>
								<th scope="col" class="px-6 py-3 text-right font-medium uppercase tracking-wide">
									<!-- @if (count($basicInfos) > 0)
									<button wire:click="openApproveAllDialog" class="bg-empex-green text-white px-1 rounded mr-2">Approve
										All</button>
									@endif -->
									Action
								</th>
							</tr>
						</thead>
						<tbody class="bg-white divide-y divide-gray-200">
							@forelse($basicInfos as $info)
							<tr class="hover:bg-gray-50">
								<td class="px-6 py-4 whitespace-nowrap text-sm">
									<img src="{{ asset('/storage/'.$info->avatar) }}" alt="avatar" class="h-8 w-8 rounded-full">
								</td>
								<td class="px-6 py-4 whitespace-nowrap text-sm">
									{{ $info->full_name }}
								</td>
								<td class="px-6 py-4 whitespace-nowrap text-sm">
									{{ $info->district->name }}
								</td>
								<td class="px-6 py-4 whitespace-nowrap text-sm">
									{{ date('d-m-Y', strtotime($info->created_at)) }}
								</td>
								<td class="px-6 py-4 whitespace-nowrap text-sm">
									{{ $info->status }}
								</td>
								<td class="px-6 py-4 whitespace-nowrap text-sm">
									{{ $info->notes }}
								</td>
								<td class="px-6 py-4 whitespace-nowrap text-sm text-right font-medium">
									<form action="{{ route('verifier.verify', [$info->id, 'Approved', 'district-admin']) }}" method="post"
										class="inline mr-2">
										@csrf
										<button type="submit" class="bg-empex-green text-white p-1 rounded">Approve</button>
									</form>
									<a href="{{ route('district-admin.verify-application', $info->id) }}"
										class="text-indigo-600 dark:text-indigo-500 hover:text-indigo-900 dark:hover:text-indigo-700">Detail</a>
								</td>
							</tr>
							@empty
							<tr>
								<td class="px-6 py-4 whitespace-nowrap" colspan="7">Application not found</td>
							</tr>
							@endforelse
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="py-2">
			{{ $basicInfos->onEachSide(1)->links() }}
		</div>
	</div>

	<x-jet-confirmation-modal wire:model="approveAllDialog">
		<x-slot name="title">
			Approve Application
		</x-slot>
		<x-slot name="content">
			Are you sure you want to approve all verified applications?
		</x-slot>
		<x-slot name="footer">
			<x-jet-secondary-button wire:click="closeApproveAllDialog" wire:loading.attr="disabled">
				{{ __('Cancel') }}
			</x-jet-secondary-button>

			<x-jet-button class="ml-2" wire:click="approveAll" wire:loading.attr="disabled">
				{{ __('Approved') }}
			</x-jet-button>
		</x-slot>
	</x-jet-confirmation-modal>
</div>

<div>
	<div class="w-full flex justify-between">
		<div class="font-semibold">
			Official Accounts
		</div>
		<button wire:click="$emit('openModal', 'district.account.create')"
			class="bg-empex-green text-white rounded px-4 py-1 hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-300">
			Add
		</button>
	</div>

	<div class="mt-5">
		<div class="grid grid-cols-1 md:grid-cols-4 my-3 gap-1">
			<input wire:model='name'
				class="w-full rounded input border-gray-400 text-base text-gray-600 focus:text-empex-green focus:border-green-600 focus:outline-none focus:ring-green-600"
				type="text" placeholder="Search by name" />
			<div></div>
			<div></div>
			<select wire:model.lazy='role' style="margin-left: auto"
				class="w-full md:w-1/2 p-2 rounded input border-gray-400 text-base text-gray-600 focus:text-empex-green focus:border-green-600 focus:outline-none focus:ring-green-600">
				<option value>All Role</option>
				@foreach ($roles as $rol)
				<option value="{{ $rol->id }}">{{ $rol->name }}</option>
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
										Email
									</th>
									<th scope="col" class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wide">
										Role
									</th>
									<th scope="col" class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wide">
										Districts
									</th>
									<th scope="col" class="px-6 py-3 text-right font-medium uppercase tracking-wide">
										Action
									</th>
								</tr>
							</thead>
							<tbody class="bg-white divide-y divide-gray-200">
								@forelse($admins as $admin)
								<tr class="hover:bg-gray-50">
									<td class="px-6 py-4 whitespace-nowrap text-sm">
										{{ $admin->name }}
									</td>
									<td class="px-6 py-4 whitespace-nowrap text-sm">
										{{ $admin->email }}
									</td>
									<td class="px-6 py-4 whitespace-nowrap text-sm">
										{{ $admin->role->name }}
									</td>
									<td class="px-6 py-4 whitespace-nowrap text-sm">
										@forelse ($admin->district as $dist)
										{{ $dist->name }}{{ !$loop->last ? ',' : ''}}
										@empty
										-
										@endforelse
									</td>
									<td class="px-6 py-4 whitespace-nowrap text-sm text-right font-medium">
										<button
											wire:click='$emit("openModal", "district.account.edit", {{ json_encode(["id" => $admin->id]) }})'
											class="text-indigo-600 hover:text-indigo-900">Edit</button>
										|
										<button wire:click='openDeleteDialog({{ $admin->id }})'
											class="text-empex-red hover:text-red-500">Delete</button>
									</td>
								</tr>
								@empty
								<tr>
									<td class="px-6 py-4 whitespace-nowrap" colspan="5">Admin not found</td>
								</tr>
								@endforelse
							</tbody>
						</table>
					</div>
				</div>
			</div>

			<div class="py-2">
				{{ $admins->onEachSide(1)->links() }}
			</div>
		</div>
	</div>

	<x-jet-confirmation-modal wire:model="deleteDialog">
		<x-slot name="title">
			Delete Admin
		</x-slot>
		<x-slot name="content">
			Are you sure you want to delete this account?
		</x-slot>
		<x-slot name="footer">
			<x-jet-secondary-button wire:click="closeDeleteDialog">
				{{ __('Close') }}
			</x-jet-secondary-button>
			<x-jet-danger-button class="ml-2" wire:click="deleteAdmin" wire:loading.attr="disabled"
				wire:loading.class='bg-gray-100'>
				{{ __('Delete') }}
			</x-jet-danger-button>
		</x-slot>
	</x-jet-confirmation-modal>
</div>
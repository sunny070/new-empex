<div>
    <div class="w-full flex justify-between">
        <div class="font-semibold">
            Expired Accounts


            {{-- {{ $expired }} --}}
        </div>
        <div class="">
            <span class="font-semibold">Total: </span>


            {{ count($expired) }}
        </div>

    </div>

    <div class="mt-5">
        <div class="grid grid-cols-1 md:grid-cols-4 my-3 gap-1">
            <input wire:keyup.debounce.1000ms="change" wire:model.debounce.1000ms='name'
                class="w-full rounded input border-gray-400 text-base text-gray-600 focus:text-empex-green focus:border-green-600 focus:outline-none focus:ring-green-600"
                type="text" placeholder="Search by name" />
            <div></div>
            <div></div>

        </div>

        <div class="flex flex-col w-full">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wide">
                                        Name
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wide">
                                        Phone
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wide">
                                        Email
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wide">
                                        Valid from
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wide">
                                        Valid Till
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-right font-medium uppercase tracking-wide">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($expired as $user)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            {{ $user?->full_name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            {{ $user?->phone_no }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            {{ $user?->email }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            {{ date_format($user?->card_valid_from, 'd-M-Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            {{ date_format($user?->card_valid_till, 'd-M-Y') }}

                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-right font-medium">
                                            {{-- <button
											wire:click='$emit("openModal", "admin.account.official.edit", {{ json_encode(["id" => $admin->id]) }})'
											class="text-indigo-600 dark:text-indigo-500 hover:text-indigo-900 dark:hover:text-indigo-700">Edit</button> --}}
                                            {{-- @if ($admin->role_id != 1) --}}
                                                |
                                                <button wire:click='openDeleteDialog({{ $user->id }})'
                                                    class="text-empex-red hover:text-red-500">Delete</button>
                                            {{-- @endif --}}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap" colspan="5">Employee not found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="py-2">
                {{-- {{ $admins->onEachSide(1)->links() }} --}}
            </div>
        </div>
    </div>

    <x-jet-confirmation-modal wire:model="deleteDialog">
        <x-slot name="title">
            Delete Employee
        </x-slot>
        <x-slot name="content">
            Are you sure you want to delete this account?
        </x-slot>
        <x-slot name="footer">
            <div class="flex flex-row">
                <div class="flex flex-col w-1/2">
                    <button type="submit" wire:click="deleteEmployee" wire:loading.attr="disabled"
                        class="tracking-wide font-semibold bg-indigo-500 text-gray-100 w-full py-2 rounded-lg hover:bg-indigo-700 transition-all duration-300 ease-in-out flex items-center justify-center focus:shadow-outline focus:outline-none">
                        <span class="ml-3">
                            Yes
                        </span>
                    </button>
                </div>
                <div class="flex flex-col ml-4 w-1/2">
                    <button type="submit" wire:click.prevent='closeDeleteDialog'
                        class="tracking-wide font-semibold bg-red-500 text-gray-100 w-full py-2 rounded-lg hover:bg-red-700 transition-all duration-300 ease-in-out flex items-center justify-center focus:shadow-outline focus:outline-none">
                        <span class="ml-3">
                            Cancel
                        </span>
                    </button>
                </div>
            </div>
        </x-slot>
    </x-jet-confirmation-modal>
</div>

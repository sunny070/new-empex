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
            <option value="{{ $dist->name }}">{{ $dist->name }}</option>
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
                                    Employer
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wide">
                                    Address
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wide">
                                    District
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wide">
                                    Date
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-right text-sm font-medium uppercase tracking-wide">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($sponsorships as $spon)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    {{ $spon->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    {{ $spon->employer_name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    {{ $spon->address }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    {{ $spon->district ?? '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    {{ $spon->created_at->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-right font-medium">
                                    <button class="text-empex-green"
                                        wire:click.prevent='openDetailDialog({{ $spon->id }})'>
                                        Detail
                                    </button>
                                    |
                                    <button class="text-indigo-600" wire:click.prevent='downloadExcel({{ $spon->id }})'>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        Excel
                                    </button>
                                    @if(auth()->guard('admin')->user()->role_id == 1)
                                    |
                                    <button wire:click="openDeleteDialog({{ $spon->id }})"
                                        class="text-red-600 dark:text-indigo-500 hover:text-red-900">Delete</button>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap" colspan="6">Sponsorship not found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="py-2">
            {{ $sponsorships->onEachSide(1)->links() }}
        </div>
    </div>

    @if ($data)
    <x-jet-dialog-modal wire:model="detailDialog">
        <x-slot name="title">
            Detail of sponsorship
        </x-slot>
        <x-slot name="content">
            <div class="grid grid-cols-2 md:grid-cols-3 gap-2">
                <div>Name</div>
                <div class="md:col-span-2">{{ $data->name }}</div>

                <div>Employer</div>
                <div class="md:col-span-2">{{ $data->employer_name }}</div>

                <div>Address</div>
                <div class="md:col-span-2">{{ $data->address }}</div>

                <div>Proff</div>
                <div class="md:col-span-2">
                    @if ($data->file)
                    <a href="{{ asset('storage/'.$data->file) }}" target="_blank" class="text-empex-green">
                        Download
                    </a>
                    @else
                    <input type="file" wire:model="sponsorshipFile" class="w-full border border-empex-gray p-1 rounded">
                    @endif
                </div>

                <div>District</div>
                <div class="md:col-span-2">{{ $data->district ?? '-' }}</div>

                <div>Category</div>
                <div class="md:col-span-2">{{ $data->category ?? '-' }}</div>

                <div>Male/post</div>
                <div class="md:col-span-2">{{ $data->male_per_post ?? '-' }}</div>

                <div>Female/post</div>
                <div class="md:col-span-2">{{ $data->female_per_post ?? '-' }}</div>

                <div>Min Age</div>
                <div class="md:col-span-2">{{ $data->min_age ?? '-' }}</div>

                <div>Max Age</div>
                <div class="md:col-span-2">{{ $data->max_age ?? '-' }}</div>

                <div>Qualification</div>
                <div class="md:col-span-2">
                    @forelse ($data->qualification as $quali)
                    {{ $quali->name }}@if(!$loop->last), @endif
                    @empty
                    -
                    @endforelse
                </div>

                <div>Subject</div>
                <div class="md:col-span-2">
                    @forelse ($data->subject as $subj)
                    {{ $subj->name }}@if(!$loop->last), @endif
                    @empty
                    -
                    @endforelse
                </div>

                <div>Major/Core</div>
                <div class="md:col-span-2">
                    @forelse ($data->major_core as $core)
                    {{ $core->name }}@if(!$loop->last), @endif
                    @empty
                    -
                    @endforelse
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="closeDialog">
                {{ __('Close') }}
            </x-jet-secondary-button>

            @if ($sponsorshipFile != null)
            <x-jet-button class="ml-2" wire:click="uploadProff({{ $data->id }})" wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-jet-button>
            @endif
        </x-slot>
    </x-jet-dialog-modal>
    @endif

    <x-jet-confirmation-modal wire:model="deleteDialog">
        <x-slot name="title">
            Delete Sponsorship
        </x-slot>
        <x-slot name="content">
            Are you sure you want to delete this sponsorship? Sponsorship count will be deducted on many users!
        </x-slot>
        <x-slot name="footer">
            <div class="flex items-center justify-end mt-4">
                <x-jet-secondary-button wire:click.prevent='closeDeleteDialog'>
                    {{ __('Cancel') }}
                </x-jet-secondary-button>

                <x-jet-button class="ml-2 bg-empex-red" wire:click.prevent='delete' wire:loading.attr="disabled">
                    {{ __('Delete') }}
                </x-jet-button>
            </div>
        </x-slot>
    </x-jet-confirmation-modal>
</div>

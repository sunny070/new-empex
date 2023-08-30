<div class="mtd-5">

    <div class="w-full ml-5">
        <span class="font-semibold text-green-600 text-sm">Active: </span>


        {{ $count_active }} |
        <span class="font-semibold text-yellow-600 text-sm">Inactive: </span>


        {{ $count_inactive }}
    </div>
    <div class="grid grid-cols-1 md:grid-cols-4 my-3 gap-1">


        <input wire:model='name'
            class="w-full rounded input border-gray-400 text-base text-gray-600 focus:text-empex-green focus:border-green-600 focus:outline-none focus:ring-green-600"
            type="text" placeholder="Search by name" />
        <div></div>
        <div></div>
        <select wire:model.lazy='category'
            class="w-full md:w-2/3 ml-auto p-2 rounded input border-gray-400 text-base text-gray-600 focus:text-empex-green focus:border-green-600 focus:outline-none focus:ring-green-600">
            <option value>All Category</option>
            @foreach ($categories as $cat)
                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
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
                                <th scope="col"
                                    class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wide">
                                    Image
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wide">
                                    Name
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wide">
                                    Email
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wide">
                                    Contact
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wide">
                                    Organization
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wide">
                                    Category
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wide">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3 text-right font-medium uppercase tracking-wide">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($employers as $emp)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        @if ($emp->profile_photo_path)
                                            <img src="{{ asset('/storage/' . $emp->profile_photo_path) }}"
                                                alt="admin_image" class="h-10 w-10 rounded-full">
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        {{ $emp->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        {{ $emp->email }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        {{ $emp->contact }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        @if ($emp->category_id == 3)
                                            {{ $emp->organization?->department?->name }}
                                        @else
                                            {{ $emp->organization?->name }}
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        {{ $emp->category->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        {{ $emp->is_approved == 0 ? 'Pending' : 'Approved' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-right font-medium">
                                        {{-- @if ($emp->active == 1) --}}
                                            <a href="{{ route('admin.employer.detail', $emp->id) }}"
                                                class="text-indigo-600 dark:text-indigo-500 hover:text-indigo-900 dark:hover:text-indigo-700">Detail</a>
                                        {{-- @else
                                            Not active
                                        @endif --}}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap" colspan="8">Employer not found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="py-2">
            {{ $employers->onEachSide(1)->links() }}
        </div>
    </div>
</div>

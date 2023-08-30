<div>
  <div class="w-full flex justify-between">
    <div class="text-sm font-semibold ml-5">
      Notice Board
    </div>
    <button wire:click="openAddDialog"
      class="float-right bg-empex-green text-white rounded px-4 py-1 text-base font-medium hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-300">
      Add
    </button>
  </div>

  <div class="flex flex-col w-full mt-5">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
        <div class="shadow overflow-hidden border-b">
          <table class="min-w-full divide-y divide-gray-200">
            <thead>
              <tr>
                <th scope="col" class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wide">
                  Title
                </th>
                <th scope="col" class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wide">
                  Content
                </th>
                <th scope="col" class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wide">
                  File
                </th>
                <th scope="col" class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wide">
                  Date
                </th>
                <th scope="col" class="px-6 py-3 text-right font-medium uppercase tracking-wide">
                  Action
                </th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              @forelse($notices as $notice)
              <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 whitespace-nowrap text-sm">
                  {{ $notice->title }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">
                  {{ Str::limit($notice->content, 20, '...') }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">
                  @if ($notice->file)
                  <a class="text-blue-400 hover:text-blue-700" href="{{ asset('storage/'.$notice->file) }}"
                    target="_blank">View</a>
                  @else
                  -
                  @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">
                  {{ date('d-M-Y', strtotime($notice->created_at)) }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-right font-medium">
                  <button
                    wire:click="openEditDialog('{{ $notice->id }}', '{{ $notice->title }}', '{{ $notice->content }}')"
                    class="text-indigo-600 hover:text-indigo-700">Edit</button> |
                  <button wire:click="openDeleteDialog('{{ $notice->id }}')"
                    class="text-empex-red hover:text-red-800">Delete</button>
                </td>
              </tr>
              @empty
              <tr>
                <td class="px-6 py-4 whitespace-nowrap" colspan="5">Notice not found</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="py-2">
      {{ $notices->onEachSide(1)->links() }}
    </div>
  </div>

  {{-- add notice --}}
  <form method="post">
    <x-jet-dialog-modal wire:model="addDialog">
      <x-slot name="title">
        Add Notice
      </x-slot>
      <x-slot name="content">
        <input wire:model="title" required
          class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-green-500 text-sm focus:outline-none focus:border-green-400 focus:bg-white"
          type="text" placeholder="Title" autofocus />
        @error('title')<div class="text-empex-red text-xs">{{ $message }}</div>@enderror
        <textarea wire:model="content" required
          class="w-full px-8 mt-4 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-green-500 text-sm focus:outline-none focus:border-green-400 focus:bg-white"
          type="number" placeholder="Content"></textarea>
        @error('content')<div class="text-empex-red text-xs">{{ $message }}</div>@enderror
        <input
          class="w-full px-8 mt-4 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-green-500 text-sm focus:outline-none focus:border-green-400 focus:bg-white"
          type="file" name="" id="" wire:model="file">
      </x-slot>
      <x-slot name="footer">
        <button type="submit" wire:click.prevent='addNotice'
          class="tracking-wide font-semibold bg-indigo-500 text-gray-100 w-full py-2 rounded-lg hover:bg-indigo-700 transition-all duration-300 ease-in-out flex items-center justify-center focus:shadow-outline focus:outline-none">
          <span class="ml-3">
            Add
          </span>
        </button>
      </x-slot>
    </x-jet-dialog-modal>
  </form>

  {{-- edit notice --}}
  <form method="post">
    <x-jet-dialog-modal wire:model="updateDialog">
      <x-slot name="title">
        Update Notice
      </x-slot>
      <x-slot name="content">
        <input wire:model="title" required
          class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-green-500 text-sm focus:outline-none focus:border-green-400 focus:bg-white"
          type="text" placeholder="Title" autofocus />
        @error('title')<div class="text-empex-red text-xs">{{ $message }}</div>@enderror
        <textarea wire:model="content" required
          class="w-full px-8 mt-4 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-green-500 text-sm focus:outline-none focus:border-green-400 focus:bg-white"
          type="number" placeholder="Content"></textarea>
        @error('content')<div class="text-empex-red text-xs">{{ $message }}</div>@enderror
        <input
          class="w-full px-8 mt-4 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-green-500 text-sm focus:outline-none focus:border-green-400 focus:bg-white"
          type="file" name="" id="" wire:model="file">
      </x-slot>
      <x-slot name="footer">
        <button type="submit" wire:click.prevent='updateNotice'
          class="tracking-wide font-semibold bg-indigo-500 text-gray-100 w-full py-2 rounded-lg hover:bg-indigo-700 transition-all duration-300 ease-in-out flex items-center justify-center focus:shadow-outline focus:outline-none">
          <span class="ml-3">
            Update
          </span>
        </button>
      </x-slot>
    </x-jet-dialog-modal>
  </form>

  {{-- delete notice --}}
  <x-jet-confirmation-modal wire:model="deleteDialog">
    <x-slot name="title">
      Delete Notice
    </x-slot>
    <x-slot name="content">
      Are you sure you want to delete this notice?
    </x-slot>
    <x-slot name="footer">
      <div class="flex flex-row">
        <div class="flex flex-col w-1/2">
          <button type="submit" wire:click='deleteNotice'
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

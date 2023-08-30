<div class="mt-4">
  <div class="flex flex-col w-full">
    @if (Session('error'))
    <div class="flex flex-col mb-5 bg-white border-empex-yellow shadow border rounded p-2" x-data="{ show: true }"
      x-show="show" x-init="setTimeout(() => show = false, 2000)">
      <div class="font-medium leading-none">{{ session('error') }}</div>
    </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-5 gap-2">
      <input wire:model='name'
        class="rounded md:col-span-2 input border-gray-400 py-1 text-base text-gray-600 focus:text-empex-green focus:border-green-600 focus:outline-none focus:ring-green-600"
        type="text" placeholder="Search by name" />
      <div class="hidden md:block"></div>
      <div class="hidden md:block"></div>
      <button wire:click="openAddDialog"
        class="bg-green-500 text-white rounded-md py-1 font-medium hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-300"
        id="open-btn">
        Add New
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
                    Name
                  </th>
                  <th scope="col" class="px-6 py-3 text-right text-sm font-medium uppercase tracking-wide">
                    Action
                  </th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                @forelse($states as $state)
                <tr class="hover:bg-gray-50">
                  <td class="px-6 py-4 whitespace-nowrap text-sm">
                    {{ $state->name }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-right font-medium">
                    <button wire:click="openUpdateDialog({{ $state->id }}, '{{ $state->name }}')"
                      class="text-indigo-600 dark:text-indigo-500 hover:text-indigo-900 dark:hover:text-indigo-700">Edit</button>
                    |
                    <button wire:click="openDeleteDialog({{ $state->id }})"
                      class="text-red-600 dark:text-indigo-500 hover:text-red-900">Delete</button>
                  </td>
                </tr>
                @empty
                <tr>
                  <td class="px-6 py-4 whitespace-nowrap" colspan="2">State not found</td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="py-2">
        {{ $states->onEachSide(1)->links() }}
      </div>
    </div>
  </div>

  {{-- add state modal --}}
  <form method="post">
    <x-jet-dialog-modal wire:model="addDialog">
      <x-slot name="title">
        Add State
      </x-slot>
      <x-slot name="content">
        <input wire:model="stateName" required
          class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-green-500 text-sm focus:outline-none focus:border-green-400 focus:bg-white"
          type="text" placeholder="Enter Name" autofocus name="name" />
        @error('stateName')<div class="text-empex-red text-xs">{{ $message }}</div>@enderror
      </x-slot>
      <x-slot name="footer">
        <button type="submit" wire:click.prevent='addState'
          class="tracking-wide font-semibold bg-indigo-500 text-gray-100 w-full py-2 rounded-lg hover:bg-indigo-700 transition-all duration-300 ease-in-out flex items-center justify-center focus:shadow-outline focus:outline-none">
          <span class="ml-3">
            Add
          </span>
        </button>
      </x-slot>
    </x-jet-dialog-modal>
  </form>

  {{-- edit state modal --}}
  <form method="post">
    <x-jet-dialog-modal wire:model="updateDialog">
      <x-slot name="title">
        Update State
      </x-slot>
      <x-slot name="content">
        <input wire:model="stateName" required
          class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-green-500 text-sm focus:outline-none focus:border-green-400 focus:bg-white"
          type="text" placeholder="Enter Name" autofocus name="name" />
        @error('stateName')<div class="text-empex-red text-xs">{{ $message }}</div>@enderror
      </x-slot>
      <x-slot name="footer">
        <button type="submit" wire:click.prevent='updateState'
          class="tracking-wide font-semibold bg-indigo-500 text-gray-100 w-full py-2 rounded-lg hover:bg-indigo-700 transition-all duration-300 ease-in-out flex items-center justify-center focus:shadow-outline focus:outline-none">
          <span class="ml-3">
            Update
          </span>
        </button>
      </x-slot>
    </x-jet-dialog-modal>
  </form>

  {{-- delete state --}}
  <form method="post">
    <x-jet-confirmation-modal wire:model="deleteDialog">
      <x-slot name="title">
        Delete State
      </x-slot>
      <x-slot name="content">
        Are you sure you want to delete this state?
      </x-slot>
      <x-slot name="footer">
        <div class="flex flex-row">
          <div class="flex flex-col w-1/2">
            <button type="submit" wire:click.prevent='deleteState'
              class="tracking-wide font-semibold bg-indigo-500 text-gray-100 w-full py-2 rounded-lg hover:bg-indigo-700 transition-all duration-300 ease-in-out flex items-center justify-center focus:shadow-outline focus:outline-none">
              <span class="ml-3">
                Yes
              </span>
            </button>
          </div>
          <div class="flex flex-col w-1/2 ml-4">
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
  </form>
</div>
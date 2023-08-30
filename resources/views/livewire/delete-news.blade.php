<div class="textd-center">
    <button wire:click="toggleDeleteDialog({{$jobId}})" class="text-red-600 dark:text-red-500 hover:text-red-400 dark:hover:text-red-700">Delete</button>
    <x-jet-dialog-modal wire:model="deleteDialog">
    <x-slot name="title">Confirmation</x-slot>
    <x-slot name="content">Are you sure you want to delete this article?</x-slot>
    <x-slot name="footer">
        <button wire:click="deleteJob" class="text-red-600 hover:text-red-500 px-4">Yes</button>
        <button wire:click="cancelDelete" class="text-green-600 hover:text-green-500 px-4">No</button>
    </x-slot>
  </x-jet-dialog-modal>
</div>

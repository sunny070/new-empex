@props(['formAction' => false])

<div class="bg-white dark:bg-gray-800">
  @if($formAction)
  <form wire:submit.prevent="{{ $formAction }}">
    @endif
    <div class="p-4 sm:px-6 sm:py-4 border-b border-gray-150 dark:border-gray-600">
      @if(isset($title))
      <h3 class="text-lg leading-6 font-medium text-gray-700 dark:text-gray-300">
        {{ $title }}
      </h3>
      @endif
    </div>
    <div class="px-4 sm:p-6 text-gray-700 dark:text-gray-400">
      <div class="space-y-2">
        {{ $content }}
      </div>
    </div>

    <div
      class="flex flex-col items-center justify-end px-6 py-3 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row bg-gray-50 dark:bg-gray-900">
      {{ $buttons }}
    </div>
    @if($formAction)
  </form>
  @endif
</div>
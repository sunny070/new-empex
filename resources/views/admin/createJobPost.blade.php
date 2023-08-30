@extends('layouts.admin')
@section('content')
<div class="py-5">
  <div class="max-w-7xl mx-auto px-4">
    <h6 class="text-gray-600 font-semibold dark:text-gray-200">Post New Job</h6>

    <div class="lg:flex items-center py-4 space-y-2 sm:space-y-4 md:space-y-2 lg:space-y-0 w-full">
      @livewire('admin.job-post')
    </div>
  </div>
</div>
@endsection

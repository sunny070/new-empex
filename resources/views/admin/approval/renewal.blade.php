@extends('layouts.admin')
@section('content')
  <div class="py-5">
    <div class="max-w-7xl mx-auto px-4">
      <h1 class="text-gray-600 font-semibold dark:text-gray-200">Renewal Applications</h1>
      <div class="lg:flex items-center justify-between py-4 space-y-2 sm:space-y-4 md:space-y-2 lg:space-y-0">
        @livewire('admin.enrollment-renew')
      </div>
    </div>
  </div>
@endsection

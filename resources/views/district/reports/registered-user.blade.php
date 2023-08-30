@extends('layouts.district.app')
@section('content')
<div class="py-5">
  <div class="max-w-7xl mx-auto px-4">
    <h6 class="text-gray-600 dark:text-gray-200">
      Registered user list report
    </h6>
    <div class="items-center justify-between py-4 space-y-2 sm:space-y-4 md:space-y-2 lg:space-y-0">
      @livewire('district.reports.registered-user')
    </div>
  </div>
</div>
@endsection
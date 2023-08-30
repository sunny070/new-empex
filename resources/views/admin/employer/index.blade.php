@extends('layouts.admin')
@section('content')
<div class="max-w-7xl mx-auto px-4 mb-10 mt-5">
  <div class="w-full flex justify-between">
    <div class=" text-sm font-semibold ml-5">
      Employer
    </div>

    <button onclick="Livewire.emit('openModal', 'admin.employer.create')"
      class="float-right bg-empex-green text-white rounded px-4 py-1 text-base font-medium hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-300">
      Add
    </button>
  </div>

  @livewire('admin.employer.index')
</div>
@endsection

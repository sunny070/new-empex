@extends('layouts.admin')
@section('content')
<div class="flex">
  {{-- SIDEBAR --}}
  @include('layouts.sidebar')
  {{-- END SIDEBAR --}}

  {{-- BODY SECTION --}}
  <div class="w-4/5 bg-gray-50 dark:bg-gray-800 overflow-y-hidden">
    @include('layouts.navbar')
    <div class="px-10 py-8">
      {{-- HEADING --}}
      <h1 class="text-3xl text-gray-600 dark:text-gray-200 font-semibold">Approve Renewal Applications</h1>
      <div class="lg:flex items-center justify-between py-4 space-y-2 sm:space-y-4 md:space-y-2 lg:space-y-0">
        This is test
      </div>
    </div>
  </div>
</div>
@endsection
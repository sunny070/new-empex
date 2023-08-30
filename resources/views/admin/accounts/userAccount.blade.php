@extends('layouts.admin')
@section('content')
<div class="max-w-7xl mx-auto px-4 mt-5">
  <h6 class="text-gray-600 font-semibold dark:text-gray-200">Employee</h6>

  @livewire('admin.account.user.index')
</div>
@endsection
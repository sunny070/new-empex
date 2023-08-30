@extends('layouts.admin')
@section('content')
<div class="max-w-7xl mx-auto px-4 mb-10 mt-5">
  <div class="w-full">
    <div class="font-semibold ml-5">
      Verify New Application
    </div>
  </div>

  @livewire('admin.verify.new-application')
</div>
@endsection
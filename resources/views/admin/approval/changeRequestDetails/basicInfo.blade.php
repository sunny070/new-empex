@extends('layouts.admin')
@section('content')
<div class="py-5">
  <div class="max-w-7xl mx-auto px-4">
    @livewire('admin.change-request.basic-info', ['id' => $id])
  </div>
</div>
@endsection
@extends('layouts.verifier.app')

@section('title', 'Verifier - Dashboard')

@section('navbar')
@parent
@endsection

@section('content')
<div class="max-w-7xl mx-auto px-4 my-10">
  <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-5">
    <div class="border bg-white rounded p-5">
      <div class="font-bold text-2xl">{{ $basicInfos }}</div>
      <div class="empex mt-4"></div>
      <div class="font-bold mt-4">Pending Employment</div>
      <div class="text-gray-400 mt-4">Verification</div>
    </div>
    <a href="{{ route('verifier.employment') }}" class="border bg-white rounded p-5 hover:bg-green-50">
      <div class="font-bold text-2xl">{{ $employee }}</div>
      <div class="empex mt-4"></div>
      <div class="font-bold mt-4">Employment</div>
      <div class="text-gray-400 mt-4">Total</div>
    </a>
    <a href="{{ route('verifier.change') }}" class="border bg-white rounded p-5 hover:bg-green-50">
      <div class="font-bold text-2xl">{{ $changes }}</div>
      <div class="empex mt-4"></div>
      <div class="font-bold mt-4">Change Request</div>
      <div class="text-gray-400 mt-4">Pending</div>
    </a>
  </div>

  <div class="w-full">
    <div class=" text-sm font-semibold ml-5 my-3">
      Verify Employment
    </div>
  </div>

  @livewire('verifier.index')
</div>
@endsection
@extends('layouts.district.app')

@section('title', 'Sponsorship List')

@section('navbar')
@parent
@endsection
@section('content')
<div class="max-w-7xl mx-auto px-4 py-5">
  <div class="flex justify-between">
    <h6 class="text-gray-600">
      Sponsorship list
    </h6>

    <a href="{{ route('district-admin.report.sponsorship') }}" class="text-empex-green">back to sponsorship</a>
  </div>
  @livewire('admin.reports.sponsorship-list')
</div>
@endsection

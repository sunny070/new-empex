@extends('layouts.web.app')

@section('title', auth()->user()->name.' Profile')

@section('navbar')
@parent
@endsection

@section('content')
<div class="w-full bg-white py-5">
  <div class="max-w-7xl mx-auto px-4">
    <div class="w-full">
      <div class=" text-sm font-semibold ml-5 my-3">
        Profile
      </div>
    </div>
    @livewire('web.auth.employee-detail', ['type' => 'profile'])
  </div>
</div>
@endsection

@section('footer')
@parent
@endsection

@section('copyright')
@parent
@endsection
@extends('layouts.web.app')

@section('title', 'Notifications')

@section('navbar')
@parent
@endsection

@section('content')
<div class="w-full bg-white py-5">
  <div class="max-w-7xl mx-auto px-4">
    <div class="w-full">
      <div class=" text-sm font-semibold ml-5 my-3">
        Sponsorship Notification
      </div>
    </div>
    @livewire('web.notification')
  </div>
</div>
@endsection

@section('footer')
@parent
@endsection

@section('copyright')
@parent
@endsection
@extends('layouts.web.app')

@section('title', 'Notifications Detail')

@section('navbar')
@parent
@endsection

@section('content')
<div class="w-full bg-white py-5">
  <div class="max-w-7xl mx-auto px-4">
    <div class="w-full flex justify-between my-5">
      <div class=" text-sm font-semibold">
        Notification Detail
      </div>
      <a href="{{ route('auth.notification') }}"
        class="uppercase focus:outline-none py-1 border-empex-green px-5 rounded text-center text-empex-green bg-white hover:bg-gray-100 font-medium border">Back</a>
    </div>

    <div>
      {{ $noti->content }}
    </div>
  </div>
</div>
@endsection

@section('footer')
@parent
@endsection

@section('copyright')
@parent
@endsection
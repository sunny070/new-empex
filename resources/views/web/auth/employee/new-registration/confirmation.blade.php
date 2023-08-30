@extends('layouts.web.app')

@section('title', 'Employee Registration Confirmation - Empex')

@section('navbar')
@parent
@endsection

@section('content')
<div class="w-full py-12">
  <div class="max-w-7xl mx-auto px-4">
    <div class="border rounded bg-white p-5">
      <div class="text-center">
        <div class="flex justify-center">
          <img src="/images/auth/confirm.svg" alt="confirmation">
        </div>
        <div class="font-semibold text-xl mt-5">Submitted successfully</div>
        <div class="text-gray-400 mt-2">
          <p>Please, wait for an Authorised</p>
          <p>personnel for a response. </p>
          </p>Thank You</p>
        </div>

        <div class="mt-20">
          <a href="{{ route('auth.dashboard') }}"
            class="w-36 uppercase focus:outline-none py-1 border-empex-green px-5 rounded text-center text-empex-green bg-white hover:bg-gray-100 font-medium border">HOME</a>
        </div>
      </div>
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
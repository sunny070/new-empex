@extends('layouts.web.app')

@section('title', 'Enrollment Card - Empex')

@section('navbar')
@parent
@endsection

@section('content')
<div class="w-full py-5">
  <div class="max-w-7xl mx-auto px-4">
    <div class=" w-full grid grid-cols-1 md:grid-cols-3 md:gap-4 md:border md:bg-white md:rounded md:p-5">
      @livewire('web.enrollment-card')
      <div class="col-span-2 grid grid-cols-2 md:gap-4 mt-5">
        <div class="text-center">
          <div class="py-8">
            <img src="/images/auth/card.svg" alt="pocket card" class="mx-auto">
          </div>
          <div class="text-gray-400 mt-2 mb-4">Pocket Card</div>
          <a href="{{ route('auth.employee.pdf.card') }}"
            class="uppercase bg-empex-green text-white rounded px-3 py-1 hover:bg-green-500">Download</a>
        </div>
        <div class="text-center">
          <div>
            <img src="/images/auth/pdf.svg" alt="pdf" class="mx-auto">
          </div>
          <div class="text-gray-400 mt-2 mb-4">A4 document</div>
          <a href="{{ route('auth.employee.pdf.a4') }}"
            class="uppercase bg-empex-green text-white rounded px-3 py-1 hover:bg-green-500">Download</a>
        </div>
      </div>
    </div>

    <div class=" mt-5 w-full border rounded p-5 bg-white">
      <div class="font-semibold mb-2">View you registration details</div>
      <button @click="employeeDetail = !employeeDetail"
        class="uppercase focus:outline-none border border-empex-green py-1 px-5 rounded text-center text-empex-green bg-white hover:bg-empex-gray">view
        details</button>
    </div>

    <div x-show="employeeDetail">
      @livewire('web.auth.employee-detail')
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

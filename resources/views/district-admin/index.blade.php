@extends('layouts.district.app')

@section('title', 'District Admin - Dashboard')

@section('navbar')
@parent
@endsection

@section('content')
<div class="max-w-7xl mx-auto px-4 my-5">
  <div class="mt-1">
    <div class="ml-5 mb-2 text-gray-700">Employee application info</div>
    <div class="grid grid-cols-2 md:grid-cols-3  gap-4">
      <a href="{{ route('district-admin.new-application') }}"
        class="hover:bg-empex-gray hover:border-empex-green bg-white rounded-lg w-full p-5 border">
        <h1 class="font-bold text-3xl mb-5">{{ $verifyPending }}</h1>
        <div class="empex"></div>
        <p class="font-bold pb-1 pt-2">Pending applications</p>
        <p class="text-gray-500">Verification</p>
      </a>
      <a href="{{ route('district-admin.new-application') }}"
        class="hover:bg-empex-gray hover:border-empex-green bg-white rounded-lg w-full p-5 border">
        <h1 class="font-bold text-3xl mb-5">{{ $approvalPending }}</h1>
        <div class="empex"></div>
        <p class="font-bold pb-1 pt-2">Pending applications</p>
        <p class="text-gray-500">Approval</p>
      </a>
      <a href="{{ route('district-admin.renew') }}"
        class="hover:bg-empex-gray hover:border-empex-green bg-white rounded-lg w-full p-5 border col-span-2 md:col-span-1">
        <h1 class="font-bold text-3xl mb-5">{{ $renewPending }}</h1>
        <div class="empex"></div>
        <p class="font-bold pb-1 pt-2">Renewal</p>
        <p class="text-gray-500">Employee</p>
      </a>
    </div>
  </div>

  <div class="mt-5">
    <div class="ml-5 mb-2 text-gray-700">More info</div>
    <div class="grid grid-cols-1 md:grid-cols-2  gap-4">
      <div class="grid grid-cols-1 md:grid-cols-2 bg-white p-5 rounded border gap-4">
        <a href="{{ route('district-admin.change.verification') }}"
          class="flex flex-col hover:bg-empex-gray md:p-5 rounded">
          <h1 class="font-bold text-3xl mb-2">{{ $changeVerify }}</h1>
          <div class="empex"></div>
          <p class="font-bold mb-1 mt-2">Verification pending</p>
          <p class="text-gray-500">User change request</p>
        </a>
        <a href="{{ route('district-admin.change.approval') }}"
          class="flex flex-col hover:bg-empex-gray md:p-5 rounded">
          <h1 class="font-bold text-3xl mb-2">{{ $changeApproval }}</h1>
          <div class="empex"></div>
          <p class="font-bold mb-1 mt-2">Approval pending</p>
          <p class="text-gray-500">User change request</p>
        </a>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 bg-white p-5 rounded border gap-4">
        <a href="{{ route('district-admin.employee') }}" class="flex flex-col hover:bg-empex-gray md:p-5 rounded">
          <h1 class="font-bold text-3xl mb-2">{{ $employee }}</h1>
          <div class="empex"></div>
          <p class="font-bold mb-1 mt-2">Users</p>
          <p class="text-gray-500">With employee card</p>
        </a>
        <a href="{{ route('district-admin.account') }}" class="flex flex-col hover:bg-empex-gray md:p-5 rounded">
          <h1 class="font-bold text-3xl mb-2">{{ $official }}</h1>
          <div class="empex"></div>
          <p class="font-bold mb-1 mt-2">Official users</p>
          <p class="text-gray-500">In Districts</p>
        </a>
      </div>
    </div>
  </div>
</div>
@endsection

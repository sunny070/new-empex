@extends('layouts.web.app')

@section('title', 'Enrollment Surrender - Empex')

@section('navbar')
@parent
@endsection

@section('content')
<div class="w-full py-5">
  <div class="max-w-7xl mx-auto px-4">
    <div class="w-full">
      <div class=" text-sm font-semibold ml-5 my-3">
        Enrollment Surrender
      </div>
    </div>
    <div class="w-full md:bg-white md:rounded md:shadow md:border md:mb-0">
      <form class="md:px-6 md:py-4" action="{{ route('surrender.employee') }}" method="POST">
        @csrf
        <div class="my-2">
          by clicking below surrender, all your data will be removed and you'll be logout from EmpEx
        </div>
        <div class="my-2">
          You can re-register as a new jobseeker later on
        </div>
        <div class="mt-5">
          <button type="submit" onclick="confirm('Are you sure to Surrender?')" class="mr-2 uppercase focus:outline-none border border-transparent py-1 px-5 rounded text-center text-white bg-empex-green hover:bg-green-500 font-medium">Surrender</button>
        </div>
      </form>
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
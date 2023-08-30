@extends('layouts.verifier.app')

@section('title', 'Verifier - Change Request')

@section('navbar')
@parent
@endsection

@section('content')
<div class="max-w-7xl mx-auto px-4 my-10">
  <div class="w-full">
    <div class=" text-sm font-semibold ml-5 my-3">
      Change Request Detail
    </div>

    @if ($type == 'info')
    @livewire('verifier.change.info', ['id' => $id])
    @elseif ($type == 'address')
    @livewire('verifier.change.address', ['userId' => $id])
    @elseif ($type == 'education')
    @livewire('verifier.change.education', ['userId' => $id])
    @elseif ($type == 'experience')
    @livewire('verifier.change.experience', ['userId' => $id])
    @else
    @livewire('verifier.change.transfer', ['id' => $id])
    @endif
  </div>
</div>
@endsection
@extends('layouts.approver.app')

@section('title', 'Approver - Change Request')

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
    @livewire('approver.change.info', ['id' => $id])
    @elseif ($type == 'address')
    @livewire('approver.change.address', ['userId' => $id])
    @elseif ($type == 'education')
    @livewire('approver.change.education', ['userId' => $id])
    @elseif ($type == 'experience')
    @livewire('approver.change.experience', ['userId' => $id])
    @else
    @livewire('approver.change.transfer', ['id' => $id])
    @endif
  </div>
</div>
@endsection
@extends('layouts.approver.app')

@section('title', 'Approver - Employee List')

@section('navbar')
@parent
@endsection

@section('content')
<div class="max-w-7xl mx-auto px-4 my-10">
  @livewire('approver.employment')
</div>
@endsection
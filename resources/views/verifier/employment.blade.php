@extends('layouts.verifier.app')

@section('title', 'Verifier - Employee List')

@section('navbar')
@parent
@endsection

@section('content')
<div class="max-w-7xl mx-auto px-4 my-10">
  @livewire('verifier.employment')
</div>
@endsection
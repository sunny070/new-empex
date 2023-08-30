@extends('layouts.district.app')

@section('title', 'District Admin - Employee')

@section('navbar')
@parent
@endsection

@section('content')
<div class="max-w-7xl mx-auto px-4 my-10">
  @livewire('district.employee')
</div>
@endsection
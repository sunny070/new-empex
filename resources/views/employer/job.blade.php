@extends('layouts.employer.app')

@section('title', 'Employer - Job')

@section('navbar')
@parent
@endsection

@section('content')
<div class="max-w-7xl mx-auto px-4 my-10">
	@if (isset($id))
	@livewire('employer.job-create', ['id' => $id])
	@else
	@livewire('employer.job-create', ['id' => null])
	@endif
</div>
@endsection
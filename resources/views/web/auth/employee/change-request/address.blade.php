@extends('layouts.web.app')

@section('title', 'Change Address - Empex')

@section('navbar')
@parent
@endsection

@section('content')
<div class="w-full py-5">
	<div class="max-w-7xl mx-auto px-4">
		<div class="mb-3 ml-3 font-semibold">Change Address</div>
		@livewire('web.auth.change.address')
	</div>
</div>
@endsection

@section('footer')
@parent
@endsection

@section('copyright')
@parent
@endsection
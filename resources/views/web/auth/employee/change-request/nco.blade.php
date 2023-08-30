@extends('layouts.web.app')

@section('title', 'Change NCO - Empex')

@section('navbar')
@parent
@endsection

@section('content')
<div class="w-full py-5">
	<div class="max-w-7xl mx-auto px-4">
		<div class="mb-3 ml-3 font-semibold">Change NCO</div>
		@livewire('web.auth.change.nco')
	</div>
</div>
@endsection

@section('footer')
@parent
@endsection

@section('copyright')
@parent
@endsection
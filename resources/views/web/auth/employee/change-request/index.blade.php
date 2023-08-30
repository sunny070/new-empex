@extends('layouts.web.app')

@section('title', 'Request for change - Empex')

@section('navbar')
@parent
@endsection

@section('content')
<div class="w-full py-5">
	<div class="max-w-7xl mx-auto px-4">
		@if (Session('message'))
		<div class="flex flex-col mb-5 bg-white border-empex-yellow shadow border rounded" x-data="{ show: true }"
			x-show="show" x-init="setTimeout(() => show = false, 5000)">
			<div class="flex items-center justify-between">
				<div class="flex items-center">
					<div class="bg-empex-yellow rounded-l p-6 md:p-4">
						<img src="/images/auth/info.svg" alt="noti">
					</div>
					<div class="flex flex-col mx-3 py-2 md:py-0">
						<div class="font-medium leading-none">{{ session('message') }}</div>
						<p class="text-sm text-gray-600 leading-none mt-1">Track your application status on <a
								href="{{ route('auth.enrollment.status') }}" class="underline text-empex-green">Ongoing Application</a>
						</p>
					</div>
				</div>
			</div>
		</div>
		@endif

		<div class="mb-3 ml-3 font-semibold">Request for change</div>
		<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
			{{-- <a href="{{ route('auth.employee.changerequest.nco') }}"
				class="flex w-full border rounded bg-white shadow p-5 hover:bg-empex-gray">
				<img class=" h-10" src="/images/auth/transfer.svg" alt="nco">
				<div class="ml-2 md:ml-5 w-full">
					<div class="font-semibold">NCO</div>
					<div class="text-gray-400">Update NCO details</div>
				</div>
			</a> --}}

			<a href="{{ route('auth.employee.changerequest.basicinfo') }}"
				class="flex w-full border rounded bg-white shadow p-5 hover:bg-empex-gray">
				<img class=" h-10" src="/images/auth/basic_info.svg" alt="employee basic info">
				<div class="ml-2 md:ml-5 w-full">
					<div class="font-semibold">Basic Information</div>
					<div class="text-gray-400">Name and general information</div>
				</div>
			</a>

			<a href="{{ route('auth.employee.changerequest.address') }}"
				class="flex w-full border rounded bg-white shadow p-5 hover:bg-empex-gray">
				<img class=" h-10" src="/images/auth/address.svg" alt="employee address">
				<div class="ml-2 md:ml-5 w-full">
					<div class="font-semibold">Address</div>
					<div class="text-gray-400">Permanent address and present address</div>
				</div>
			</a>

			<a href="{{ route('auth.employee.changerequest.educational') }}"
				class="flex w-full border rounded bg-white shadow p-5 hover:bg-empex-gray">
				<img class=" h-10" src="/images/auth/education.svg" alt="employee education">
				<div class="ml-2 md:ml-5 w-full">
					<div class="font-semibold">Educational Details</div>
					<div class="text-gray-400">Add or change education details</div>
				</div>
			</a>

			<a href="{{ route('auth.employee.changerequest.experience') }}"
				class="flex w-full border rounded bg-white shadow p-5 hover:bg-empex-gray">
				<img class=" h-10" src="/images/auth/experience.svg" alt="employee experience">
				<div class="ml-2 md:ml-5 w-full">
					<div class="font-semibold">Experience</div>
					<div class="text-gray-400">Add or change work experience</div>
				</div>
			</a>

			<a href="{{ route('auth.employee.changerequest.transfer') }}"
				class="flex w-full border rounded bg-white shadow p-5 hover:bg-empex-gray">
				<img class=" h-10" src="/images/auth/transfer.svg" alt="employee transfer">
				<div class="ml-2 md:ml-5 w-full">
					<div class="font-semibold">Transfer</div>
					<div class="text-gray-400">Transfer your employment card to another region</div>
				</div>
			</a>
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
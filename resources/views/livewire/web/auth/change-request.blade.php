<div>
	{{-- {{dd($info)}} --}}
	@if ($info && $info->canEdit == 0 && $info->status != 'Approved')
	<div class="w-full md:border md:bg-white md:rounded md:px-5 md:py-16 py-5 text-center">
		<img src="/images/auth/submitted.svg" alt="approved" class="mx-auto">
		<div class="font-semibold mt-7 text-xl">Application submitted</div>
		<div class="mb-7 text-gray-400 mt-3">The application is still ongoing. You can find it on the ongoing applications
			page</div>
		<a href="{{ route('auth.enrollment.status') }}"
			class="uppercase border border-empex-green text-empex-green hover:bg-empex-gray py-1 px-5 rounded text-center">
			ongoing application</a>
	</div>
	@elseif ($card && !$canSubmit)
	{{-- @elseif ($info && $info->canEdit == 0 && $info->status == 'Approved') --}}
	<div class="w-full md:border md:bg-white md:rounded md:px-5 md:py-16 py-5 text-center">
		<img src="/images/auth/approved.svg" alt="approved" class="mx-auto">
		<div class="font-semibold mt-7 text-xl">Congratulations</div>
		<div class="mb-7 text-gray-400 mt-3">Your application has been approved. You can now view your Employment
			Registration card</div>
		<a href="{{ route('auth.enrollment.card') }}"
			class="uppercase border border-empex-green text-empex-green hover:bg-empex-gray py-1 px-5 rounded text-center">VIEW
			CARD</a>
	</div>
	@else
	<div class="{{ $step != 6 ? 'md:bg-white md:shadow md:rounded md:border' : '' }}">
		<div>
			<div>
				<div class="border-b-2 py-4 md:px-10">
					@if ($step <= 5) <div class="uppercase tracking-wide text-xs font-bold text-gray-500 mb-1 leading-tight">Step
						{{ $step }} of 5
				</div>
				@endif
				<div class="flex flex-col md:flex-row md:items-center md:justify-between">
					<div class="flex-1">
						@if ($step == 1)
						<div class="text-lg font-bold text-gray-700 leading-tight">Basic Information</div>
						@elseif ($step == 2)
						<div class="text-lg font-bold text-gray-700 leading-tight">Address</div>
						@elseif ($step == 3)
						<div class="text-lg font-bold text-gray-700 leading-tight">Education Details</div>
						@elseif ($step == 4)
						<div class="text-lg font-bold text-gray-700 leading-tight">Experience</div>
						@elseif ($step == 5)
						<div class="text-lg font-bold text-gray-700 leading-tight">National Classification of Occupation (NCO)
						</div>
						@else
						<div class="text-lg font-bold text-gray-700 leading-tight">Confirmation</div>
						@endif
					</div>

					@if ($step <= 5) <div class="flex items-center md:w-64">
						<div class="w-full bg-white rounded-full mr-2">
							<div class="rounded-full bg-empex-green text-xs leading-none h-2 text-center text-white"
								:style="'width: '+ parseInt({{ $step }} / 5 * 100) +'%'"></div>
						</div>
						<div class="text-xs w-10 text-gray-600" x-text="parseInt({{ $step }} / 5 * 100) +'%'"></div>
						@endif
				</div>
			</div>
		</div>

		<div class="pt-5 md:pt-10">
			@if ($step == 1)
			@livewire('web.auth.basic-info')
			@elseif ($step == 2)
			@livewire('web.auth.permanent-address')
			@elseif ($step == 3)
			@livewire('web.auth.education-detail')
			@elseif ($step == 4)
			@livewire('web.auth.experience')
			@elseif ($step == 5)
			@livewire('web.auth.nco-selection')
			@else
			@livewire('web.auth.employee-detail', ['type' => 'registration'])
			@endif
		</div>
	</div>
	@endif
</div>

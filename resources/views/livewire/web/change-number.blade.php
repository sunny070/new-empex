<div>
	@if ($step == 1)
	<div class="flex justify-between">
		<div>
			Jobseeker Detail
		</div>
		<div class="text-xs">
			Step {{ $step }} of 2
		</div>
	</div>
	<div class="w-full relative my-3">
		<input type="text"
			class="w-full input border-gray-400 rounded text-base text-gray-500 focus:text-empex-green focus:border-green-600 focus:outline-none focus:ring-green-600"
			placeholder="Employment No*" wire:model.lazy='employmentNo' required />
		<label class="tracking-wide text-gray-500 text-xs label">
			Employment No*
		</label>
		<div class="text-left">
			@error('employmentNo') <span class="text-sm text-empex-red">{{ $message }}</span> @enderror
		</div>
	</div>

	<div class="w-full relative my-3">
		<input type="text"
			class="w-full input border-gray-400 rounded text-base text-gray-500 focus:text-empex-green focus:border-green-600 focus:outline-none focus:ring-green-600"
			placeholder="Name*" wire:model.lazy='name' required />
		<label class="tracking-wide text-gray-500 text-xs label">
			Name*
		</label>
		<div class="text-left">
			@error('name') <span class="text-sm text-empex-red">{{ $message }}</span> @enderror
		</div>
	</div>

	<div class="w-full relative my-3">
		<input type="text"
			class="w-full input border-gray-400 rounded text-base text-gray-500 focus:text-empex-green focus:border-green-600 focus:outline-none focus:ring-green-600"
			placeholder="Parent's Name*" wire:model.lazy='parentName' required />
		<label class="tracking-wide text-gray-500 text-xs label">
			Parent's Name*
		</label>
		<div class="text-left">
			@error('parentName') <span class="text-sm text-empex-red">{{ $message }}</span> @enderror
		</div>
	</div>

	<div class="w-full relative my-3">
		<input type="date"
			class="w-full input border-gray-400 rounded text-base text-gray-500 focus:text-empex-green focus:border-green-600 focus:outline-none focus:ring-green-600"
			placeholder="Date of Birth*" wire:model.lazy='dob' required />
		<label class="tracking-wide text-gray-500 text-xs label">
			Date of Birth*
		</label>
		<div class="text-left">
			@error('dob') <span class="text-sm text-empex-red">{{ $message }}</span> @enderror
		</div>
		@if (session()->has('error'))
		<div class="text-left mt-2">
			<span class="text-empex-red">{{ session('error') }}</span>
		</div>
		@endif
	</div>

	<div class="flex justify-between">
		<a class="underline text-gray-600 py-1 hover:text-gray-900" href="{{ route('login') }}">
			{{ __('Back to Login') }}
		</a>
		<button wire:click.prevent='showPhone' wire:loading.attr="disabled" wire:loading.class="bg-gray-400"
			wire:loading.class.remove="bg-empex-green hover:bg-green-500"
			class="uppercase focus:outline-none border border-transparent py-1 px-5 rounded text-center text-white bg-empex-green hover:bg-green-500 font-medium">
			<span wire:loading.remove wire:target='showPhone'>
				Validate
			</span>

			<span wire:loading wire:target='showPhone'>
				Validating...
			</span>
		</button>
	</div>
	@else
	<div class="flex justify-between">
		<div>
			New Contact Number
		</div>
		<div class="text-xs">
			Step {{ $step }} of 2
		</div>
	</div>
	<div class="w-full relative my-3">
		<input type="number" {{ $showOtp==true ? 'disabled' : '' }} autofocus
			class="w-full input border-gray-400 rounded text-base text-gray-500 focus:text-empex-green focus:border-green-600 focus:outline-none focus:ring-green-600 {{ $showOtp==true ? 'bg-gray-100 cursor-not-allowed' : '' }}"
			placeholder="10 digits mobile number*" wire:model.lazy='mobileNo' required />
		<label class="tracking-wide text-gray-500 text-xs label">
			Mobile Number*
		</label>
		<div class="text-left">
			@error('mobileNo') <span class="text-sm text-empex-red">{{ $message }}</span> @enderror
		</div>
	</div>

	@if ($showOtp)
	<div class="w-full relative my-3">
		<input
			class="w-full input rounded border-gray-400 text-base text-gray-500 focus:text-empex-green focus:border-green-600 focus:outline-none focus:ring-green-600"
			{{ $showOtp==true ? 'autofocus' : '' }} type="number" placeholder="OTP*" wire:model.lazy='otp' />
		<label class="tracking-wide text-gray-500 text-xs label" for="phone">
			OTP*
		</label>
		<div class="text-left">
			@error('otp') <span class="text-sm text-empex-red">{{ $message }}</span> @enderror
		</div>
		@if (session()->has('otpError'))
		<div class="text-left">
			<span class="text-sm text-empex-red">{{ session('otpError') }}</span>
		</div>
		@endif
	</div>
	@endif

	@if (!$showOtp)
	<button type="submit" wire:click.prevent='requestOtp' wire:loading.attr="disabled"
		class="w-full focus:outline-none border border-transparent py-1 px-5 rounded text-center text-white bg-empex-green hover:bg-green-500 font-medium">
		<span class="ml-3" wire:loading wire:target='requestOtp'>
			Request OTP...
		</span>

		<span class="ml-3" wire:loading.remove wire:target='requestOtp'>
			Request OTP
		</span>
	</button>
	@else
	<button type="submit" wire:click.prevent='submit' wire:loading.attr="disabled"
		class="w-full focus:outline-none border border-transparent py-1 px-5 rounded text-center text-white bg-empex-green hover:bg-green-500 font-medium">
		<span class="ml-3" wire:loading wire:target='submit'>
			Login...
		</span>

		<span class="ml-3" wire:loading.remove wire:target='submit'>
			Login
		</span>
	</button>
	@endif

	@endif

	{{-- <div class="mt-5">
		Already Registered?

	</div> --}}
</div>

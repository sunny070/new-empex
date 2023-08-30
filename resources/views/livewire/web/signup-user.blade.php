<form>
	<div>Register to jobseeker</div>
	<div class="w-full relative mt-3">
		<input {{ $showOtp==true ? 'disabled' : '' }}
			class="w-full {{ $showOtp==true ? 'bg-gray-100 cursor-not-allowed' : '' }} input border-gray-400 rounded text-base text-gray-500 focus:text-empex-green focus:border-green-600 focus:outline-none focus:ring-green-600"
			type="text" placeholder="Full Name*" wire:model.lazy='name' value="{{ old('name') }}" {{ $showOtp==false
			? 'autofocus' : '' }} />
		<label class="tracking-wide text-gray-500 text-xs label" for="fullname">
			Full Name*
		</label>
		<div class="text-left">
			@error('name') <span class="text-sm text-empex-red">{{ $message }}</span> @enderror
		</div>
	</div>

	<div class="w-full relative mt-5">
		<input {{ $showOtp==true ? 'disabled' : '' }}
			class="w-full {{ $showOtp==true ? 'bg-gray-100 cursor-not-allowed' : '' }} input border-gray-400 rounded text-base text-gray-500 focus:text-empex-green focus:border-green-600 focus:outline-none focus:ring-green-600"
			type="number" placeholder="10 digits Mobile Number*" wire:model.lazy='mobile_no' />
		<label class="tracking-wide text-gray-500 text-xs label">
			Mobile Number*
		</label>
		<div class="text-left">
			@error('mobile_no') <span class="text-sm text-empex-red">{{ $message }}</span> @enderror
		</div>
	</div>

	@if ($showOtp)
	<div class="w-full relative mt-5">
		<input
			class="w-full input border-gray-400 rounded text-base text-gray-500 focus:text-empex-green focus:border-green-600 focus:outline-none focus:ring-green-600"
			type="text" placeholder="OTP*" wire:model.lazy='otp' {{ $showOtp==true ? 'autofocus' : '' }} />
		<label class="tracking-wide text-gray-500 text-xs label">
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

	@if ($showResendTimer)
	<div id="timerContainer" class="text-gray-500 mt-2">Resend OTP in <span id='timer' class="text-black"></span>
		Secs</div>
	@endif

	@if ($showResendLink)
	<button type="button" wire:click='resendOTP' id="resend" class="underline text-empex-green mt-2 float-right">Resend
		OTP</button>
	@endif

	<button type="submit" wire:click.prevent='loginUserUsingPhoneAndOtp' wire:loading.attr="disabled"
		class="mt-5 w-full focus:outline-none border border-transparent py-1 px-5 rounded text-center text-white bg-empex-green hover:bg-green-500 font-medium">
		<span class="ml-3" wire:loading wire:target='loginUserUsingPhoneAndOtp'>
			Verify OTP...
		</span>

		<span class="ml-3" wire:loading.remove wire:target='loginUserUsingPhoneAndOtp'>
			Verify OTP
		</span>
	</button>
	@else
	<button type="submit" wire:click.prevent='registerUsingPhone' wire:loading.attr="disabled"
		class="mt-5 w-full focus:outline-none border border-transparent py-1 px-5 rounded text-center text-white bg-empex-green hover:bg-green-500 font-medium">
		<span class="ml-3" wire:loading wire:target='registerUsingPhone'>
			Signup...
		</span>

		<span class="ml-3" wire:loading.remove wire:target='registerUsingPhone'>
			Signup
		</span>
	</button>
	@endif

	<div class="mt-5">
		Already Registered?
		<a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
			{{ __('Login') }}
		</a>
	</div>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
	@if ($showResendTimer)
	<script>
		var count = 60, timer = setInterval(function() {
				if(count == 0) {
					clearInterval(timer);
					livewire.emit('showLink')
				}
				$("#timer").html(count--);
			}, 1000);
	</script>
	@endif

	<script>
		document.addEventListener("livewire:load", function (event) {
				@this.on('resend', function () {
					var count = 60, timer = setInterval(function() {
						if(count == 0) {
							clearInterval(timer);
							livewire.emit('showLink')
						}
						$("#timer").html(count--);
					}, 1000);
				});
			});
	</script>
</form>
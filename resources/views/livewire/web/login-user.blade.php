<form>
	<div>Login as jobseeker</div>
	<div class="w-full relative mt-3">
		<input {{ $showOtp==true ? 'disabled' : '' }}
			class="w-full input rounded {{ $showOtp == true ? 'bg-gray-100 cursor-not-allowed' : '' }} border-gray-400 text-base text-gray-500 focus:text-empex-green focus:border-green-600 focus:outline-none focus:ring-green-600"
			type="number" placeholder="10 digits Mobile No.*" wire:model.lazy='mobile_no' {{ $showOtp==true ? '' : 'autofocus'
			}} />
		<label class="tracking-wide text-gray-500 text-xs label" for="phone">
			Mobile Number*
		</label>
		<div class="text-left">
			@error('mobile_no') <span class="text-sm text-empex-red">{{ $message }}</span> @enderror
		</div>
		@if (session()->has('error'))
		<div class="text-left">
			<span class="text-sm text-empex-red">{{ session('error') }}</span>
		</div>
		@endif
	</div>

	@if ($showOtp)
	<div class="w-full relative mt-3">
		<input
			class="w-full input rounded border-gray-400 text-base text-gray-500 focus:text-empex-green focus:border-green-600 focus:outline-none focus:ring-green-600"
			type="number" placeholder="OTP*" wire:model.lazy='otp' {{ $showOtp==true ? 'autofocus' : '' }} />
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
	<button type="submit" wire:click.prevent='loginUserUsingPhone' wire:loading.attr="disabled"
		class="mt-5 w-full focus:outline-none border border-transparent py-1 px-5 rounded text-center text-white bg-empex-green hover:bg-green-500 font-medium">
		<span class="ml-3" wire:loading wire:target='loginUserUsingPhone'>
			Login...
		</span>

		<span class="ml-3" wire:loading.remove wire:target='loginUserUsingPhone'>
			Login
		</span>
	</button>
	@endif

	<div class="mt-5 flex justify-between">
		<a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('signup') }}">
			{{ __('Jobseeker Register') }}
		</a>
		<a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('change-number')}}">
			{{ __('Account Recovery') }}
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

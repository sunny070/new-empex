<div class="mx-auto">
    @if ($step == 1)
        <div class="flex justify-between">
            <div>
                Organization Detail
            </div>
            <div class="text-xs">
                Step {{ $step }} of 3
            </div>
        </div>
        <div>
            <div class="w-full relative my-5">
                <select wire:model.lazy='organizationCategory'
                    class="w-full input border-gray-400 rounded text-base text-gray-500 focus:text-empex-green focus:border-green-600 focus:outline-none focus:ring-green-600">
                    <option value="">Select Category</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
                <label class="tracking-wide text-gray-500 text-xs label" for="category">
                    Organization Category*
                </label>
                @error('organizationCategory')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="w-full relative my-5">
                <select wire:model.lazy='organizationType'
                    class="w-full input border-gray-400 rounded text-base text-gray-500 focus:text-empex-green focus:border-green-600 focus:outline-none focus:ring-green-600">
                    <option value="">Select Type</option>
                    @foreach ($types as $tp)
                        <option value="{{ $tp->id }}">{{ $tp->name }}</option>
                    @endforeach
                </select>
                <label class="tracking-wide text-gray-500 text-xs label">
                    Organization Type*
                </label>
                @error('organizationType')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            @if ($organizationCategory == 3)
                <div class="w-full relative my-5">
                    <select wire:model.lazy='departmentName'
                        class="w-full input border-gray-400 rounded text-base text-gray-500 focus:text-empex-green focus:border-green-600 focus:outline-none focus:ring-green-600">
                        <option value="">Select Department</option>
                        @foreach ($departments as $dept)
                            <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                        @endforeach
                    </select>
                    <label class="tracking-wide text-gray-500 text-xs label">
                        Department Name*
                    </label>
                    @error('departmentName')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
            @else
                <div class="w-full relative my-5">
                    <input
                        class="w-full input border-gray-400 rounded text-base text-gray-500 focus:text-empex-green focus:border-green-600 focus:outline-none focus:ring-green-600"
                        type="text" placeholder="Organization Name*" wire:model.lazy='organizationName' required />
                    <label class="tracking-wide text-gray-500 text-xs label">
                        Organization Name*
                    </label>
                    <div class="text-left">
                        @error('organizationName')
                            <span class="text-sm text-empex-red">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            @endif

            <div class="w-full relative my-5">
                <select wire:model.lazy='sector'
                    class="w-full input border-gray-400 rounded text-base text-gray-500 focus:text-empex-green focus:border-green-600 focus:outline-none focus:ring-green-600">
                    <option value="">Select Sector</option>
                    @foreach ($sectors as $sect)
                        <option value="{{ $sect->id }}">{{ $sect->name }}</option>
                    @endforeach
                </select>
                <label class="tracking-wide text-gray-500 text-xs label" for="sector">
                    Sector*
                </label>
                @error('sector')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="flex justify-end">
            <button wire:click.prevent='continueToStep2' wire:loading.attr="disabled" wire:loading.class="bg-gray-400"
                wire:loading.class.remove="bg-empex-green hover:bg-green-500"
                class="uppercase focus:outline-none border border-transparent py-1 px-5 rounded text-center text-white bg-empex-green hover:bg-green-500 font-medium">
                <span wire:loading.remove wire:target='continueToStep2'>
                    Next
                </span>

                <span wire:loading wire:target='continueToStep2'>
                    Saving...
                </span>
            </button>
        </div>
    @elseif ($step == 2)
        <div class="flex justify-between">
            <div>
                Organization Address
            </div>
            <div class="text-xs">
                Step {{ $step }} of 3
            </div>
        </div>
        <div>
            <div class="w-full relative my-5">
                <input
                    class="w-full input border-gray-400 rounded text-base text-gray-500 focus:text-empex-green focus:border-green-600 focus:outline-none focus:ring-green-600"
                    type="text" placeholder="Address 1*" wire:model.lazy='address1' required />
                <label class="tracking-wide text-gray-500 text-xs label">
                    Address 1*
                </label>
                <div class="text-left">
                    @error('address1')
                        <span class="text-sm text-empex-red">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="w-full relative my-5">
                <input
                    class="w-full input border-gray-400 rounded text-base text-gray-500 focus:text-empex-green focus:border-green-600 focus:outline-none focus:ring-green-600"
                    type="text" placeholder="Address 2" wire:model.lazy='address2' />
                <label class="tracking-wide text-gray-500 text-xs label">
                    Address 2
                </label>
                <div class="text-left">
                    @error('address2')
                        <span class="text-sm text-empex-red">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="w-full relative my-5" wire:key='state'>
                <select wire:model.lazy='state'
                    class="w-full input border-gray-400 rounded text-base text-gray-500 focus:text-empex-green focus:border-green-600 focus:outline-none focus:ring-green-600">
                    <option value="">Select State</option>
                    @foreach ($allStates as $st)
                        <option value="{{ $st->id }}">{{ $st->name }}</option>
                    @endforeach
                </select>
                <label class="tracking-wide text-gray-500 text-xs label">
                    State*
                </label>
                @error('state')
                    <p class="text-empex-red text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            @if ($state == 1)

                <div class="w-full relative my-5" wire:key='district'>
                    <select wire:model.lazy='district'
                        class="w-full input border-gray-400 rounded text-base text-gray-500 focus:text-empex-green focus:border-green-600 focus:outline-none focus:ring-green-600">
                        <option value="">Select District</option>
                        @foreach ($allDistricts as $dstc)
                            <option value="{{ $dstc->id }}">{{ $dstc->name }}</option>
                        @endforeach
                    </select>
                    <label class="tracking-wide text-gray-500 text-xs label" for="district">
                        District*
                    </label>
                    @error('district')
                        <p class="text-empex-red text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
            @else
                <div class="w-full relative my-5">
                    <input
                        class="w-full input border-gray-400 rounded text-base text-gray-500 focus:text-empex-green focus:border-green-600 focus:outline-none focus:ring-green-600"
                        type="text" placeholder="District*" wire:model.lazy='districtName' />
                    <label class="tracking-wide text-gray-500 text-xs label">
                        District
                    </label>
                    <div class="text-left">
                        @error('districtName')
                            <span class="text-sm text-empex-red">{{ $message }}</span>
                        @enderror
                    </div>
                </div>


            @endif

            <div class="w-full relative my-5">
                <input type="number"
                    class="w-full input border-gray-400 rounded text-base text-gray-500 focus:text-empex-green focus:border-green-600 focus:outline-none focus:ring-green-600"
                    placeholder="Pincode*" wire:model.lazy='pincode' required />
                <label class="tracking-wide text-gray-500 text-xs label">
                    Pincode*
                </label>
                <div class="text-left">
                    @error('pincode')
                        <span class="text-sm text-empex-red">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="flex justify-between">
            <button wire:click.prevent='backToStep1'
                class="uppercase focus:outline-none py-1 border-empex-green px-5 rounded text-center text-empex-green bg-white hover:bg-gray-100 font-medium border">Back</button>

            <button wire:click.prevent='continueToStep3' wire:loading.attr="disabled"
                wire:loading.class="bg-gray-400" wire:loading.class.remove="bg-empex-green hover:bg-green-500"
                class="uppercase focus:outline-none border border-transparent py-1 px-5 rounded text-center text-white bg-empex-green hover:bg-green-500 font-medium">
                <span wire:loading.remove wire:target='continueToStep3'>
                    Next
                </span>

                <span wire:loading wire:target='continueToStep3'>
                    Saving...
                </span>
            </button>
        </div>
    @elseif ($step == 3)
        <div class="flex justify-between">
            <div>
                User Detail
            </div>
            <div class="text-xs">
                Step {{ $step }} of 3
            </div>
        </div>
        <div>
            <div class="w-full my-5 flex justify-between">
                <div>
                    <label class="tracking-wide text-gray-500 text-xs font-semibold" for="certificate">
                        Photo (Max 2MB)*
                    </label>
                    <input wire:model.lazy='image'
                        class="w-full border-gray-400 text-base text-gray-500 focus:text-empex-green focus:border-green-600 focus:outline-none focus:ring-green-600"
                        type="file" placeholder="Image*" accept="image/*">
                    @error('image')
                        <p class="text-empex-red text-sm">{{ $message }}</p>
                    @enderror
                </div>
                @if ($image)
                    <div>
                        <img src="{{ $image->temporaryUrl() }}" alt="user image" class=" h-12 w-12" />
                    </div>
                @endif
            </div>

            <div class="w-full relative my-5">
                <input
                    class="w-full input border-gray-400 rounded text-base text-gray-500 focus:text-empex-green focus:border-green-600 focus:outline-none focus:ring-green-600"
                    type="text" placeholder="Full Name*" wire:model.lazy='name' required />
                <label class="tracking-wide text-gray-500 text-xs label">
                    Full Name*
                </label>
                <div class="text-left">
                    @error('name')
                        <span class="text-sm text-empex-red">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="w-full relative my-5">
                <input
                    class="w-full input border-gray-400 rounded text-base text-gray-500 focus:text-empex-green focus:border-green-600 focus:outline-none focus:ring-green-600"
                    type="email" placeholder="Email*" wire:model.lazy='email' required />
                <label class="tracking-wide text-gray-500 text-xs label">
                    Email*
                </label>
                <div class="text-left">
                    @error('email')
                        <span class="text-sm text-empex-red">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="w-full relative my-5">
                <input type="number"
                    class="w-full input border-gray-400 rounded text-base text-gray-500 focus:text-empex-green focus:border-green-600 focus:outline-none focus:ring-green-600"
                    placeholder="Contact Number*" wire:model.lazy='contactNo' required />
                <label class="tracking-wide text-gray-500 text-xs label">
                    Contact Number*
                </label>
                <div class="text-left">
                    @error('contactNo')
                        <span class="text-sm text-empex-red">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="w-full relative my-5">
                <input wire:model.lazy='password'
                    class="w-full input border-gray-400 rounded text-base text-gray-500 focus:text-empex-green focus:border-green-600 focus:outline-none focus:ring-green-600"
                    type="password" placeholder="Password*" required />
                <label class="tracking-wide text-gray-500 text-xs label">
                    Password*
                </label>
                <div class="text-left">
                    @error('password')
                        <span class="text-sm text-empex-red">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            {{-- @if ($organizationCategory == 3)
		<div class="w-full relative my-5">
			<label class="tracking-wide text-gray-500 text-xs">
				Office Order*
			</label>
			<input
				class="w-full input border-gray-400 rounded text-base text-gray-500 focus:text-empex-green focus:border-green-600 focus:outline-none focus:ring-green-600"
				type="file" wire:model.lazy='officeOrder' required />
			<div class="text-left">
				@error('officeOrder') <span class="text-sm text-empex-red">{{ $message }}</span> @enderror
			</div>
		</div>
		@else
		<div class="w-full relative my-5">
			<input
				class="w-full input border-gray-400 rounded text-base text-gray-500 focus:text-empex-green focus:border-green-600 focus:outline-none focus:ring-green-600"
				type="number" placeholder="Aadhaar*" wire:model.lazy='aadhaar' required />
			<label class="tracking-wide text-gray-500 text-xs label">
				Aadhaar*
			</label>
			<div class="text-left">
				@error('aadhaar') <span class="text-sm text-empex-red">{{ $message }}</span> @enderror
			</div>
		</div>
		@endif --}}

            <div class="w-full relative my-5">
                <label class="inline-flex">
                    <input type="checkbox" class="form-checkbox text-empex-green focus:outline-none focus:ring-0"
                        wire:model.lazy='termsAndCondition'>
                    <span class="ml-2 -mt-1">I agree to the <button
                            wire:click="$emit('openModal', 'admin.terms-and-condition')"
                            class="text-empex-green">terms and condition</button> </span>
                </label>
                <div class="text-left">
                    @error('termsAndCondition')
                        <span class="text-sm text-empex-red">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <div class="flex justify-between">
            <button wire:click.prevent='backToStep2'
                class="uppercase focus:outline-none py-1 border-empex-green px-5 rounded text-center text-empex-green bg-white hover:bg-gray-100 font-medium border">Back</button>

            <button wire:click.prevent='sendOtp' wire:loading.attr="disabled" wire:loading.class="bg-gray-400"
                wire:loading.class.remove="bg-empex-green hover:bg-green-500"
                class="uppercase focus:outline-none border border-transparent py-1 px-5 rounded text-center text-white bg-empex-green hover:bg-green-500 font-medium">
                <span wire:loading.remove wire:target='sendOtp'>
                    Next
                </span>

                <span wire:loading wire:target='sendOtp'>
                    Saving...
                </span>
            </button>
        </div>
    @else
        <div>
            <div class="font-semibold">OTP Confirmation</div>
            <div class="text-xs">please enter the one time pin sent to your provided contact no!</div>
        </div>
        <div class="w-full relative my-5">
            <input type="number"
                class="w-full input border-gray-400 rounded text-base text-gray-500 focus:text-empex-green focus:border-green-600 focus:outline-none focus:ring-green-600"
                placeholder="OTP*" wire:model.lazy='otp' required />
            <label class="tracking-wide text-gray-500 text-xs label">
                OTP*
            </label>
            <div class="text-left">
                @error('otp')
                    <span class="text-sm text-empex-red">{{ $message }}</span>
                @enderror
            </div>
            @if (session()->has('otpError'))
                <div class="text-left">
                    <span class="text-sm text-empex-red">{{ session('otpError') }}</span>
                </div>
            @endif
        </div>

        <div class="flex justify-between">
            <button wire:click.prevent='backToStep3'
                class="uppercase focus:outline-none py-1 border-empex-green px-5 rounded text-center text-empex-green bg-white hover:bg-gray-100 font-medium border">Back</button>

            <button wire:click.prevent='submit' wire:loading.attr="disabled" wire:loading.class="bg-gray-400"
                wire:loading.class.remove="bg-empex-green hover:bg-green-500"
                class="uppercase focus:outline-none border border-transparent py-1 px-5 rounded text-center text-white bg-empex-green hover:bg-green-500 font-medium">
                <span wire:loading.remove wire:target='submit'>
                    Register
                </span>

                <span wire:loading wire:target='submit'>
                    Saving...
                </span>
            </button>
        </div>
    @endif

    <div class="mt-5">
        Already Registered?
        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('admin.login') }}">
            {{ __('Login') }}
        </a>
    </div>
</div>

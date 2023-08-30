<x-modal>
    <x-slot name="title">
        <div>
            @if ($step == 1)
                Organization Address
            @else
                User Detail
            @endif
            <span class="text-xs">(Step {{ $step > 2 ? '2' : $step }} of 2)</span>
        </div>
    </x-slot>

    <x-slot name="content">
        @if ($step == 1)
            <div>
                <div class="w-full relative mb-5">
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
        @elseif($step == 2)
            <div>
                <div class="w-full flex justify-between">
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
                    @else
                        <div>
                            <img src="{{ asset('/storage/' .auth()->guard('admin')->user()->profile_photo_path) }}"
                                alt="admin image" class=" h-12 w-12" />
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
                        type="password" placeholder="Password" required />
                    <label class="tracking-wide text-gray-500 text-xs label">
                        Password
                    </label>
                    <div class="text-left">
                        @error('password')
                            <span class="text-sm text-empex-red">{{ $message }}</span>
                        @else
                            <span class="text-sm text-empex-green">leave blank for same password</span>
                        @enderror
                    </div>
                </div>
            </div>
        @else
            <div>
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
            </div>
        @endif
    </x-slot>

    <x-slot name="buttons">
        <div class="flex justify-end">
            @if ($step == 1)
                <x-jet-secondary-button wire:click="$emit('closeModal')">
                    {{ __('Close') }}
                </x-jet-secondary-button>
                <x-jet-button class="ml-2" wire:click="goToStep2" wire:loading.attr="disabled"
                    wire:loading.class='bg-gray-100'>
                    {{ __('Next') }}
                </x-jet-button>
            @elseif($step == 2)
                <x-jet-secondary-button type="submit" wire:click="returnToStep1">
                    {{ __('Back') }}
                </x-jet-secondary-button>
                <x-jet-button class="ml-2" wire:click="save" wire:loading.attr="disabled"
                    wire:loading.class='bg-gray-100'>
                    {{ __('Update') }}
                </x-jet-button>
            @else
                <x-jet-secondary-button type="submit" wire:click="returnToStep2">
                    {{ __('Back') }}
                </x-jet-secondary-button>
                <x-jet-button class="ml-2" wire:click="submit" wire:loading.attr="disabled"
                    wire:loading.class='bg-gray-100'>
                    {{ __('Update') }}
                </x-jet-button>
            @endif
        </div>
    </x-slot>
</x-modal>

@extends('layouts.web.app')

@section('title', 'Renew Enrollment - Empex')

@section('navbar')
    @parent
@endsection

@section('content')
    <div class="w-full py-5">
        <div class="max-w-7xl mx-auto px-4">
            @if (Session('error'))
                <div class="flex flex-col mb-5 bg-white border-empex-yellow shadow border rounded p-2" x-data="{ show: true }"
                    x-show="show" x-init="setTimeout(() => show = false, 6000)">
                    <div class="font-medium leading-none">{{ session('error') }}</div>
                </div>
            @endif

            <div class="w-full">
                <div class=" text-sm font-semibold ml-5 my-3">
                    Enrollment Renew
                </div>
            </div>
            <div class="w-full md:shadow md:bg-white md:rounded md:border md:p-5 grid grid-cols-1 md:grid-cols-3 md:gap-8">
                @livewire('web.enrollment-card')
                <div
                    class="col-span-2 bg-white border rounded shadow p-5 mt-5 md:bg-transparent md:border-0 md:rounded-none md:shadow-none md:p-0 md:mt-0">
                    <div class="grid grid-cols-1 md:grid-cols-2 md:gap-4 gap-1 mt-2">
                        <div class="flex justify-between md:grid grid-cols-1 md:grid-cols-2 gap-1 md:gap-4">
                            <div class="text-gray-400">Full Name</div>
                            <div>{{ $info->full_name }}</div>
                        </div>

                        <div class="flex justify-between md:grid grid-cols-1 md:grid-cols-2 gap-1 md:gap-4">
                            <div class="text-gray-400">Employment ID</div>
                            <div>{{ $info->employment_no }}</div>
                        </div>

                        <div class="flex justify-between md:grid grid-cols-1 md:grid-cols-2 gap-1 md:gap-4">
                            <div class="text-gray-400">Card Valid Till</div>
                            <div class="{{ date('Y-m-d') > $info->card_valid_till ? 'text-empex-red' : '' }}">
                                {{ date('d M Y', strtotime($info->card_valid_till)) }}</div>
                        </div>

                        <div class="flex justify-between md:grid grid-cols-1 md:grid-cols-2 gap-1 md:gap-4">
                            <div class="text-gray-400">Validity Days left</div>
                            <div>{!! $daysLeft !!}</div>

                        </div>
                        @if ($expired)
                            <div class="flex justify-between md:grid grid-cols-1 md:grid-cols-2 gap-1 md:gap-4">
                                <div class="text-gray-400">Renewal Days left</div>
                                <div class="text-empex-red">
                                    {{ $renewalDays > 0 ? $renewalDays : '0' }}</div>
                            </div>
                        @endif


                    </div>

                    <div class="mt-5 md:mt-10 flex justify-between md:justify-start">
                        <button {{ $enableButton == false || $alreadyRenew !== null ? 'disabled' : '' }}
                            @click=" renewDialog = {{($enableButton == false || $alreadyRenew !== null || $gracePeriodOver) ? 'false' : true}} "
                            class="mr-2 uppercase focus:outline-none border border-transparent py-1 px-5 rounded text-center text-white {{ $enableButton == false || $alreadyRenew !== null || $gracePeriodOver ? 'bg-gray-400 cursor-not-allowed' : 'bg-empex-green hover:bg-green-500' }} font-medium">Renew</button>

                        <a href="{{ route('auth.dashboard') }}"
                            class="ml-2 uppercase focus:outline-none py-1 border-empex-green px-5 rounded text-center text-empex-green bg-white hover:bg-empex-gray font-medium border">Back</a>
                    </div>
                    @if ($alreadyRenew !== null)
                        <div class="text-gray-400 mt-2 md:mt-5">
                            Already requested for Renewal, please check the status on <a
                                href="{{ route('auth.enrollment.status') }}" class="text-empex-green">ongoing
                                application</a>
                        </div>
                    @endif
                    @if ($enableButton == false)
                        <div class="text-gray-400 mt-2 md:mt-5">
                            You can renew your registration after {{ date('dS M Y', strtotime($enableDate)) }}.
                            <div class="text-empex-red">
                                Account will be delete after
                                {{ date('dS M Y', strtotime($info->card_valid_till . '+2 months')) }}, if not
                                renew.
                            </div>
                        </div>
                    @endif



                    @if ($gracePeriodOver == true)
                        <div class="text-gray-400 mt-2 md:mt-5">

                            <div class="text-empex-red">
                                <div>{!! $periodOverMsg !!}</div>
                            </div>
                        </div>
                    @endif



                    @if ($expired == true && !$gracePeriodOver)
                        <div class="text-gray-400 mt-2 md:mt-5">

                            <div class="text-empex-red">
                                <span class="text-empex-red">Your Card has expired. Kindly renew within 3 months</span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="w-full shadow bg-white rounded border p-5 mt-5">
                <div class="text-gray-400 mb-5">Want to change education details, work experience etc? Go to the change
                    request
                    page
                </div>
                <a href="{{ route('auth.employee.changerequest') }}"
                    class="uppercase focus:outline-none border border-empex-green py-1 px-5 rounded text-center text-empex-green bg-white hover:bg-empex-gray">change
                    request</a>
            </div>
        </div>
    </div>

    <div class="fixed inset-0 w-full h-full z-20 bg-black bg-opacity-50 duration-300 overflow-y-auto" x-show="renewDialog"
        x-transition:enter="transition duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition duration-300"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
        <div class="relative sm:w-3/4 md:w-1/2 lg:w-1/3 mx-2 sm:mx-auto my-10 opacity-100">
            <div class="relative bg-white shadow-lg rounded-md text-gray-900 z-20 h-auto" @click.away="renewDialog = false"
                x-show="renewDialog" x-transition:enter="transition transform duration-300"
                x-transition:enter-start="scale-0" x-transition:enter-end="scale-100"
                x-transition:leave="transition transform duration-300" x-transition:leave-start="scale-100"
                x-transition:leave-end="scale-0">
                <header class="flex items-center justify-between px-5 pt-5">
                    <div class="font-semibold">Are you sure to Renew?</div>
                    <button class="focus:outline-none p-2 float-right" @click="renewDialog = false">
                        <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                            viewBox="0 0 18 18">
                            <path
                                d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                            </path>
                        </svg>
                    </button>
                </header>
                @livewire('web.auth.renew-card')
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

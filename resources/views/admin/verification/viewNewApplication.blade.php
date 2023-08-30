@extends('layouts.admin')
@section('content')
    <div class="py-5" x-cloak x-data="{ rejectDialog: false, verifyDialog: false, ncoDialog: false, ncoEditDialog: false }">
        <div class="max-w-7xl mx-auto px-4">
            {{-- HEADING --}}
            <h6 class="text-gray-600 font-semibold dark:text-gray-200">Verify employee exchange applications</h6>
            <div class="lg:flex items-center justify-between py-4 space-y-2 sm:space-y-4 md:space-y-2 lg:space-y-0">
                <table class="table-auto w-screen">
                    <tbody>
                        <tr>
                            <td>
                                <img class="rounded-full h-24 w-24" src="{{ asset('storage/' . $basicInfo->avatar) }}"
                                    alt="profile picture">
                            </td>
                        </tr>
                        <tr>
                            <td class="text-gray-500 p-2">Basic Information</td>
                        </tr>
                        <tr>
                            <td class="text-gray-600 p-2">Full Name</td>
                            <td class="p-2">{{ $basicInfo->full_name }}</td>
                            <td class="text-gray-600 p-2">Date of Birth</td>
                            <td class="p-2">{{ $basicInfo->dob }}</td>
                        </tr>
                        <tr>
                            <td class="text-gray-600 p-2">Gender</td>
                            <td class="p-2">{{ $basicInfo->gender }}</td>
                            <td class="text-gray-600 p-2">Phone</td>
                            <td class="p-2">{{ $basicInfo->phone_no }}</td>
                        </tr>
                        <tr>
                            <td class="text-gray-600 p-2">Email</td>
                            <td class="p-2">{{ $basicInfo->email }}</td>
                            <td class="text-gray-600 p-2">Ex-servicemen?</td>
                            <td class="p-2">{{ $basicInfo->ex_servicemen == 1 ? 'Yes' : 'No' }}</td>
                        </tr>
                        <tr>
                            <td class="text-gray-600 p-2">Father/Mother</td>
                            <td class="p-2">{{ $basicInfo->parents_name }}</td>
                            <td class="text-gray-600 p-2">Marital Status</td>
                            <td class="p-2">{{ $basicInfo->marital_status }}</td>
                        </tr>
                        <tr>
                            <td class="text-gray-600 p-2">Religion</td>
                            <td class="p-2">{{ $basicInfo->religion->name }}</td>
                            <td class="text-gray-600 p-2">Caste</td>
                            <td class="p-2">{{ $basicInfo->caste }}</td>
                        </tr>
                        <tr>
                            <td class="text-gray-600 p-2">Aadhaar</td>
                            <td class="p-2">{{ $basicInfo->aadhar_no }}</td>
                            <td class="text-gray-600 p-2">Language Spoken</td>
                            <td class="p-2">
                                @foreach ($spokenLang as $canSpeak)
                                    {{ $canSpeak->language->name }}@if (!$loop->last)
                                        ,
                                    @endif
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td class="text-gray-600 p-2">Language Read</td>
                            <td class="p-2">
                                @foreach ($readLang as $canRead)
                                    {{ $canRead->language->name }}@if (!$loop->last)
                                        ,
                                    @endif
                                @endforeach
                            </td>
                            <td class="text-gray-600 p-2">Language Write</td>
                            <td class="p-2">
                                @foreach ($writeLang as $canWrite)
                                    {{ $canWrite->language->name }}@if (!$loop->last)
                                        ,
                                    @endif
                                @endforeach
                            </td>
                        </tr>
                        <tr class="border-t-2 border-b-2">
                            <td class="text-gray-500 p-2">Physically Challenged</td>
                            <td class="p-2"> {{ count($physicalList) > 0 ? 'Yes' : 'No' }} </td>
                        </tr>
                        {{-- @foreach ($addresses as $address)
                            <tr>
                                <td class="text-gray-500 p-2">
                                    {{ ucfirst($address->type) }} Address
                                </td>
                            </tr>
                            <tr>
                                <td class="text-gray-600 p-2">State</td>
                                <td class="p-2">{{ $address->state->name }}</td>
                                <td class="text-gray-600 p-2">District</td>
                                <td class="p-2">{{ $address->district->name }}</td>
                            </tr>
                            <tr>
                                <td class="text-gray-600 p-2">City/Village</td>
                                <td class="p-2">{{ $address->village }}</td>
                                <td class="text-gray-600 p-2">RD Block</td>
                                @if ($address->rdBlock)
                                    <td class="p-2">{{ $address->rdBlock->name }}</td>
                                @endif
                            </tr>
                            <tr>
                                <td class="text-gray-600 p-2">Police Station</td>
                                <td class="p-2">{{ $address->policeStation->name }}</td>
                                <td class="text-gray-600 p-2">Post Office</td>
                                <td class="p-2">{{ $address->postOffice?->name }}</td>
                            </tr>
                            <tr>
                                <td class="text-gray-600 p-2">PIN Code</td>
                                <td class="p-2">{{ $address->pin_code }}</td>
                                <td class="text-gray-600 p-2">House No.</td>
                                <td class="p-2">{{ $address->house_no }}</td>
                            </tr>
                            <tr>
                                <td></td>
                            </tr>
                        @endforeach --}}
                        {{-- added rj --}}

                        {{-- Permanent Address --}}
                        @if (!empty($permanentAddress))
                            <tr>
                                <td class="text-gray-500 p-2">
                                    Permanent Address
                                </td>
                            </tr>
                            <tr>
                                <td class="text-gray-600 p-2">State</td>
                                <td class="p-2">{{ $permanentAddress?->state?->name }}</td>
                                <td class="text-gray-600 p-2">District</td>
                                <td class="p-2">{{ $permanentAddress?->district?->name }}</td>
                            </tr>
                            <tr>
                                <td class="text-gray-600 p-2">City/Village</td>
                                <td class="p-2">{{ $permanentAddress?->village }}</td>
                                <td class="text-gray-600 p-2">RD Block</td>
                                @if ($permanentAddress?->rdBlock)
                                    <td class="p-2">{{ $permanentAddress?->rdBlock->name }}</td>
                                @endif
                            </tr>
                            <tr>
                                <td class="text-gray-600 p-2">Police Station</td>
                                <td class="p-2">{{ $permanentAddress?->policeStation?->name }}</td>
                                <td class="text-gray-600 p-2">Post Office</td>
                                <td class="p-2">{{ $permanentAddress?->postOffice?->name }}</td>
                            </tr>
                            <tr>
                                <td class="text-gray-600 p-2">PIN Code</td>
                                <td class="p-2">{{ $permanentAddress?->pin_code }}</td>
                                <td class="text-gray-600 p-2">House No.</td>
                                <td class="p-2">{{ $permanentAddress?->house_no }}</td>
                            </tr>
                            <tr>
                                <td></td>
                            </tr>
                        @endif



                        {{-- PresentAddress --}}
                        @if (!empty($presentAddress))
                            <tr>
                                <td class="text-gray-500 p-2">
                                    Present Address
                                </td>
                            </tr>
                            <tr>
                                <td class="text-gray-600 p-2">State</td>
                                <td class="p-2">{{ $presentAddress?->state?->name }}</td>
                                <td class="text-gray-600 p-2">District</td>
                                <td class="p-2">{{ $presentAddress?->district?->name }}</td>
                            </tr>
                            <tr>
                                <td class="text-gray-600 p-2">City/Village</td>
                                <td class="p-2">{{ $presentAddress?->village }}</td>
                                <td class="text-gray-600 p-2">RD Block</td>
                                @if ($presentAddress?->rdBlock)
                                    <td class="p-2">{{ $presentAddress?->rdBlock->name }}</td>
                                @endif
                            </tr>
                            <tr>
                                <td class="text-gray-600 p-2">Police Station</td>
                                <td class="p-2">{{ $presentAddress?->policeStation?->name }}</td>
                                <td class="text-gray-600 p-2">Post Office</td>
                                <td class="p-2">{{ $presentAddress?->postOffice?->name }}</td>
                            </tr>
                            <tr>
                                <td class="text-gray-600 p-2">PIN Code</td>
                                <td class="p-2">{{ $presentAddress?->pin_code }}</td>
                                <td class="text-gray-600 p-2">House No.</td>
                                <td class="p-2">{{ $presentAddress?->house_no }}</td>
                            </tr>
                            <tr>
                                <td></td>
                            </tr>
                        @endif
                        {{-- added rj --}}


                    </tbody>
                </table>
            </div>
            <div class="lg:flex items-center justify-between py-4 space-y-2 sm:space-y-4 md:space-y-2 lg:space-y-0">
                <table class="table-auto w-screen">
                    <tbody>
                        <tr class="border-t-2">
                            <td colspan="8" class="text-gray-500 p-2">Education Qualifications</td>
                        </tr>
                        <tr>
                            <td class="text-gray-600 p-2">#</td>
                            <td class="text-gray-600 p-2">Qualification</td>
                            <td class="text-gray-600 p-2">Board/University</td>
                            <td class="text-gray-600 p-2">Subject</td>
                            <td class="text-gray-600 p-2">Major/Core</td>
                            <td class="text-gray-600 p-2">Division/Rank</td>
                            <td class="text-gray-600 p-2">Passing Year</td>
                            <td class="text-gray-600 p-2">Duration</td>
                            <td class="text-gray-600 p-2">Document</td>
                        </tr>
                        @foreach ($qualifications as $key => $qualification)
                            <tr>
                                <td class="p-2">{{ $key + 1 }}</td>
                                <td class="p-2">
                                    {{ $qualification->qualification != null ? $qualification->qualification->name : '-' }}
                                </td>
                                <td class="p-2">{{ $qualification->school }}</td>
                                <td class="p-2">
                                    {{ $qualification->subject != null ? $qualification->subject->name : $qualification?->custom_subject ?? '-' }}
                                </td>
                                <td class="p-2">
                                    {{ $qualification->majorCore != null ? $qualification->majorCore->name : $qualification?->custom_major_core ?? '-' }}
                                </td>
                                {{-- added rj --}}

                                {{-- added rj --}}



                                <td class="p-2">{{ $qualification->division }}</td>
                                <td class="p-2">{{ $qualification->year_of_passing }}</td>
                                <td class="p-2">{{ $qualification->duration }}</td>
                                <td class="p-2">
                                    @if ($qualification->certificate != null)
                                        <a target="_blank"
                                            href="{{ asset('storage/' . $qualification->certificate) }}">View</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="lg:flex items-center justify-between py-4 space-y-2 sm:space-y-4 md:space-y-2 lg:space-y-0">
                <table class="table-auto w-screen">
                    <tbody>
                        <tr class="border-t-2">
                            <td colspan="2" class="text-gray-500 p-2">Experience</td>
                            <td>{{ count($experiences) > 0 ? 'Yes' : 'No' }}</td>
                        </tr>
                        @if (count($experiences) > 0)
                            <tr>
                                <td class="text-gray-600 p-2">#</td>
                                <td class="text-gray-600 p-2">Designation</td>
                                <td class="text-gray-600 p-2">From</td>
                                <td class="text-gray-600 p-2">To</td>
                                <td class="text-gray-600 p-2">Department/Company</td>
                                <td class="text-gray-600 p-2">Salary</td>
                                <td class="text-gray-600 p-2">Reason for leaving</td>
                            </tr>
                            @foreach ($experiences as $key => $experience)
                                <tr>
                                    <td class="p-2">{{ $key + 1 }}</td>
                                    <td class="p-2">{{ $experience->designation }}</td>
                                    <td class="p-2">{{ $experience->from }}</td>
                                    <td class="p-2">{{ $experience->to }}</td>
                                    <td class="p-2">{{ $experience->company }}</td>
                                    <td class="p-2">{{ $experience->total_emoluments }}</td>
                                    <td class="p-2">{{ $experience->leave_reason }}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>

            <div class="md:px-6 md:py-4">
                <div class="grid grid-cols-1 md:gap-4 gap-1 mt-2">
                    <div class="flex justify-between md:grid grid-cols-1 md:grid-cols-4 lg:grid-cols-6 gap-1 md:gap-4">
                        <div class="text-gray-400">NCO on card</div>
                        <div class="col-span-4 text-right md:text-left">
                            @if ($ncoCodeToDisplay)
                                <span class="font-semibold">{{ $ncoCodeToDisplay->code }}</span>
                                {{ $ncoCodeToDisplay->name }}
                            @else
                                <span class="font-semibold">No NCO selected</span>
                            @endif
                        </div>
                    </div>

                    <div class="flex justify-between md:grid grid-cols-1 md:grid-cols-4 lg:grid-cols-6 gap-1 md:gap-4">
                        <div class="text-gray-400">NCO Detail</div>
                        <div class="col-span-4 text-right md:text-left">
                            <span class="font-semibold">{{ count($ncoFamilySelected) }}</span> NCO selected
                            <button @click="ncoDialog = true" class="text-empex-green ml-8">
                                view
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex">
                <div class="m-auto">
                    <button @click="verifyDialog = true"
                        class="bg-green-600 hover:bg-green-500 text-white font-semibold hover:text-white py-2 px-4 rounded">
                        Verify
                    </button>
                    <button @click="rejectDialog = true"
                        class="bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded">
                        Reject
                    </button>
                    <a href="{{ route('admin.verify.new.application') }}"
                        class="bg-transparent hover:bg-gray-500 text-gray-700 font-semibold hover:text-white py-3 px-4 border border-gray-500 hover:border-transparent rounded">
                        Back
                    </a>
                </div>
            </div>

            {{-- nco dialog --}}
            <div class="fixed inset-0 w-full h-full z-20 bg-black bg-opacity-50 duration-300 overflow-y-auto"
                x-show="ncoDialog" x-transition:enter="transition duration-300" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="transition duration-300"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                <div class="relative sm:w-3/4 md:w-1/2 lg:w-1/3 mx-2 sm:mx-auto my-10 opacity-100">
                    <div class="relative bg-white shadow-lg rounded-md text-gray-900 z-20 h-70"
                        @click.away="ncoDialog = false" x-show="ncoDialog"
                        x-transition:enter="transition transform duration-300" x-transition:enter-start="scale-0"
                        x-transition:enter-end="scale-100" x-transition:leave="transition transform duration-300"
                        x-transition:leave-start="scale-100" x-transition:leave-end="scale-0">
                        <header class="flex justify-center p-2">
                            NCO Details of Applicant
                        </header>
                        <main class="p-2">
                            @foreach ($ncoFamilySelected as $fmKey => $family)
                                <div class="text-gray-600 font-bold">{{ $fmKey }}</div>
                                @foreach ($family as $fam)
                                    <div
                                        class="{{ $fam['detail'] !== null && $fam['detail']['id'] == $ncoCodeToDisplay->id ? 'font-bold' : '' }}">
                                        @if ($fam['detail'] !== null && $fam['detail']['id'] == $ncoCodeToDisplay->id)
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="h-5 w-5 inline text-empex-green" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                                            </svg>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="h-5 w-5 inline text-empex-green" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                        @endif
                                        {{ $fam['detail']['code'] }} - {{ $fam['detail']['name'] }}
                                    </div>
                                @endforeach
                            @endforeach
                            <hr class="my-3">
                            <div class="text-center">
                                <button
                                    class="bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white py-1 px-4 border border-green-500 hover:border-transparent rounded"
                                    @click="ncoDialog = false, ncoEditDialog = true">Edit</button>

                                <button @click="ncoDialog = false" type="button"
                                    class="bg-transparent hover:bg-gray-500 text-gray-700 font-semibold hover:text-white py-1 px-4 border border-gray-500 hover:border-transparent rounded text-center">Close</button>
                            </div>
                        </main>
                    </div>
                </div>
            </div>

            {{-- noc edit --}}
            <div class="fixed inset-0 w-full h-full z-20 bg-black bg-opacity-50 duration-300 overflow-y-auto"
                x-show="ncoEditDialog" x-transition:enter="transition duration-300" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="transition duration-300"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                <div class="relative w-full md:w-3/4 mx-2 sm:mx-auto my-10 opacity-100">
                    <div class="relative bg-white shadow-lg rounded-md text-gray-900 z-20 h-70"
                        @click.away="ncoEditDialog = false" x-show="ncoEditDialog"
                        x-transition:enter="transition transform duration-300" x-transition:enter-start="scale-0"
                        x-transition:enter-end="scale-100" x-transition:leave="transition transform duration-300"
                        x-transition:leave-start="scale-100" x-transition:leave-end="scale-0">
                        <header class="flex justify-center p-2">
                            NCO Details of Applicant
                        </header>
                        <main class="p-2">
                            @livewire('admin.verify.nco-selection', [$basicInfo->user_id, $basicInfo->id])
                        </main>
                    </div>
                </div>
            </div>

            {{-- verify modal --}}
            <form
                action="{{ route('admin.post.verify.application', [$basicInfo->id, 'Verified', 'admin.verify.new.application']) }}"
                method="post">
                @csrf
                <div class="fixed inset-0 w-full h-full z-20 bg-black bg-opacity-50 duration-300 overflow-y-auto"
                    x-show="verifyDialog" x-transition:enter="transition duration-300"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    x-transition:leave="transition duration-300" x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0">
                    <div class="relative sm:w-3/4 md:w-1/2 lg:w-1/3 mx-2 sm:mx-auto my-10 opacity-100">
                        <div class="relative bg-white shadow-lg rounded-md text-gray-900 z-20 h-70"
                            @click.away="verifyDialog = false" x-show="verifyDialog"
                            x-transition:enter="transition transform duration-300" x-transition:enter-start="scale-0"
                            x-transition:enter-end="scale-100" x-transition:leave="transition transform duration-300"
                            x-transition:leave-start="scale-100" x-transition:leave-end="scale-0">
                            <header class="flex items-center justify-between p-2">
                                Confirm application verification?
                            </header>
                            <main class="p-2 text-center">
                                <textarea placeholder="" name="notes" id="notes" cols="30" rows="3"
                                    class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-green-200 placeholder-green-500 text-sm focus:outline-none focus:border-green-400 focus:bg-white mb-3"></textarea>
                                <button type="submit"
                                    class="bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent rounded">Verify</button>
                                <button @click="verifyDialog = false" type="button"
                                    class="bg-transparent hover:bg-gray-500 text-gray-700 font-semibold hover:text-white py-2 px-4 border border-gray-500 hover:border-transparent rounded text-center">Back</button>
                            </main>
                        </div>
                    </div>
                </div>
            </form>

            {{-- reject modal --}}
            <form
                action="{{ route('admin.post.verify.application', [$basicInfo->id, 'Rejected', 'admin.verify.new.application']) }}"
                method="post">
                @csrf
                <div class="fixed inset-0 w-full h-full z-20 bg-black bg-opacity-50 duration-300 overflow-y-auto"
                    x-show="rejectDialog" x-transition:enter="transition duration-300"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    x-transition:leave="transition duration-300" x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0">
                    <div class="relative sm:w-3/4 md:w-1/2 lg:w-1/3 mx-2 sm:mx-auto my-10 opacity-100">
                        <div class="relative bg-white shadow-lg rounded-md text-gray-900 z-20 h-70"
                            @click.away="rejectDialog = false" x-show="rejectDialog"
                            x-transition:enter="transition transform duration-300" x-transition:enter-start="scale-0"
                            x-transition:enter-end="scale-100" x-transition:leave="transition transform duration-300"
                            x-transition:leave-start="scale-100" x-transition:leave-end="scale-0">
                            <header class="flex items-center justify-between p-2">
                                Confirm application rejection?
                            </header>
                            <main class="p-2 text-center">
                                <textarea placeholder="Rejection Note" name="notes" id="notes" cols="30" rows="3"
                                    class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-red-200 placeholder-red-500 text-sm focus:outline-none focus:border-green-400 focus:bg-white mb-3"></textarea>
                                <button type="submit"
                                    class="bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded">Reject</button>
                                <button @click="rejectDialog = false" type="button"
                                    class="bg-transparent hover:bg-gray-500 text-gray-700 font-semibold hover:text-white py-2 px-4 border border-gray-500 hover:border-transparent rounded text-center">Back</button>
                            </main>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

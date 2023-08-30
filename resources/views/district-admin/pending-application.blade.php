@extends('layouts.district.app')

@section('title', 'District Admin - Dashboard')

@section('navbar')
    @parent
@endsection

@section('content')
    <div class="max-w-7xl mx-auto px-4 my-5 flex">
        <div class="w-full mb-5 md:mb-0">
            <div class="md:flex md:justify-between grid grid-cols-1 justify-start md:px-6 md:py-4 md:mt-5">
                <img src="{{ asset('/storage/' . $basicInfo->avatar) }}" alt="user image"
                    class="rounded-full align-middle border-none order-2 md:order-1 w-32 h-32 mx-auto md:mx-0 mb-5 md:mb-0" />
            </div>

            <div class="md:px-6 md:py-4 border-b border-gray-200">
                <div class="text-gray-500">Basic Information</div>
                <div class="grid grid-cols-1 md:grid-cols-2 md:gap-4 gap-1 mt-2">
                    <div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
                        <div class="text-gray-400">Full Name</div>
                        <div class="font-semibold col-span-2 text-right md:text-left">{{ $basicInfo->full_name }}</div>
                    </div>

                    <div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
                        <div class="text-gray-400">Date of Birth</div>
                        <div class="font-semibold col-span-2 text-right md:text-left">
                            {{ date('d M Y', strtotime($basicInfo->dob)) }}</div>
                    </div>

                    <div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
                        <div class="text-gray-400">Gender</div>
                        <div class="font-semibold col-span-2 text-right md:text-left">{{ $basicInfo->gender }}</div>
                    </div>

                    <div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
                        <div class="text-gray-400">Phone</div>
                        <div class="font-semibold col-span-2 text-right md:text-left">{{ $basicInfo->phone_no }}</div>
                    </div>

                    <div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
                        <div class="text-gray-400">Father/Mother</div>
                        <div class="font-semibold col-span-2 text-right md:text-left">{{ $basicInfo->parents_name }}</div>
                    </div>

                    <div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
                        <div class="text-gray-400">Marital Status</div>
                        <div class="font-semibold col-span-2 text-right md:text-left">{{ $basicInfo->marital_status }}</div>
                    </div>

                    <div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
                        <div class="text-gray-400">Religion</div>
                        <div class="font-semibold col-span-2 text-right md:text-left">{{ $basicInfo->religion->name }}</div>
                    </div>

                    <div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
                        <div class="text-gray-400">Caste</div>
                        <div class="font-semibold col-span-2 text-right md:text-left">{{ $basicInfo->caste }}</div>
                    </div>

                    <div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
                        <div class="text-gray-400">Aadhaar</div>
                        <div class="font-semibold col-span-2 text-right md:text-left">{{ $basicInfo->aadhar_no ?? '-' }}
                        </div>
                    </div>

                    <div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
                        <div class="text-gray-400">Language Spoken</div>
                        <div class="font-semibold col-span-2 text-right md:text-left">{{ $langSpoken }}</div>
                    </div>

                    <div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
                        <div class="text-gray-400">Language Read</div>
                        <div class="font-semibold col-span-2 text-right md:text-left">{{ $langRead }}</div>
                    </div>

                    <div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
                        <div class="text-gray-400">Language Write</div>
                        <div class="font-semibold col-span-2 text-right md:text-left">{{ $langWrite }}</div>
                    </div>
                </div>
            </div>

            <div class="md:px-6 md:py-4 border-b">
                <div class="grid grid-cols-1 md:grid-cols-2 md:gap-8">
                    <div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
                        <div class="text-gray-500">Physical Challenge</div>
                        <div class="font-semibold col-span-2 text-right md:text-left">{{ $physical ?? 'No' }}</div>
                    </div>
                </div>
            </div>

            {{-- <div class="md:px-6 md:py-4 border-b">
      @foreach ($addresses as $address)
      <div class="text-gray-500 {{ $loop->index > 0 ? 'mt-2' : '' }}">{{ ucfirst($address->type) }} Address</div>
      <div class="grid grid-cols-1 md:grid-cols-2 md:gap-4 mt-2">
        <div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
          <div class="text-gray-400">State</div>
          <div class="font-semibold col-span-2 text-right md:text-left">{{ $address->state->name }}</div>
        </div>

        <div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
          <div class="text-gray-400">District</div>
          <div class="font-semibold col-span-2 text-right md:text-left">{{ $address->district->name }}</div>
        </div>

        <div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
          <div class="text-gray-400">City/Village</div>
          <div class="font-semibold col-span-2 text-right md:text-left">{{ $address->village }}</div>
        </div>

        <div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
          <div class="text-gray-400">RD Block</div>
          <div class="font-semibold col-span-2 text-right md:text-left">{{ $address->rdBlock?->name }}</div>
        </div>

        <div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
          <div class="text-gray-400">Police Station</div>
          <div class="font-semibold col-span-2 text-right md:text-left">{{ $address->policeStation?->name }}
          </div>
        </div>

        <div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
          <div class="text-gray-400">Post Office</div>
          <div class="font-semibold col-span-2 text-right md:text-left">{{ $address->postOffice?->name }}
          </div>
        </div>

        <div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
          <div class="text-gray-400">Pincode</div>
          <div class="font-semibold col-span-2 text-right md:text-left">{{ $address->pin_code }}</div>
        </div>

        <div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
          <div class="text-gray-400">House No</div>
          <div class="font-semibold col-span-2 text-right md:text-left">{{ $address->house_no }}</div>
        </div>
      </div>
      @endforeach
    </div> --}}




            <div class="md:px-6 md:py-4 border-b">
                @if (!empty($permanentAddress))
                    <div class="text-gray-500 mb-2">Permanent Address
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 md:gap-4 mt-2">
                        <div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
                            <div class="text-gray-400">State</div>
                            <div class="font-semibold col-span-2 text-right md:text-left">
                                {{ $permanentAddress?->state->name }}
                            </div>
                        </div>

                        <div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
                            <div class="text-gray-400">District</div>
                            <div class="font-semibold col-span-2 text-right md:text-left">
                                {{ $permanentAddress?->district->name }}
                            </div>
                        </div>

                        <div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
                            <div class="text-gray-400">City/Village</div>
                            <div class="font-semibold col-span-2 text-right md:text-left">{{ $permanentAddress?->village }}
                            </div>
                        </div>

                        <div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
                            <div class="text-gray-400">RD Block</div>
                            <div class="font-semibold col-span-2 text-right md:text-left">
                                {{ $permanentAddress?->rdBlock?->name }}
                            </div>
                        </div>

                        <div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
                            <div class="text-gray-400">Police Station</div>
                            <div class="font-semibold col-span-2 text-right md:text-left">
                                {{ $permanentAddress->policeStation?->name }}
                            </div>
                        </div>

                        <div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
                            <div class="text-gray-400">Post Office</div>
                            <div class="font-semibold col-span-2 text-right md:text-left">
                                {{ $permanentAddress->postOffice?->name }}
                            </div>
                        </div>

                        <div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
                            <div class="text-gray-400">Pincode</div>
                            <div class="font-semibold col-span-2 text-right md:text-left">
                                {{ $permanentAddress?->pin_code }}
                            </div>
                        </div>

                        <div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
                            <div class="text-gray-400">House No</div>
                            <div class="font-semibold col-span-2 text-right md:text-left">
                                {{ $permanentAddress?->house_no }}
                            </div>
                        </div>
                    </div>
                @endif

                @if (!empty($presentAddress))
                    <div class="text-gray-500">Present Address
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 md:gap-4 mt-2">
                        <div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
                            <div class="text-gray-400">State</div>
                            <div class="font-semibold col-span-2 text-right md:text-left">
                                {{ $presentAddress?->state->name }}
                            </div>
                        </div>

                        <div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
                            <div class="text-gray-400">District</div>
                            <div class="font-semibold col-span-2 text-right md:text-left">
                                {{ $presentAddress?->district->name }}
                            </div>
                        </div>

                        <div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
                            <div class="text-gray-400">City/Village</div>
                            <div class="font-semibold col-span-2 text-right md:text-left">{{ $presentAddress?->village }}
                            </div>
                        </div>

                        <div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
                            <div class="text-gray-400">RD Block</div>
                            <div class="font-semibold col-span-2 text-right md:text-left">
                                {{ $presentAddress?->rdBlock?->name }}
                            </div>
                        </div>

                        <div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
                            <div class="text-gray-400">Police Station</div>
                            <div class="font-semibold col-span-2 text-right md:text-left">
                                {{ $presentAddress->policeStation?->name }}
                            </div>
                        </div>

                        <div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
                            <div class="text-gray-400">Post Office</div>
                            <div class="font-semibold col-span-2 text-right md:text-left">
                                {{ $presentAddress->postOffice?->name }}
                            </div>
                        </div>

                        <div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
                            <div class="text-gray-400">Pincode</div>
                            <div class="font-semibold col-span-2 text-right md:text-left">{{ $presentAddress?->pin_code }}
                            </div>
                        </div>

                        <div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
                            <div class="text-gray-400">House No</div>
                            <div class="font-semibold col-span-2 text-right md:text-left">{{ $presentAddress?->house_no }}
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <div class="md:px-6 md:py-4 border-b">
                <div class="text-gray-500">Education Details</div>
                <div class="flex flex-col">
                    <div class="overflow-x-auto">
                        <div class="align-middle inline-block min-w-full">
                            <div class="overflow-hidden">
                                <table class="min-w-full">
                                    <thead>
                                        <tr>
                                            <th scope="col"
                                                class="px-1 py-1 text-left text-sm text-gray-400 font-normal">Qualification
                                            </th>
                                            <th scope="col"
                                                class="px-1 py-1 text-left text-sm text-gray-400 font-normal">Subject
                                                /Stream</th>
                                            <th scope="col"
                                                class="px-1 py-1 text-left text-sm text-gray-400 font-normal">Major /Core
                                            </th>
                                            <th scope="col"
                                                class="px-1 py-1 text-left text-sm text-gray-400 font-normal">Board
                                                /University
                                            </th>
                                            <th scope="col"
                                                class="px-1 py-1 text-left text-sm text-gray-400 font-normal">Division
                                                /Rank
                                            </th>
                                            <th scope="col"
                                                class="px-1 py-1 text-left text-sm text-gray-400 font-normal">Year</th>
                                            <th scope="col"
                                                class="px-1 py-1 text-left text-sm text-gray-400 font-normal">Duration</th>
                                            <th scope="col"
                                                class="px-1 py-1 text-left text-sm text-gray-400 font-normal">Document</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($qualifications as $edu)
                                            <tr>
                                                <td class="px-1 py-1 whitespace-nowrap">{{ $edu->qualification->name }}
                                                </td>
                                                <td class="px-1 py-1 whitespace-nowrap">
                                                    {{ $edu->subject !== null ? $edu->subject->name : $edu->custom_subject ?? '-' }}
                                                </td>
                                                <td class="px-1 py-1 whitespace-nowrap">
                                                    {{ $edu->majorCore !== null ? $edu->majorCore->name : $edu->custom_major_core ?? '-' }}
                                                </td>
                                                <td class="px-1 py-1 whitespace-nowrap">{{ $edu->school }}</td>
                                                <td class="px-1 py-1 whitespace-nowrap">{{ $edu->division }}</td>
                                                <td class="px-1 py-1 whitespace-nowrap">{{ $edu->year_of_passing }}</td>
                                                <td class="px-1 py-1 whitespace-nowrap">{{ $edu->course_duration }}</td>
                                                <td class="px-1 py-1 whitespace-nowrap text-empex-green">
                                                    @if ($edu->certificate != null)
                                                        <a target="_blank"
                                                            href="{{ asset('storage/' . $edu->certificate) }}">View</a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="md:px-6 md:py-4 border-b">
                <div class="text-gray-500">Experience</div>
                <div class="flex flex-col">
                    <div class="overflow-x-auto">
                        <div class="align-middle inline-block min-w-full">
                            <div class="overflow-hidden">
                                <table class="min-w-full">
                                    <thead>
                                        <tr>
                                            <th class="px-1 py-1 text-left text-sm font-normal text-gray-400">Designation
                                            </th>
                                            <th class="px-1 py-1 text-left text-sm font-normal text-gray-400">From</th>
                                            <th class="px-1 py-1 text-left text-sm font-normal text-gray-400">To</th>
                                            <th class="px-1 py-1 text-left text-sm font-normal text-gray-400">Department
                                                /Company</th>
                                            <th class="px-1 py-1 text-left text-sm font-normal text-gray-400">Salary</th>
                                            <th class="px-1 py-1 text-left text-sm font-normal text-gray-400">Reason for
                                                leaving</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($experiences as $exp)
                                            <tr>
                                                <td class="px-1 py-1 whitespace-nowrap">{{ $exp->designation }}</td>
                                                <td class="px-1 py-1 whitespace-nowrap">
                                                    {{ date('d M Y', strtotime($exp->from)) }}</td>
                                                <td class="px-1 py-1 whitespace-nowrap">
                                                    @if ($exp->is_working == 1)
                                                        Present
                                                    @else
                                                        {{ date('d M Y', strtotime($exp->to)) }}
                                                    @endif
                                                </td>
                                                <td class="px-1 py-1 whitespace-nowrap">{{ $exp->company }}</td>
                                                <td class="px-1 py-1 whitespace-nowrap">{{ $exp->total_emoluments }}</td>
                                                <td class="px-1 py-1 whitespace-nowrap">{{ $exp->leave_reason }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
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
                        class="bg-green-600 hover:bg-green-500 text-white uppercase hover:text-white py-1 px-6 rounded">
                        Verify
                    </button>
                    <button @click="approveDialog = true"
                        class="bg-green-600 hover:bg-green-500 text-white uppercase hover:text-white py-1 px-6 rounded">
                        Verify & Approve
                    </button>
                    <button @click="rejectDialog = true"
                        class="bg-transparent hover:bg-red-500 text-red-700 uppercase hover:text-white py-1 px-6 border border-red-500 hover:border-transparent rounded">
                        Reject
                    </button>
                    <a href="{{ route('district-admin.new-application') }}"
                        class="bg-transparent hover:bg-gray-500 text-gray-700 uppercase hover:text-white py-1 px-6 border border-gray-500 hover:border-transparent rounded">
                        Back
                    </a>
                </div>
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
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline text-empex-green"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                                        </svg>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline text-empex-green"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
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
        <form action="{{ route('verifier.verify', [$basicInfo->id, 'Verified', 'district-admin']) }}" method="post">
            @csrf
            <div class="fixed inset-0 w-full h-full z-20 bg-black bg-opacity-50 duration-300 overflow-y-auto"
                x-show="verifyDialog" x-transition:enter="transition duration-300" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="transition duration-300"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                <div class="relative sm:w-3/4 md:w-1/2 lg:w-1/3 mx-2 sm:mx-auto my-10 opacity-100">
                    <div class="relative bg-white shadow-lg rounded-md text-gray-900 z-20 h-70"
                        @click.away="verifyDialog = false" x-show="verifyDialog"
                        x-transition:enter="transition transform duration-300" x-transition:enter-start="scale-0"
                        x-transition:enter-end="scale-100" x-transition:leave="transition transform duration-300"
                        x-transition:leave-start="scale-100" x-transition:leave-end="scale-0">
                        <header class="flex items-center justify-between px-5 py-3">
                            Confirm application verification?
                        </header>
                        <main class="px-5 text-center pb-3">
                            <textarea placeholder="Add notes" name="notes" id="notes" cols="30" rows="3"
                                class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border text-sm focus:outline-none focus:border-green-400 focus:bg-white mb-3"></textarea>
                            <button type="submit"
                                class="bg-empex-green text-white uppercase hover:text-white py-1 px-6 border border-empex-green hover:border-transparent rounded">Verify</button>
                            <button @click="verifyDialog = false" type="button"
                                class="bg-transparent hover:bg-gray-500 text-gray-700 uppercase hover:text-white py-1 px-6 border border-gray-500 hover:border-transparent rounded text-center">Cancel</button>
                        </main>
                    </div>
                </div>
            </div>
        </form>

        {{-- approver modal --}}
        <form action="{{ route('verifier.verify', [$basicInfo->id, 'Approved', 'district-admin']) }}" method="post">
            @csrf
            <div class="fixed inset-0 w-full h-full z-20 bg-black bg-opacity-50 duration-300 overflow-y-auto"
                x-show="approveDialog" x-transition:enter="transition duration-300" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="transition duration-300"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                <div class="relative sm:w-3/4 md:w-1/2 lg:w-1/3 mx-2 sm:mx-auto my-10 opacity-100">
                    <div class="relative bg-white shadow-lg rounded-md text-gray-900 z-20 h-70 py-5"
                        @click.away="approveDialog = false" x-show="approveDialog"
                        x-transition:enter="transition transform duration-300" x-transition:enter-start="scale-0"
                        x-transition:enter-end="scale-100" x-transition:leave="transition transform duration-300"
                        x-transition:leave-start="scale-100" x-transition:leave-end="scale-0">
                        <header class="px-5 py-3 text-xl text-center">
                            Confirm application approval?
                        </header>
                        <main class="px-5 text-center pb-3 mt-10">
                            <button type="submit"
                                class="bg-empex-green text-white uppercase py-1 px-6 border border-empex-green hover:border-transparent rounded">Approve</button>
                            <button @click="approveDialog = false" type="button"
                                class="bg-transparent hover:bg-gray-500 text-gray-700 uppercase hover:text-white py-1 px-6 border border-gray-500 hover:border-transparent rounded text-center">Cancel</button>
                        </main>
                    </div>
                </div>
            </div>
        </form>

        {{-- reject modal --}}
        <form action="{{ route('verifier.verify', [$basicInfo->id, 'Rejected', 'district-admin']) }}" method="post">
            @csrf
            <div class="fixed inset-0 w-full h-full z-20 bg-black bg-opacity-50 duration-300 overflow-y-auto"
                x-show="rejectDialog" x-transition:enter="transition duration-300" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="transition duration-300"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                <div class="relative sm:w-3/4 md:w-1/2 lg:w-1/3 mx-2 sm:mx-auto my-10 opacity-100">
                    <div class="relative bg-white shadow-lg rounded-md text-gray-900 z-20 h-70"
                        @click.away="rejectDialog = false" x-show="rejectDialog"
                        x-transition:enter="transition transform duration-300" x-transition:enter-start="scale-0"
                        x-transition:enter-end="scale-100" x-transition:leave="transition transform duration-300"
                        x-transition:leave-start="scale-100" x-transition:leave-end="scale-0">
                        <header class="flex items-center justify-between px-5 py-3">
                            Confirm application rejection?
                        </header>
                        <main class="px-5 text-center pb-3">
                            <textarea placeholder="Rejection reason" name="notes" id="notes" cols="30" rows="3"
                                class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border text-sm focus:outline-none focus:border-green-400 focus:bg-white mb-3"></textarea>
                            <button type="submit"
                                class="bg-transparent bg-red-500 text-white uppercase hover:text-white py-1 px-6 border border-red-500 hover:border-transparent rounded">Reject</button>
                            <button @click="rejectDialog = false" type="button"
                                class="bg-transparent hover:bg-gray-500 text-gray-700 uppercase hover:text-white py-1 px-6 border border-gray-500 hover:border-transparent rounded text-center">Cancel</button>
                        </main>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

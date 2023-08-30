@extends('layouts.admin')
@section('content')
<div class="max-w-7xl mx-auto px-4 my-5 flex">
  <div class="w-full mb-5 md:mb-0">
    <div class="md:flex md:justify-between grid grid-cols-1 justify-start md:px-6 md:py-4 md:mt-5">
      <img src="{{ asset('/storage/'.$basicInfo->avatar) }}" alt="user image"
        class="rounded-full align-middle border-none order-2 md:order-1 w-32 h-32 mx-auto md:mx-0 mb-5 md:mb-0" />
    </div>

    <div class="md:px-6 md:py-4 border-b border-gray-200">
      <div class="text-gray-700">Basic Information</div>
      <div class="grid grid-cols-1 md:grid-cols-2 md:gap-4 gap-1 mt-2">
        <div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
          <div class="text-gray-600">Full Name</div>
          <div class="font-semibold col-span-2 text-right md:text-left">{{ $basicInfo->full_name }}</div>
        </div>

        <div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
          <div class="text-gray-600">Date of Birth</div>
          <div class="font-semibold col-span-2 text-right md:text-left">{{ date('d M Y', strtotime($basicInfo->dob))
            }}</div>
        </div>

        <div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
          <div class="text-gray-600">Gender</div>
          <div class="font-semibold col-span-2 text-right md:text-left">{{ $basicInfo->gender }}</div>
        </div>

        <div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
          <div class="text-gray-600">Phone</div>
          <div class="font-semibold col-span-2 text-right md:text-left">{{ $basicInfo->phone_no }}</div>
        </div>

        <div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
          <div class="text-gray-600">Father/Mother</div>
          <div class="font-semibold col-span-2 text-right md:text-left">{{ $basicInfo->parents_name }}</div>
        </div>

        <div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
          <div class="text-gray-600">Marital Status</div>
          <div class="font-semibold col-span-2 text-right md:text-left">{{ $basicInfo->marital_status }}</div>
        </div>

        <div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
          <div class="text-gray-600">Religion</div>
          <div class="font-semibold col-span-2 text-right md:text-left">{{ $basicInfo->religion->name }}</div>
        </div>

        <div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
          <div class="text-gray-600">Caste</div>
          <div class="font-semibold col-span-2 text-right md:text-left">{{ $basicInfo->caste }}</div>
        </div>

        <div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
          <div class="text-gray-600">Aadhaar</div>
          <div class="font-semibold col-span-2 text-right md:text-left">{{ $basicInfo->aadhar_no ?? '-' }}</div>
        </div>

        <div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
          <div class="text-gray-600">Language Spoken</div>
          <div class="font-semibold col-span-2 text-right md:text-left">{{ $langSpoken }}</div>
        </div>

        <div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
          <div class="text-gray-600">Language Read</div>
          <div class="font-semibold col-span-2 text-right md:text-left">{{ $langRead }}</div>
        </div>

        <div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
          <div class="text-gray-600">Language Write</div>
          <div class="font-semibold col-span-2 text-right md:text-left">{{ $langWrite }}</div>
        </div>
      </div>
    </div>

    <div class="md:px-6 md:py-4 border-b">
      <div class="grid grid-cols-1 md:grid-cols-2 md:gap-8">
        <div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
          <div class="text-gray-700">Physical Challenge</div>
          <div class="font-semibold col-span-2 text-right md:text-left">{{ $physical ?? 'No' }}</div>
        </div>
      </div>
    </div>

    <div class="md:px-6 md:py-4 border-b">
      @foreach ($addresses as $address)
      <div class="text-gray-700 {{ $loop->index > 0 ? 'mt-2' : '' }}">{{ ucfirst($address->type) }} Address</div>
      <div class="grid grid-cols-1 md:grid-cols-2 md:gap-4 mt-2">
        <div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
          <div class="text-gray-600">State</div>
          <div class="font-semibold col-span-2 text-right md:text-left">{{ $address->state?->name }}</div>
        </div>

        <div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
          <div class="text-gray-600">District</div>
          <div class="font-semibold col-span-2 text-right md:text-left">{{ $address->district?->name }}</div>
        </div>

        <div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
          <div class="text-gray-600">City/Village</div>
          <div class="font-semibold col-span-2 text-right md:text-left">{{ $address->village }}</div>
        </div>

        <div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
          <div class="text-gray-600">RD Block</div>
          <div class="font-semibold col-span-2 text-right md:text-left">{{ $address->rdBlock?->name }}</div>
        </div>

        <div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
          <div class="text-gray-600">Police Station</div>
          <div class="font-semibold col-span-2 text-right md:text-left">{{ $address->policeStation?->name }}
          </div>
        </div>

        <div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
          <div class="text-gray-600">Post Office</div>
          <div class="font-semibold col-span-2 text-right md:text-left">{{ $address->postOffice?->name }}
          </div>
        </div>

        <div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
          <div class="text-gray-600">Pincode</div>
          <div class="font-semibold col-span-2 text-right md:text-left">{{ $address->pin_code }}</div>
        </div>

        <div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
          <div class="text-gray-600">House No</div>
          <div class="font-semibold col-span-2 text-right md:text-left">{{ $address->house_no }}</div>
        </div>
      </div>
      @endforeach
    </div>

    <div class="md:px-6 md:py-4 border-b">
      <div class="text-gray-700">Education Details</div>
      <div class="flex flex-col">
        <div class="overflow-x-auto">
          <div class="align-middle inline-block min-w-full">
            <div class="overflow-hidden">
              <table class="min-w-full">
                <thead>
                  <tr>
                    <th scope="col" class="px-1 py-1 text-left text-sm text-gray-600 font-normal">Qualification</th>
                    <th scope="col" class="px-1 py-1 text-left text-sm text-gray-600 font-normal">Subject /Stream</th>
                    <th scope="col" class="px-1 py-1 text-left text-sm text-gray-600 font-normal">Major /Core</th>
                    <th scope="col" class="px-1 py-1 text-left text-sm text-gray-600 font-normal">School /University
                    </th>
                    <th scope="col" class="px-1 py-1 text-left text-sm text-gray-600 font-normal">Division /Rank</th>
                    <th scope="col" class="px-1 py-1 text-left text-sm text-gray-600 font-normal">Year</th>
                    <th scope="col" class="px-1 py-1 text-left text-sm text-gray-600 font-normal">Duration</th>
                    <th scope="col" class="px-1 py-1 text-left text-sm text-gray-600 font-normal">Document</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($qualifications as $edu)
                  <tr>
                    <td class="px-1 py-1 whitespace-nowrap">{{ $edu->qualification->name }}</td>
                    <td class="px-1 py-1 whitespace-nowrap">{{ $edu->subject !== null ? $edu->subject->name :
                      ($edu->custom_subject ?? '-') }}</td>
                    <td class="px-1 py-1 whitespace-nowrap">{{ $edu->majorCore !== null ? $edu->majorCore->name :
                      ($edu->custom_major_core ?? '-') }}</td>
                    <td class="px-1 py-1 whitespace-nowrap">{{ $edu->school }}</td>
                    <td class="px-1 py-1 whitespace-nowrap">{{ $edu->division }}</td>
                    <td class="px-1 py-1 whitespace-nowrap">{{ $edu->year_of_passing }}</td>
                    <td class="px-1 py-1 whitespace-nowrap">{{ $edu->course_duration }}</td>
                    <td class="px-1 py-1 whitespace-nowrap text-empex-green">
                      @if ($edu->certificate != null)
                      <a target="_blank" href="{{ asset('storage/'.$edu->certificate) }}">View</a>
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
      <div class="text-gray-700">Experience</div>
      <div class="flex flex-col">
        <div class="overflow-x-auto">
          <div class="align-middle inline-block min-w-full">
            <div class="overflow-hidden">
              <table class="min-w-full">
                <thead>
                  <tr>
                    <th class="px-1 py-1 text-left text-sm font-normal text-gray-600">Designation</th>
                    <th class="px-1 py-1 text-left text-sm font-normal text-gray-600">From</th>
                    <th class="px-1 py-1 text-left text-sm font-normal text-gray-600">To</th>
                    <th class="px-1 py-1 text-left text-sm font-normal text-gray-600">Department /Company</th>
                    <th class="px-1 py-1 text-left text-sm font-normal text-gray-600">Salary</th>
                    <th class="px-1 py-1 text-left text-sm font-normal text-gray-600">Reason for leaving</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($experiences as $exp)
                  <tr>
                    <td class="px-1 py-1 whitespace-nowrap">{{ $exp->designation }}</td>
                    <td class="px-1 py-1 whitespace-nowrap">{{ date('d M Y', strtotime($exp->from)) }}</td>
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
          <div class="text-gray-600">NCO Detail</div>
          <div class="col-span-4 text-right md:text-left">
            <span class="font-semibold">{{ count($ncoFamilySelected) }}</span> NCO selected
          </div>
        </div>

        <div class="flex justify-between md:grid grid-cols-1 md:grid-cols-4 lg:grid-cols-6 gap-1 md:gap-4">
          <div class="text-gray-600">NCO on card</div>
          <div class="col-span-4 text-right md:text-left">
            <span class="font-semibold">{{ $ncoCodeToDisplay?->code }}</span> {{ $ncoCodeToDisplay?->name }}
          </div>
        </div>
      </div>
    </div>

    <div class="flex py-5">
      <div class="m-auto">
        <a href="{{ route('admin.user.accounts') }}"
          class="bg-transparent hover:bg-gray-500 text-gray-700 uppercase hover:text-white py-2 px-6 border border-gray-500 hover:border-transparent rounded">
          Back
        </a>
      </div>
    </div>
  </div>

</div>
@endsection

@extends('layouts.admin')
@section('content')
<div class="max-w-7xl mx-auto px-4 mb-10 mt-5" x-data="{approveDialog: false, rejectDialog: false}" x-cloak>
  <div class="w-full">
    <div class=" text-sm font-semibold ml-5">
      Employer Detail
    </div>
  </div>

  <div class="flex w-full mt-5">
    <div class="w-full md:bg-white md:rounded md:border pb-5">
      <div class="md:px-6 md:py-4 border-b">
        <div class="text-gray-800">Organization Detail</div>
        <div class="grid grid-cols-1 md:grid-cols-2 md:gap-4 gap-1 mt-2">
          <div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
            <div class="text-gray-700">Name</div>
            @if ($data->category_id == 3)
            <div class="font-semibold col-span-2 text-right md:text-left">{{ $data->organization->department->name }}
            </div>
            @else
            <div class="font-semibold col-span-2 text-right md:text-left">{{ $data->organization->name }}</div>
            @endif
          </div>

          <div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
            <div class="text-gray-700">Category</div>
            <div class="font-semibold col-span-2 text-right md:text-left">{{ $data->organization->category->name }}
            </div>
          </div>

          <div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
            <div class="text-gray-700">Type</div>
            <div class="font-semibold col-span-2 text-right md:text-left">{{ $data->organization->type->name }}
            </div>
          </div>

          <div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
            <div class="text-gray-700">Sector</div>
            <div class="font-semibold col-span-2 text-right md:text-left">{{ $data->organization->sector->name
              }}</div>
          </div>
        </div>
      </div>

      <div class="md:px-6 md:py-4 border-b">
        <div class="text-gray-800">Organization Address</div>
        <div class="grid grid-cols-1 md:grid-cols-2 md:gap-4 gap-1 mt-2">
          <div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
            <div class="text-gray-700">Address</div>
            <div class="font-semibold col-span-2 text-right md:text-left">{{ $data->address?->address1 }} {{
              $data->address?->address2 }}</div>
          </div>

          <div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
            <div class="text-gray-700">State</div>
            <div class="font-semibold col-span-2 text-right md:text-left">{{ $data->address?->state?->name }}
            </div>
          </div>

          <div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
            <div class="text-gray-700">District</div>
            <div class="font-semibold col-span-2 text-right md:text-left">{{ $data->address?->district?->name ?? $data->address?->district_name }}
            </div>
          </div>

          <div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
            <div class="text-gray-700">Pincode</div>
            <div class="font-semibold col-span-2 text-right md:text-left">{{ $data->address?->pincode }}</div>
          </div>
        </div>
      </div>

      <div class="md:px-6 md:py-4 border-">
        <div class="text-gray-800">User Detail <span class="text-sm font-semibold">(Please call and confirm before
            approve)</span></div>
        <div class="grid grid-cols-1 md:grid-cols-2 md:gap-4 gap-1 mt-2">
          <div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
            <div class="text-gray-700">Name</div>
            <div class="font-semibold col-span-2 text-right md:text-left">{{ $data?->name }}</div>
          </div>

          <div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
            <div class="text-gray-700">Email</div>
            <div class="font-semibold col-span-2 text-right md:text-left">{{ $data?->email }}
            </div>
          </div>

          <div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
            <div class="text-gray-700">Contact</div>
            <div class="font-semibold col-span-2 text-right md:text-left">{{ $data->contact }}
            </div>
          </div>

          <div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
            <div class="text-gray-700">Status</div>
            <div class="font-semibold col-span-2 text-right md:text-left">{{ $data->is_approved == 1 ? 'Approved' :
              'Pending' }}</div>
          </div>

          <div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
            <div class="text-gray-700">Image</div>
            <img src="{{ asset('/storage/'.$data->profile_photo_path) }}" alt="admin_image">
          </div>

          {{-- @if ($data->category_id == 3)
          <div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
            <div class="text-gray-700">Office Order</div>
            <a href="{{ asset('/storage/'.$data->office_order) }}" class="text-blue-400 underline"
              target="_blank">view</a>
          </div>
          @else
          <div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
            <div class="text-gray-700">Aadhar</div>
            <div class="font-semibold col-span-2 text-right md:text-left">
              {{ chunk_split($data->aadhaar, 4, ' ') }}
            </div>
          </div>
          @endif --}}
        </div>
      </div>

      <div class="flex py-5">
        <div class="m-auto">
          @if ($data->is_approved == 0)
          <button @click="approveDialog = true"
            class="bg-empex-green hover:bg-green-500 text-white uppercase hover:text-white py-1 px-6 rounded">
            Approve
          </button>
          <button @click="rejectDialog = true"
            class="bg-transparent hover:bg-red-500 text-red-700 uppercase hover:text-white py-1 px-6 border border-red-500 hover:border-transparent rounded">
            Reject
          </button>
          @endif
          <a href="{{ route('admin.employer') }}"
            class="bg-transparent hover:bg-gray-500 text-gray-700 uppercase hover:text-white py-2 px-6 border border-gray-500 hover:border-transparent rounded">
            Back
          </a>
        </div>
      </div>
    </div>
  </div>

  {{-- verify modal --}}
  <form action="{{ route('admin.employer.approve', $data->id) }}" method="post">
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
            Approved employer application?
            <div class="text-base mt-5">After approving, the employer can access their dashboard and post jobs.
            </div>
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
  <form action="{{ route('admin.employer.reject', $data->id) }}" method="post">
    @csrf
    <div class="fixed inset-0 w-full h-full z-20 bg-black bg-opacity-50 duration-300 overflow-y-auto"
      x-show="rejectDialog" x-transition:enter="transition duration-300" x-transition:enter-start="opacity-0"
      x-transition:enter-end="opacity-100" x-transition:leave="transition duration-300"
      x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
      <div class="relative sm:w-3/4 md:w-1/2 lg:w-1/3 mx-2 sm:mx-auto my-10 opacity-100">
        <div class="relative bg-white shadow-lg rounded-md text-gray-900 z-20 h-70 py-5"
          @click.away="rejectDialog = false" x-show="rejectDialog"
          x-transition:enter="transition transform duration-300" x-transition:enter-start="scale-0"
          x-transition:enter-end="scale-100" x-transition:leave="transition transform duration-300"
          x-transition:leave-start="scale-100" x-transition:leave-end="scale-0">
          <header class="flex items-center justify-center px-5 py-3 text-xl">
            Reject employer application?
          </header>
          <main class="px-5 text-center pb-3 mt-10">
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

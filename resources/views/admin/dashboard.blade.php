@extends('layouts.admin')
@section('content')
<div class="py-5">
  <div class="max-w-7xl mx-auto px-4">

    {{-- application info --}}
    <div class="mt-1">
      <div class="ml-5 mb-2 text-gray-700">Employee application info</div>
      <div class="grid grid-cols-2 md:grid-cols-3  gap-4">
        <a href="{{ Route('admin.verify.new.application') }}"
          class="hover:bg-empex-gray hover:border-empex-green bg-white rounded-lg w-full p-5 border">
          <h1 class="font-bold text-3xl mb-5">{{ $pendingVerification }}</h1>
          <div class="empex"></div>
          <p class="font-bold pb-1 pt-2">Pending applications</p>
          <p class="text-gray-500">Verification</p>
        </a>
        <a href="{{ Route('admin.approve.new.application') }}"
          class="hover:bg-empex-gray hover:border-empex-green bg-white rounded-lg w-full p-5 border">
          <h1 class="font-bold text-3xl mb-5">{{ $pendingApproval }}</h1>
          <div class="empex"></div>
          <p class="font-bold pb-1 pt-2">Pending applications</p>
          <p class="text-gray-500">Approval</p>
        </a>
        <a href="{{ route('admin.employer') }}"
          class="hover:bg-empex-gray hover:border-empex-green bg-white rounded-lg w-full p-5 border col-span-2 md:col-span-1">
          <h1 class="font-bold text-3xl mb-5">{{ $pendingEmployer }}</h1>
          <div class="empex"></div>
          <p class="font-bold pb-1 pt-2">Pending Account</p>
          <p class="text-gray-500">Employer</p>
        </a>
      </div>
    </div>

    {{-- jobs and news --}}
    <div class="mt-5">
      <div class="ml-5 mb-2 text-gray-700">Jobs and News</div>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4 ">
        <div class="flex flex-col bg-white rounded w-full p-5 border">
          <div class="flex flex-row">
            <div class="flex flex-col mr-4">
              <img src="/images/job.svg" alt="job" width="80">
            </div>
            <div class="flex flex-col w-9/12">
              <div class="flex flex-row">
                <h1 class="font-bold text-3xl mb-2">{{ $noOfJobs }}</h1>
              </div>
              <div class="flex flex-row mb-2">
                <p class="font-bold">Jobs currently posted</p>
              </div>
              <div class="flex flex-row mb-2">
                <p class="text-gray-500">From {{ $totalDepartments }} Departments</p>
              </div>
              <hr>
              <div class="flex flex-row">
                <a href="{{ Route('jobsPost') }}"
                  class="hover:text-green-800 font-semibold text-empex-green border-none rounded-lg mt-3">VIEW JOBS</a>
              </div>
            </div>
          </div>
        </div>
        <div class="flex flex-col bg-white rounded w-full p-5 border">
          <div class="flex flex-row">
            <div class="flex flex-col mr-4">
              <img src="/images/news.svg" alt="job" width="80">
            </div>
            <div class="flex flex-col w-9/12">
              <div class="flex flex-row">
                <h1 class="font-bold text-3xl mb-2">{{ $noOfNews }}</h1>
              </div>
              <div class="flex flex-row mb-2">
                <p class="font-bold">Career articles</p>
              </div>
              <div class="flex flex-row mb-2">
                <p class="text-gray-500">this week</p>
              </div>
              <hr>
              <div class="flex flex-row">
                <a href="{{ Route('employeeNews') }}"
                  class="hover:text-green-800 font-semibold text-empex-green border-none rounded-lg mt-3">SEE ARTICLES</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    {{-- more info --}}
    <div class="mt-5">
      <div class="ml-5 mb-2 text-gray-700">More info</div>
      <div class="grid grid-cols-1 md:grid-cols-2  gap-4">
        <div class="grid grid-cols-1 md:grid-cols-2 bg-white p-5 rounded border gap-4">
          <a href="{{ route('admin.verify.change.request') }}" class="flex flex-col hover:bg-empex-gray md:p-5 rounded">
            <h1 class="font-bold text-3xl mb-2">{{ $pendingChangeVerification }}</h1>
            <div class="empex"></div>
            <p class="font-bold mb-1 mt-2">Verification pending</p>
            <p class="text-gray-500">User change request</p>
          </a>
          <a href="{{ route('admin.approve.change.request') }}"
            class="flex flex-col hover:bg-empex-gray md:p-5 rounded">
            <h1 class="font-bold text-3xl mb-2">{{ $pendingChangeApproval }}</h1>
            <div class="empex"></div>
            <p class="font-bold mb-1 mt-2">Approval pending</p>
            <p class="text-gray-500">User change request</p>
          </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 bg-white p-5 rounded border gap-4">
          <a href="{{ route('admin.user.accounts') }}" class="flex flex-col hover:bg-empex-gray md:p-5 rounded">
            <h1 class="font-bold text-3xl mb-2">{{ $users }}</h1>
            <div class="empex"></div>
            <p class="font-bold mb-1 mt-2">Users</p>
            <p class="text-gray-500">With employee card</p>
          </a>
          <a href="{{ route('admin.official.accounts') }}" class="flex flex-col hover:bg-empex-gray md:p-5 rounded">
            <h1 class="font-bold text-3xl mb-2">{{ $admins }}</h1>
            <div class="empex"></div>
            <p class="font-bold mb-1 mt-2">Official users</p>
            <p class="text-gray-500">On Empex</p>
          </a>
        </div>
      </div>
    </div>

    {{-- sponsors and districts nakin ah siam that tur, static data display vangin demo dawn ah hide ani --}}
    {{-- <div class="mt-5">
      <div class="grid grid-cols-1 md:grid-cols-2  gap-4">
        <div>
          <div class="ml-5 mb-2 text-gray-700">Sponsors</div>
          <div class="flex flex-col bg-white rounded-lg w-full p-10 border mr-5">
            <h1 class="font-bold text-xl mb-2">Sponsors</h1>
            <div class="empex"></div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <p class="font-bold mb-1 mt-2">Total sponsors</p>
                <p>54</p>
              </div>
              <div>
                <p class="font-bold mb-1 mt-2">Latest sponsorship</p>
                <p>Police Department Technician</p>
              </div>
            </div>
          </div>
        </div>

        <div>
          <div class="ml-5 mb-2 text-gray-700">District</div>
          <div class="flex flex-col bg-white rounded-lg w-full p-10 border">
            <h1 class="font-bold text-xl mb-2">Pending applications</h1>
            <div class="empex"></div>
            <div class="grid grid-cols-3 md:grid-cols-5 gap-4">
              <div class="flex flex-col">
                <p class="font-bold mb-1 mt-2">Aizawl</p>
                <p>24</p>
              </div>
              <div class="flex flex-col">
                <p class="font-bold mb-1 mt-2">Lunglei</p>
                <p>12</p>
              </div>
              <div class="flex flex-col">
                <p class="font-bold mb-1 mt-2">Siaha</p>
                <p>16</p>
              </div>
              <div class="flex flex-col">
                <p class="font-bold mb-1 mt-2">Champhai</p>
                <p>7</p>
              </div>
              <div class="flex flex-col">
                <p class="font-bold mb-1 mt-2">Kolasib</p>
                <p>8</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> --}}
  </div>
</div>

@endsection

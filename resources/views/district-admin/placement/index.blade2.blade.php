@extends('layouts.admin', ['districts' => $districts])

@section('title', 'Employment News - Empex')

@section('navbar')
@parent
@endsection

@section('content')
<div class="max-w-7xl mx-auto px-4 my-10">
    {{-- <div class="w-full">
        <div class=" text-sm font-semibold ml-5 my-3">
            Placement in Siaha
        </div>
    </div> --}}

    @if (Session('newsMessage'))
    <div class="flex flex-col mb-2 md:mb-4 bg-white border-empex-yellow shadow border rounded" x-data="{ show: true }"
        x-show="show" x-init="setTimeout(() => show = false, 5000)">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <div class="bg-empex-yellow rounded-l p-2">
                    <img src="/images/auth/info.svg" alt="noti">
                </div>
                <div class="flex flex-col mx-3">
                    <div class="font-medium leading-none">{{ session('newsMessage') }}</div>
                </div>
            </div>
        </div>
    </div>
    @endif


    <div class=" grid grid-cols-1 md:grid-cols-3 md:gap-4">
        <div class="p-3 w-full md:bg-white md:rounded-lg overflow-hidden md:shadow md:border col-span-2 mb-5 md:mb-0">

            <div class=" text-sm font-semibold my-3">
                Placement in {{ $district->name }}
            </div>
            <div class="grid grid-cols-1 md:grid-cols-4 my-3 gap-1">
                {{-- <input wire:model='name'
                    class="w-full rounded input border-gray-400 text-base text-gray-600 focus:text-empex-green focus:border-green-600 focus:outline-none focus:ring-green-600"
                    type="text" placeholder="Search by name" /> --}}





                <div>
                    <form action="" method="get" id="searchForm">
                        <div class="grid grid-cols-6 my-3 content-center">
                            <div class="col-span-8">
                                <div class="relative">
                                    <input type="search" required name="q" value="{{ $search }}" id="search"
                                        class="w-fudll py-2 text-sm text-dark bg-empex-gray rounded-md focus:outline-none focus:bg-white border-empex-green focus:ring-0 focus:border-empex-green"
                                        placeholder="Search regno" autocomplete="off">
                                    {{-- <span class="absolute inset-y-0 right-0 flex items-center pr-2">
                                        <button type="submit" class="p-1 focus:outline-none focus:shadow-outline">
                                            <svg fill="none" stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24"
                                                class="w-4 h-4">
                                                <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                            </svg>
                                        </button>
                                    </span> --}}
                                </div>
                            </div>
                        </div>
                    </form>
                </div>









            </div>



            <table class="min-w-full divide-y divide-gray-200">
                <thead class="text-white" style="background-color: #212120;">
                    <tr>
                        <th scope="col" class="px-6 py-3  text-left text-sm font-medium tracking-wide">
                            Reg No.
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-sm font-medium tracking-wide">
                            Address
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-sm font-medium tracking-wide">
                            Recruiter
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-sm font-medium tracking-wide">
                            Designation
                        </th>
                        <th scope="col" class="px-6 py-3 text-right font-medium tracking-wide">
                            Type
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">

                    @forelse($placements as $placement)
                    <tr class="hover:bg-gray-50">
                        <td class="font-semibold px-6 py-4 whitespace-nowrap text-sm">
                            {{ $placement['reg_no'] }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            {{ $placement['address'] }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            {{ $placement['recruiter'] }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            {{ $placement['designation'] }}
                        </td>
                        <td
                            class="px-6 py-4 whitespace-nowrap text-sm text-right font-medium {{ $placement['type'] == 'Temporary' ? 'text-blue' : 'text-empex-green' }}">
                            {{ $placement['type'] }}
                        </td>
                    </tr>

                    @empty
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap" colspan="5">Placement not found</td>
                    </tr>
                    @endforelse



                </tbody>



            </table>

            <div class="py-2">
                {{ $placements->appends(['q' => $search, 'sort' => $sort])->onEachSide(1)->links() }}
            </div>
        </div>

        <div class="w-full p-3 bg-white rounded-lg overflow-hidden shadow border">
            {{-- @livewire('web.placement-archive',[$placements,$district->id]) --}}
            @livewire('web.placement-archive',[[],$district->id])
            {{-- <div class=" text-sm font-semibold ml-5">
                Articles
            </div>
            <div class="flex px-6 py-4">
                <img src="/images/features/news.svg" alt="news">
                @livewire('web.news.count')
            </div> --}}
        </div>
    </div>
</div>

{{-- job signup modal --}}
<div class="fixed inset-0 w-full h-full z-20 bg-black bg-opacity-50 duration-300 overflow-y-auto"
    x-show="jobSignupDialog" x-transition:enter="transition duration-300" x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100" x-transition:leave="transition duration-300"
    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
    <div class="relative sm:w-3/4 md:w-1/2 lg:w-1/3 mx-2 sm:mx-auto my-10 opacity-100">
        <div class="relative bg-white shadow-lg rounded-md text-gray-900 z-20 h-96"
            @click.away="jobSignupDialog = false" x-show="jobSignupDialog"
            x-transition:enter="transition transform duration-300" x-transition:enter-start="scale-0"
            x-transition:enter-end="scale-100" x-transition:leave="transition transform duration-300"
            x-transition:leave-start="scale-100" x-transition:leave-end="scale-0">
            <header class="flex items-center justify-between p-2">
                <div></div>
                <button class="focus:outline-none p-2 float-right" @click="jobSignupDialog = false">
                    <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                        viewBox="0 0 18 18">
                        <path
                            d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                        </path>
                    </svg>
                </button>
            </header>
            <main class="p-2 text-center">
                <div>
                    <img class="mx-auto" src="/images/modal/job.svg" alt="job signup">
                </div>
                <div class=" font-semibold my-5 text-gray-700">
                    Signup on EmpEx to view Articles
                </div>
                {{-- <div class=" text-gray-500 mb-5">
                    only Name and Phone no. is required
                </div> --}}
                <div class=" text-gray-500 mb-5">
                    He article hi chipchiar zawk a i en duh chuan in ziak lut ve rawh le <br>
                    I hming leh phone number chauh a ngai e
                </div>
                <div class=" mb-5">
                    <a href="{{ route('signup') }}"
                        class="bg-empex-green text-gray-100 rounded hover:bg-green-400 px-6 py-1 focus:outline-none">SIGNUP</a>
                </div>
            </main>
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

<script type="module">
    document.getElementById("search").addEventListener("search", function(event) {
    document.getElementById("searchForm").submit();
	});

	$(document).on('change', '.sortJob', function () {
		$('#searchForm').submit();
	})
</script>










@extends('layouts.admin',['districts' => $districts])

@section('content')
<div class="max-w-7xl mx-auto px-4 my-10">

    <div class="w-full my-2 flex justify-between">
        <div class=" text-sm font-semibold ml-5">
            {{-- Placement in {{ $district->name }} --}}
        </div>

        <div>
            {{-- <span class="text-sm font-semibold">Archive</span> <br> --}}
            <a href="{{ route('create.placement') }}"
                class="bg-empex-green text-white rounded px-4 py-1 text-base font-medium hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-300">
                Add
            </a>
        </div>
    </div>

    <div class=" grid grid-cols-1 md:grid-cols-3 md:gap-4">
        <div class=" w-full   overflow-hidden col-span-2 mb-5 md:mb-0">
            {{-- wrap border --}}
            <div class=" text-sm font-semibold my-3">
                Placement in {{ $district->name }}
            </div>
            <div class="md:bg-white md:shadow md:border md:rounded-lg p-3">
                <div class="grid grid-cols-1 md:grid-cols-4 my-3 gap-1">

                    <div>
                        <form action="" method="get" id="searchForm">
                            <div class="grid grid-cols-6 my-3 content-center">
                                <div class="col-span-8">
                                    <div class="relative">
                                        <input type="search" name="q" value="{{ $search }}" id="search"
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
                <div class="flex flex-col w-full">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b">
                                <table class="min-w-full table-auto divide-y divide-gray-200">
                                    <thead class="text-white" style="background-color: #212120;">
                                        <tr>
                                            <th scope="col"
                                                class="px-6 py-3  text-left text-sm font-medium tracking-wide">
                                                Reg No.
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-sm font-medium tracking-wide">
                                                Address
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-sm font-medium tracking-wide">
                                                Recruiter
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-sm font-medium tracking-wide">
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
                            </div>
                        </div>
                    </div>
                </div>
                <div class="py-2">
                    {{ $placements->appends(['q' => $search, 'sort' => $sort])->onEachSide(1)->links() }}
                </div>
            </div>
            {{-- wrap border --}}
        </div>

        <div class="w-full">
            <div class=" text-sm font-semibold my-3">
                Archive
            </div>
            {{-- @livewire('web.placement-archive',[$placements,$district->id]) --}}
            <div class="p-3 bg-white rounded-lg overflow-hidden shadow border">
                @livewire('web.placement-archive',[[],$district->id])</div>
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


@endsection

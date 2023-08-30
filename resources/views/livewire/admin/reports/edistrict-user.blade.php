<div>
    <div class="bg-white border p-5 rounded shadow-sm">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-2">
            <div>
                <label class="text-xs">District</label>
                <select wire:model="district" class="w-full border border-empex-gray p-2 rounded">
                    {{-- @foreach ($districts as $dist) --}}
                    <option value="1">{{ $districtName }}</option>
                    {{-- @endforeach --}}
                </select>

                {{-- @foreach ($districts as $dist)
                    <span>dd{{ collect($dist)->pluck('id') }}</span>
                @endforeach --}}

                {{-- <select wire:model="district" class="w-full border border-empex-gray p-2 rounded">
                    @foreach ($districts as $dist)
                        <option value="{{ collect($dist)->pluck('id') }}">
                            {{ implode(',',collect($dist)->pluck('name')->toArray()) }}</option>
                    @endforeach
                </select> --}}
            </div>
        </div>

        <div class="mt-3">
            <button {{ $buttonEnable == false ? 'disabled' : '' }} wire:click="generateReport"
                class=" px-6 py-2 rounded {{ $buttonEnable == false ? 'bg-empex-gray cursor-not-allowed' : 'bg-empex-green text-white hover:bg-green-600' }}">
                GENERATE
            </button>
        </div>
    </div>

    @if ($generated)
        <div class="bg-white border p-5 rounded shadow-sm mt-5">
            <div class="flex justify-between mb-3">
                <div>Report Detail</div>
                @if (count($reports) > 0)
                    <button wire:click="downloadReport"
                        class="text-empex-green border brder-empex-green bg-white px-6 py-2 rounded hover:bg-empex-gray">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 pb-1 inline" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Download
                    </button>
                @endif
            </div>
            <div class="flex flex-col w-full">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <table class="table-auto w-full">
                            <tr>
                                <th class="text-center border border-black p-4" colspan="9">
                                    LIST OF EMPLOYMENT REGISTER UNDER EMPLOYMENT EXCHANGE, {{ $districtName }} DISTRICT
                                </th>
                            </tr>
                            <tr>
                                <td class="text-center border border-black p4">SL.No.</td>
                                <td class="text-center border border-black p4">Name</td>
                                <td class="text-center border border-black p4">Address</td>
                                <td class="text-center border border-black p4">Father's Name</td>
                                <td class="text-center border border-black p4">DOB</td>
                                <td class="text-center border border-black p4">Reg.No.</td>
                                <td class="text-center border border-black p4">Ph.No.</td>
                            </tr>
                            @forelse ($reports as $index => $report)
                                <tr>
                                    <td class="text-center border border-black p4">{{ $index + 1 }}</td>
                                    <td class="text-center border border-black p4">{{ $report?->full_name }}</td>
                                    <td class="text-center border border-black p4">
                                        {{ $report['permanent_address']['house_no'] . ',' ?? '' }}
                                        {{ $report['permanent_address']['village'] . ',' ?? '' }}
                                        {{ $report['permanent_address']['district']['name'] . ',' ?? '' }}
                                        {{ $report['permanent_address']['state']['name'] ?? '' }}
                                        - {{ $report['permanent_address']['pin_code'] ?? '' }}
                                    </td>
                                    <td class="text-center border border-black p4">{{ $report?->parents_name }}</td>
                                    <td class="text-center border border-black p4">
                                        {{ date('d/m/Y', strtotime($report->dob)) ?? '-' }}</td>
                                    <td class="text-center border border-black p4">{{ $report?->employment_no }}</td>
                                    <td class="text-center border border-black p4">{{ $report?->phone_no }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center border border-black p4" colspan="9">Employment Not found
                                    </td>
                                </tr>
                            @endforelse
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

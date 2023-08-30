<div>
    <div class="bg-white border p-5 rounded shadow-sm">
        <div class="grid grid-cols-1 md:grid-cols-5 gap-2">
            <div>
                <label class="text-xs">Category</label>
                <select wire:model="category" class="w-full border border-empex-gray p-2 rounded">
                    <option value="All">All Category</option>
                    <option value="Mizo">Mizo</option>
                    <option value="Non-Mizo">Non-Mizo</option>
                    <option value="Physically Handicapped">Physically Handicapped</option>
                    <option value="Education">Education</option>
                </select>
            </div>

            <div>
                <label class="text-xs">District</label>
                <select wire:model="district" class="w-full border border-empex-gray p-2 rounded">
                    <option value="All">All District</option>
                    @foreach ($districts as $dist)
                        <option value="{{ $dist->id }}">{{ $dist->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="text-xs">Duration</label>
                <select class="w-full border border-empex-gray p-2 rounded" wire:model="duration">
                    <option value="Custom">Custom</option>
                    <option value="Monthly">Monthly</option>
                    <option value="Quarterly">Quarterly</option>
                    <option value="Half-Yearly">Half-Yearly</option>
                    <option value="Yearly">Yearly</option>
                </select>
            </div>

            @if ($duration != 'Yearly')
                <div>
                    @if ($duration == 'Custom')
                        <label class="text-xs">From</label>
                        <input wire:model="from" type="date" class="w-full border border-empex-gray p-2 rounded">
                    @elseif ($duration == 'Monthly')
                        <label class="text-xs">Month</label>
                        <select wire:model="month" class="w-full border border-empex-gray p-2 rounded">
                            <option value="01">January</option>
                            <option value="02">February</option>
                            <option value="03">March</option>
                            <option value="04">April</option>
                            <option value="05">May</option>
                            <option value="06">June</option>
                            <option value="07">July</option>
                            <option value="08">August</option>
                            <option value="09">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select>
                    @elseif ($duration == 'Quarterly')
                        <label class="text-xs">Quarterly</label>
                        <select wire:model="quarter" class="w-full border border-empex-gray p-2 rounded">
                            <option value="01">1st Quarter</option>
                            <option value="02">2nd Quarter</option>
                            <option value="03">3rd Quarter</option>
                            <option value="04">4th Quarter</option>
                        </select>
                    @else
                        <label class="text-xs">Half Yearly</label>
                        <select wire:model="half" class="w-full border border-empex-gray p-2 rounded">
                            <option value="01">1st Half</option>
                            <option value="02">2nd Half</option>
                        </select>
                    @endif
                </div>
            @endif

            <div>
                @if ($duration == 'Custom')
                    <label class="text-xs">To</label>
                    <input wire:model="to" min="{{ $this->from }}" type="date"
                        class="w-full border border-empex-gray p-2 rounded">
                @else
                    <label class="text-xs">Year</label>
                    <select wire:model="year" class="w-full border border-empex-gray p-2 rounded">
                        @foreach ($years as $yr)
                            <option value="{{ $yr }}">{{ $yr }}</option>
                        @endforeach
                    </select>
                @endif
            </div>
        </div>
        <div class="mt-3">
            <button wire:loading.attr="disabled"
                wire:loading.class="cursor-not-allowed bg-empex-gray hover:bg-empex-gray"
                wire:click.prevent="generateReport"
                class=" px-6 py-2 rounded bg-empex-green text-white   {{ $buttonEnable == false ? 'bg-empex-gray cursor-not-allowed' : 'hover:bg-green-600' }} ">
                <span wire:loading.remove wire:target='generateReport'>
                    GENERATE
                </span>

                <span wire:loading wire:target='generateReport'>
                    GENERATING
                </span>
            </button>

            {{-- <button {{ $buttonEnable == false ? 'disabled' : '' }} wire:click="generateReport"
                class=" px-6 py-2 rounded {{ $buttonEnable == false ? 'bg-empex-gray cursor-not-allowed' : 'bg-empex-green text-white hover:bg-green-600' }}">
                GENERATE
            </button> --}}
        </div>
    </div>

    @if ($generated)
        <div class="bg-white border p-5 rounded shadow-sm mt-5">
            @if ($category == 'Education')
                <div class="flex justify-between mb-3">
                    <div>Report Detail</div>
                    <button wire:click="downloadEducation"
                        class="text-empex-green border brder-empex-green bg-white px-6 py-2 rounded hover:bg-empex-gray">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 pb-1 inline" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Download
                    </button>
                </div>

                <div class="flex flex-col w-full">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <table class="table-auto w-full">
                                <tr class="border border-black">
                                    <th class="text-center" colspan="8">
                                        REPORT OF EMPLOYMENT STATISTICS OF {{ $districtName }} DISTRICT EMPLOYMENT
                                        EXCHANGE
                                    </th>
                                    <th colspan="7">
                                        @if ($duration != 'Custom')
                                            {{ $duration == 'Monthly'
                                                ? $monthName
                                                : ($duration == 'Quarterly'
                                                    ? $quarter . ' Quarter'
                                                    : ($duration == 'Half-Yearly'
                                                        ? $half . ' Half'
                                                        : ($duration == 'Yearly'
                                                            ? 'Year'
                                                            : ''))) }},
                                            {{ $year }}
                                        @else
                                            From: {{ date('d M Y', strtotime($from)) }} -
                                            {{ date('d M Y', strtotime($to)) }}
                                        @endif
                                    </th>
                                </tr>
                                <tr class="border border-black">
                                    <td class="border border-black text-center" rowspan="2">Sl. No</td>
                                    <td class="border border-black text-center" rowspan="2">Category</td>
                                    <td class="border border-black text-center" rowspan="2">Subject</td>
                                    <td class="border border-black text-center" colspan="2">
                                        {{ $duration == 'Monthly'
                                            ? 'The Month'
                                            : ($duration == 'Quarterly'
                                                ? 'The Quarter'
                                                : ($duration == 'Half-Yearly'
                                                    ? 'Half Year'
                                                    : ($duration == 'Yearly'
                                                        ? 'The Year'
                                                        : ($duration == 'Custom'
                                                            ? 'Custom'
                                                            : '')))) }}
                                    </td>
                                    <td class="border border-black text-center" rowspan="2">Total</td>
                                    <td class="border border-black text-center" colspan="2">Lapsed</td>
                                    <td class="border border-black text-center" rowspan="2">Total</td>
                                    <td class="border border-black text-center" colspan="2">Placed</td>
                                    <td class="border border-black text-center" rowspan="2">Total</td>
                                    <td class="border border-black text-center" colspan="2">Live Register</td>
                                    <td class="border border-black text-center" rowspan="2">Total</td>
                                </tr>
                                <tr class="border border-black">
                                    <td class="border border-black text-center">Male</td>
                                    <td class="border border-black text-center">Female</td>
                                    <td class="border border-black text-center">Male</td>
                                    <td class="border border-black text-center">Female</td>
                                    <td class="border border-black text-center">Male</td>
                                    <td class="border border-black text-center">Female</td>
                                    <td class="border border-black text-center">Male</td>
                                    <td class="border border-black text-center">Female</td>
                                </tr>
                                @foreach ($educations as $quali)
                                    <tr class="border border-black text-center">
                                        <td class="border border-black text-center"
                                            rowspan="{{ count($quali['subject']) > 0 ? count($quali['subject']) : '' }}">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="border border-black text-center"
                                            rowspan="{{ count($quali['subject']) > 0 ? count($quali['subject']) : '' }}">
                                            {{ $quali['name'] }}
                                        </td>
                                        @if (count($quali['subject']) == 0)
                                            <td></td>
                                            <td class="border border-black text-center">
                                                {{ $quali['reports']['maleReport'] }}</td>
                                            <td class="border border-black text-center">
                                                {{ $quali['reports']['femaleReport'] }}</td>
                                            <td class="border border-black text-center">
                                                {{ $quali['reports']['totalReport'] }}</td>
                                            <td class="border border-black text-center">
                                                {{ $quali['reports']['maleLapsed'] }}</td>
                                            <td class="border border-black text-center">
                                                {{ $quali['reports']['femaleLapsed'] }}</td>
                                            <td class="border border-black text-center">
                                                {{ $quali['reports']['totalLapsed'] }}</td>
                                            <td class="border border-black text-center">
                                                {{ $quali['reports']['malePlaced'] }}</td>
                                            <td class="border border-black text-center">
                                                {{ $quali['reports']['femalePlaced'] }}</td>
                                            <td class="border border-black text-center">
                                                {{ $quali['reports']['totalPlaced'] }}</td>
                                            <td class="border border-black text-center">
                                                {{ $quali['reports']['maleLiveRegister'] }}</td>
                                            <td class="border border-black text-center">
                                                {{ $quali['reports']['femaleLiveRegister'] }}</td>
                                            <td class="border border-black text-center">
                                                {{ $quali['reports']['totalLiveRegister'] }}</td>
                                        @else
                                            @foreach ($quali['subject'] as $subIndex => $subj)
                                                @if ($subIndex != 0)
                                    <tr class="border border-black text-center">
                                @endif
                                <td class="border border-black text-center">{{ $subj['name'] }}</td>
                                <td class="border border-black text-center">
                                    {{ $quali['reports'][$subIndex]['maleReport'] }}</td>
                                <td class="border border-black text-center">
                                    {{ $quali['reports'][$subIndex]['femaleReport'] }}</td>
                                <td class="border border-black text-center">
                                    {{ $quali['reports'][$subIndex]['totalReport'] }}</td>
                                <td class="border border-black text-center">
                                    {{ $quali['reports'][$subIndex]['maleLapsed'] }}</td>
                                <td class="border border-black text-center">
                                    {{ $quali['reports'][$subIndex]['femaleLapsed'] }}</td>
                                <td class="border border-black text-center">
                                    {{ $quali['reports'][$subIndex]['totalLapsed'] }}</td>
                                <td class="border border-black text-center">
                                    {{ $quali['reports'][$subIndex]['malePlaced'] }}</td>
                                <td class="border border-black text-center">
                                    {{ $quali['reports'][$subIndex]['femalePlaced'] }}</td>
                                <td class="border border-black text-center">
                                    {{ $quali['reports'][$subIndex]['totalPlaced'] }}</td>
                                <td class="border border-black text-center">
                                    {{ $quali['reports'][$subIndex]['maleLiveRegister'] }}</td>
                                <td class="border border-black text-center">
                                    {{ $quali['reports'][$subIndex]['femaleLiveRegister'] }}</td>
                                <td class="border border-black text-center">
                                    {{ $quali['reports'][$subIndex]['totalLiveRegister'] }}</td>
                                @if ($subIndex != 0)
                                    </tr>
                                @endif
            @endforeach
    @endif
    </tr>
    @endforeach
    <tr>
        <td class="border-l border-b border-black"></td>
        <td class="border-b border-black"></td>
        <td class="border-b border-black text-center font-bold">Grand Total</td>
        <td class="border border-black text-center font-bold">{{ $maleReport }}</td>
        <td class="border border-black text-center font-bold">{{ $femaleReport }}</td>
        <td class="border border-black text-center font-bold">{{ $totalReport }}</td>
        <td class="border border-black text-center font-bold">{{ $maleLapsed }}</td>
        <td class="border border-black text-center font-bold">{{ $femaleLapsed }}</td>
        <td class="border border-black text-center font-bold">{{ $totalLapsed }}</td>
        <td class="border border-black text-center font-bold">{{ $malePlaced }}</td>
        <td class="border border-black text-center font-bold">{{ $femalePlaced }}</td>
        <td class="border border-black text-center font-bold">{{ $totalPlaced }}</td>
        <td class="border border-black text-center font-bold">{{ $maleLiveRegister }}</td>
        <td class="border border-black text-center font-bold">{{ $femaleLiveRegister }}</td>
        <td class="border border-black text-center font-bold">{{ $totalLiveRegister }}</td>
    </tr>
    </table>
</div>
</div>
</div>
@elseif($category == 'All')
<div class="flex justify-between mb-3">
    <div>Report Detail</div>
    <button wire:click="downloadAllReport"
        class="text-empex-green border brder-empex-green bg-white px-6 py-2 rounded hover:bg-empex-gray">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 pb-1 inline" fill="none" viewBox="0 0 24 24"
            stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
        </svg>
        Download
    </button>
</div>

<div>
    Preview is not available when selecting to All category, download file will contain all category in separate
    sheet!
</div>
@else
<div class="flex justify-between mb-3">
    <div>Report Detail</div>
    <button wire:click="downloadReport"
        class="text-empex-green border brder-empex-green bg-white px-6 py-2 rounded hover:bg-empex-gray">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 pb-1 inline" fill="none" viewBox="0 0 24 24"
            stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
        </svg>
        Download
    </button>
</div>
<div class="flex flex-col w-full">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <table class="table-auto w-full">
                <tr class="border border-black">
                    <th class="text-center" colspan="8">
                        REPORT OF EMPLOYMENT STATISTICS OF {{ $districtName }} DISTRICT EMPLOYMENT EXCHANGE
                    </th>
                    <th colspan="7">
                        @if ($duration != 'Custom')
                            {{ $duration == 'Monthly'
                                ? $monthName
                                : ($duration == 'Quarterly'
                                    ? $quarter . ' Quarter'
                                    : ($duration == 'Half-Yearly'
                                        ? $half . ' Half'
                                        : ($duration == 'Yearly'
                                            ? 'Year'
                                            : ''))) }},
                            {{ $year }}
                        @else
                            From: {{ date('d M Y', strtotime($from)) }} - {{ date('d M Y', strtotime($to)) }}
                        @endif
                    </th>
                </tr>
                <tr>
                    <td class="border border-black text-center" rowspan="2">Sl. No</td>
                    <td class="border border-black text-center" rowspan="2">Category</td>
                    <td class="border border-black text-center" rowspan="2">Subject</td>
                    <td class="border border-black text-center" colspan="2">
                        {{ $duration == 'Monthly'
                            ? 'The Month'
                            : ($duration == 'Quarterly'
                                ? 'The Quarter'
                                : ($duration == 'Half-Yearly'
                                    ? 'Half Year'
                                    : ($duration == 'Yearly'
                                        ? 'The Year'
                                        : ($duration == 'Custom'
                                            ? 'Custom'
                                            : '')))) }}
                    </td>
                    <td class="border border-black text-center" rowspan="2">Total</td>
                    <td class="border border-black text-center" colspan="2">Lapsed</td>
                    <td class="border border-black text-center" rowspan="2">Total</td>
                    <td class="border border-black text-center" colspan="2">Placed</td>
                    <td class="border border-black text-center" rowspan="2">Total</td>
                    <td class="border border-black text-center" colspan="2">Live Register</td>
                    <td class="border border-black text-center" rowspan="2">Total</td>
                </tr>
                <tr>
                    <td class="border border-black text-center">Male</td>
                    <td class="border border-black text-center">Female</td>
                    <td class="border border-black text-center">Male</td>
                    <td class="border border-black text-center">Female</td>
                    <td class="border border-black text-center">Male</td>
                    <td class="border border-black text-center">Female</td>
                    <td class="border border-black text-center">Male</td>
                    <td class="border border-black text-center">Female</td>
                </tr>
                @foreach ($reports as $index => $report)
                    <tr>
                        <td class="border border-black text-center">{{ $index + 1 }}</td>
                        @if ($index == 0)
                            <td class="border border-black text-center" rowspan="{{ count($reports) }}">
                                {{ $category }}</td>
                        @endif
                        <td class="border border-black text-center">{{ $report['category'] }}</td>
                        <td class="border border-black text-center">{{ $report['maleReport'] }}</td>
                        <td class="border border-black text-center"> {{ $report['femaleReport'] }}</td>
                        <td class="border border-black text-center">{{ $report['totalReport'] }}</td>
                        <td class="border border-black text-center">{{ $report['maleLapsed'] }}</td>
                        <td class="border border-black text-center"> {{ $report['femaleLapsed'] }}</td>
                        <td class="border border-black text-center">{{ $report['totalLapsed'] }}</td>
                        <td class="border border-black text-center">{{ $report['malePlaced'] }}</td>
                        <td class="border border-black text-center"> {{ $report['femalePlaced'] }}</td>
                        <td class="border border-black text-center">{{ $report['totalPlaced'] }}</td>
                        <td class="border border-black text-center">{{ $report['maleLiveRegister'] }}</td>
                        <td class="border border-black text-center"> {{ $report['femaleLiveRegister'] }}</td>
                        <td class="border border-black text-center">{{ $report['totalLiveRegister'] }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td class="border-l border-b border-black"></td>
                    <td class="border-b border-black"></td>
                    <td class="border-b border-black text-center font-bold">Grand Total</td>
                    <td class="border border-black text-center font-bold">{{ $maleReport }}</td>
                    <td class="border border-black text-center font-bold">{{ $femaleReport }}</td>
                    <td class="border border-black text-center font-bold">{{ $totalReport }}</td>
                    <td class="border border-black text-center font-bold">{{ $maleLapsed }}</td>
                    <td class="border border-black text-center font-bold">{{ $femaleLapsed }}</td>
                    <td class="border border-black text-center font-bold">{{ $totalLapsed }}</td>
                    <td class="border border-black text-center font-bold">{{ $malePlaced }}</td>
                    <td class="border border-black text-center font-bold">{{ $femalePlaced }}</td>
                    <td class="border border-black text-center font-bold">{{ $totalPlaced }}</td>
                    <td class="border border-black text-center font-bold">{{ $maleLiveRegister }}</td>
                    <td class="border border-black text-center font-bold">{{ $femaleLiveRegister }}</td>
                    <td class="border border-black text-center font-bold">{{ $totalLiveRegister }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endif
</div>
@endif
</div>

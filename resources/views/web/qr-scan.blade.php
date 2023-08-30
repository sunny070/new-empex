@extends('layouts.web.app')

@section('title', 'Employment Detail - Empex')

@section('navbar')
@parent
@endsection

@section('content')
<div class="w-full py-5">
  <div class="max-w-7xl mx-auto px-4">
    <div class="w-full">
      <div class=" text-sm font-semibold ml-5 my-3">
        Employment card validation
      </div>
    </div>
    <div class="w-full md:shadow md:bg-white md:rounded md:border md:p-5 grid grid-cols-1 md:grid-cols-3 md:gap-8">
      <div class="max-w-sm bg-white rounded overflow-hidden shadow">
        <div class="bg-empex-green px-6 py-1 w-full">
          <div class="flex justify-center text-white align-middle items-center">
            <img src="/images/auth/emblem.svg" alt="emblem" class="w-7 h-7">
            <div>
              <div class="font-semibold text-sm">Employment Registration Card</div>
              <div class="text-xs">LESDE, Govt. of Mizoram</div>
            </div>
          </div>
        </div>
        <div class="px-6 py-2">
          <div class="grid grid-cols-4">
            <div class="col-span-3">
              <div class="text-sm">NCO : {{ $ncoCodeToDisplay }}</div>
              <div class="text-empex-green">{{ $info->employment_no }}</div>

              <div class="font-semibold mt-2">{{ $info->full_name }}</div>
              <div class="text-xs text-gray-400">
                <span class="mr-5"> {{ $info->phone_no }}</span>
                {{ $district->district->name }} District
              </div>

              <div class="text-xs text-empex-green mt-8">Valid :
                {{ date('d', strtotime($info->card_valid_from)) }}<sup>{{ date('S', strtotime($info->card_valid_from))
                  }}</sup>
                {{ date('M Y', strtotime($info->card_valid_from)) }} -
                {{ date('d', strtotime($info->card_valid_till)) }}<sup>{{ date('S', strtotime($info->card_valid_till))
                  }}</sup>
                {{ date('M Y', strtotime($info->card_valid_till)) }}
              </div>
            </div>
            <div>
              <img src="{{ asset('/storage/'.$info->avatar) }}" class="float-right h-16 w-16" alt="avatar">
              <div class="float-right mt-3">
                {!! QrCode::size(64)->generate(route('qr-code', [
                'phone' => $info->phone_no,
                'empNo' => $info->employment_no,
                ])) !!}
              </div>
            </div>
          </div>
        </div>
      </div>

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
            <div class="{{ $daysLeft > 0 ? '' : 'text-empex-red'}}">{{ date('d M Y', strtotime($info->card_valid_till))
              }}</div>
          </div>

          <div class="flex justify-between md:grid grid-cols-1 md:grid-cols-2 gap-1 md:gap-4">
            <div class="text-gray-400">Validity Days left</div>
            <div>{!! $daysLeft !!}</div>
          </div>
        </div>

        <div class="mt-5 text-gray-500">Please ensure the details on the scanned Card are same as this</div>
      </div>
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
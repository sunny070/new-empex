@extends('layouts.web.app')

@section('title', $notice->title)

@section('navbar')
@parent
@endsection

@section('content')
<div class="max-w-7xl mx-auto md:px-4 my-10">
  <div class=" grid grid-cols-1">
    <div class="w-full bg-white md:rounded-lg overflow-hidden md:shadow md:border col-span-2 mb-5 md:mb-0">
      <div class="px-6 py-4">
        <div class="flex justify-between">
          <a href="{{ route('web.notice-board') }}" class="text-empex-green">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" fill="none" viewBox="0 0 24 24"
              stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to List
          </a>
          @if ($notice->file != null)
          <a href="{{ asset('storage/'. $notice->file) }}" target="_blank" class="hover:text-empex-green">
            Download
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline text-empex-green" fill="none"
              viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
            </svg>
          </a>
          @endif
        </div>

        <div class="mt-5">
          <div class="font-semibold">
            {{ $notice->title }}
          </div>

          <div class="text-gray-400 text-sm mt-3">
            <span>{{ date('d', strtotime($notice->created_at)) }}<sup>{{ date('S', strtotime($notice->created_at))
                }}</sup>{{ date(' M Y', strtotime($notice->created_at)) }}</span>
          </div>

          <div class="mt-3 text-gray-500">
            {!! $notice->content !!}
          </div>

          <div class="text-gray-400 font-semibold my-2">Share Now</div>
          {!! Share::page(request()->url(), $notice->title, ['class' => 'text-empex-green text-2xl
          mx-2'])->telegram()->facebook()->linkedin()->twitter()->whatsapp() !!}
        </div>
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
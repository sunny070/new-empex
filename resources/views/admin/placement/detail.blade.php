@extends('layouts.web.app')

@section('title', $news->title)

@section('navbar')
    @parent
@endsection

@section('content')
    <div class="max-w-7xl mx-auto md:px-4 my-10">
        <div class=" grid grid-cols-1 md:grid-cols-3 md:gap-4">
            <div class="w-full bg-white md:rounded-lg overflow-hidden md:shadow md:border col-span-2 mb-5 md:mb-0">
                <div class="px-6 py-4">
                    <a href="{{ route('web.news') }}" class="text-empex-green">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Back to List
                    </a>
                    <div class="mt-5">
                        <div class="font-semibold">
                            {{ $news->title }}
                        </div>

                        <div class="text-gray-400 text-sm mt-3">
                            <span
                                class=" pr-2 mr-2 md:pr-5 md:mr-5 border-r-2 border-gray-300">{{ date('h:i A', strtotime($news->created_at)) }}</span><span>{{ date('d', strtotime($news->created_at)) }}<sup>{{ date('S', strtotime($news->created_at)) }}</sup>{{ date(' M Y', strtotime($news->created_at)) }}</span>
                        </div>

                        <div class="mt-3 text-gray-500">
                            {!! $news->content !!}
                        </div>

                        <div class="text-gray-400 font-semibold my-2">Share Now</div>
                        {!! Share::page(request()->url(), $news->title, [
                            'class' => 'text-empex-green text-2xl
                                                          mx-2',
                        ])->telegram()->facebook()->linkedin()->twitter()->whatsapp() !!}






                        <div class="mt-5">
                            <div class="mb-3 text-gray-800 font-medium">Attached File</div>
                            @if ($news->attachments)
                            <div class="break-words flex justify-between mb-2">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline text-empex-green"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                    </svg>
                                    <span>{{ $news->attachments->file_name }}</span>
                                </span>
                                <span>
                                    <span>{{ $news->attachments->file_size }}</span>
                                    <a href="{{ asset('storage/' . $news->attachments->file) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline text-empex-green"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                        </svg>
                                    </a>
                                </span>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="w-full border-t border-yellow-400 md:border-gray-200 md:p-3 md:h-36 bg-white md:rounded-lg overflow-hidden md:shadow md:border">
                <div class="flex px-6 py-4">
                    <img src="/images/features/news.svg" alt="news">
                    @livewire('web.news.count')
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

@extends('layouts.web.app')

@section('title', 'Notice Board - Empex')

@section('navbar')
@parent
@endsection

@section('content')
<div class="max-w-7xl mx-auto px-4 my-10">
	<div class="w-full">
		<div class=" text-sm font-semibold ml-5 my-3">
			Notice Board
		</div>
	</div>

	<div class=" grid grid-cols-1">
		<div class="w-full md:bg-white md:rounded-lg overflow-hidden md:shadow md:border mb-5 md:mb-0">
			<div class="md:px-6 md:py-4">
				<form action="" method="get" id="searchForm">
					<div class="grid grid-cols-6 my-3 content-center">
						<div class="col-span-5">
							<div class="relative">
								<input type="search" required name="q" value="{{ $search }}" id="search"
									class="w-full py-2 text-sm text-dark bg-empex-gray rounded-md focus:outline-none focus:bg-white border-empex-green focus:ring-0 focus:border-empex-green"
									placeholder="Search..." autocomplete="off">

								<span class="absolute inset-y-0 right-0 flex items-center pr-2">
									<button type="submit" class="p-1 focus:outline-none focus:shadow-outline">
										<svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
											stroke-width="2" viewBox="0 0 24 24" class="w-4 h-4">
											<path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
										</svg>
									</button>
								</span>
							</div>
						</div>
						<div class="flex col-span-1 justify-end">
							<button type="button" class="text-right mt-1 flex" onclick="openPopover(event,'showNewsSortingOption')">
								<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-flex" viewBox="0 0 20 20"
									fill="currentColor">
									<path fill-rule="evenodd"
										d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1z"
										clip-rule="evenodd" />
								</svg>
								<span class="ml-2 hidden md:inline">Sort</span>
							</button>
						</div>

						<div
							class="hidden bg-white border mr-3 z-50 font-normal leading-normal text-sm max-w-xs no-underline break-words rounded-lg w-52 shadow"
							id="showNewsSortingOption">
							<div class="text-gray-700 opacity-75 p-3 mb-0 rounded-t-lg">
								<div class="border-b mb-1">
									<span class="text-black">Sort By</span>
									<button type="button" class="float-right" onclick="openPopover(event,'showNewsSortingOption')">
										<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
											stroke="currentColor">
											<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
										</svg>
									</button>
								</div>
								<div class="flex items-center mb-2 mr-4">
									<input type="radio" {{ $sort=='newest' ? 'checked' : '' }} name="sort" value="newest" id="newest"
										class="h-4 w-4 text-empex-green ring-0 focus:ring-0 rounded-full mr-2 sortJob cursor-pointer">
									<label for="newest" class="cursor-pointer">Newest</label>
								</div>
								<div class="flex items-center mb-2">
									<input type="radio" {{ $sort=='oldest' ? 'checked' : '' }} name="sort" value="oldest" id="oldest"
										class="h-4 w-4 text-empex-green ring-0 focus:ring-0 rounded-full mr-2 sortJob cursor-pointer">
									<label for="oldest" class="cursor-pointer">Oldest</label>
								</div>
							</div>
						</div>
					</div>
				</form>

				<ul>
					@forelse ($notices as $notice)
					<a href="/notice/{{ $notice->slug }}">
						<li class="p-3 hover:bg-empex-gray hover:text-dark border-b border-gray-200">
							<div class="font-normal line-clamp-2">{{ $notice->title }}</div>
							<div class="text-gray-400 text-sm mt-3">
								<span>{{ date('d', strtotime($notice->created_at)) }}<sup>{{ date('S', strtotime($notice->created_at))
										}}</sup>{{ date(' M Y', strtotime($notice->created_at)) }}</span>
								@if ($notice->file != null)
								<a href="{{ asset('storage/'. $notice->file) }}" target="_blank"
									class="float-right hover:text-empex-green">
									Download
									<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline text-empex-green" fill="none"
										viewBox="0 0 24 24" stroke="currentColor">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
											d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
									</svg>
								</a>
								@endif
							</div>
						</li>
					</a>
					@empty
					<div class="font-normal">Notice not found</div>
					@endforelse
				</ul>

				<div class="py-2">
					{{ $notices->appends(['q' => $search, 'sort' => $sort])->onEachSide(1)->links() }}
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

<script type="module">
	document.getElementById("search").addEventListener("search", function(event) {
    document.getElementById("searchForm").submit();
	});

	$(document).on('change', '.sortJob', function () {
		$('#searchForm').submit();
	})
</script>
<div>
	<ul class="divide-y mt-5">
		@foreach ($userJobPost as $job)
		<li class="flex p-2 justify-between">
			<a href="/employment-news/{{ $job->job?->slug }}" class="hover:text-empex-green">
				<div class="font-normal">{{ mb_strimwidth($job->job?->title, 0, 40, '...') }}</div>
				<div class="text-gray-400 text-sm mt-3">
					<span>Due date:
						{{ date('d', strtotime($job->job?->due_date_of_submission)) }}<sup>{{ date('S',
							strtotime($job->job?->due_date_of_submission)) }}</sup>{{ date(' M Y',
						strtotime($job->job?->due_date_of_submission)) }}</span>
				</div>
			</a>

			<button type="button" class="h-5 w-5" onclick="openPopover(event,'deleteViewedJob')">
				<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-flex text-empex-red" fill="none"
					viewBox="0 0 24 24" stroke="currentColor">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
						d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
				</svg>
			</button>

			<div
				class="hidden bg-white border mr-3 z-50 font-normal leading-normal text-sm max-w-xs no-underline break-words rounded-lg w-52 shadow text-center"
				id="deleteViewedJob">
				<div class="text-gray-700 opacity-75 font-semibold p-3 mb-0 rounded-t-lg">
					Delete Viewed Post?
				</div>
				<input type="hidden" id="ongoingId">
				<div class="text-gray-700 p-3 flex justify-between">
					<button type="button" class="border bg-empex-red text-white px-5 rounded-md py-1"
						wire:click.prevent='deleteViewedJob({{ $job?->id }})'>Yes</button>
					<button type="button" class="border bg-white text-gray-400 px-5 rounded-md py-1"
						onclick="openPopover(event,'deleteViewedJob')">No</button>
				</div>
			</div>
		</li>
		@endforeach
	</ul>

	<div class="mt-5">
		{{ $userJobPost->links() }}
	</div>
</div>

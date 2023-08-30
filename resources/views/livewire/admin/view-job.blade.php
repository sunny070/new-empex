<div class="max-w-7xl mx-auto md:px-4 my-10">
	<div class=" grid grid-cols-1 md:grid-cols-3 md:gap-4">
		<div class="w-full md:bg-white md:rounded-lg overflow-hidden md:shadow md:border mb-5 md:mb-0 col-span-2">
			<div class="px-6 py-4">
				<a href="{{ route('unpublished.job') }}" class="text-empex-green">
					<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" fill="none" viewBox="0 0 24 24"
						stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
					</svg>
					Back
				</a>
				<div class="mt-5">
					<div class="font-semibold">
						{{ $job->title }}
					</div>

					<div class="text-gray-400 text-sm mt-3">
						<span class=" pr-2 mr-2 md:pr-5 md:mr-5 border-r-2">{{ $job->no_of_post }}
							post</span>
						<span><span class="hidden md:inline">Due
								date:</span> {{ date('d',
							strtotime($job->due_date_of_submission)) }}<sup>{{ date('S',
								strtotime($job->due_date_of_submission)) }}</sup>{{ date(' M Y',
							strtotime($job->due_date_of_submission)) }}</span>
					</div>

					<div class="mt-3 text-gray-600 text-base">
						{!! $job->description !!}
					</div>

					@if (count($job->attachments) > 0)
					<div class="mt-5">
						<div class="mb-3 text-gray-800 font-medium">Attached File</div>
						@foreach ($job->attachments as $file)
						<div class="break-words flex justify-between mb-2">
							<span>
								<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline text-empex-green" fill="none"
									viewBox="0 0 24 24" stroke="currentColor">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
										d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
								</svg>
								<span>{{ $file->file_name }}</span>
							</span>
							<span>
								<span>{{ $file->file_size }}</span>
								<a href="{{ asset('storage/'. $file->file) }}">
									<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline text-empex-green" fill="none"
										viewBox="0 0 24 24" stroke="currentColor">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
											d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
									</svg>
								</a>
							</span>
						</div>
						@endforeach
					</div>
					@endif
				</div>
			</div>
		</div>
		<div>
			<div
				class="w-full border-t border-empex-yellow md:bg-white md:rounded-lg overflow-hidden md:shadow md:border md:border-gray-200"
				style="height: max-content">
				<div class=" px-6 py-4">
					<div class="font-semibold">Employer</div>
					<div class="grid grid-cols-2 md:grid-cols-3 gap-2">
						<div>Name</div>
						<div class="md:col-span-2">{{ $job->organization_name }}</div>
					</div>
					<div class="grid grid-cols-2 md:grid-cols-3 gap-2">
						<div>Type</div>
						<div class="md:col-span-2">{{ $job->category->name }}, {{ $job->type->name }}</div>
					</div>
					<div class="grid grid-cols-2 md:grid-cols-3 gap-2">
						<div>Sector</div>
						<div class="md:col-span-2">{{ $job->sector->name }}</div>
					</div>
					<div class="grid grid-cols-2 md:grid-cols-3 gap-2">
						<div>Contact</div>
						<div class="md:col-span-2">{{ $job->admin->contact }}</div>
					</div>
				</div>
			</div>

			<div
				class="w-full border-t md:mt-3 border-empex-yellow md:bg-white md:rounded-lg overflow-hidden md:shadow md:border md:border-gray-200"
				style="height: max-content">
				<div class=" px-6 py-4">
					<div class="font-semibold">Action</div>

					<div class="flex justify-between mt-3">
						<button wire:click='approved'
							class="bg-empex-green text-white rounded px-4 py-1 text-base font-medium hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-300">Approve</button>
						<a href="{{ route('unpublished.job') }}"
							class="bg-empex-yellow text-white rounded px-4 py-1 text-base font-medium hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-300">
							Cancel
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

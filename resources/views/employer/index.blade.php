@extends('layouts.employer.app')

@section('title', 'Employer - Dashboard')

@section('navbar')
@parent
@endsection

@section('content')
<div class="max-w-7xl mx-auto px-4 my-10">
	<div class="w-full">
		<div class=" text-sm font-semibold ml-5 my-3">
			Employer Dashboard
		</div>
	</div>

	<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-5">
		<div class="border bg-white rounded p-5">
			<div class="font-bold text-2xl">Post New Job</div>
			<div class="text-gray-400 mt-4">Post a new job for all users of Empex</div>
			<div class="mt-8">
				<a href="{{ route('employer.job.create') }}"
					class="uppercase py-1 px-5 bg-empex-green rounded text-white font-bold">New Post</a>
			</div>
		</div>
		<div class="border bg-white rounded p-5">
			<div class="font-bold text-2xl">{{ count($jobPosts) }}</div>
			<div class="empex mt-4"></div>
			<div class="font-bold mt-4">Total jobs posted</div>
			<div class="text-gray-400 mt-4">Total</div>
		</div>
		<div class="border bg-white rounded p-5">
			<div class="font-bold text-2xl">{{ $totalNoOfPost }}</div>
			<div class="empex mt-4"></div>
			<div class="font-bold mt-4">No. of Posts Available</div>
			<div class="text-gray-400 mt-4">Total</div>
		</div>
	</div>

	<div class="flex flex-col mt-5 bg-white rounded">
		<div class="overflow-x-auto">
			<div class="align-middle inline-block min-w-full">
				<div class="overflow-hidden border-b border-gray-200">
					<table class="min-w-full divide-y divide-black">
						<thead class="">
							<tr>
								<th class="py-1 text-left font-bold tracking-wider w-28 mr-2 md:w-96">Title</th>
								<th class="py-1 text-center font-bold tracking-wider">No. of Posts</th>
								<th class="py-1 text-center font-bold tracking-wider">Due Date</th>
								<th class="py-1 text-center font-bold tracking-wider">Status</th>
								<th class="py-1 text-right font-bold tracking-wider">Action</th>
							</tr>
						</thead>
						<tbody class="bg-white divide-y divide-gray-200">
							@forelse ($jobPosts as $job)
							<tr>
								<td class="py-2 whitespace-nowrap w-28 mr-2 md:w-96 line-clamp-1">{{ $job->title }}</td>
								<td class="py-2 whitespace-nowrap text-center">{{ $job->no_of_post }}</td>
								<td class="py-2 whitespace-nowrap text-center">{{ date('d M Y',
									strtotime($job->due_date_of_submission))
									}}</td>
								<td class="py-2 whitespace-nowrap text-center">{{ $job->published == 0 ? 'Unpublished' : 'Published' }}
								</td>
								<td class="py-2 whitespace-nowrap text-right text-sm font-medium">
									<a href="{{ route('employer.job.edit', $job->id) }}" class="text-indigo-600" title="Edit">
										<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline" fill="none" viewBox="0 0 24 24"
											stroke="currentColor">
											<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
												d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
										</svg>
									</a>
									<form action="{{ route('employer.job.delete', $job->id) }}" method="post" class="inline"
										id="removeForm">
										@csrf
										<button type="button" id="removePost" class="text-empex-red" title="Delete">
											<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline" fill="none" viewBox="0 0 24 24"
												stroke="currentColor">
												<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
													d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
											</svg>
										</button>
									</form>
								</td>
							</tr>
							@empty
							<tr>
								<td colspan="4" class="px-4 py-2 whitespace-nowrap">No Job Found!</td>
							</tr>
							@endforelse
						</tbody>
					</table>
				</div>
				<div class="mt-3">
					{{ $jobPosts->links() }}
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).on('click', '#removePost', function () {
			if (confirm('Are you sure to delete this post?')) {
				$('#removeForm').submit();
			}
		})
</script>

@if (auth()->user()->active == 0)
<button class="hidden" id="triggerDataModal" onclick="Livewire.emit('openModal', 'employer.create-detail')">Edit
	User</button>

<script>
	$(document).ready(function () {
		$('#triggerDataModal').click();
	});
</script>
@endif
@endsection
@extends('layouts.web.app')

@section('title', 'Welcome '. $userName)

@section('navbar')
@parent
@endsection

@section('content')
<div class="w-full py-5">
	<div class="max-w-7xl mx-auto px-4">
		@if (Session('message'))
		<div class="flex flex-col mb-5 bg-white border-empex-yellow shadow border rounded" x-data="{ show: true }"
			x-show="show" x-init="setTimeout(() => show = false, 5000)">
			<div class="flex items-center justify-between">
				<div class="flex items-center">
					<div class="bg-empex-yellow rounded-l p-6 md:p-4">
						<img src="/images/auth/info.svg" alt="noti">
					</div>
					<div class="flex flex-col mx-3 py-2 md:py-0">
						<div class="font-medium leading-none">{{ session('message') }}</div>
						<p class="text-sm text-gray-600 leading-none mt-1">Track your application status on <a
								href="{{ route('auth.enrollment.status') }}" class="underline text-empex-green">Ongoing Application</a>
						</p>
					</div>
				</div>
			</div>
		</div>
		@endif

		{{-- employee info --}}
		<div class="mb-3 ml-3 font-semibold">Employee application info</div>
		<div class=" grid grid-cols-1 md:grid-cols-3 md:gap-4">
			<div class="w-full text-white bg-empex-green rounded overflow-hidden border col-span-2 mb-5 p-5 md:mb-0">
				<div class="grid grid-cols-2 gap-2">
					<div>
						<div class="mb-2">Chibai!</div>
						<div class="text-empex-yellow mb-2 text-xl">{{ $userName }}</div>
					</div>
					@if ($noti > 0)
					<a href="{{ route('auth.notification') }}">
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
							stroke="currentColor" class="w-6 h-6 float-right text-empex-yellow">
							<path stroke-linecap="round" stroke-linejoin="round"
								d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0M3.124 7.5A8.969 8.969 0 015.292 3m13.416 0a8.969 8.969 0 012.168 4.5" />
						</svg>
					</a>
					@else
					<a href="{{ route('auth.notification') }}">
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
							stroke="currentColor" class="w-6 h-6 float-right text-white">
							<path stroke-linecap="round" stroke-linejoin="round"
								d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
						</svg>
					</a>
					@endif
				</div>

				<div class="grid grid-cols-1 md:grid-cols-2 gap-1">
					<div class="flex mb-5">
						<img class=" h-10" src="/images/auth/card_valid.svg" alt="valid card">
						@if ($registrationCard)
						<a href="{{ route('auth.enrollment.card') }}" class="ml-3">
							<div>Card Valid Till</div>

							<div>{{ date('d', strtotime($cardValidTill)) }}<sup>{{ date('S', strtotime($cardValidTill)) }}</sup>
								{{ date('M Y', strtotime($cardValidTill)) }}</div>
						</a>
						@else
						<div class="ml-3">
							<div>No Registration</div>
							<div>Card Found</div>
						</div>
						@endif
					</div>
					<div class="flex">
						<img class="h-10" src="/images/auth/profile_complete.svg" alt="valid card">
						@if ($completedProfile)
						<div class="ml-3">
							<div>Profile Completed</div>
							<a href="{{ route('auth.profile') }}">View Now</a>
						</div>
						@else
						<div class="ml-3">
							<div>{{ $percent }}% Profile</div>
							<div>Completed</div>
						</div>
						@endif
					</div>
				</div>
			</div>

			<div class="w-full bg-white rounded shadow overflow-hidden border mb-5 p-5 md:mb-0">
				<div class="text-4xl font-semibold">{{ $totalOngoingApplication }}</div>
				<div class="empex-sm mt-5"></div>
				<div class="mt-2 font-semibold">Ongoing applications and requests</div>
				<div class=" uppercase mt-2">
					<a href="{{ route('auth.enrollment.status') }}" class="text-empex-green font-semibold">view now</a>
				</div>
			</div>
		</div>

		{{-- quick links --}}
		<div class="my-3 ml-3 font-semibold">Quick links</div>
		<div class="grid grid-cols-1 md:grid-cols-2 md:gap-4">
			<div class="w-full bg-white rounded shadow overflow-hidden border mb-5 p-5 md:mb-0">
				<div class="flex">
					<img class=" h-16" src="/images/auth/quick_link1.svg" alt="valid card">
					@if (!$registrationCard)
					<div class="ml-5 w-full">
						<div class="font-semibold mb-2">Employment Registration Card</div>
						<div class="text-gray-400">Apply for Empex Card</div>
						<div class=" uppercase mt-2">
							<a href="{{ route('auth.employee.newregistration') }}" class="text-empex-green font-semibold">apply
								now</a>
						</div>
					</div>
					@else
					<div class="ml-5 w-full">
						<div class="font-semibold mb-2">Employment Registration Card</div>
						<div class="text-gray-400">{{ $employmentNo }}</div>
						<div class=" uppercase mt-2">
							<a href="{{ route('auth.enrollment.card') }}" class="text-empex-green font-semibold">view
								now</a>
						</div>
					</div>
					@endif
				</div>
			</div>

			<div class="w-full bg-white rounded shadow overflow-hidden border mb-5 p-5 md:mb-0">
				<div class="flex">
					<img class=" h-16" src="/images/auth/quick_link2.svg" alt="valid card">
					<div class="ml-5 w-full">
						<div class="font-semibold mb-2">Vacancy</div>
						<div class="text-gray-400">{{ $totalJobs }} jobs available</div>
						<div class=" uppercase mt-2">
							<a href="{{ route('web.jobs') }}" class="text-empex-green font-semibold">view now</a>
						</div>
					</div>
				</div>
			</div>
		</div>

		{{-- jobs and news --}}
		<div class="grid grid-cols-1 md:grid-cols-2 md:gap-4">
			<div>
				<div class="my-3 ml-3 font-semibold">Employment News</div>
				<div class="w-full bg-white rounded shadow overflow-hidden border mb-5 p-3 md:mb-0">
					<ul class="divide-y-2 divide-gray-400">
						@forelse ($jobList as $job)
						<a href="/employment-news/{{ $job->slug }}">
							<li class="flex p-3 hover:bg-empex-gray hover:text-dark border-b border-gray-200 justify-between">
								<div>
									<div class="font-normal">{{ mb_strimwidth($job->title, 0, 70, '...') }}</div>
									{{-- <span class="hidden md:block text-sm text-gray-600">{!! mb_strimwidth($job->description, 0, 100,
										'...') !!}</span> --}}
									<div class="text-gray-400 text-sm mt-3">
										<span class=" pr-2 mr-2 md:pr-5 md:mr-5 border-r-2 border-gray-300">{{ $job->no_of_posts}}
											post</span><span>Due date:
											{{ date('d', strtotime($job->due_date_of_submission)) }}<sup>{{ date('S',
												strtotime($job->due_date_of_submission)) }}</sup>{{ date(' M Y',
											strtotime($job->due_date_of_submission)) }}</span>
									</div>
								</div>
								@if ($job->logo)
								<img class=" h-16" src="/images/jobs/jobs.webp" alt="jobs">
								@endif
							</li>
						</a>
						@empty
						<div class="font-normal">Job not found</div>
						@endforelse
					</ul>

					@if (count($jobList) > 0)
					<div class="py-3">
						<a href="{{ route('web.jobs') }}" class="ml-2 uppercase text-empex-green font-semibold">view
							news</a>
					</div>
					@endif
				</div>
			</div>

			<div>
				<div class="my-3 ml-3 font-semibold">Career Articles</div>
				<div class="w-full bg-white rounded shadow overflow-hidden border mb-5 p-3 md:mb-0">
					<ul class="divide-y-2 divide-gray-400">
						@forelse ($newsList as $news)
						<a href="/career-guidance/{{ $news->slug }}">
							<li class="p-3 hover:bg-empex-gray hover:text-dark border-b border-gray-200">
								<div class="font-normal">{{ mb_strimwidth($news->title, 0, 90, '...') }}</div>
								{{-- <span class="hidden md:block text-sm text-gray-600">{!! mb_strimwidth($news->content, 0, 100,
									'...') !!}</span> --}}
								<div class="text-gray-400 text-sm mt-3">
									<span class=" pr-2 mr-2 md:pr-5 md:mr-5 border-r-2 border-gray-300">{{ date('h:i A',
										strtotime($news->created_at)) }}</span><span>{{ date('d', strtotime($news->created_at)) }}<sup>{{
											date('S', strtotime($news->created_at)) }}</sup>{{ date(' M Y', strtotime($news->created_at))
										}}</span>
								</div>
							</li>
						</a>
						@empty
						<div class="font-normal">News not found</div>
						@endforelse
					</ul>

					@if (count($newsList) > 0)
					<div class="py-3">
						<a href="{{ route('web.news') }}" class="ml-2 uppercase text-empex-green font-semibold">view
							articles</a>
					</div>
					@endif
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

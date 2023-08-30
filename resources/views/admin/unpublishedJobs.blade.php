@extends('layouts.admin')
@section('content')
<div class="max-w-7xl mx-auto px-4 mb-10 mt-5">
  <div class="w-full flex justify-between">
    <div class="text-sm font-semibold ml-5">
      Unpublished Job Post
    </div>
    <a href="{{ route('jobsPost') }}"
      class="bg-empex-green text-white rounded px-4 py-1 text-base font-medium hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-300">
      All Jobs
    </a>
  </div>

  <div class="mt-5">
    <div class="flex flex-col w-full">
      <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
          <div class="shadow overflow-hidden border-b">
            <table class="min-w-full divide-y divide-gray-200">
              <thead>
                <tr>
                  <th scope="col" class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wide">
                    Name
                  </th>
                  <th scope="col" class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wide">
                    Organization Name
                  </th>
                  <th scope="col" class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wide">
                    No of Posts
                  </th>
                  <th scope="col" class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wide">
                    Due Date
                  </th>
                  <th scope="col" class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wide">
                    Status
                  </th>
                  <th scope="col" class="px-6 py-3 text-right font-medium uppercase tracking-wide">
                    Action
                  </th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                @forelse($jobs as $job)
                <tr class="hover:bg-gray-50">
                  <td class="px-6 py-4 whitespace-nowrap text-sm">
                    {{ $job->title }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm">
                    {{ $job->organization_name }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm">
                    {{ $job->no_of_post }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm">
                    {{ date('d-M-Y', strtotime($job->due_date_of_submission)) }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm">
                    {{ $job->published == 1 ? 'Published' : 'Unpublished' }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-right font-medium">
                    <a href="{{ route('view.job', $job->id) }}"
                      class="text-indigo-600 dark:text-indigo-500 hover:text-indigo-900 dark:hover:text-indigo-700">View</a>
                  </td>
                </tr>
                @empty
                <tr>
                  <td class="px-6 py-4 whitespace-nowrap" colspan="5">Jobs not found</td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="py-2">
        {{ $jobs->onEachSide(1)->links() }}
      </div>
    </div>
  </div>
</div>
@endsection
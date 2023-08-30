@extends('layouts.admin')
@section('content')
    <div class="max-w-7xl mx-auto px-4 mb-10 mt-5">
        <div class="w-full flex justify-between">
            <div class="text-sm font-semibold ml-5">
                Career Guidance
            </div>
            <a href="{{ route('create.news') }}"
                class="float-right bg-empex-green text-white rounded px-4 py-1 text-base font-medium hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-300">
                Add
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
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wide">
                                            Title
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wide">
                                            Post Date
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-right font-medium uppercase tracking-wide">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse($news as $empNews)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                {{ $empNews->title }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                {{ $empNews->created_at->format('d-M-Y') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-right font-medium">
                                                <a href="{{ route('edit.employee.news', $empNews->id) }}"
                                                    class="text-indigo-600 dark:text-indigo-500 hover:text-indigo-900 dark:hover:text-indigo-700">Edit</a>
                                            </td>

                                            <td>

                                                @livewire('delete-news', ['id' => $empNews->id])
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap" colspan="3">Employee news not found
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="py-2">
                    {{ $news->onEachSide(1)->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.admin')
@section('content')
    <div class="py-5">
        <div class="max-w-7xl mx-auto px-4">
            <h6 class="text-gray-600 font-semibold dark:text-gray-200 mb-2">Create Articles</h6>
            <div class="lg:flex items-center justify-between bg-white p-5 shadow border border-empex-gray rounded-lg">
                <form action="{{ route('save.news') }}" method="post" enctype="multipart/form-data" class="w-full">
                    @csrf
                    <input
                        class="mb-3 w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-green-500 text-sm focus:outline-none focus:border-green-400 focus:bg-white"
                        type="text" placeholder="Enter Title" name="title" />
                    @error('title')
                        <div class="text-xs text-empex-red">{{ $message }}</div>
                    @enderror
                    <textarea id="description"
                        class="mb-3 w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-green-500 text-sm focus:outline-none focus:border-green-400 focus:bg-white"
                        placeholder="Content" name="content"></textarea>
                    @error('content')
                        <div class="text-xs text-empex-red">{{ $message }}</div>
                    @enderror



                    <div class="w-full relative">
                        <div class="flex justify-between">
                            <div>
                                <label class="tracking-wide text-gray-500 text-xs font-semibold -mt-3" for="attachments">
                                    PDF attachments (Max 2MB)
                                </label>
                                <input name='attachment'
                                    class="w-full border-gray-400 text-base text-gray-500 focus:text-empex-green focus:border-empex-green focus:outline-none focus:ring-green-600"
                                    type="file" placeholder="PDF" accept=".pdf">
                                @error('attachment')
                                    <p class="text-empex-red text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>
                    </div>

                    <button type="submit"
                        class="mt-3 bg-green-500 text-white rounded-md px-8 py-2 text-base font-medium hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-300"
                        id="open-btn">
                        Save
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('loadedScripts')
    <script src="https://cdn.tiny.cloud/1/vht8bgfmk42s3epjyw0o4n8n61x93u4egnrswpj13dwdvi7d/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: '#description',
            height: '400',
        });
    </script>
@endsection

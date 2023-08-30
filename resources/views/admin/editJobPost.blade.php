@extends('layouts.admin')
@section('content')
<div class="py-5">
  <div class="max-w-7xl mx-auto px-4">
    <h6 class="text-gray-600 font-semibold dark:text-gray-200">Edit {{ $job->title }}</h6>
    <div class="lg:flex items-center py-4 space-y-2 sm:space-y-4 md:space-y-2 lg:space-y-0 w-full">
      @livewire('admin.edit-job', ['job' => $job])
    </div>
  </div>
</div>
@endsection

@section('loadedScripts')
<script src="https://cdn.tiny.cloud/1/vht8bgfmk42s3epjyw0o4n8n61x93u4egnrswpj13dwdvi7d/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script type="text/javascript">
  tinymce.init({
    selector: '#description',
    height: '400',
  });
</script>
@endsection

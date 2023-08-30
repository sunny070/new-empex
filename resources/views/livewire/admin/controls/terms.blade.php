<div class="md:ml-5">
	<div class="mb-3 text-xl md:hidden">Terms & Condition</div>
	<div class="flex flex-col w-full mb-5">
		<div class="w-full" wire:ignore>
			<label class="block font-medium text-sm text-gray-700" for="description">Content* (This terms and condition is for
				employer registration)</label>
			<textarea id="content" wire:model="content" placeholder="Content" wire:key='content'></textarea>
		</div>
		@error('content')
		<p class="text-red-500 text-xs italic">{{ $message }}</p>
		@enderror
	</div>

	<button type="submit" wire:click.prevent='update'
		class="tracking-wide font-semibold bg-indigo-500 text-gray-100 py-2 px-4 rounded-lg hover:bg-indigo-700 transition-all duration-300 ease-in-out flex items-center justify-center focus:shadow-outline focus:outline-none">
		Update
	</button>

	@if (env('APP_ENV') == 'local')
	<div class="mt-5 grid grid-cols-1 md:grid-cols-2 gap-4">
		<div>
			<div class=" font-semibold my-2">Import Jobseeker</div>
			<input type="file" wire:model.lazy='file'>
			@error('file')
			<div class="text-xs text-empex-red">{{ $message }}</div>
			@enderror
			<button wire:click='importExcel' wire:loading.attr="disabled"
				wire:loading.class="bg-gray-400 text-black cursor-not-allowed"
				wire:loading.class.remove="bg-indigo-500 text-white"
				class="px-2 bg-indigo-500 block mt-2 text-white rounded py-1">
				<span wire:loading.remove wire:target='importExcel'>
					Import
				</span>

				<span wire:loading wire:target='importExcel'>
					Importing...
				</span>
			</button>
		</div>

		<div>
			<div class=" font-semibold my-2">Import Archive Jobseeker</div>
			<input type="file" wire:model.lazy='archiveFile'>
			@error('archiveFile')
			<div class="text-xs text-empex-red">{{ $message }}</div>
			@enderror
			<button wire:click='importArchive' wire:loading.attr="disabled"
				wire:loading.class="bg-gray-400 text-black cursor-not-allowed"
				wire:loading.class.remove="bg-indigo-500 text-white"
				class="px-2 bg-indigo-500 block mt-2 text-white rounded py-1">
				<span wire:loading.remove wire:target='importArchive'>
					Archive
				</span>

				<span wire:loading wire:target='importArchive'>
					Archiving...
				</span>
			</button>
		</div>
	</div>
	@endif

	@if (Session('success'))
	<div class="flex flex-col mt-5 bg-white border-empex-green shadow border rounded p-2" x-data="{ show: true }"
		x-show="show" x-init="setTimeout(() => show = false, 2000)">
		<div class="font-medium leading-none">{{ session('success') }}</div>
	</div>
	@endif

	<script>
		$(document).ready(function () {
	    $('#content').on('change keyup paste', function (e) {
	      var data = $(this).val();
	      @this.set('content', data);
	    });
	  });
	</script>

	<script src="https://cdn.tiny.cloud/1/vht8bgfmk42s3epjyw0o4n8n61x93u4egnrswpj13dwdvi7d/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
	<script>
		$(document).ready(function() {
				window.initSelect2=()=>{
	        tinymce.init({
	          selector: '#content',
	          height: '500',
	          setup: function (editor) {
	            editor.on('init change', function () {
	            editor.save();
	          });
	          editor.on('change', function (e) {
	            @this.set('content', editor.getContent());
	          });}
	        });
				}

				initSelect2();

				window.livewire.on('select2AutoInit',()=>{
					initSelect2();
				});
			});
	</script>
</div>

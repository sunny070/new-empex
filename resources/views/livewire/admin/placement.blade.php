<div class="bg-white rounded border p-5 w-full">
  <div class="mb-5">Please fill the job details</div>
  <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-5">
    <div class="w-full relative">
      <label class="tracking-wide text-gray-500 text-xs" for="category">
        Category*
      </label>
      <select id="category" wire:model.lazy='category'
        class="w-full p-2 rounded input border-gray-400 text-base text-gray-600 focus:text-empex-green focus:border-green-600 focus:outline-none focus:ring-green-600"
        id="category">
        <option hidden value="">Select Category</option>
        @foreach ($categories as $category)
        <option value="{{ $category->id }}"> {{ $category->name }}</option>
        @endforeach
      </select>
      @error('category')
      <p class="text-red-500 text-xs italic">{{ $message }}</p>
      @enderror
    </div>
    <div class="w-full relative">
      <label class="tracking-wide text-gray-500 text-xs" for="type">
        Type*
      </label>
      <select id="type" wire:model.lazy='type'
        class="w-full p-2 rounded input border-gray-400 text-base text-gray-600 focus:text-empex-green focus:border-green-600 focus:outline-none focus:ring-green-600"
        id="jobType">
        <option hidden value="">Select Type</option>
        @foreach ($types as $type)
        <option value="{{ $type->id }}"> {{ $type->name }}</option>
        @endforeach
      </select>
      @error('type')
      <p class="text-red-500 text-xs italic">{{ $message }}</p>
      @enderror
    </div>
    <div class="w-full relative md:col-span-2">
      <label class="tracking-wide text-gray-500 text-xs" for="title">
        Job Title*
      </label>
      <input wire:model.lazy="title"
        class="w-full rounded input border-gray-400 text-base text-gray-600 focus:text-empex-green focus:border-green-600 focus:outline-none focus:ring-green-600"
        id="title" type="text" placeholder="Job Title*">
      @error('title')
      <p class="text-red-500 text-xs italic">{{ $message }}</p>
      @enderror
    </div>

    <div class="w-full relative md:col-span-2" wire:ignore>
      <label class="block font-medium text-sm text-gray-700" for="description">Description*</label>
      <textarea id="description" wire:model.debounce.9999999ms="description" wire:key="description"
        placeholder="Description"></textarea>
      @error('description')
      <p class="text-red-500 text-xs italic">{{ $message }}</p>
      @enderror
    </div>
    <div class="w-full relative">
      <label class="tracking-wide text-gray-500 text-xs" for="organization_name">
        Organization Name*
      </label>
      <input wire:model.lazy="organizationName"
        class="w-full rounded input border-gray-400 text-base text-gray-600 focus:text-empex-green focus:border-green-600 focus:outline-none focus:ring-green-600"
        id="organization_name" type="text" placeholder="Organization Name*">
      @error('organizationName')
      <p class="text-red-500 text-xs italic">{{ $message }}</p>
      @enderror
    </div>
    <div class="w-full relative">
      <label class="tracking-wide text-gray-500 text-xs" for="sector">
        Sector*
      </label>
      <select wire:model.lazy='sector'
        class="w-full p-2 rounded input border-gray-400 text-base text-gray-600 focus:text-empex-green focus:border-green-600 focus:outline-none focus:ring-green-600"
        id="sector">
        <option value="">Select Sector</option>
        @foreach ($sectors as $sector)
        <option value="{{ $sector->id }}"> {{ $sector->name }}</option>
        @endforeach
      </select>
      @error('sector')
      <p class="text-red-500 text-xs italic">{{ $message }}</p>
      @enderror
    </div>
    <div class="w-full relative">
      <label class="tracking-wide text-gray-500 text-xs" for="no_of_post">
        No of Posts*
      </label>
      <input wire:model.lazy="noOfPosts"
        class="w-full rounded input border-gray-400 text-base text-gray-600 focus:text-empex-green focus:border-green-600 focus:outline-none focus:ring-green-600"
        id="no_of_post" type="number" placeholder="No of Posts*">
      @error('noOfPosts')
      <p class="text-red-500 text-xs italic">{{ $message }}</p>
      @enderror
    </div>

    <div class="w-full relative">
      <label class="tracking-wide text-gray-600 text-xs" for="dueDate">
        Due Date*
      </label>
      <input wire:model.lazy='dueDate'
        class="w-full rounded input text-base text-gray-600 focus:text-empex-green focus:border-green-600 focus:outline-none focus:ring-green-600 border-gray-400"
        id="dob" type="date" placeholder="Due Date*">
      @error('dueDate')
      <p class="text-red-500 text-xs italic">{{ $message }}</p>
      @enderror
    </div>
  </div>

  <div class="border my-3"></div>

  <div class="mb-3">Please choose the relevant National Classification of Occupation (NCO) for the job. Users with
    similar NCO will get notifications for the availability of your Job post.</div>
  <div class="w-full relative">
    <label class="tracking-wide text-gray-500 text-xs label-select2" for="spoken">
      NCO 2015*
    </label>
    <select id="ncos" multiple wire:model.lazy='nco'>
      @foreach ($ncoOccupation as $ncoOcu)
      <option value="{{ $ncoOcu->id }}">
        {{ $ncoOcu->name }}</option>
      @endforeach
    </select>
    @error('nco')
    <p class="text-red-500 text-xs italic">{{ $message }}</p>
    @enderror
  </div>

  <div class="border my-3"></div>
  <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="md:col-span-2 font-bold">Attachments</div>
    @if (count($jobAttachments) > 0)
    @foreach ($jobAttachments as $jobIndex => $attach)
    <div class="w-full relative">
      <div class="flex justify-between">
        <a href="{{ asset('storage/'.$attach['file']) }}" target="_blank" class="text-empex-green">{{
          $attach['file_name'] }}</a>
        <button class="text-empex-red" wire:click.prevent='deleteAttachment({{ $attach[' id'] }}, {{ $jobIndex }})'>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
    </div>
    @endforeach
    @endif

    @foreach ($attachments as $pdfIndex => $pdf)
    <div class="w-full relative">
      <div class="flex justify-between">
        <div>
          <label class="tracking-wide text-gray-500 text-xs font-semibold -mt-3" for="attachments">
            PDF attachments (Max 2MB)
          </label>
          <input wire:model.lazy='attachments.{{ $pdfIndex }}.file'
            class="w-full border-gray-400 text-base text-gray-500 focus:text-empex-green focus:border-empex-green focus:outline-none focus:ring-green-600"
            type="file" placeholder="PDF" accept=".pdf">
          @error('file')
          <p class="text-empex-red text-xs italic">{{ $message }}</p>
          @enderror
        </div>
        <button class="text-empex-red" wire:click.prevent='removeAttachment({{ $pdfIndex }})'>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
    </div>
    @endforeach
  </div>

  <div class="flex w-full mt-5 justify-between">
    <button type="button" class="text-empex-green uppercase font-semibold text-sm"
      wire:click.prevent='addMoreAttachment'>
      @if (count($attachments) == 0)
      Add Attachment
      @else
      Add More attachment
      @endif
    </button>
  </div>

  <div class="border mt-3"></div>

  <div class="flex justify-between md:justify-start mt-5">
    <div class="md:mr-2 ">
      <button type="submit" wire:click.prevent='submit' wire:loading.attr="disabled" wire:loading.class="bg-gray-400"
        wire:loading.class.remove="bg-empex-green hover:bg-green-500"
        class="uppercase focus:outline-none border border-transparent py-1 px-5 rounded text-center text-white bg-empex-green hover:bg-green-500 font-medium">
        <span wire:loading.remove wire:target='submit'>
          Post job
        </span>

        <span wire:loading wire:target='submit'>
          Posting...
        </span>
      </button>
    </div>

    <div class="md:ml-2 ">
      <button wire:click.prevent='cancel'
        class="uppercase focus:outline-none py-1 border-empex-green text-empex-green px-5 rounded text-center text-empex bg-white hover:bg-gray-100 font-medium border">Cancel</button>
    </div>
  </div>
</div>
<script>
  $(document).ready(function () {
    $('#description').on('change keyup paste', function (e) {
      var data = $(this).val();
      @this.set('description', data);
    });
  });
</script>

<script src="https://cdn.tiny.cloud/1/vht8bgfmk42s3epjyw0o4n8n61x93u4egnrswpj13dwdvi7d/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
  $(document).ready(function() {
			window.initSelect2=()=>{
        tinymce.init({
          selector: '#description',
          height: '400',
          forced_root_block: false,
          setup: function (editor) {
            editor.on('init change', function () {
            editor.save();
          });
          editor.on('change', function (e) {
            @this.set('description', editor.getContent());
          });}
        });

				$("#ncos").select2({
					allowClear: true,
					placeholder:"Select NCO(multiple)"
				});
			}

			initSelect2();

			$('#ncos').on('change', function (e) {
				@this.set('nco', $(this).val());
			});

			window.livewire.on('select2AutoInit',()=>{
				initSelect2();
			});
		});
</script>

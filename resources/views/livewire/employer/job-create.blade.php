<div>
	<div class="w-full">
		<div class=" text-sm font-semibold ml-5 my-3">
			@if ($jobId !== null)
			Edit Job
			@else
			Post New Job
			@endif
		</div>
	</div>

	<div class="bg-white rounded border p-5">
		<div class="mb-5">Please fill the job details</div>
		<form>
			<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-5">
				<div class="w-full relative md:col-span-2">
					<input wire:model.lazy="title"
						class="w-full rounded input border-gray-400 text-base text-gray-600 focus:text-empex-green focus:border-green-600 focus:outline-none focus:ring-green-600"
						id="title" type="text" placeholder="Job Title*">
					<label class="tracking-wide text-gray-500 text-xs label" for="title">
						Job Title*
					</label>
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
					<input wire:model.lazy="no_of_post"
						class="w-full rounded input border-gray-400 text-base text-gray-600 focus:text-empex-green focus:border-green-600 focus:outline-none focus:ring-green-600"
						id="no_of_post" type="number" placeholder="No of Posts*">
					<label class="tracking-wide text-gray-500 text-xs label" for="no_of_post">
						No of Posts*
					</label>
					@error('no_of_post')
					<p class="text-red-500 text-xs italic">{{ $message }}</p>
					@enderror
				</div>

				<div class="w-full relative">
					<input wire:model.lazy='due_date' min="{{ date('Y-m-d') }}"
						class="w-full rounded input text-base text-gray-600 focus:text-empex-green focus:border-green-600 focus:outline-none focus:ring-green-600 border-gray-400"
						id="dob" type="date" placeholder="Due Date*">
					<label class="tracking-wide text-gray-600 text-xs label" for="dueDate">
						Due Date*
					</label>
					@error('due_date')
					<p class="text-red-500 text-xs italic">{{ $message }}</p>
					@enderror
				</div>
			</div>

			<div class="border my-3"></div>

			<div class="mb-3">Please choose the relevant National Classification of Occupation (NCO) for the job. Users with
				similar NCO will get notifications for the availability of your Job post.</div>
			<div class="w-full relative">
				<select id="ncos" multiple wire:model.lazy='nco'>
					@foreach ($ncoOccupation as $ncoOcu)
					<option value="{{ $ncoOcu->id }}">
						{{ $ncoOcu->name }}</option>
					@endforeach
				</select>
				<label class="tracking-wide text-gray-500 text-xs label-select2" for="spoken">
					NCO 2015*
				</label>
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
						<button class="text-empex-red" wire:click.prevent='deleteAttachment({{ $attach["id"] }}, {{ $jobIndex }})'>
							<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
								stroke="currentColor">
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
							<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
								stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
							</svg>
						</button>
					</div>
				</div>
				@endforeach
			</div>

			<div class="flex w-full mt-5 justify-between">
				<button type="button" class="text-empex-green uppercase font-semibold text-sm"
					wire:click.prevent='addMoreAttachment'>Add More attachment</button>
			</div>

			<div class="border mt-3"></div>

			@if ($confirmOtp == 1 && $jobId == null)
			<div class="grid grid-cols-1 md:grid-cols-4 gap-2">
				<div class="w-full relative mt-5">
					<input type="number"
						class="w-full input border-gray-400 rounded text-base text-gray-500 focus:text-empex-green focus:border-green-600 focus:outline-none focus:ring-green-600"
						placeholder="OTP*" wire:model.lazy='otp' required />
					<label class="tracking-wide text-gray-500 text-xs label">
						OTP*
					</label>
					<div class="text-left">
						@error('otp') <span class="text-sm text-empex-red">{{ $message }}</span> @enderror
					</div>
					@if (session()->has('otpError'))
					<div class="text-left">
						<span class="text-sm text-empex-red">{{ session('otpError') }}</span>
					</div>
					@endif
				</div>
				<div class="flex items-center md:mt-4">
					OTP sent to {{ preg_replace('~[+\d-](?=[\d-]{4})~', '*', auth()->guard('admin')->user()->contact) }}
				</div>
			</div>
			@endif

			<div class="flex justify-between md:justify-start mt-5">
				<div class="md:mr-2 ">
					<button type="submit" wire:click.prevent='saveJob' wire:loading.attr="disabled"
						wire:loading.class="bg-gray-400" wire:loading.class.remove="bg-empex-green hover:bg-green-500"
						class="uppercase focus:outline-none border border-transparent py-1 px-5 rounded text-center text-white bg-empex-green hover:bg-green-500 font-medium">
						<span wire:loading.remove wire:target='saveJob'>
							@if ($jobId !== null)
							Update
							@else
							@if ($confirmOtp == false && $category == 3)
							Generate OTP
							@else
							Post Job
							@endif
							@endif
						</span>

						<span wire:loading wire:target='saveJob'>
							@if ($jobId !== null)
							Updating...
							@else
							Posting...
							@endif
						</span>
					</button>
				</div>

				<div class="md:ml-2 ">
					<button wire:click.prevent='cancel'
						class="uppercase focus:outline-none py-1 border-empex-green text-empex-green px-5 rounded text-center text-empex bg-white hover:bg-gray-100 font-medium border">Cancel</button>
				</div>
			</div>
		</form>
	</div>

	<style>
		.tox-tinymce {
			border-radius: 5px !important;
		}
	</style>

	@error('description')
	<style>
		.tox-tinymce {
			border: 1px solid red !important;
		}
	</style>
	@enderror

	<script src="https://cdn.tiny.cloud/1/vht8bgfmk42s3epjyw0o4n8n61x93u4egnrswpj13dwdvi7d/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
	<script>
		$(document).ready(function() {
			window.initSelect2=()=>{
				tinymce.init({
					selector: '#description',
					plugins: [
						'advlist autolink lists link image charmap print preview hr anchor pagebreak',
						'searchreplace wordcount visualblocks visualchars code fullscreen ',
						'insertdatetime media nonbreaking save table directionality',
						'emoticons template paste textpattern help'
					],
					toolbar: 'insertfile undo redo | styleselect | bold italic forecolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image ',
					relative_urls: false,
					remove_script_host : false,
					height: '400',
					setup: function (editor) {
						editor.on('init change', function () {
							editor.save();
						});
						editor.on('change', function (e) {
                            console.log('chaange');
							@this.set('description', editor.getContent());
						});
					},
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
</div>

<div>
	@if ($ongoing)
	<div class="flex flex-col md:grid grid-cols-12">
		<div class="flex md:contents">
			<div class="col-start-2 col-end-4 mr-10 md:mx-auto relative">
				<div class="h-full w-4 flex items-center justify-center">
					<div class="h-full w-1 bg-empex-green pointer-events-none"></div>
				</div>
				<div class="w-4 h-4 absolute top-1/2 -mt-3 rounded-full bg-empex-green text-center"></div>
			</div>
			<div class="col-start-4 col-end-12 my-4 mr-auto w-full">
				<h3 class="text-lg mb-1">Submitted</h3>
				<p class="leading-tight w-full text-gray-400">
					{{ date('d M Y', strtotime($ongoing->created_at)) }}
				</p>
			</div>
		</div>

		<div class="flex md:contents">
			<div class="col-start-2 col-end-4 mr-10 md:mx-auto relative">
				<div class="h-full w-4 flex items-center justify-center">
					<div
						class="h-full w-1 {{ $ongoing->verified_date !== null ? 'bg-empex-green' : 'bg-gray-100' }} pointer-events-none">
					</div>
				</div>
				<div
					class="w-4 h-4 absolute top-1/2 -mt-3 rounded-full {{ $ongoing->verified_date !== null ? 'bg-empex-green' : 'bg-gray-100' }} text-center">
				</div>
			</div>
			<div class="col-start-4 col-end-12 my-4 mr-auto w-full">
				<h3 class="text-lg mb-1 {{ $ongoing->verified_date !== null ? 'text-black' : 'text-gray-400' }}">Verified</h3>
				@if ($ongoing->verified_date !== null)
				<p class="leading-tight w-full text-gray-400">
					{{ date('d M Y', strtotime($ongoing->verified_date)) }}
				</p>
				@endif
			</div>
		</div>

		@if ($ongoing->rejected_date == null)
		<div class="flex md:contents">
			<div class="col-start-2 col-end-4 mr-10 md:mx-auto relative">
				<div class="h-full w-4 flex items-center justify-center">
					<div class="h-full w-1 bg-gray-100 pointer-events-none">
					</div>
				</div>
				<div class="w-4 h-4 absolute top-1/2 -mt-3 rounded-full bg-gray-100 text-center"></div>
			</div>
			<div class="col-start-4 col-end-12 my-4 mr-auto w-full">
				<h3 class="text-lg mb-1 text-gray-400">Approval</h3>
			</div>
		</div>
		@endif

		@if ($ongoing->rejected_date !== null)
		<div class="flex md:contents">
			<div class="col-start-2 col-end-4 mr-10 md:mx-auto relative">
				<div class="h-full w-4 flex items-center justify-center">
					<div
						class="h-full w-1 {{ $ongoing->rejected_date !== null ? 'bg-empex-red' : 'bg-gray-100' }} pointer-events-none">
					</div>
				</div>
				<div
					class="w-4 h-4 absolute top-1/2 -mt-3 rounded-full {{ $ongoing->rejected_date !== null ? 'bg-empex-red' : 'bg-gray-100' }} text-center">
				</div>
			</div>
			<div class="col-start-4 col-end-12 my-4 mr-auto w-full">
				<h3 class="text-lg mb-1 {{ $ongoing->rejected_date !== null ? 'text-empex-red' : 'text-gray-400' }}">Rejected
				</h3>
				@if ($ongoing->rejected_date !== null)
				<p class="leading-tight w-full text-gray-400">
					{{ date('d M Y', strtotime($ongoing->rejected_date)) }}
				</p>
				@endif
				@if ($ongoing->rejection_note !== null)
				<p class="leading-tight w-full text-empex-red">
					{{ $ongoing->rejection_note }}
				</p>
				@endif
			</div>
		</div>
		@endif
	</div>
	@endif
</div>
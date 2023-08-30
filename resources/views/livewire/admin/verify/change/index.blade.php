<div class="mt-2">
	<div class="rounded w-full">
		<ul id="tabs" class="grid grid-cols-3 md:grid-cols-9 text-gray-400">
			<li class="md:px-4 py-2 font-semibold">
				@if ($infoCount > 0)
				<span class="inline-block w-2 h-2 bg-red-600 mb-1 rounded-full"></span>
				@endif
				<a id="default-tab" href="#basicInfo">BasicInfo</a>
			</li>
			<li class="md:px-4 py-2 font-semibold">
				@if ($addressCount > 0)
				<span class="inline-block w-2 h-2 bg-red-600 mb-1 rounded-full"></span>
				@endif
				<a href="#address">Address</a>
			</li>
			<li class="md:px-4 py-2 font-semibold">
				@if ($eduCount > 0)
				<span class="inline-block w-2 h-2 bg-red-600 mb-1 rounded-full"></span>
				@endif
				<a href="#education">Education</a>
			</li>
			<li class="md:px-4 py-2 font-semibold">
				@if ($expCount > 0)
				<span class="inline-block w-2 h-2 bg-red-600 mb-1 rounded-full"></span>
				@endif
				<a href="#experience">Experience</a>
			</li>
			<li class="md:px-4 py-2 font-semibold">
				@if ($transferCount > 0)
				<span class="inline-block w-2 h-2 bg-red-600 mb-1 rounded-full"></span>
				@endif
				<a href="#transfer">Transfer</a>
			</li>
		</ul>

		<div id="tab-contents" class="mt-4">
			<div id="basicInfo" class="">
				@livewire('admin.verify.change.info')
			</div>
			<div id="address" class="hidden">
				@livewire('admin.verify.change.address')
			</div>
			<div id="education" class="hidden">
				@livewire('admin.verify.change.education')
			</div>
			<div id="experience" class="hidden">
				@livewire('admin.verify.change.experience')
			</div>
			<div id="transfer" class="hidden">
				@livewire('admin.verify.change.transfer')
			</div>
		</div>
	</div>
</div>
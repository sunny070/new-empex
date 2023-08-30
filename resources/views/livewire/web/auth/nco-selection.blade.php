<div>
    <x-loading-indicator />
	<form class="w-full md:p-5">
		@if (!$showNcoCard)
		<div class="md:flex md:justify-between">
			<div class="text-empex-green mb-3 font-semibold">
				Selecting NCO will help you find Jobs on EmpEx. Please Select as many occupations as you find fit for your job
				interests.
			</div>

			{{-- <button type="button"
				class="focus:outline-none border border-transparent py-0 px-3 rounded text-center text-white bg-empex-green hover:bg-green-500 font-medium"
				wire:click='selectAllNco'>
				<span>
					Select All
				</span>
			</button> --}}
		</div>

		<div class="w-full relative my-5">
			<select id="ncos" multiple wire:model.lazy='checkData'>
				@foreach ($ncoFamilies as $ncoOcu)
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
		@endif


		<div class="grid grid-cols-1 gap-4 md:grid-cols-2">
			@if (!$showNcoCard)
			<div x-data="{accordianParent:null, accordionToggle:null}">
				@if (count($checkData) > 0)
				<div class="mb-2"><span class="font-semibold">{{ count($checkData)}}</span> NCO family class selected</div>
				@endif
				@php
				$count = 0;
				@endphp
				@foreach ($ncoList as $ncoKey => $groups)
				<ul class="border rounded">
					<li class="relative border-b">
						<button type="button" class="w-full px-3 py-2 text-left bg-gray-50"
							:class="accordianParent == {{ $count }} ? 'border-b' : ''"
							@click="accordianParent !== {{ $count }} ? accordianParent = {{ $count }} : accordianParent = null">
							<div class="flex items-center justify-between">
								<span>
									{{ $ncoKey }}
									@foreach ($allNcoDetails as $ndt)
									@if ($ndt['division'] == $ncoKey)
									<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline text-empex-green" fill="none"
										viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
										<path stroke-linecap="round" stroke-linejoin="round"
											d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
									</svg>
									@php
									break;
									@endphp
									@endif
									@endforeach
								</span>
								<span :class="accordianParent == {{ $count }} ? 'fa fa-minus' : 'fa fa-plus'"></span>
							</div>
						</button>

						<div class="relative overflow-hidden transition-all duration-700" x-show="accordianParent == {{ $count }}"
							:class="accordianParent == {{ $count }} ? '' : 'hidden'">
							<div class="px-1 py-1">
								<ul>
									@foreach ($groups as $group)
									<li class="relative border-b">
										<button type="button" class="w-full px-3 py-2 text-left"
											:class="accordionToggle == {{ $group['id'] }} ? 'border-b' : ''"
											@click="accordionToggle !== {{ $group['id'] }} ? accordionToggle = {{ $group['id'] }} : accordionToggle = null">
											<div class="flex items-center justify-between">
												<span>
													{{ $group['name'] }}
													@foreach ($allNcoDetails as $ndt)
													@if ($ndt['group'] == $group['id'])
													<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline text-empex-green" fill="none"
														viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
														<path stroke-linecap="round" stroke-linejoin="round"
															d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
													</svg>
													@php
													break;
													@endphp
													@endif
													@endforeach
												</span>
												<span
													:class="accordionToggle == {{ $group['id'] }} ? 'fa fa-chevron-down' : 'fa fa-chevron-right'"></span>
											</div>
										</button>

										<div class="relative overflow-hidden transition-all duration-700"
											x-show="accordionToggle == {{ $group['id'] }}"
											:class="accordionToggle == {{ $group['id'] }} ? '' : 'hidden'">
											<div class="px-1 py-1">
												@foreach ($group['family'] as $family)
												<label class="inline-flex p-1 border rounded m-1 items-center cursor-pointer">
													<input type="checkbox" wire:model.lazy='checkData' value="{{ $family['id'] }}"
														class="form-checkbox text-empex-green focus:outline-none focus:ring-0" />
													<span class="ml-3">
														{{ $family['name'] }}
													</span>
												</label>
												@endforeach
											</div>
										</div>
									</li>
									@endforeach
								</ul>
							</div>
						</div>
					</li>
				</ul>
				@php
				$count++
				@endphp
				@endforeach
			</div>
			@if ($showNcoDetails)
			<div class="border rounded p-5">
				@foreach ($allNcoDetails as $allNco)
				<div class="text-gray-400 pb-1" wire:model.lazy="checkFamilyDataForStore">{{ $allNco['family']['name'] }}</div>
				@foreach ($allNco['detail'] as $dtKey => $detail)
				<label class="block ml-5 pb-1 items-centercursor-pointer">
					<input type="checkbox" wire:model.lazy='checkDataForStore' value="{{ $detail['id'] }}"
						class="form-checkbox text-empex-green focus:outline-none focus:ring-0" />
					<span class="ml-3 text-sm">
						{{ $detail['name'] }}
					</span>
				</label>
				@endforeach
				@endforeach
			</div>
			@endif
			@else
			<div class="p-2 text-center w-full col-span-2">
				<div class="font-bold">Select NCO Code</div>
				<div>Select your preferred NCO Code for your card</div>
				<div class="my-5">
					<img src="/images/auth/nco.svg" alt="nco" class="mx-auto">
				</div>
				<div class="w-full relative text-left md:w-1/2 md:mx-auto">
					<select class="input" id="ncoCode" wire:model.lazy='ncoCodeToDisplayOnCard'>
						<option value="">Select Nco</option>
						@foreach ($detailSelected as $detail)
						<option value="{{ $detail->id }}">{{ $detail->code }} {{ $detail->name }}</option>
						@endforeach
					</select>
					<label class="tracking-wide text-gray-600 text-xs label-select2">
						NCO Code*
					</label>
					@error('ncoCodeToDisplayOnCard')
					<p class="text-red-500 text-xs italic">{{ $message }}</p>
					@enderror
				</div>
			</div>

			<script>
				$(document).ready(function() {
						window.initSelect2=()=>{
							$("#ncoCode").select2({
								placeholder:"Select NCO"
							});
						}

						initSelect2();

						$('#ncoCode').on('change', function (e) {
							@this.set('ncoCodeToDisplayOnCard', $(this).val());
						});

						window.livewire.on('select2AutoInit',()=>{
							initSelect2();
						});
					});
			</script>
			@endif
		</div>
	</form>

	@if (Session('error'))
	<div class="text-empex-red text-center">{{ session('error') }}</div>
	@endif
	<div class="pb-5 pt-10">
		<div class="flex justify-between md:justify-center">
			@if ($showNcoCard)
			<div class="md:mr-2 w-1/2 md:w-full text-left md:text-right">
				<button wire:click.prevent='backToSelect'
					class="uppercase focus:outline-none py-1 border-empex-green px-5 rounded text-center text-empex-green bg-white hover:bg-gray-100 font-medium border">Back</button>
			</div>

			<div class="md:ml-2 w-1/2 md:w-full text-right md:text-left">
				<button type="submit" wire:click='saveAndNext' wire:loading.attr="disabled" wire:loading.class="bg-gray-400"
					wire:loading.class.remove="bg-empex-green hover:bg-green-500"
					class="uppercase focus:outline-none border border-transparent py-1 px-5 rounded text-center text-white bg-empex-green hover:bg-green-500 font-medium">
					<span wire:loading.remove wire:target='saveAndNext'>
						Save & next
					</span>

					<span wire:loading wire:target='saveAndNext'>
						Saving...
					</span>
				</button>
			</div>
			@else
			<div class="md:mr-2 w-1/2 md:w-full text-left md:text-right">
				<button wire:click.prevent='back'
					class="uppercase focus:outline-none py-1 border-empex-green px-5 rounded text-center text-empex-green bg-white hover:bg-gray-100 font-medium border">Back</button>
			</div>

			<div class="md:ml-2 w-1/2 md:w-full text-right md:text-left">
				<button type="button"
					class="uppercase focus:outline-none border border-transparent py-1 px-5 rounded text-center text-white bg-empex-green hover:bg-green-500 font-medium"
					wire:click='confirmAndSelectNco'>
					<span>
						Save & next
					</span>
				</button>
			</div>
			@endif
		</div>
	</div>

	<script>
		$(document).ready(function() {
			window.initSelect2=()=>{
				$("#ncos").select2({
					allowClear: true,
					placeholder:"Select NCO(multiple)"
				});
			}

			initSelect2();

			$('#ncos').on('change', function (e) {
				@this.set('checkData', $(this).val());
			});

			window.livewire.on('select2AutoInit',()=>{
				initSelect2();
			});
		});
	</script>
</div>

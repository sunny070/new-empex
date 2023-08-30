<div>
    <x-loading-indicator />
	@if ($canChange)
	<div class="bg-white w-full p-5 border rounded shadow">
		<form class="w-full md:w-3/4 mx-auto">
			<div class="grid grid-cols-1 gap-4 md:grid-cols-2">
				<div class="w-full relative">
					<select id="division" wire:model.lazy='division' class="input">
						<option value="">Select Division</option>
						@foreach ($allDivisions as $div)
						<option value="{{ $div->id }}">{{ $div->name }}</option>
						@endforeach
					</select>
					<label class="tracking-wide text-gray-500 text-xs label-select2">
						Division*
					</label>
					@error('division')
					<p class="text-empex-red text-xs italic">{{ $message }}</p>
					@enderror
				</div>

				<div class="w-full relative">
					<select id="subdivision" wire:model.lazy='subdivision' {{ is_null($division) ? 'disabled' : '' }} class="input">
						<option value="">Select SubDivision</option>
						@foreach ($allSubDivisions as $sub)
						<option value="{{ $sub->id }}">{{ $sub->name }}</option>
						@endforeach
					</select>
					<label class="tracking-wide text-gray-500 text-xs label-select2">
						SubDivision*
					</label>
					@error('subdivision')
					<p class="text-empex-red text-xs italic">{{ $message }}</p>
					@enderror
				</div>

				<div class="w-full relative">
					<select id="group" wire:model.lazy='group' {{ is_null($subdivision) ? 'disabled' : '' }}
						class="input">
						<option value="">Select Group</option>
						@foreach ($allGroups as $grp)
						<option value="{{ $grp->id }}">{{ $grp->name }}</option>
						@endforeach
					</select>
					<label class="tracking-wide text-gray-500 text-xs label-select2">
						Group*
					</label>
					@error('group')
					<p class="text-empex-red text-xs italic">{{ $message }}</p>
					@enderror
				</div>

				<div class="w-full relative">
					<select id="family" wire:model.lazy='family' {{ is_null($group) ? 'disabled' : '' }}
						class="input">
						<option value="">Select Family</option>
						@foreach ($allFamilies as $fam)
						<option value="{{ $fam->id }}">{{ $fam->name }}</option>
						@endforeach
					</select>
					<label class="tracking-wide text-gray-500 text-xs label-select2">
						Family*
					</label>
					@error('family')
					<p class="text-empex-red text-xs italic">{{ $message }}</p>
					@enderror
				</div>

				<div class="w-full relative">
					<select id="detail" wire:model.lazy='detail' {{ is_null($family) ? 'disabled' : '' }}
						class="input">
						<option value="">Select Detail</option>
						@foreach ($allDetails as $det)
						<option value="{{ $det->id }}">{{ $det->name }}</option>
						@endforeach
					</select>
					<label class="tracking-wide text-gray-500 text-xs label-select2">
						Detail*
					</label>
					@error('detail')
					<p class="text-empex-red text-xs italic">{{ $message }}</p>
					@enderror
				</div>
			</div>
		</form>

		<div class="pb-5 pt-10">
			<div class="flex justify-between md:justify-center">
				<div class="md:mr-2 w-1/2 md:w-full text-left md:text-right mt-1">
					<a href="{{ route('auth.employee.changerequest') }}"
						class="focus:outline-none py-1 border-empex-green uppercase px-5 rounded text-center text-empex-green bg-white font-medium border">Cancel</a>
				</div>

				<div class="md:ml-2 w-1/2 md:w-full text-right md:text-left">
					<button type="submit" wire:click.prevent='submit' wire:loading.attr="disabled"
						wire:loading.class="bg-gray-400" wire:loading.class.remove="bg-empex-green hover:bg-green-500"
						class="uppercase focus:outline-none border border-transparent py-1 px-5 rounded text-center text-white bg-empex-green hover:bg-green-500 font-medium">
						<span wire:loading.remove wire:target='submit'>
							Submit
						</span>

						<span wire:loading wire:target='submit'>
							Submit...
						</span>
					</button>
				</div>
			</div>
		</div>

		<script>
			$(document).ready(function() {
				window.initSelect2=()=>{
					$("#division").select2({
						allowClear: true,
						placeholder:"Select Division"
					});

					$("#subdivision").select2({
						allowClear: true,
						placeholder:"Select Sub Division"
					});

					$("#group").select2({
						allowClear: true,
						placeholder:"Select Group"
					});

					$("#family").select2({
						allowClear: true,
						placeholder:"Select Family"
					});

					$("#detail").select2({
						allowClear: true,
						placeholder:"Select Detail"
					});
				}

				initSelect2();

				$('#division').on('change', function (e) {
					@this.set('division', $(this).val());
				});

				$('#subdivision').on('change', function (e) {
					@this.set('subdivision', $(this).val());
				});

				$('#group').on('change', function (e) {
					@this.set('group', $(this).val());
				});

				$('#family').on('change', function (e) {
					@this.set('family', $(this).val());
				});

				$('#detail').on('change', function (e) {
					@this.set('detail', $(this).val());
				});

				window.livewire.on('select2AutoInit',()=>{
					initSelect2();
				});
			});
		</script>
	</div>
	@else
	<div class="md:bg-white w-full md:p-5 md:border md:rounded md:shadow">
		<div class="w-full py-12 text-center">
			<img src="/images/auth/submitted.svg" alt="approved" class="mx-auto">
			<div class="font-semibold mt-7 text-xl">A request is still ongoing</div>
			<div class="mb-7 text-gray-400 mt-3">Please, wait for confirmation for this request</div>
			<a href="{{ route('auth.enrollment.status') }}"
				class="uppercase border border-empex-green text-empex-green hover:bg-empex-gray py-1 px-5 rounded text-center">
				ongoing application</a>
		</div>
	</div>
	@endif
</div>

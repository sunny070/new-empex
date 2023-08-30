<div>
    <x-loading-indicator />
	<form class="w-full md:w-3/4 mx-auto">
		<div class="flex flex-wrap -mx-3 mt-3">
			<div class="w-full md:w-1/2 px-3">
				<label class="block uppercase tracking-wide text-sm font-bold mb-3">
					Permanent Address
				</label>
			</div>
		</div>

		<div class="grid grid-cols-1 gap-4 md:grid-cols-2">
			<div class="w-full relative">
				<select wire:model.lazy='permanentState' class="input" id="permanentState">
					<option value="">Select State</option>
					@foreach ($allStates as $state)
					<option value="{{ $state->id }}">{{ $state->name }}</option>
					@endforeach
				</select>
				<label class="tracking-wide text-gray-500 text-xs label-select2">
					State*
				</label>
				@error('permanentState')
				<p class="text-empex-red text-xs italic">{{ $message }}</p>
				@enderror
			</div>

			<div class="w-full relative">
				<select wire:model.lazy='permanentDistrict' class="input" id="permanentDistrict">
					<option value="">Select District</option>
					@foreach ($allDistricts as $district)
					<option value="{{ $district->id }}">{{ $district->name }}</option>
					@endforeach
				</select>
				<label class="tracking-wide text-gray-500 text-xs label-select2" for="permanentDistrict">
					District*
				</label>
				@error('permanentDistrict')
				<p class="text-empex-red text-xs italic">{{ $message }}</p>
				@enderror
			</div>

			<div class="w-full relative">
				<input wire:model.lazy='permanentLocality'
					class="w-full rounded input border-gray-400 text-base text-gray-500 focus:text-empex focus:border-empex-green focus:outline-none focus:ring-green-600"
					id="permanentLocality" type="text" placeholder="Village/Locality*">
				<label class="tracking-wide text-gray-500 text-xs label" for="permanentLocality">
					Village/Locality*
				</label>
				@error('permanentLocality')
				<p class="text-empex-red text-xs italic">{{ $message }}</p>
				@enderror
			</div>

			<div class="w-full relative">
				<select wire:model.lazy='permanentRdBlock' class="input" id="permanentRdBlock">
					<option value="">Select Rd Block</option>
					@foreach ($allRdBlock as $rd)
					<option value="{{ $rd->id }}">{{ $rd->name }}</option>
					@endforeach
				</select>
				<label class="tracking-wide text-gray-500 text-xs label-select2" for="permanentRdBlock">
					RD Block*
				</label>
				@error('permanentRdBlock')
				<p class="text-empex-red text-xs italic">{{ $message }}</p>
				@enderror
			</div>

			<div class="w-full relative">
				<select wire:model.lazy='permanentPoliceStation' class="input" id="permanentPoliceStation">
					<option value="">Select Police Station</option>
					@foreach ($allPoliceStation as $ps)
					<option value="{{ $ps->id }}">{{ $ps->name }}</option>
					@endforeach
				</select>
				<label class="tracking-wide text-gray-500 text-xs label-select2" for="permanentPoliceStation">
					Police Station*
				</label>
				@error('permanentPoliceStation')
				<p class="text-empex-red text-xs italic">{{ $message }}</p>
				@enderror
			</div>

			<div class="w-full relative">
				<select wire:model.lazy='permanentPostOffice' class="input" id="permanentPostOffice">
					<option value="">Select Post Office</option>
					@foreach ($allPostOffice as $post)
					<option value="{{ $post->id }}">{{ $post->name }}</option>
					@endforeach
				</select>
				<label class="tracking-wide text-gray-500 text-xs label-select2" for="permanentPostOffice">
					Post Office*
				</label>
				@error('permanentPostOffice')
				<p class="text-empex-red text-xs italic">{{ $message }}</p>
				@enderror
			</div>

			<div class="w-full relative">
				<input wire:model.lazy='permanentPincode'
					class="w-full rounded input border-gray-400 text-base text-gray-500 focus:text-empex focus:border-empex-green focus:outline-none focus:ring-green-600"
					id="pincode" type="number" placeholder="Pincode*">
				<label class="tracking-wide text-gray-500 text-xs label" for="pincode">
					Pincode*
				</label>
				@error('permanentPincode')
				<p class="text-empex-red text-xs italic">{{ $message }}</p>
				@enderror
			</div>

			<div class="w-full relative">
				<input wire:model.lazy='permanentHouseNo'
					class="w-full rounded input border-gray-400 text-base text-gray-500 focus:text-empex focus:border-empex-green focus:outline-none focus:ring-green-600"
					id="houseno" type="text" placeholder="House No*">
				<label class="tracking-wide text-gray-500 text-xs label" for="houseno">
					House No*
				</label>
				@error('permanentHouseNo')
				<p class="text-empex-red text-xs italic">{{ $message }}</p>
				@enderror
			</div>
		</div>

		<div class="flex flex-wrap -mx-3 my-3">
			<div class="w-full md:w-1/2 px-3">
				<label class="block uppercase tracking-wide text-sm md:text-md font-bold">
					Present Address
					<label class="inline-flex ml-5 text-xs">
						<input type="checkbox" class="form-checkbox text-empex-green focus:outline-none focus:ring-0"
							wire:model.lazy='sameAsPermanent'>
						<span class="ml-2">same as permanent</span>
					</label>
				</label>
			</div>
		</div>

		<div class="grid grid-cols-1 gap-4 md:grid-cols-2">
			<div class="w-full relative">
				<select wire:model.lazy='presentState' {{ $sameAsPermanent==true ? 'disabled' : '' }} class="input"
					id="presentState">
					<option value="">Select State</option>
					@foreach ($allStates as $state)
					<option value="{{ $state->id }}">{{ $state->name }}</option>
					@endforeach
				</select>
				<label class="tracking-wide text-gray-600 text-xs label-select2">
					State*
				</label>
				@error('presentState')
				<p class="text-empex-red text-xs italic">{{ $message }}</p>
				@enderror
			</div>

			<div class="w-full relative">
				<select wire:model.lazy='presentDistrict' {{ $sameAsPermanent==true ? 'disabled' : '' }} class="input"
					id="presentDistrict">
					<option value="">Select District</option>
					@foreach ($presentAllDistricts as $district)
					<option value="{{ $district->id }}">{{ $district->name }}</option>
					@endforeach
				</select>
				<label class="tracking-wide text-gray-600 text-xs label-select2">
					District*
				</label>
				@error('presentDistrict')
				<p class="text-empex-red text-xs italic">{{ $message }}</p>
				@enderror
			</div>

			<div class="w-full relative">
				<input wire:model.lazy='presentLocality' {{ $sameAsPermanent==true ? 'disabled' : '' }}
					class="w-full rounded input border-gray-400 text-base text-gray-500 focus:text-empex focus:border-empex-green focus:outline-none focus:ring-green-600 {{ $sameAsPermanent==true ? 'bg-gray-100' : '' }}"
					id="presentLocality" type="text" placeholder="Village/Locality*">
				<label class="tracking-wide text-gray-500 text-xs label" for="presentLocality">
					Village/Locality*
				</label>
				@error('presentLocality')
				<p class="text-empex-red text-xs italic">{{ $message }}</p>
				@enderror
			</div>

			<div class="w-full relative">
				<select wire:model.lazy='presentRdBlock' {{ $sameAsPermanent==true ? 'disabled' : '' }} class="input"
					id="presentRdBlock">
					<option value="">Select Rd Block</option>
					@foreach ($allRdBlock as $rd)
					<option value="{{ $rd->id }}">{{ $rd->name }}</option>
					@endforeach
				</select>
				<label class="tracking-wide text-gray-500 text-xs label-select2" for="presentRdBlock">
					RD Block*
				</label>
				@error('presentRdBlock')
				<p class="text-empex-red text-xs italic">{{ $message }}</p>
				@enderror
			</div>

			<div class="w-full relative">
				<select wire:model.lazy='presentPoliceStation' {{ $sameAsPermanent==true ? 'disabled' : '' }} class="input"
					id="presentPoliceStation">
					<option value="">Select Police Station</option>
					@foreach ($allPoliceStation as $ps)
					<option value="{{ $ps->id }}">{{ $ps->name }}</option>
					@endforeach
				</select>
				<label class="tracking-wide text-gray-500 text-xs label-select2" for="presentPoliceStation">
					Police Station*
				</label>
				@error('presentPoliceStation')
				<p class="text-empex-red text-xs italic">{{ $message }}</p>
				@enderror
			</div>

			<div class="w-full relative">
				<select wire:model.lazy='presentPostOffice' {{ $sameAsPermanent==true ? 'disabled' : '' }} class="input"
					id="presentPostOffice">
					<option value="">Select Post Office</option>
					@foreach ($allPostOffice as $post)
					<option value="{{ $post->id }}">{{ $post->name }}</option>
					@endforeach
				</select>
				<label class="tracking-wide text-gray-500 text-xs label-select2" for="presentPostOffice">
					Post Office*
				</label>
				@error('presentPostOffice')
				<p class="text-empex-red text-xs italic">{{ $message }}</p>
				@enderror
			</div>

			<div class="w-full relative">
				<input wire:model.lazy='presentPincode' {{ $sameAsPermanent==true ? 'disabled' : '' }}
					class="w-full rounded input border-gray-400 text-base text-gray-500 focus:text-empex focus:border-empex-green focus:outline-none focus:ring-green-600 {{ $sameAsPermanent==true ? 'bg-gray-100' : '' }}"
					id="prepincode" type="number" placeholder="Pincode*">
				<label class="tracking-wide text-gray-500 text-xs label" for="prepincode">
					Pincode*
				</label>
				@error('presentPincode')
				<p class="text-empex-red text-xs italic">{{ $message }}</p>
				@enderror
			</div>

			<div class="w-full relative">
				<input wire:model.lazy='presentHouseNo' {{ $sameAsPermanent==true ? 'disabled' : '' }}
					class="w-full rounded input border-gray-400 text-base text-gray-500 focus:text-empex focus:border-empex-green focus:outline-none focus:ring-green-600 {{ $sameAsPermanent==true ? 'bg-gray-100' : '' }}"
					id="prehouseno" type="text" placeholder="House No*">
				<label class="tracking-wide text-gray-500 text-xs label" for="prehouseno">
					House No*
				</label>
				@error('presentHouseNo')
				<p class="text-empex-red text-xs italic">{{ $message }}</p>
				@enderror
			</div>
		</div>
	</form>

	<div class="pb-5 pt-10">
		<div class="flex justify-between md:justify-center">
			<div class="md:mr-2 w-1/2 md:w-full text-left md:text-right">
				<button wire:click.prevent='back'
					class="uppercase focus:outline-none py-1 border-empex-green px-5 rounded text-center text-empex bg-white hover:bg-gray-100 font-medium border">Back</button>
			</div>

			<div class="md:ml-2 w-1/2 md:w-full text-right md:text-left">
				<button type="submit" wire:click.prevent='saveAndNext' wire:loading.attr="disabled"
					wire:loading.class="bg-gray-400" wire:loading.class.remove="bg-empex-green hover:bg-green-500"
					class="uppercase focus:outline-none border border-transparent py-1 px-5 rounded text-center text-white bg-empex-green hover:bg-green-500 font-medium">
					<span wire:loading.remove wire:target='saveAndNext'>
						Save & next
					</span>

					<span wire:loading wire:target='saveAndNext'>
						Saving...
					</span>
				</button>
			</div>
		</div>
	</div>

	<script>
		$(document).ready(function() {
			window.initSelect2=()=>{
				$("#permanentState").select2({
					placeholder:"Select State"
				});

				$("#permanentDistrict").select2({
					placeholder:"Select District"
				});

				$("#permanentRdBlock").select2({
					placeholder:"Select Rd Block"
				});

				$("#permanentPostOffice").select2({
					placeholder:"Select Post Office"
				});

				$("#permanentPoliceStation").select2({
					placeholder:"Select Police Station"
				});

				// present
				$("#presentState").select2({
					placeholder:"Select State"
				});

				$("#presentDistrict").select2({
					placeholder:"Select District"
				});

				$("#presentRdBlock").select2({
					placeholder:"Select Rd Block"
				});

				$("#presentPostOffice").select2({
					placeholder:"Select Post Office"
				});

				$("#presentPoliceStation").select2({
					placeholder:"Select Police Station"
				});
			}

			initSelect2();

			$('#permanentState').on('change', function (e) {
				@this.set('permanentState', $(this).val());
			});

			$('#permanentDistrict').on('change', function (e) {
				@this.set('permanentDistrict', $(this).val());
			});

			$('#permanentRdBlock').on('change', function (e) {
				@this.set('permanentRdBlock', $(this).val());
			});

			$('#permanentPostOffice').on('change', function (e) {
				@this.set('permanentPostOffice', $(this).val());
			});

			$('#permanentPoliceStation').on('change', function (e) {
				@this.set('permanentPoliceStation', $(this).val());
			});

			// present
			$('#presentState').on('change', function (e) {
				@this.set('presentState', $(this).val());
			});

			$('#presentDistrict').on('change', function (e) {
				@this.set('presentDistrict', $(this).val());
			});

			$('#presentRdBlock').on('change', function (e) {
				@this.set('presentRdBlock', $(this).val());
			});

			$('#presentPostOffice').on('change', function (e) {
				@this.set('presentPostOffice', $(this).val());
			});

			$('#presentPoliceStation').on('change', function (e) {
				@this.set('presentPoliceStation', $(this).val());
			});

			window.livewire.on('select2AutoInit',()=>{
				initSelect2();
			});
		});
	</script>
</div>

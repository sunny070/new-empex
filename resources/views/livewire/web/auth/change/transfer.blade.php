<div>
    <x-loading-indicator />
	@if ($canChange)
	<div class="bg-white w-full p-5 border rounded shadow">
		<form class="w-full md:w-3/4 mx-auto">
			<div class="flex flex-wrap -mx-3 mt-3 mb-2">
				<div class="w-full px-3">
					<label class="text-sm mb-3">
						Please enter new address. Your card will be transferred to the selected DISTRICT below.
					</label>
				</div>
			</div>

			<div class="flex flex-wrap -mx-3 mt-3 mb-2">
				<div class="w-full md:w-1/2 px-3">
					<label class="block uppercase tracking-wide text-sm font-bold mb-3">
						New Present Address
					</label>
				</div>
			</div>

			<div class="grid grid-cols-1 gap-4 md:grid-cols-2">
				<div class="w-full relative">
					<select wire:model.lazy='state' class="input" id="state">
						<option value="">Select State</option>
						@foreach ($allStates as $st)
						<option value="{{ $st->id }}">{{ $st->name }}</option>
						@endforeach
					</select>
					<label class="tracking-wide text-gray-500 text-xs label-select2">
						State*
					</label>
					@error('state')
					<p class="text-empex-red text-xs italic">{{ $message }}</p>
					@enderror
				</div>

				<div class="w-full relative">
					<select wire:model.lazy='district' {{ is_null($state) ? 'disabled' : '' }} class="input" id="district">
						<option value="">Select District</option>
						@foreach ($allDistricts as $dist)
						<option value="{{ $dist->id }}">{{ $dist->name }}</option>
						@endforeach
					</select>
					<label class="tracking-wide text-gray-500 text-xs label-select2">
						District*
					</label>
					@error('district')
					<p class="text-empex-red text-xs italic">{{ $message }}</p>
					@enderror
					@if (!is_null($sameDistrict))
					<p class="text-empex-red text-xs italic">{{ $sameDistrict }}</p>
					@endif
				</div>

				<div class="w-full relative">
					<input wire:model.lazy='locality'
						class="w-full rounded input border-gray-400 text-base text-gray-500 focus:text-empex focus:border-empex-green focus:outline-none focus:ring-green-600"
						id="locality" type="text" placeholder="Village/Locality*">
					<label class="tracking-wide text-gray-500 text-xs label" for="locality">
						Village/Locality*
					</label>
					@error('locality')
					<p class="text-empex-red text-xs italic">{{ $message }}</p>
					@enderror
				</div>

				<div class="w-full relative">
					<select wire:model.lazy='rdBlock' class="input" id="rdBlock">
						<option value="">Select Rd Block</option>
						@foreach ($allRdBlock as $rd)
						<option value="{{ $rd->id }}">{{ $rd->name }}</option>
						@endforeach
					</select>
					<label class="tracking-wide text-gray-500 text-xs label-select2" for="rdBlock">
						RD Block*
					</label>
					@error('rdBlock')
					<p class="text-empex-red text-xs italic">{{ $message }}</p>
					@enderror
				</div>

				<div class="w-full relative">
					<select wire:model.lazy='policeStation' class="input" id="policeStation">
						<option value="">Select Police Station</option>
						@foreach ($allPoliceStation as $ps)
						<option value="{{ $ps->id }}">{{ $ps->name }}</option>
						@endforeach
					</select>
					<label class="tracking-wide text-gray-500 text-xs label-select2" for="policeStation">
						Police Station*
					</label>
					@error('policeStation')
					<p class="text-empex-red text-xs italic">{{ $message }}</p>
					@enderror
				</div>

				<div class="w-full relative">
					<select wire:model.lazy='postOffice' class="input" id="postOffice">
						<option value="">Select Post Office</option>
						@foreach ($allPostOffice as $post)
						<option value="{{ $post->id }}">{{ $post->name }}</option>
						@endforeach
					</select>
					<label class="tracking-wide text-gray-500 text-xs label-select2" for="postOffice">
						Post Office*
					</label>
					@error('postOffice')
					<p class="text-empex-red text-xs italic">{{ $message }}</p>
					@enderror
				</div>

				{{-- @if (!is_null($locality))
				<div class="w-full relative">
					<select wire:model.lazy='rdBlock' disabled
						class="w-full input border-gray-400 rounded text-base text-gray-600 focus:text-empex focus:border-empex-green focus:outline-none focus:ring-green-600 bg-gray-200 no-bg-select"
						id="rdblock">
						<option value="{{ $rdBlock->id }}">{{ $rdBlock->name }}</option>
					</select>
					<label class="tracking-wide text-gray-500 text-xs label" for="rdblock">
						RD Block*
					</label>
					@error('rdBlock')
					<p class="text-empex-red text-xs italic">{{ $message }}</p>
					@enderror
				</div>

				<div class="w-full relative">
					<select wire:model.lazy='policeStation' disabled
						class="w-full input border-gray-400 rounded text-base text-gray-600 focus:text-empex focus:border-empex-green focus:outline-none focus:ring-green-600 bg-gray-200 no-bg-select"
						id="police">
						<option value="{{ $policeStation->id }}">{{ $policeStation->name }}</option>
					</select>
					<label class="tracking-wide text-gray-500 text-xs label" for="police">
						Police Station*
					</label>
					@error('policeStation')
					<p class="text-empex-red text-xs italic">{{ $message }}</p>
					@enderror
				</div>

				<div class="w-full relative">
					<select wire:model.lazy='postOffice' disabled
						class="w-full input border-gray-400 rounded text-base text-gray-600 focus:text-empex focus:border-empex-green focus:outline-none focus:ring-green-600 bg-gray-200 no-bg-select"
						id="postoffice">
						<option value="{{ $postOffice->id }}">{{ $postOffice->name }}</option>
					</select>
					<label class="tracking-wide text-gray-500 text-xs label" for="postoffice">
						Post Office*
					</label>
					@error('postOffice')
					<p class="text-empex-red text-xs italic">{{ $message }}</p>
					@enderror
				</div>
				@endif --}}

				<div class="w-full relative">
					<input wire:model.lazy='pincode'
						class="w-full input border-gray-400 rounded text-base text-gray-500 focus:text-empex focus:border-empex-green focus:outline-none focus:ring-green-600"
						id="pincode" type="number" placeholder="Pincode*">
					<label class="tracking-wide text-gray-500 text-xs label" for="pincode">
						Pincode*
					</label>
					@error('pincode')
					<p class="text-empex-red text-xs italic">{{ $message }}</p>
					@enderror
				</div>

				<div class="w-full relative">
					<input wire:model.lazy='houseNo'
						class="w-full input border-gray-400 rounded text-base text-gray-500 focus:text-empex focus:border-empex-green focus:outline-none focus:ring-green-600"
						id="houseno" type="text" placeholder="House No">
					<label class="tracking-wide text-gray-500 text-xs label" for="houseno">
						House No*
					</label>
					@error('houseNo')
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
					<button type="submit" wire:click.prevent='submit' wire:loading.attr="disabled" {{ $buttonDisable==true
						? 'disabled' : '' }} wire:loading.class="bg-gray-400"
						wire:loading.class.remove="bg-empex-green hover:bg-green-500"
						class="uppercase focus:outline-none border border-transparent py-1 px-5 rounded text-center text-white font-medium {{ $buttonDisable == true ? 'bg-gray-400 cursor-not-allowed' : 'bg-empex-green hover:bg-green-500' }}">
						<span wire:loading.remove wire:target='submit'>
							Transfer
						</span>

						<span wire:loading wire:target='submit'>
							Transfer...
						</span>
					</button>
				</div>
			</div>
		</div>

		<script>
			$(document).ready(function() {
				window.initSelect2=()=>{
					$("#state").select2({
						placeholder:"Select State"
					});

					$("#district").select2({
						placeholder:"Select District"
					});

					$("#rdBlock").select2({
						placeholder:"Select Rd Block"
					});

					$("#postOffice").select2({
						placeholder:"Select Post Office"
					});

					$("#policeStation").select2({
						placeholder:"Select Police Station"
					});
				}

				initSelect2();

				$('#state').on('change', function (e) {
					@this.set('state', $(this).val());
				});

				$('#district').on('change', function (e) {
					@this.set('district', $(this).val());
				});

				$('#rdBlock').on('change', function (e) {
					@this.set('rdBlock', $(this).val());
				});

				$('#postOffice').on('change', function (e) {
					@this.set('postOffice', $(this).val());
				});

				$('#policeStation').on('change', function (e) {
					@this.set('policeStation', $(this).val());
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

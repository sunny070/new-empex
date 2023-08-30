<div>
    <x-loading-indicator />
	@if ($canChange)
	<div class="bg-white w-full p-5 border rounded shadow">
		<form class="w-full md:w-3/4 mx-auto">
			@if ($userImage && !$image)
			<div class="flex flex-wrap justify-center md:justify-start">
				<div class="w-6/12 sm:w-2/12 px-4">
					<img src="{{ asset('/storage/'.$userImage) }}" alt="user image"
						class="shadow-xl rounded-full max-w-full h-auto align-middle border-none" />
				</div>
			</div>
			@endif
			@if ($image)
			<div class="flex flex-wrap justify-center md:justify-start">
				<div class="w-6/12 sm:w-2/12 px-4">
					<img src="{{ $image->temporaryUrl() }}" alt="user image"
						class="shadow-xl rounded-full max-w-full h-auto align-middle border-none" />
				</div>
			</div>
			@endif

			@if ($errors->any())
			<div class="alert alert-danger">
			</div>
			@endif

			<div class="w-full relative mt-5 mb-4">
				<label class="tracking-wide text-gray-500 text-xs font-semibold" for="certificate">
					Formal Passport Photo (Max 2MB)*
				</label>
				<input wire:model.lazy='image'
					class="w-full border-gray-400 text-base text-gray-500 focus:text-empex-green focus:border-green-600 focus:outline-none focus:ring-green-600"
					type="file" placeholder="Image*" accept="image/*">
				@error('image')
				<p class="text-red-500 text-xs italic">{{ $message }}</p>
				@enderror
			</div>

			<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
				<div class="w-full relative">
					<input wire:model.lazy='name'
						class="w-full rounded input border-gray-400 text-base text-gray-500 focus:text-empex-green focus:border-green-600 focus:outline-none focus:ring-green-600"
						id="fullname" type="text" placeholder="Full Name*">
					<label class="tracking-wide text-gray-500 text-xs label" for="fullname">
						Full Name*
					</label>
					@error('name')
					<p class="text-red-500 text-xs italic">{{ $message }}</p>
					@enderror
				</div>

				<div class="w-full relative">
					<input wire:model.lazy='date_of_birth'
						class="w-full rounded input text-base text-gray-600 focus:text-empex-green focus:border-green-600 focus:outline-none focus:ring-green-600 border-gray-400"
						id="dob" type="date" placeholder="Date of Birth*">
					<label class="tracking-wide text-gray-600 text-xs label" for="dob">
						Date of Birth*
					</label>
					@error('date_of_birth')
					<p class="text-red-500 text-xs italic">{{ $message }}</p>
					@enderror
				</div>

				<div class="w-full relative">
					<input wire:model.lazy='email'
						class="w-full rounded input border-gray-400 text-base text-gray-500 focus:text-empex-green focus:border-green-600 focus:outline-none focus:ring-green-600"
						id="email" type="text" placeholder="Email*">
					<label class="tracking-wide text-gray-500 text-xs label" for="email">
						Email*
					</label>
					@error('email')
					<p class="text-red-500 text-xs italic">{{ $message }}</p>
					@enderror
				</div>

				<div class="w-full relative">
					<select wire:model.lazy='gender' class="input" id="gender">
						<option value="">Select Gender</option>
						<option value="Male">Male</option>
						<option value="Female">Female</option>
						<option value="Others">Others</option>
					</select>
					<label class="tracking-wide text-gray-500 text-xs label-select2" for="gender">
						Gender*
					</label>
					@error('gender')
					<p class="text-red-500 text-xs italic">{{ $message }}</p>
					@enderror
				</div>

				<div class="w-full relative">
					<input wire:model.lazy='phone_no'
						class="w-full rounded input border-gray-400 text-base text-gray-500 focus:text-empex-green focus:border-green-600 focus:outline-none focus:ring-green-600"
						id="phone" type="number" placeholder="Phone Number*">
					<label class="tracking-wide text-gray-500 text-xs label" for="phone">
						Phone Number*
					</label>
					@error('phone_no')
					<p class="text-red-500 text-xs italic">{{ $message }}</p>
					@enderror
				</div>

				<div class="w-full relative">
					<input wire:model.lazy='parents_name'
						class="w-full rounded input border-gray-400 text-base text-gray-500 focus:text-empex-green focus:border-green-600 focus:outline-none focus:ring-green-600"
						id="parents" type="text" placeholder="Father's/Mother's Name">
					<label class="tracking-wide text-gray-500 text-xs label" for="parents">
						Father's/Mother's Name*
					</label>
					@error('parents_name')
					<p class="text-red-500 text-xs italic">{{ $message }}</p>
					@enderror
				</div>

				<div class="w-full relative">
					<select wire:model.lazy='marital_status' class="input" id="marital">
						<option value="">Select Marital Status</option>
						<option value="Single">Single</option>
						<option value="Married">Married</option>
					</select>
					<label class="tracking-wide text-gray-500 text-xs label-select2" for="marital">
						Marital Status*
					</label>
					@error('marital_status')
					<p class="text-red-500 text-xs italic">{{ $message }}</p>
					@enderror
				</div>

				<div class="w-full relative">
					<select wire:model.lazy='religion' class="input" id="religion">
						<option value="">Select Religion</option>
						@foreach ($religions as $reli)
						<option value="{{ $reli->id }}">{{ $reli->name }}</option>
						@endforeach
					</select>
					<label class="tracking-wide text-gray-500 text-xs label-select2" for="religion">
						Religion*
					</label>
					@error('religion')
					<p class="text-red-500 text-xs italic">{{ $message }}</p>
					@enderror
				</div>

				<div class="w-full relative">
					<select wire:model.lazy='caste' class="input" id="caste">
						<option value="">Select Caste</option>
						<option value="ST">ST</option>
						<option value="SC">SC</option>
						<option value="OBC">OBC</option>
						<option value="General">General</option>
					</select>
					<label class="tracking-wide text-gray-500 text-xs label-select2" for="caste">
						Caste*
					</label>
					@error('caste')
					<p class="text-red-500 text-xs italic">{{ $message }}</p>
					@enderror
				</div>

				<div class="w-full relative">
					<select wire:model.lazy='society' class="input" id="society">
						<option value="Mizo">Mizo</option>
						<option value="Non-Mizo">Non-Mizo</option>
					</select>
				</div>

				<div class="w-full relative">
					<input wire:model.lazy='aadhaar_number'
						class="w-full rounded input border-gray-400 text-base text-gray-500 focus:text-empex-green focus:border-green-600 focus:outline-none focus:ring-green-600"
						id="aadhaar" type="number" placeholder="Aadhaar Number (optional)">
					<label class="tracking-wide text-gray-500 text-xs label" for="aadhaar">
						Aadhaar Number (optional)
					</label>
				</div>

				<div class="w-full relative" wire:ignore>
					<select id="read" multiple class="input" wire:model.lazy='languageRead'>
						@foreach ($languages as $language)
						<option value="{{ $language->id }}" {{ count($userReadLanguages)> 0 &&
							$userReadLanguages->where('language_id', $language->id)->first() != null ? 'selected' : '' }}>
							{{ $language->name }}</option>
						@endforeach
					</select>
					<label class="tracking-wide text-gray-500 text-xs label-select2" for="read">
						Language Read*
					</label>
					@error('languageRead')
					<p class="text-red-500 text-xs italic">{{ $message }}</p>
					@enderror
				</div>

				<div class="w-full relative" wire:ignore>
					<select id="write" multiple wire:model.lazy='languageWrite'>
						@foreach ($languages as $language)
						<option value="{{ $language->id }}" {{ count($userWriteLanguages)> 0 &&
							$userWriteLanguages->where('language_id', $language->id)->first() != null ? 'selected' : '' }}>
							{{ $language->name }}</option>
						@endforeach
					</select>
					<label class="tracking-wide text-gray-500 text-xs label-select2" for="write">
						Language Write*
					</label>
					@error('languageWrite')
					<p class="text-red-500 text-xs italic">{{ $message }}</p>
					@enderror
				</div>

				<div class="w-full relative" wire:ignore>
					<select id="spoken" multiple wire:model.lazy='languageSpoken'>
						@foreach ($languages as $language)
						<option value="{{ $language->id }}" {{ count($userSpokenLanguages)> 0 &&
							$userSpokenLanguages->where('language_id', $language->id)->first() != null ? 'selected' : '' }}>
							{{ $language->name }}</option>
						@endforeach
					</select>
					<label class="tracking-wide text-gray-500 text-xs label-select2" for="spoken">
						Language Spoken*
					</label>
					@error('languageSpoken')
					<p class="text-red-500 text-xs italic">{{ $message }}</p>
					@enderror
				</div>

				<div class="w-full relative md:col-span-2" wire:ignore>
					<select id="physicalChallenge" multiple wire:model.lazy='userPhysicalDisabled'>
						@foreach ($physicalChallenges as $challenge)
						<option value="{{ $challenge->id }}" {{ count($disabledList)> 0 &&
							$disabledList->where('physical_challenge_id', $challenge->id)->first() != null ? 'selected' : '' }}>
							{{ $challenge->name }}</option>
						@endforeach
					</select>
					<label class="tracking-wide text-gray-500 text-xs label-select2" for="physicalChallenge">
						Physical Disable
					</label>
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
	</div>

	<script>
		$(document).ready(function() {
			window.initSelect2=()=>{
				$("#gender").select2({
					placeholder:"Select Gender"
				});

				$("#marital").select2({
					placeholder:"Select Marital Status"
				});

				$("#religion").select2({
					placeholder:"Select Religion"
				});

				$("#caste").select2({
					placeholder:"Select Caste"
				});

				$("#society").select2({
					placeholder:"Select Society"
				});

				$("#spoken").select2({
					allowClear: true,
					placeholder:"Select Language(multiple)"
				});

				$("#read").select2({
					allowClear: true,
					placeholder:"Select Language(multiple)"
				});

				$("#write").select2({
					allowClear: true,
					placeholder:"Select Language(multiple)"
				});

				$("#physicalChallenge").select2({
					allowClear: true,
					placeholder:"Select Category if Physically Disabled?"
				});
			}

			initSelect2();

			$('#gender').on('change', function (e) {
				@this.set('gender', $(this).val());
			});

			$('#marital').on('change', function (e) {
				@this.set('marital_status', $(this).val());
			});

			$('#religion').on('change', function (e) {
				@this.set('religion', $(this).val());
			});

			$('#caste').on('change', function (e) {
				@this.set('caste', $(this).val());
			});

			$('#society').on('change', function (e) {
				@this.set('society', $(this).val());
			});

			$('#spoken').on('change', function (e) {
				@this.set('languageSpoken', $(this).val());
			});

			$('#read').on('change', function (e) {
				@this.set('languageRead', $(this).val());
			});

			$('#write').on('change', function (e) {
				@this.set('languageWrite', $(this).val());
			});

			$('#physicalChallenge').on('change', function (e) {
				@this.set('userPhysicalDisabled', $(this).val());
			});

			window.livewire.on('select2AutoInit',()=>{
				initSelect2();
			});
		});
	</script>
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

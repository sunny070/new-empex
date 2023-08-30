<div>
    <x-loading-indicator />
	<div class="flex w-full mt-5">
		<div class="w-full md:shadow md:bg-white md:rounded md:border mb-5 md:mb-0">
			<div class="md:flex md:justify-between grid grid-cols-1 justify-start md:px-6 md:py-4 md:mt-5">
				<img src="{{ asset('/storage/'.$basicInfo->avatar) }}" alt="user image"
					class="rounded-full align-middle border-none order-2 md:order-1 w-32 h-32 mx-auto md:mx-0 mb-5 md:mb-0" />
			</div>


			<div class="md:px-6 md:py-4 border-b border-gray-200">
				<div class="text-gray-500">Basic Information</div>
				<div class="grid grid-cols-1 md:grid-cols-2 md:gap-4 gap-1 mt-2">
					<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
						<div class="text-gray-400">Full Name</div>
						<div class="font-semibold col-span-2 text-right md:text-left">{{ $basicInfo->full_name }}</div>
					</div>

					<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
						<div class="text-gray-400">Date of Birth</div>
						<div class="font-semibold col-span-2 text-right md:text-left">{{ date('d M Y', strtotime($basicInfo->dob))
							}}</div>
					</div>

					<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
						<div class="text-gray-400">Gender</div>
						<div class="font-semibold col-span-2 text-right md:text-left">{{ $basicInfo->gender }}</div>
					</div>

					<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
						<div class="text-gray-400">Phone</div>
						<div class="font-semibold col-span-2 text-right md:text-left">{{ $basicInfo->phone_no }}</div>
					</div>

					<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
						<div class="text-gray-400">Father/Mother</div>
						<div class="font-semibold col-span-2 text-right md:text-left">{{ $basicInfo->parents_name }}</div>
					</div>

					<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
						<div class="text-gray-400">Marital Status</div>
						<div class="font-semibold col-span-2 text-right md:text-left">{{ $basicInfo->marital_status }}</div>
					</div>

					<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
						<div class="text-gray-400">Religion</div>
                        @if ($basicInfo->religion)
						<div class="font-semibold col-span-2 text-right md:text-left">{{ $basicInfo->religion->name }}</div>
                        @endif
					</div>

					<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
						<div class="text-gray-400">Caste</div>
						<div class="font-semibold col-span-2 text-right md:text-left">{{ $basicInfo->caste }}</div>
					</div>

					<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
						<div class="text-gray-400">Aadhaar</div>
						<div class="font-semibold col-span-2 text-right md:text-left">{{ $basicInfo->aadhar_no ?? '-' }}</div>
					</div>

					<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
						<div class="text-gray-400">Language Spoken</div>
						<div class="font-semibold col-span-2 text-right md:text-left">{{ $langSpoken }}</div>
					</div>

					<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
						<div class="text-gray-400">Language Read</div>
						<div class="font-semibold col-span-2 text-right md:text-left">{{ $langRead }}</div>
					</div>

					<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
						<div class="text-gray-400">Language Write</div>
						<div class="font-semibold col-span-2 text-right md:text-left">{{ $langWrite }}</div>
					</div>
				</div>
			</div>

			<div class="md:px-6 md:py-4 border-b">
				<div class="grid grid-cols-1 md:grid-cols-2 md:gap-8">
					<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
						<div class="text-gray-500">Physical Challenge</div>
						<div class="font-semibold col-span-2 text-right md:text-left">{{ $physical ?? 'No' }}</div>
					</div>
				</div>
			</div>

			<div class="md:px-6 md:py-4 border-b">
				@foreach ($addresses as $address)
				<div class="text-gray-500 {{ $loop->index > 0 ? 'mt-2' : '' }}">{{ ucfirst($address->type) }} Address</div>
				<div class="grid grid-cols-1 md:grid-cols-2 md:gap-4 mt-2">
					<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
						<div class="text-gray-400">State</div>
                        @if ($address->state)
						<div class="font-semibold col-span-2 text-right md:text-left">{{ $address->state->name }}</div>
                        @endif
					</div>

					<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
						<div class="text-gray-400">District</div>
                        @if ($address->district)
						<div class="font-semibold col-span-2 text-right md:text-left">{{ $address->district->name }}</div>
                        @endif
					</div>

					<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
						<div class="text-gray-400">City/Village</div>
						<div class="font-semibold col-span-2 text-right md:text-left">{{ $address->village }}</div>
					</div>

					<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
						<div class="text-gray-400">RD Block</div>
                        @if ($address->rdBlock)
						<div class="font-semibold col-span-2 text-right md:text-left">{{ $address->rdBlock->name }}</div>
                        @endif
					</div>

					<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
						<div class="text-gray-400">Police Station</div>
                        @if ($address->policeStation)
						<div class="font-semibold col-span-2 text-right md:text-left">{{ $address->policeStation->name }}
                        @endif
						</div>
					</div>

					<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
						<div class="text-gray-400">Post Office</div>
                        @if ($address->postOffice)
						<div class="font-semibold col-span-2 text-right md:text-left">{{ $address->postOffice->name }}
                        @endif
						</div>
					</div>

					<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
						<div class="text-gray-400">Pincode</div>
						<div class="font-semibold col-span-2 text-right md:text-left">{{ $address->pin_code }}</div>
					</div>

					<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-3 gap-1 md:gap-4">
						<div class="text-gray-400">House No</div>
						<div class="font-semibold col-span-2 text-right md:text-left">{{ $address->house_no }}</div>
					</div>
				</div>
				@endforeach
			</div>

			<div class="md:px-6 md:py-4 border-b">
				<div class="text-gray-500">Education Details</div>
				<div class="flex flex-col">
					<div class="overflow-x-auto">
						<div class="align-middle inline-block min-w-full">
							<div class="overflow-hidden">
								<table class="min-w-full">
									<thead>
										<tr>
											<th scope="col" class="px-1 py-1 text-left text-sm text-gray-400 font-normal">Qualification</th>
											<th scope="col" class="px-1 py-1 text-left text-sm text-gray-400 font-normal">Subject /Stream</th>
											<th scope="col" class="px-1 py-1 text-left text-sm text-gray-400 font-normal">Major /Core</th>
											<th scope="col" class="px-1 py-1 text-left text-sm text-gray-400 font-normal">School /University
											</th>
											<th scope="col" class="px-1 py-1 text-left text-sm text-gray-400 font-normal">Division /Rank</th>
											<th scope="col" class="px-1 py-1 text-left text-sm text-gray-400 font-normal">Year</th>
											<th scope="col" class="px-1 py-1 text-left text-sm text-gray-400 font-normal">Duration</th>
										</tr>
									</thead>
									<tbody>
										@foreach ($qualifications as $edu)
										<tr>
                                            @if ($edu->qualification)
											<td class="px-1 py-1 whitespace-nowrap">{{ $edu->qualification->name }}</td>
                                            @endif
											<td class="px-1 py-1 whitespace-nowrap">{{ $edu->subject !== null ? $edu->subject->name :
												($edu->custom_subject ?? '-') }}</td>
											<td class="px-1 py-1 whitespace-nowrap">{{ $edu->majorCore !== null ? $edu->majorCore->name :
												($edu->custom_major_core ?? '-') }}</td>
											<td class="px-1 py-1 whitespace-nowrap">{{ $edu->school }}</td>
											<td class="px-1 py-1 whitespace-nowrap">{{ $edu->division }}</td>
											<td class="px-1 py-1 whitespace-nowrap">{{ $edu->year_of_passing }}</td>
											<td class="px-1 py-1 whitespace-nowrap">{{ $edu->course_duration }}</td>
										</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="md:px-6 md:py-4 border-b">
				<div class="text-gray-500">Experience</div>
				<div class="flex flex-col">
					<div class="overflow-x-auto">
						<div class="align-middle inline-block min-w-full">
							<div class="overflow-hidden">
								<table class="min-w-full">
									<thead>
										<tr>
											<th class="px-1 py-1 text-left text-sm font-normal text-gray-400">Designation</th>
											<th class="px-1 py-1 text-left text-sm font-normal text-gray-400">From</th>
											<th class="px-1 py-1 text-left text-sm font-normal text-gray-400">To</th>
											<th class="px-1 py-1 text-left text-sm font-normal text-gray-400">Department /Company</th>
											<th class="px-1 py-1 text-left text-sm font-normal text-gray-400">Salary</th>
											<th class="px-1 py-1 text-left text-sm font-normal text-gray-400">Reason for leaving</th>
										</tr>
									</thead>
									<tbody>
										@foreach ($experiences as $exp)
										<tr>
											<td class="px-1 py-1 whitespace-nowrap">{{ $exp->designation }}</td>
											<td class="px-1 py-1 whitespace-nowrap">{{ date('d M Y', strtotime($exp->from)) }}</td>
											<td class="px-1 py-1 whitespace-nowrap">
												@if ($exp->is_working == 1)
												Present
												@else
												{{ date('d M Y', strtotime($exp->to)) }}
												@endif
											</td>
											<td class="px-1 py-1 whitespace-nowrap">{{ $exp->company }}</td>
											<td class="px-1 py-1 whitespace-nowrap">{{ $exp->total_emoluments }}</td>
											<td class="px-1 py-1 whitespace-nowrap">{{ $exp->leave_reason }}</td>
										</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="md:px-6 md:py-4">
				<div class="grid grid-cols-1 md:gap-4 gap-1 mt-2">
					<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-4 lg:grid-cols-6 gap-1 md:gap-4">
						<div class="text-gray-400">NCO Detail</div>
						<div class="col-span-4 text-right md:text-left">
							<span class="font-semibold">{{ count($ncoFamilySelected) }}</span> NCO selected
						</div>
					</div>

					<div class="flex justify-between md:grid grid-cols-1 md:grid-cols-4 lg:grid-cols-6 gap-1 md:gap-4">
						<div class="text-gray-400">NCO on card</div>
						<div class="col-span-4 text-right md:text-left">
                            @if(count($ncoFamilySelected) != 0)
                                <span class="font-semibold">{{ $ncoCodeToDisplay->code }}</span> {{ $ncoCodeToDisplay->name }}
                            @else
                                <span class="font-semibold">No NCO Selected</span>
                            @endif
						</div>
					</div>
				</div>
			</div>

			@if ($type == 'registration')
			@if ($alreadyPaid)
			<div class="mt-5 md:px-6 text-empex-green">You will be notified the status of your application</div>
			@else
			<div class="mt-5 md:px-6 text-empex-green">After successful payment, You will be notified the status of your
				application</div>
			@endif

			<div class="py-5 md:px-6">
				<div class="flex justify-between md:justify-center">
					<div class="md:mr-2 w-1/2 md:w-full text-left md:text-right">
						<button wire:click.prevent='back'
							class="uppercase focus:outline-none py-1 border-empex-green px-5 rounded text-center text-empex-green bg-white hover:bg-gray-100 font-medium border">Back</button>
					</div>

					<div class="md:ml-2 w-1/2 md:w-full text-right md:text-left">
						@if ($alreadyPaid)
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
						@else
						<button type="submit" wire:click.prevent='makePayment' wire:loading.attr="disabled"
							wire:loading.class="bg-gray-400" wire:loading.class.remove="bg-empex-green hover:bg-green-500"
							class="uppercase focus:outline-none border border-transparent py-1 px-5 rounded text-center text-white bg-empex-green hover:bg-green-500 font-medium">
							<span wire:loading.remove wire:target='submit'>
								Make Payment
							</span>

							<span wire:loading wire:target='submit'>
								Submit...
							</span>
						</button>
						@endif
					</div>
				</div>
			</div>
			@endif
		</div>
	</div>
</div>

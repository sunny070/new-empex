<div>
    <x-loading-indicator />
    <form class="w-full md:w-3/4 mx-auto">
        <div>Please, Enter from 10th Standard</div>

        {{-- @if ($errors->any())
		<div class="text-empex-red" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">
			Please enter all field marked with *
		</div>
		@endif --}}


        @if ($errors->any())
            <div class="text-empex-red" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">
                Please enter all field marked with *
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        @foreach ($employeeQualifications as $qualiIndex => $empQuali)
            <div class=" font-normal my-3">Education - {{ $qualiIndex + 1 }}</div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 border-b pb-2">
                <div class="w-full relative">
                    <select wire:model.lazy='employeeQualifications.{{ $qualiIndex }}.qualification_id' class="input"
                        id="qualification_id_{{ $qualiIndex }}" name="{{ $qualiIndex }}">
                        <option value="">Select Qualification</option>
                        @foreach ($qualifications as $qualification)
                            <option value="{{ $qualification->id }}">{{ $qualification->name }}</option>
                        @endforeach
                    </select>
                    <label class="tracking-wide text-gray-500 text-xs label-select2" for="qualification">
                        Qualification*
                    </label>
                    @error('employeeQualifications.{{ $qualiIndex }}.qualification_id')
                        <p class="text-empex-red text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="w-full relative">
                    <select wire:model.lazy='employeeQualifications.{{ $qualiIndex }}.subject_id'
                        {{ count($employeeQualifications[$qualiIndex]['streams']) < 1 ? 'disabled' : '' }}
                        class="input" id="subject_id_{{ $qualiIndex }}" name="{{ $qualiIndex }}">
                        <option value="">Select Subject/Stream</option>
                        @foreach ($employeeQualifications[$qualiIndex]['streams'] as $subject)
                            <option value="{{ $subject['id'] }}">{{ $subject['name'] }}</option>
                        @endforeach
                        <option value="other">Other</option>
                    </select>
                    <label class="tracking-wide text-gray-500 text-xs label-select2" for="subject">
                        Subject/Stream*
                    </label>
                    @error('employeeQualifications.{{ $qualiIndex }}.subject_id')
                        <p class="text-empex-red text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                @if (isset($customSubject[$qualiIndex]) && $customSubject[$qualiIndex] == true)
                    <div class="w-full relative">
                        <input wire:model.lazy='employeeQualifications.{{ $qualiIndex }}.custom_subject'
                            class="input w-full rounded border-gray-400 text-base text-gray-500 focus:text-empex-green focus:border-empex-green focus:outline-none focus:ring-green-600"
                            type="text" placeholder="Subject (full name)*">
                        <label class="tracking-wide text-gray-500 text-xs label">
                            Subject (full name)*
                        </label>
                    </div>

                    <div class="w-full relative">
                        <input wire:model.lazy='employeeQualifications.{{ $qualiIndex }}.custom_core'
                            class="input w-full rounded border-gray-400 text-base text-gray-500 focus:text-empex-green focus:border-empex-green focus:outline-none focus:ring-green-600"
                            type="text" placeholder="Major/Core (optional)">
                        <label class="tracking-wide text-gray-500 text-xs label">
                            Major/Core (optional)
                        </label>
                    </div>
                @else
                    <div class="w-full relative">
                        <select wire:model.lazy='employeeQualifications.{{ $qualiIndex }}.core_id'
                            {{ count($employeeQualifications[$qualiIndex]['cores']) < 1 ? 'disabled' : '' }}
                            class="input" id="core_id_{{ $qualiIndex }}" name="{{ $qualiIndex }}">
                            <option value="">Select Major/Core</option>
                            @foreach ($employeeQualifications[$qualiIndex]['cores'] as $core)
                                <option value="{{ $core['id'] }}">{{ $core['name'] }}</option>
                            @endforeach
                            <option value="other">Other</option>
                        </select>
                        <label class="tracking-wide text-gray-500 text-xs label-select2" for="core">
                            Major/Core*
                        </label>
                        @error('core')
                            <p class="text-empex-red text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>

                    @if (isset($customCore[$qualiIndex]) && $customCore[$qualiIndex] == true)
                        <div class="w-full relative">
                            <input wire:model.lazy='employeeQualifications.{{ $qualiIndex }}.custom_core'
                                class="input rounded w-full border-gray-400 text-base text-gray-500 focus:text-empex-green focus:border-empex-green focus:outline-none focus:ring-green-600"
                                type="text" placeholder="Major/Core (full name)*">
                            <label class="tracking-wide text-gray-500 text-xs label">
                                Major/Core (full name)*
                            </label>
                        </div>
                    @endif
                @endif

                <div class="w-full relative">
                    <input wire:model.lazy='employeeQualifications.{{ $qualiIndex }}.school'
                        class="input w-full border-gray-400 rounded text-base text-gray-500 focus:text-empex-green focus:border-empex-green focus:outline-none focus:ring-green-600"
                        type="text" placeholder="Board/University*">
                    <label class="tracking-wide text-gray-500 text-xs label" for="school">
                        Board/University*
                    </label>
                    @error('school')
                        <p class="text-empex-red text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="w-full relative">
                    <select wire:model.lazy='employeeQualifications.{{ $qualiIndex }}.division' class="input"
                        id="division_{{ $qualiIndex }}" name="{{ $qualiIndex }}">
                        <option value="">Select Division/Grade*</option>
                        <option value="Distinction">Distinction</option>
                        <option value="First">First</option>
                        <option value="Second">Second</option>
                        <option value="Third">Third</option>
                    </select>
                    <label class="tracking-wide text-gray-500 text-xs label-select2" for="qualification">
                        Division/Grade*
                    </label>
                    @error('division')
                        <p class="text-empex-red text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="w-full relative">
                    <input wire:model.lazy='employeeQualifications.{{ $qualiIndex }}.year'
                        class="input w-full border-gray-400 rounded text-base text-gray-500 focus:text-empex-green focus:border-empex-green focus:outline-none focus:ring-green-600"
                        type="number" placeholder="Year of passing*">
                    <label class="tracking-wide text-gray-500 text-xs label" for="year">
                        Year of passing*
                    </label>
                    @error('year')
                        <p class="text-empex-red text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="w-full relative">
                    <input wire:model.lazy='employeeQualifications.{{ $qualiIndex }}.duration'
                        class="input w-full border-gray-400 rounded text-base text-gray-500 focus:text-empex-green focus:border-empex-green focus:outline-none focus:ring-green-600"
                        type="text" placeholder="Course Duration*">
                    <label class="tracking-wide text-gray-500 text-xs label" for="duration*">
                        Course Duration*
                    </label>
                    @error('duration')
                        <p class="text-empex-red text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="w-full relative -mt-3">
                    @if ($hasCertificate[$qualiIndex] !== null)
                        <div class="mt-3">
                            File Attached
                            <a target="_blank"
                                href="{{ asset('storage/' . $employeeQualifications[$qualiIndex]['certificate']) }}"
                                class="text-empex-green">view</a>
                            <button type="button" class="float-right text-empex-red group"
                                wire:click='removeCertificate({{ $qualiIndex }})'>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                                <div class="absolute bottom-0 flex-col hidden mb-6 group-hover:flex">
                                    <span
                                        class="relative z-10 p-1 text-xs ml-5 leading-none text-white whitespace-no-wrap bg-black shadow-lg">Delete
                                        Certificate?</span>
                                </div>
                            </button>
                        </div>
                    @else
                        <label class="tracking-wide text-gray-500 text-xs font-semibold -mt-3" for="certificate">
                            Certificate/Marksheet (Max 2MB)*
                        </label>
                        <input wire:model.lazy='employeeQualifications.{{ $qualiIndex }}.certificate'
                            class="w-full border-gray-400
							text-base text-gray-500 focus:text-empex-green focus:border-empex-green
							focus:outline-none focus:ring-green-600"
                            type="file" placeholder="Certificate/Marksheet*" accept=".doc, .docx, .pdf, image/*">
                        @error('certificate')
                            <p class="text-empex-red text-xs italic">{{ $message }}</p>
                        @enderror
                    @endif
                </div>

                @if ($qualiIndex == 0)
                    <div class="w-full flex items-center md:col-span-2" style="background-color: #fdf9ed">
                        <div class="bg-empex-yellow px-2 py-0 text-white">!</div>
                        <div class="ml-1 text-sm">Upload 10th Passing Certificate for HSLC</div>
                    </div>
                @endif

                @if ($qualiIndex != 0 && $qualiIndex == count($employeeQualifications) - 1)
                    <div class="w-full flex items-center md:col-span-2" style="background-color: #def3dd">
                        <div class="bg-empex-green px-2 py-0 text-white">!</div>
                        <div class="ml-1 text-sm">This will be treated as highest education</div>
                    </div>
                @endif
            </div>

            <script>
                $(document).ready(function() {
                    window.initSelect2{{ $qualiIndex }} = () => {
                        $("#qualification_id_{{ $qualiIndex }}").select2({
                            placeholder: "Select Qualification"
                        });

                        $("#subject_id_{{ $qualiIndex }}").select2({
                            placeholder: "Select Subject/Stream"
                        });

                        $("#division_{{ $qualiIndex }}").select2({
                            placeholder: "Select Division/Grade"
                        });

                        $("#core_id_{{ $qualiIndex }}").select2({
                            placeholder: "Select Major/core"
                        });
                    }

                    initSelect2{{ $qualiIndex }}();

                    $('#qualification_id_{{ $qualiIndex }}').on('change', function(e) {
                        livewire.emit('updateSubject', e.target.name, e.target.value)
                        @this.set('employeeQualifications.{{ $qualiIndex }}.qualification_id', $(this).val());
                    });

                    $('#subject_id_{{ $qualiIndex }}').on('change', function(e) {
                        livewire.emit('updateCore', e.target.name, e.target.value)
                        @this.set('employeeQualifications.{{ $qualiIndex }}.subject_id', $(this).val());
                    });

                    $('#division_{{ $qualiIndex }}').on('change', function(e) {
                        @this.set('employeeQualifications.{{ $qualiIndex }}.division', $(this).val());
                    });

                    $('#core_id_{{ $qualiIndex }}').on('change', function(e) {
                        livewire.emit('checkCore', e.target.name, e.target.value)
                        @this.set('employeeQualifications.{{ $qualiIndex }}.core_id', $(this).val());
                    });

                    window.livewire.on('select2AutoInit', () => {
                        initSelect2{{ $qualiIndex }}();
                    });
                });
            </script>
        @endforeach

        <div class="flex w-full mt-5 justify-between">
            <button type="button" class="text-empex-green uppercase font-semibold text-sm"
                wire:click.prevent='addMoreQualification({{ array_key_last($employeeQualifications) + 1 }})'>Add
                More</button>

            @if (count($employeeQualifications) > 1)
                <button type="button" class="text-empex-red uppercase font-semibold text-sm"
                    onclick="openPopover(event,'removeQualification')">Remove</button>

                <div class="hidden bg-white border mr-3 z-50 font-normal leading-normal text-sm max-w-xs no-underline break-words rounded-lg w-52 shadow text-center"
                    id="removeQualification">
                    <div>
                        <div class="text-gray-700 opacity-75 font-semibold p-3 mb-0 rounded-t-lg">
                            Delete Education - {{ array_key_last($employeeQualifications) + 1 }}?
                        </div>
                        <div class="text-gray-700 p-3 flex justify-between">
                            <button type="button" class="border bg-empex-red text-white px-5 rounded-md py-1"
                                wire:click.prevent="removeQualification({{ $employeeQualifications[array_key_last($employeeQualifications)]['id'] }})">Yes</button>
                            <button type="button" class="border bg-white text-gray-400 px-5 rounded-md py-1"
                                onclick="openPopover(event,'removeQualification')">No</button>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </form>

    <div class="pb-5 pt-10">
        <div class="flex justify-between md:justify-center">
            <div class="md:mr-2 w-1/2 md:w-full text-left md:text-right">
                <button wire:click.prevent='back'
                    class="uppercase focus:outline-none py-1 border-empex-green px-5 rounded text-center text-empex-green bg-white hover:bg-gray-100 font-medium border">Back</button>
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
</div>

<div class="w-full">
    <div class="bg-white border p-5 rounded shadow-sm">
        <div class="grid grid-cols-1 md:grid-cols-4 md:gap-2">
            <div class="col-span-1">
                <label class="text-xs">Category</label>
                <select wire:model="category" class="w-full border border-empex-gray p-2 rounded">
                    <option value></option>
                    <option value="ST">ST</option>
                    <option value="SC">SC</option>
                    <option value="OBC">OBC</option>
                    <option value="General">General</option>
                    <option value="ExServicemen">Ex Servicemen</option>
                </select>
            </div>

            <div class="col-span-3 grid grid-cols-2 md:grid-cols-4 gap-2">
                <div class="col-span-2 grid grid-cols-2 gap-2">
                    <div>
                        <div>
                            <label class="text-xs">Male/post</label>
                            <input type="number" wire:model="male_per_post"
                                class="w-full border border-empex-gray p-2 rounded" placeholder="">
                        </div>
                        <div class="text-xs {{ $male_per_post != null ? '' : 'hidden' }}">Male/post = {{
                            $this->male_per_post !=
                            null ? $this->male_per_post : '0' }}/20</div>
                    </div>

                    <div>
                        <div>
                            <label class="text-xs">Female/post</label>
                            <input type="number" wire:model="female_per_post"
                                class="w-full border border-empex-gray p-2 rounded" placeholder="" min="0">
                        </div>
                        <div class="text-xs {{ $female_per_post != null ? '' : 'hidden' }}">Female/post = {{
                            $this->female_per_post
                            != null ? $this->female_per_post : '0' }}/20
                        </div>
                    </div>
                </div>

                <div>
                    <label class="text-xs">Lower Age</label>
                    <input type="number" wire:model="lower_age" class="w-full border border-empex-gray p-2 rounded"
                        placeholder="">
                    <div class="text-xs {{ $lower_age != null ? '' : 'hidden' }}">Born after {{ $lowerAgeYmd }}</div>
                </div>

                <div>
                    <label class="text-xs">Upper Age</label>
                    <input type="number" wire:model="upper_age" class="w-full border border-empex-gray p-2 rounded"
                        placeholder="">
                    <div class="text-xs {{ $upper_age != null ? '' : 'hidden' }}">Born before {{ $upperAgeYmd }}</div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-2 mt-2">
            <div>
                <label class="text-xs">Qualification</label>
                <select id="qualifications" multiple wire:model="qualificationIds">
                    @foreach ($qualifications as $quali)
                    <option value="{{ $quali->id }}">{{ $quali->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="text-xs">Subject</label>
                <select id="subjects" multiple {{ count($subjects)==0 ? 'disabled' : '' }} wire:model="subjectIds">
                    @foreach ($subjects as $subj)
                    <option value="{{ $subj->id }}">{{ $subj->qualification->name }} - {{ $subj->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="text-xs">Major/Core</label>
                <select id="cores" multiple {{ count($cores)==0 ? 'disabled' : '' }} wire:model="coreIds">
                    @foreach ($cores as $core)
                    <option value="{{ $core->id }}">{{ $core->subject->name }} - {{ $core->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="text-xs">District</label>
                <select wire:model="district" class="w-full border border-empex-gray p-2 rounded">
                    <option value="All">All District</option>
                    @foreach ($districts as $dist)
                    <option value="{{ $dist->id }}">{{ $dist->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mt-3">
            <button {{ $buttonEnable==false ? 'disabled' : '' }} wire:click="generateSponsorship"
                class=" px-6 py-2 rounded {{ $buttonEnable == false ? 'bg-empex-gray cursor-not-allowed' : 'bg-empex-green text-white hover:bg-green-600' }}">
                GENERATE
            </button>
            @if (count($qualificationIds) == 0)
            <span class="ml-2 text-xs">select one or more qualifications to generate candidate for sponsorship</span>
            @endif
        </div>
    </div>

    @if ($generated == true)
    <div class="bg-white border p-5 rounded shadow-sm mt-5">
        <div class="flex flex-col w-full bg-empex-gray">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <table class=" table-auto w-full text-center">
                        <thead>
                            <tr>
                                <td class="border border-black" rowspan="2">S.No</td>
                                <td class="border border-black" rowspan="2">Name</td>
                                <td class="border border-black" rowspan="2">Father's Name</td>
                                <td class="border border-black" rowspan="2">Address</td>
                                <td class="border border-black" rowspan="2">Regd.No</td>
                                <td class="border border-black" colspan="3">Qualifications</td>
                                <td class="border border-black" rowspan="2">DOB</td>
                                <td class="border border-black" rowspan="2">Contact</td>
                                <td class="border border-black" rowspan="2">Time Sponsored</td>
                            </tr>
                            <tr>
                                <td class="border border-black">Qualification</td>
                                <td class="border border-black">Subject</td>
                                <td class="border border-black">Major/Core</td>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($qualifiedUsers as $user)
                            <tr>
                                <td class="border border-black">{{ $loop->iteration }}</td>
                                <td class="border border-black">{{ $user['full_name'] }}</td>
                                <td class="border border-black">{{ $user['parents_name'] }}</td>
                                <td class="border border-black">
                                    {{ $user['permanent_address']['house_no'] ?? '' }}, {{
                                    $user['permanent_address']['village'] ?? '' }}, {{
                                    $user['permanent_address']['district']['name'] ?? '' }}, {{
                                    $user['permanent_address']['state']['name'] ?? ''}} -
                                    {{
                                    $user['permanent_address']['pin_code'] ?? '' }}
                                </td>
                                <td class="border border-black">{{ $user['employment_no'] }}</td>
                                <td class="border border-black">
                                    @foreach ($user['education'] as $edu)
                                    {{ $edu['qualification']['name'] ?? '-' }}<br>
                                    @endforeach
                                </td>
                                <td class="border border-black">
                                    @foreach ($user['education'] as $edu)
                                    {{ $edu['subject']['name'] ?? '-' }}<br>
                                    @endforeach
                                </td>
                                <td class="border border-black">
                                    @foreach ($user['education'] as $edu)
                                    {{ $edu['major_core']['name'] ?? '-' }}<br>
                                    @endforeach
                                </td>
                                <td class="border border-black">{{ date('d/m/Y', strtotime($user['dob'])) }}</td>
                                <td class="border border-black">{{ $user['phone_no'] }}</td>
                                <td class="border border-black">{{ $user['sponsorship_count'] }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td class="border border-black" colspan="11">Candidate not found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        @if (count($qualifiedUsers) > 0)
        <div class="mt-5">
            <div>Fill up below data and confirm for sponsporship</div>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-2 mt-2">
                <div>
                    <label class="text-xs">Sponsorship Name*</label>
                    <input type="text" wire:model="sponsorshipName" class="w-full border border-empex-gray p-2 rounded"
                        placeholder="Sponsorship Name">
                    @error('sponsorshipName')
                    <div class="text-xs text-empex-red">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label class="text-xs">Employer Name*</label>
                    <input type="text" wire:model="employerName" class="w-full border border-empex-gray p-2 rounded"
                        placeholder="Employer Name">
                    @error('employerName')
                    <div class="text-xs text-empex-red">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label class="text-xs">Address*</label>
                    <input type="text" wire:model="address" class="w-full border border-empex-gray p-2 rounded"
                        placeholder="Address">
                    @error('address')
                    <div class="text-xs text-empex-red">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label class="text-xs">Sponsorship File</label>
                    <input type="file" wire:model="sponsorshipFile" class="w-full border border-empex-gray p-1 rounded">
                    @error('sponsorshipFile')
                    <div class="text-xs text-empex-red">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="flex justify-end mt-5">
                <button wire:click="confirm"
                    class="text-white border brder-empex-green bg-empex-green px-6 py-2 rounded hover:bg-green-600">
                    Confirm Sponsor
                </button>
            </div>
        </div>
        @endif
    </div>
    @endif

    <div class="flex flex-row mt-4">
        <div class="w-full">
            <p class="font-semibold mt-2 mb-2">Previous sponsorhips</p>
            <div class="bg-white w-full border-2 p-4 rounded-md">
                <div class="mb-5">
                    <b>{{ $totalSponsored }}</b> sponsorships found on EmpEx database. Click below to view them
                </div>

                <a href="{{request()->route()->getName() == 'admin.report.sponsorship' ? route('admin.report.sponsorship.list') : route('district-admin.report.sponsorship.list') }}"
                    class="text-sm text-empex-green border border-empex-green p-2 rounded hover:bg-empex-gray">VIEW
                    SPONSORSHIPS</a>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
      window.initSelect2=()=>{
        $("#qualifications").select2({
          placeholder:"Select Qualifications",
          closeOnSelect: false,
          allowClear: true,
        });

        $("#subjects").select2({
          placeholder:"Select Subjects",
          closeOnSelect: false,
          allowClear: true,
        });

        $("#cores").select2({
          placeholder:"Select Major Cores",
          closeOnSelect: false,
          allowClear: true,
        });
      }

      initSelect2();

      $('#qualifications').on('change', function (e) {
        @this.set('qualificationIds', $(this).val());
      });

      $('#subjects').on('change', function (e) {
        @this.set('subjectIds', $(this).val());
      });

      $('#cores').on('change', function (e) {
        @this.set('coreIds', $(this).val());
      });

      window.livewire.on('select2AutoInit',()=>{
        initSelect2();
      });
    });
    </script>
</div>

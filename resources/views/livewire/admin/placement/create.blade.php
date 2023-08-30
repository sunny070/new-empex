<div class="bg-white items-center justify-center flex rounded border p-5 w-full">

    <form class="md:w-2/3 w-full">
        <div class="font-semibold text-center py-2">Choose Employee Registration Number</div>
        <div class="justify-center flex">
            <div class="md:w-2/3 w-full relative">
                {{-- <select wire:model.lazy='regNo' class="input" id="regNo">
                    <option value="">Select Registration Number</option>
                    @foreach ($employmentNos as $emp)
                    <option value="{{ $emp->id }}">{{ $emp->employment_no }}</option>
                    @endforeach
                </select> --}}


                <input wire:model.lazy='regNo'
                    class="w-full rounded input border-gray-400 text-base text-gray-500 focus:text-empex focus:border-empex-green focus:outline-none focus:ring-green-600"
                    id="regNo" type="text" placeholder="Employment Number*">
                <label class="tracking-wide text-gray-500 text-xs label" for="prepincode">
                    Registration Number*
                </label>
                {{-- <label class="tracking-wide text-gray-500 text-xs label-select2" for="regNo">
                    Registration Number*
                </label> --}}
                @error('regNo')
                <p class="text-empex-red text-xs italic">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="py-2">
            Employee Information
        </div>
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">

            <div class="w-full relative">
                <input wire:model.lazy='recruiterName'
                    class="w-full rounded input border-gray-400 text-base text-gray-500 focus:text-empex focus:border-empex-green focus:outline-none focus:ring-green-600"
                    id="prepincode" type="text" placeholder="Recruiter Name*">
                <label class="tracking-wide text-gray-500 text-xs label" for="prepincode">
                    Recruiter Name*
                </label>
                @error('recruiterName')
                <p class="text-empex-red text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-full relative">
                <input wire:model.lazy='designation'
                    class="w-full rounded input border-gray-400 text-base text-gray-500 focus:text-empex focus:border-empex-green focus:outline-none focus:ring-green-600"
                    id="prepincode" type="text" placeholder="Designation*">
                <label class="tracking-wide text-gray-500 text-xs label" for="prepincode">
                    Designation*
                </label>
                @error('designation')
                <p class="text-empex-red text-xs italic">{{ $message }}</p>
                @enderror
            </div>



            <div class="w-full relative">
                <select wire:model.lazy='type' class="input" id="type">
                    <option value="">Select Type</option>

                    <option value="Regular">Regular</option>
                    <option value="Temporary">Temporary</option>

                </select>

                @error('type')
                <p class="text-empex-red text-xs italic">{{ $message }}</p>
                @enderror
            </div>


            <div class="w-full relative">
                <input wire:model.lazy='recruit_date'
                    class="w-full rounded input text-base text-gray-600 focus:text-empex-green focus:border-green-600 focus:outline-none focus:ring-green-600 border-gray-400"
                    id="dob" type="date" placeholder="Date of Recruit*">
                <label class="tracking-wide text-gray-600 text-xs label" for="dob">
                    Date of Recruit*
                </label>
                @error('recruit_date')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>



            <div class="w-full relative">
                <select wire:model.lazy='district' class="input" id="district">
                    <option value="">Select District</option>
                    @foreach ($districts as $district)
                    <option value="{{ $district->id }}">{{ $district->name }}</option>
                    @endforeach
                </select>
                {{-- <label class="tracking-wide text-gray-500 text-xs label-select2" for="regNo">
                    Registration Number*
                </label> --}}
                @error('district')
                <p class="text-empex-red text-xs italic">{{ $message }}</p>
                @enderror
            </div>




            <div class="w-full relative">
                <input wire:model.lazy='address'
                    class="w-full rounded input border-gray-400 text-base text-gray-500 focus:text-empex focus:border-empex-green focus:outline-none focus:ring-green-600"
                    id="address" type="text" placeholder="Address*">
                <label class="tracking-wide text-gray-500 text-xs label" for="prepincode">
                    Address*
                </label>
                @error('address')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="pb-5 pt-10">
            <div class="flex justify-between md:justify-center">
                <div class="md:mr-2 w-1/2 md:w-full text-left md:text-right">
                    <button type="submit" wire:click.prevent='storePlacement' wire:loading.attr="disabled"
                        wire:loading.class="bg-gray-400" wire:loading.class.remove="bg-empex-green hover:bg-green-500"
                        class="uppercase focus:outline-none border border-transparent py-1 px-5 rounded text-center text-white bg-empex-green hover:bg-green-500 font-medium">
                        <span wire:loading.remove wire:target='storePlacement'>
                            Next
                        </span>

                        <span wire:loading wire:target='storePlacement'>
                            Saving...
                        </span>
                    </button>
                </div>

                <div class="md:ml-2 w-1/2 md:w-full text-right md:text-left">
                    <button disabled
                        class="focus:outline-none py-1 border-gray-400 bg-gray-400 uppercase px-5 cursor-not-allowed rounded text-center text-white font-medium border">Back</button>
                </div>
            </div>
        </div>
    </form>
</div>



<script>
    $(document).ready(function() {
        window.initSelect2=()=>{
            // $("#regNo").select2({
            //     placeholder:"Select Registration No"
            // });
            $("#type").select2({
                placeholder:"Select Type"
            });
            $("#district").select2({
                placeholder:"Select District"
            });


            $('#district').on('change', function (e) {
						@this.set('district', $(this).val());
            });
            $('#type').on('change', function (e) {
						@this.set('type', $(this).val());
            });


        }

        initSelect2();



        window.livewire.on('select2AutoInit',()=>{
            initSelect2();
        });
    });
</script>

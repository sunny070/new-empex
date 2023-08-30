<div cldass="bg-gray-100 h-screen w-screen flex justify-center">
    <div class="mr-8">
        {{-- {{ dd( request()->route()) }} --}}
        {{-- <div class=" text-sm font-semibold">
            Archive --}}
        </div>
        <div class="bg-white max-w-xl mx-auto border border-gray-200" x-data="{selected:null}">
            @for ($i = 1; $i < 6; $i++) <ul class="shadow-box">

                <li class="relative border-b border-gray-200">
                    {{-- :class="selected == {{ $i }} ? 'text-empex-green' : ''" --}}
                    {{-- class="{{ request()->year == now()->subYears($i-1)->year }} ? 'text-empex-green' : ''" --}}
                    <button :class="selected == {{ $i }} ? 'text-empex-green' : ''" type="button"
                        class="w-full font-semibold px-4 py-2 text-left"
                        @click="selected !== {{$i}} ? selected = {{$i}} : selected = null">
                        <div class="flex items-center justify-between">

                            <span
                                class="{{ (int)request()->year == (int)now()->subYears($i-1)->year ? 'text-empex-green' : '' }}">
                                <img src="/images/main/calendar.png" alt="register" class="inline">
                                {{ now()->subYears($i-1)->year }} </span>
                            <span class="ico-plus">
                                <img :src="selected == {{$i}} ? '/images/main/minus.png' : '/images/main/plus.png'"
                                    alt="register" class="inline">
                            </span>
                        </div>
                    </button>

                    <div class="relative overflow-hidden transition-all max-h-0 duration-700" style=""
                        x-ref="container1" style="max-height: fit-content"
                        x-bind:style="selected == {{$i}} ? 'max-height: ' + 400 + 'px' : ''">
                        <ul stylde="list-style-type: circle;" classd="pl-10">
                            {{-- <li>January</li>
                            <li>February</li>
                            <li>March</li> --}}

                            @foreach ($months as $key => $month)
                            <li class="mb-2 pl-10" style=" {{ request()->month == $month && request()->year == now()->subYears($i-1)->year ? 'border-radius: 4px;
                                background-color: #e9f3ed;' : '' }} ">
                                {{-- {{$key}} --}}
                                {{-- {{ Request::url() }} --}}
                                &#8226; <a
                                    href="{{ request()->fullUrlWithQuery(['month' => $month,'year' =>now()->subYears($i-1)->year]) }} ">
                                    {{$key}}
                                </a>
                            </li>
                            @endforeach
                            {{-- <li></li> --}}
                        </ul>
                    </div>

                </li>

                </ul>
                @endfor
                {{-- <ul class="shadow-box">

                    <li class="relative border-b border-gray-200">

                        <button :class="selected ==2 ? 'text-empex-green' : ''" type="button"
                            class="w-full font-semibold px-4 py-2 text-left"
                            @click="selected !== 2 ? selected = 2 : selected = null">
                            <div class="flex items-center justify-between">
                                <span>
                                    <img src="/images/main/calendar.png" alt="register" class="inline">
                                    2022 </span>
                                <span class="ico-plus">
                                    <img :src="selected == 2 ? '/images/main/minus.png' : '/images/main/plus.png'"
                                        alt="register" class="inline">
                                </span>
                            </div>
                        </button>
                        <div class="relative overflow-hidden transition-all max-h-0 duration-700" style=""
                            x-ref="container1" x-bind:style="selected == 2 ? 'max-height: ' + 310 + 'px' : ''">

                            <ul style="list-style-type: circle;" class="ml-14">
                                @foreach ($months as $key => $month)
                                <li>{{$key}}</li>
                                @endforeach
                            </ul>
                        </div>

                    </li>




                </ul> --}}
        </div>
    </div>


</div>

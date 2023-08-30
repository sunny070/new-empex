<div>
    <div class="max-w-sm bg-white rounded overflow-hidden shadow">
        <div class="bg-empex-green px-6 py-1 w-full">
            <div class="flex justify-center text-white align-middle items-center">
                <img src="/images/auth/emblem.svg" alt="emblem" class="w-7 h-7">
                <div>
                    <div class="font-semibold text-sm">Employment Registration Card</div>
                    <div class="text-xs">LESDE, Govt. of Mizoram</div>
                </div>
            </div>
        </div>
        <div class="px-4 py-2">
            <div class="grid grid-cols-2 gap-2">
                <div>
                    <div style="font-size: 10px">NCO : {{ $ncoCodeToDisplay }}</div>
                    <div class="text-empex-green" style="font-size: 11px;">{{ $empNo }}</div>

                    <div class="font-semibold mt-2 text-sm">{{ $name }}</div>

                    <div class="flex justify-between mt-5">
                        {{-- added rj --}}

                        <div class="h-12 w-12">{{ QrCode::size(50)->generate(route('qr-code', [$phone, $empNo])) }}
                        </div>

                        {{-- added rj --}}



                        {{-- <img src="{{ asset('/storage/' . $qr) }}" alt="qr" class="h-12 w-12"> --}}

                        <div class="ml-2">
                            <div style="font-size: 8px;" class="text-gray-400">{{ $phone }}</div>
                            <div style="font-size: 8px;" class="text-gray-400">{{ $address->district->name }} District
                            </div>

                            <div style="font-size: 8px;" class="text-empex-green font-bold">
                                Valid : {{ date('d.m.y', strtotime($from)) }} - {{ date('d.m.y', strtotime($to)) }}
                            </div>
                        </div>
                    </div>

                    {{-- <img src="{{ asset('/storage/' . $qr) }}" alt="qr" class="h-12 w-12"> --}}


                </div>
                <div class="text-center">
                    <img src="{{ asset('/storage/' . $image) }}" class="h-14 w-14 mx-auto" alt="avatar">
                    <div class="mt-5">
                        <img src="{{ asset('/storage/' . $signature->signature) }}" class="h-5 mx-auto" alt="signature">
                        <div style="font-size: 8px;" class="uppercase">({{ $signature->name }})</div>
                        <div style="font-size: 8px;">Registering Authority</div>
                        <div style="font-size: 8px;">{{ $address->district->name }} District,
                            {{ $address->state->name }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

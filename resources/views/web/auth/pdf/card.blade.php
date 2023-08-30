<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>EmpEx Card</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap"
        rel="stylesheet">
</head>

<body style="font-family: 'Poppins', sans-serif;">
    <div
        style="width: 325px; background-color: #2d9735; color: #fff; text-align:center; padding-top: 6px; padding-bottom: 6px;">
        <img src="{{ public_path('images/pdf/card.png') }}" alt="national emblem" style="width: 300px; height: 40px;">
    </div>
    <div style="width: 325px;">
        <div style="float: left; width: 60%; border-left: 1px solid lightgray; height: 150px;">
            <div style="margin-left: 10px; margin-top: 10px;">
{{--                <div style="font-size: 12px; color: #101010; line-height: 11px; ">NCO : {{ $ncoCodeToDisplay }}</div>--}}
                <div style="font-size: 14px; color: #2d9735; line-height: 12px; font-weight: 600; margin-bottom: 5px;">
                    {{ $info->employment_no }}
                </div>
                <div style="font-size: 16px; font-weight: 600; line-height: 14px">{{ $info->full_name }}</div>
            </div>

            <div style="width: 100%; margin-left: 10px; margin-right: 10px; margin-top: 10px; display:inline-block">


                <img src="storage/images/qr/{{ $info->employment_no }}.svg"
                    style="width: 45px; height: 45px; margin-top: 5px; display: inline-block; vertical-align: top;"
                    alt="employee qr code">

                {{-- <img src="storage/{{ $info->qr }}"
                    style="width: 45px; height: 45px; margin-top: 5px; display: inline-block; vertical-align: top;"
                    alt="employee qr code"> --}}
                <div style="display: inline-block; vertical-align: top; margin-left: 10px;">
                    <div style="font-size: 8px;" class="text-gray-400">{{ $info->phone_no }}</div>
                    <div style="font-size: 8px;" class="text-gray-400">{{ $permanent->district->name }} District</div>

                    <div style="font-size: 8px;" class="text-empex-green font-bold">
                        Valid : {{ date('d.m.y', strtotime($info->card_valid_from)) }} -
                        {{ date('d.m.y', strtotime($info->card_valid_till)) }}
                    </div>
                </div>
            </div>
        </div>
        <div style="float: right; width: 40%; border-right: 1px solid lightgray; height: 150px;">
            <div class="margin-right: 10px;" style="text-align: center">
                <img src="storage/{{ $info->avatar }}"
                    style="width: 52px; height: 52px; margin-top: 10px; margin-left: auto; margin-right:auto"
                    alt="employee avatar">

                <div style="margin-top: 8px; text-align: center">
                    <img src="storage/{{ $signature->signature }}"
                        style="height: 30px; margin-left: auto; margin-right: auto; margin-bottom: 0" alt="signature">
                    <div style="font-size: 8px; margin-top: 0; text-transform: uppercase">({{ $signature->name }})
                    </div>
                    <div style="font-size: 8px;">Registering Authority</div>
                    <div style="font-size: 8px;">{{ $permanent->district->name }} District,
                        {{ $permanent->state->name }}</div>
                </div>
            </div>
        </div>
    </div>
    <div>
        <div style="width: 325px; margin-top: 151px; border-bottom: 1px solid lightgray;"></div>
    </div>
</body>

</html>

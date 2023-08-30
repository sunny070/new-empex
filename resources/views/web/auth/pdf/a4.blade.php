<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Employment Exchange Card</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        .w-100 {
            width: 100% !important;
        }

        th {
            text-align: left;
        }

        .bg {
            background-color: #e8e8e8;
        }

        tr.table td {
            border-bottom: 1px solid #e8e8e8;
        }

        tr.both td {
            border-bottom: 1px solid #646464;
            border-top: 1px solid #646464;
        }

        .thead {
            background-color: #646464;
            color: #fff;
        }
    </style>
</head>

<body style="font-family: 'Poppins', sans-serif; font-size: 12px; line-height: 12px;">
    <table>
        <tbody>
            <tr style="text-align:center">
                <td style="width: 20%; text-align: left;">
                    {{-- <img src="storage/images/qr/{{ $info->employment_no }}.svg"
                        style="width: 45px; height: 45px; margin-top: 5px; display: inline-block; vertical-align: top;"
                        alt="employee qr code"> --}}
                    <img src="storage/images/qr/{{ $info->employment_no }}.svg" style="width: 70px; height: 70px;"
                        alt="employee qr code">
                </td>
                <td style="width: 60%">
                    <img src="{{ public_path('images/pdf/emblem.png') }}" alt="national emblem"
                        style="width: 40px; height: 40px; margin-top: 10px;">
                    <div style="font-weight: bold;">EMPLOYMENT REGISTRATION CARD</div>
                    <div style="margin-bottom: 10px;">LEDSE, Govt. of Mizoram</div>
                </td>
                <td style="width: 20%; text-align: right;">
                    <img src="storage/{{ $info->avatar }}" style="width: 70px; height: 70px;" alt="employee avatar">
                </td>
            </tr>
        </tbody>
    </table>

    <table>
        <tbody>
            <tr style="text-align:center;" class="both">
                <td style="padding: 5px 0; width: 30%; text-align: left">NCO : {{ $ncoCodeToDisplay }}</td>
                <td style="padding: 5px 0; width: 40%">Valid : {{ date('d M Y', strtotime($info->card_valid_from)) }} -
                    {{ date('d M Y', strtotime($info->card_valid_till)) }}</td>
                <td style="padding: 5px 0; width: 30%; text-align: right; color:#2d9735;">{{ $info->employment_no }}
                </td>
            </tr>
        </tbody>
    </table>

    <div class="bg" style="padding: 5px; margin-top: 10px;">
        Basic Information
    </div>

    <table>
        <thead>
            <tr>
                <td>Full Name</td>
                <th>{{ $info->full_name }}</th>
                <td>Date of Birth</td>
                <th>{{ date('d M Y', strtotime($info->dob)) }}</th>
            </tr>
            <tr>
                <td>Gender</td>
                <th>{{ $info->gender }}</th>
                <td>Phone</td>
                <th>{{ $info->phone_no }}</th>
            </tr>
            <tr>
                <td>Parent's Name</td>
                <th>{{ $info->parents_name }}</th>
                <td>Marital Status</td>
                <th>{{ $info->marital_status }}</th>
            </tr>
            <tr>
                <td>Religion</td>
                <th>{{ $info->religion->name }}</th>
                <td>Caste</td>
                <th>{{ $info->caste }}</th>
            </tr>
            <tr>
                <td>Aadhaar</td>
                <th>{{ $info->aadhar_no ?? '-' }}</th>
                <td>Language Spoken</td>
                <th>{{ $langSpoken }}</th>
            </tr>
            <tr>
                <td>Language Read</td>
                <th>{{ $langRead }}</th>
                <td>Language Write</td>
                <th>{{ $langWrite }}</th>
            </tr>
        </thead>
    </table>

    <div class="bg" style="padding: 5px; margin-top: 10px;">
        Physical Challenge
        @if (!$disable)
            <span style="margin-left: 20px; font-weight: bold;">No</span>
        @endif
    </div>
    @if ($disable)
        <div>
            {{ $disable }}
        </div>
    @endif

    <div style="margin-top: 10px;">
        <div style="float: left; width: 49%;">
            <div class="bg" style="padding: 5px;">Permanent Address</div>
            <table>
                <tbody>
                    <tr>
                        <td>Address</td>
                        <th>{{ $permanent->house_no }}, {{ $permanent->village }}, {{ $permanent->district->name }},
                            {{ $permanent->state->name }} - {{ $permanent->pin_code }}</th>
                    </tr>
                    <tr>
                        <td>RD Block</td>
                        <th>{{ $permanent->rdBlock->name }}</th>
                    </tr>
                    <tr>
                        <td>Post Office</td>
                        <th>{{ $permanent->postOffice->name }}</th>
                    </tr>
                    <tr>
                        <td>Police Station</td>
                        <th>{{ $permanent->policeStation->name }}</th>
                    </tr>
                </tbody>
            </table>
        </div>
        <div style="float: right; width: 49%;">
            <div class="bg" style="padding: 5px;">Present Address</div>
            <table>
                @if ($present !== null)
                    <tbody>
                        <tr>
                            <td>Address</td>
                            <th>{{ $present->house_no }}, {{ $present->village }}, {{ $present->district->name }},
                                {{ $present->state->name }} - {{ $present->pin_code }}</th>
                        </tr>
                        <tr>
                            <td>RD Block</td>
                            <th>{{ $present->rdBlock->name }}</th>
                        </tr>
                        <tr>
                            <td>Post Office</td>
                            <th>{{ $present->postOffice->name }}</th>
                        </tr>
                        <tr>
                            <td>Police Station</td>
                            <th>{{ $present->policeStation->name }}</th>
                        </tr>
                    </tbody>
                @else
                    <tbody>
                        <tr>
                            <td>Address</td>
                            <th>{{ $permanent->house_no }}, {{ $permanent->village }},
                                {{ $permanent->district->name }},
                                {{ $permanent->state->name }} - {{ $permanent->pin_code }}</th>
                        </tr>
                        <tr>
                            <td>RD Block</td>
                            <th>{{ $permanent->rdBlock->name }}</th>
                        </tr>
                        <tr>
                            <td>Post Office</td>
                            <th>{{ $permanent->postOffice->name }}</th>
                        </tr>
                        <tr>
                            <td>Police Station</td>
                            <th>{{ $permanent->policeStation->name }}</th>
                        </tr>
                    </tbody>
                @endif
            </table>
        </div>
    </div>

    <div>
        <div class="w-100 bg" style="margin-top: 160px; padding: 5px;">
            Educational Qualification
        </div>

        <table style="margin-top: 10px;">
            <thead>
                <tr class="thead">
                    <th>Qualification</th>
                    <th>Subject</th>
                    <th>Major/Core</th>
                    <th>Board/University</th>
                    <th>Year</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($educations as $edu)
                    <tr class="table">
                        <td>{{ $edu->qualification->name }}</td>
                        <td>{{ $edu->subject !== null ? $edu->subject->name : $edu->custom_subject ?? '-' }}</td>
                        <td> {{ $edu->majorCore !== null ? $edu->majorCore->name : $edu->custom_major_core ?? '-' }}
                        </td>
                        <td>{{ $edu->school }}</td>
                        <td>{{ $edu->year_of_passing }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="bg" style="padding: 5px; margin-top: 10px;">
            Experience
        </div>

        <table style="margin-top: 10px;">
            <thead>
                <tr class="thead">
                    <th>Designation</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Department/Company</th>
                    <th>Leave Reason</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($experiences as $exp)
                    <tr class="table">
                        <td>{{ $exp->designation }}</td>
                        <td>{{ date('d M Y', strtotime($exp->from)) }}</td>
                        <td>
                            @if ($exp->is_working == 1)
                                Present
                            @else
                                {{ date('d M Y', strtotime($exp->to)) }}
                            @endif
                        </td>
                        <td>{{ $exp->company }}</td>
                        <td>{{ $exp->leave_reason ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div style="padding: 5px; margin-top: 20px; float: right; text-align: center;">
            <img src="storage/{{ $signature->signature }}" style="width: 70px; height: 70px;" alt="signature"> <br>
            <span style="text-transform: uppercase;">({{ $signature->name }})</span> <br>
            Registering Authority <br>
            {{ $permanent->district->name }} District, {{ $permanent->state->name }}
        </div>
    </div>
</body>

</html>

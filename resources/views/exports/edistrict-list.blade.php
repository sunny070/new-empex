<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Lists</title>
</head>

<body>
    <table>
        <tr>
            <th colspan="9">
                LIST OF NON VALIDATED EMPLOYMENT UNDER EMPLOYMENT EXCHANGE, {{ $districtName }} DISTRICT
            </th>
        </tr>
        <tr>




            <td>SL.No.</td>
            <td>Name</td>
            <td>Address</td>
            <td>Father's Name</td>
            <td>DOB</td>
            <td>Reg.No.</td>
            <td>Ph.No.</td>



        </tr>
        @foreach ($reports as $index => $report)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $report?->full_name }}</td>
                <td>
                    {{ $report['permanent_address']['house_no'] . ',' ?? '' }}
                    {{ $report['permanent_address']['village'] . ',' ?? '' }}
                    {{ $report['permanent_address']['district']['name'] . ',' ?? '' }}
                    {{ $report['permanent_address']['state']['name'] ?? '' }}
                    - {{ $report['permanent_address']['pin_code'] ?? '' }}
                </td>
                <td>{{ $report->parents_name }}</td>
                <td>
                    {{ date('d/m/Y', strtotime($report->dob)) ?? '-' }}</td>
                <td>{{ $report?->employment_no }}</td>
                <td>{{ $report?->phone_no }}</td>
            </tr>
        @endforeach
    </table>
</body>

</html>

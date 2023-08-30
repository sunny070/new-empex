<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Report</title>
</head>

<body>
  <table>
    <tr>
      <th colspan="8">
        REPORT OF EMPLOYMENT STATISTICS OF {{ $districtName }} DISTRICT EMPLOYMENT EXCHANGE
      </th>
      <th colspan="7">
        @if ($duration != 'Custom')
        {{ $duration == 'Monthly' ? $monthName : (
        $duration == 'Quarterly' ? $quarter.' Quarter' : (
        $duration == 'Half-Yearly' ? $half.' Half' : (
        $duration == 'Yearly' ? 'Year': ''
        )
        )
        ) }}, {{ $year }}
        @else
        From: {{ date('d M Y', strtotime($from)) }} - {{ date('d M Y', strtotime($to)) }}
        @endif
      </th>
    </tr>
    <tr>
      <td rowspan="2">Sl. No</td>
      <td rowspan="2">Category</td>
      <td rowspan="2">Subject</td>
      <td colspan="2">
        {{
        $duration == 'Monthly'
        ? 'The Month'
        : ($duration == 'Quarterly'
        ? 'The Quarter'
        : ($duration == 'Half-Yearly'
        ? 'Half Year'
        : ($duration == 'Yearly'
        ? 'The Year'
        : ($duration == 'Custom'
        ? 'Custom'
        : ''
        )
        )
        )
        )
        }}
      </td>
      <td rowspan="2">Total</td>
      <td colspan="2">Lapsed</td>
      <td rowspan="2">Total</td>
      <td colspan="2">Placed</td>
      <td rowspan="2">Total</td>
      <td colspan="2">Live Register</td>
      <td rowspan="2">Total</td>
    </tr>
    <tr>
      <td>Male</td>
      <td>Female</td>
      <td>Male</td>
      <td>Female</td>
      <td>Male</td>
      <td>Female</td>
      <td>Male</td>
      <td>Female</td>
    </tr>
    @foreach ($reports as $index => $report)
    <tr>
      <td>{{ $index + 1 }}</td>
      @if ($index == 0)
      <td rowspan="{{ count($reports) }}">{{ $category }}</td>
      @endif
      <td>{{ $report['category'] }}</td>
      <td>{{ $report['maleReport'] }}</td>
      <td> {{ $report['femaleReport'] }}</td>
      <td>{{ $report['totalReport'] }}</td>
      <td>{{ $report['maleLapsed'] }}</td>
      <td> {{ $report['femaleLapsed'] }}</td>
      <td>{{ $report['totalLapsed'] }}</td>
      <td>{{ $report['malePlaced'] }}</td>
      <td> {{ $report['femalePlaced'] }}</td>
      <td>{{ $report['totalPlaced'] }}</td>
      <td>{{ $report['maleLiveRegister'] }}</td>
      <td> {{ $report['femaleLiveRegister'] }}</td>
      <td>{{ $report['totalLiveRegister'] }}</td>
    </tr>
    @endforeach
    <tr>
      <td></td>
      <td></td>
      <td>Grand Total</td>
      <td>{{ $maleReport }}</td>
      <td>{{ $femaleReport }}</td>
      <td>{{ $totalReport }}</td>
      <td>{{ $maleLapsed }}</td>
      <td>{{ $femaleLapsed }}</td>
      <td>{{ $totalLapsed }}</td>
      <td>{{ $malePlaced }}</td>
      <td>{{ $femalePlaced }}</td>
      <td>{{ $totalPlaced }}</td>
      <td>{{ $maleLiveRegister }}</td>
      <td>{{ $femaleLiveRegister }}</td>
      <td>{{ $totalLiveRegister }}</td>
    </tr>
  </table>
</body>

</html>

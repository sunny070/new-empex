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
    @foreach ($education as $quali)
    <tr>
      <td>{{ $loop->iteration }}</td>
      <td>{{ $quali['name'] }}</td>

      @if (count($quali['subject']) == 0)
      <td></td>
      <td>{{ $quali['reports']['maleReport']}}</td>
      <td>{{ $quali['reports']['femaleReport']}}</td>
      <td>{{ $quali['reports']['totalReport']}}</td>
      <td>{{ $quali['reports']['maleLapsed']}}</td>
      <td>{{ $quali['reports']['femaleLapsed']}}</td>
      <td>{{ $quali['reports']['totalLapsed']}}</td>
      <td>{{ $quali['reports']['malePlaced']}}</td>
      <td>{{ $quali['reports']['femalePlaced']}}</td>
      <td>{{ $quali['reports']['totalPlaced']}}</td>
      <td>{{ $quali['reports']['maleLiveRegister']}}</td>
      <td>{{ $quali['reports']['femaleLiveRegister']}}</td>
      <td>{{ $quali['reports']['totalLiveRegister']}}</td>
      @endif

      @foreach ($quali['subject'] as $subIndex => $subj)
      <table>
        @if ($subIndex == 0)
        <tr>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
        @endif

        <tr>
          <td>{{ $subj['name'] }}</td>
          <td>{{ $quali['reports'][$subIndex]['maleReport']}}</td>
          <td>{{ $quali['reports'][$subIndex]['femaleReport']}}</td>
          <td>{{ $quali['reports'][$subIndex]['totalReport']}}</td>
          <td>{{ $quali['reports'][$subIndex]['maleLapsed']}}</td>
          <td>{{ $quali['reports'][$subIndex]['femaleLapsed']}}</td>
          <td>{{ $quali['reports'][$subIndex]['totalLapsed']}}</td>
          <td>{{ $quali['reports'][$subIndex]['malePlaced']}}</td>
          <td>{{ $quali['reports'][$subIndex]['femalePlaced']}}</td>
          <td>{{ $quali['reports'][$subIndex]['totalPlaced']}}</td>
          <td>{{ $quali['reports'][$subIndex]['maleLiveRegister']}}</td>
          <td>{{ $quali['reports'][$subIndex]['femaleLiveRegister']}}</td>
          <td>{{ $quali['reports'][$subIndex]['totalLiveRegister']}}</td>
        </tr>
      </table>
      @endforeach
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
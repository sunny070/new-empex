<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Sponsorship List</title>
</head>

<body>
  <table>
    <thead>
      <tr>
        <td colspan="11">Eligible Candidate List</td>
      </tr>
      <tr>
        <td colspan="3">Name of the Employer</td>
        <td colspan="5">{{ $employer }}</td>
        <td colspan="3"><b>Date of Issue:</b> {{ $date }}</td>
      </tr>
      <tr>
        <td colspan="3">Address</td>
        <td colspan="8">{{ $address }}</td>
      </tr>
      <tr>
        <td colspan="3">Name of the Post</td>
        <td colspan="8">{{ $name }}</td>
      </tr>
      <tr>
        <td rowspan="2">S.No</td>
        <td rowspan="2">Name</td>
        <td rowspan="2">Father's Name</td>
        <td rowspan="2">Address</td>
        <td rowspan="2">Regd.No</td>
        <td colspan="3">Qualifications</td>
        <td rowspan="2">DOB</td>
        <td rowspan="2">Contact</td>
        <td rowspan="2">Time Sponsored</td>
      </tr>
      <tr>
        <td>Qualification</td>
        <td>Subject</td>
        <td>Major/Core</td>
      </tr>
    </thead>
    <tbody>
      @foreach($users as $user)
      <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $user['full_name'] }}</td>
        <td>{{ $user['parents_name'] }}</td>
        <td>
          {{ $user['permanent_address']['house_no'] ?? '' }}, {{ $user['permanent_address']['village'] ?? '' }}, {{
          $user['permanent_address']['district']['name'] ?? '' }}, {{ $user['permanent_address']['state']['name'] ?? '' }} - {{
          $user['permanent_address']['pin_code'] ?? '' }}
        </td>
        <td>{{ $user['employment_no'] }}</td>
        <td>
          @foreach ($user['education'] as $edu)
          {{ $edu['qualification']['name'] ?? '-' }}<br>
          @endforeach
        </td>
        <td>
          @foreach ($user['education'] as $edu)
          {{ $edu['subject']['name'] ?? '-' }}<br>
          @endforeach
        </td>
        <td>
          @foreach ($user['education'] as $edu)
          {{ $edu['major_core']['name'] ?? '-' }}<br>
          @endforeach
        </td>
        <td>{{ date('d/m/Y', strtotime($user['dob'])) }}</td>
        <td>{{ $user['phone_no'] }}</td>
        <td>{{ $user['sponsorship_count'] }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</body>

</html>

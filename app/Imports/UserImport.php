<?php

namespace App\Imports;

use App\Models\Address;
use App\Models\BasicInfo;
use App\Models\EducationQualification;
use App\Models\User;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Row;

class UserImport implements OnEachRow, WithHeadingRow, WithChunkReading
{

    public function onRow(Row $row)
    {
        $rowIndex = $row->getIndex();
        $row      = $row->toArray();

        $districtCode = 0;

        $gender = $row['gender'] == 'M' ? 'Male' : 'Female';
        $tribe = $row['tribe'] == 1 ? 'Mizo' : 'Non-Mizo';
        $caste = $row['caste'] == 'GEN' || $row['caste'] == 'GENER' ? 'General' : $row['caste'];
        // $gender = $row['gender'];
        // $tribe = $row['tribe'];

        switch ($row['district_code']) {
            case 1503:
                $districtCode = 1;
                break;
            case 1502:
                $districtCode = 2;
                break;
            case 1505:
                $districtCode = 7;
                break;
            case 1501:
                $districtCode = 5;
                break;
            case 1507:
                $districtCode = 3;
                break;
            case 1504:
                $districtCode = 8;
                break;
            case 1506:
                $districtCode = 4;
                break;
            case 1508:
                $districtCode = 6;
                break;
            default:
                $districtCode = $row['district_code'];
                break;
        }

        $user = User::firstOrCreate([
            'mobile_no' => $row['contact_no']
        ], [
            'name' => $row['applicant_name'],
            'mobile_no' => $row['contact_no'],
        ]);

        $info = BasicInfo::create([
            'user_id' => $user['id'],
            'full_name' => $row['applicant_name'],
            'dob' => date('Y-m-d', (strtotime($row['date_of_birth']))),
            'gender' => $gender,
            'phone_no' => $row['contact_no'],
            'parents_name' => $row['father_name'],
            'caste' => $caste,
            'status' => null,
            'card_valid_from' => date('Y-m-d', strtotime($row['validity_from'])),
            'card_valid_till' => date('Y-m-d', strtotime($row['validity_to'])),
            'society' => $tribe,
            'district_id' => $row['district_code'],
            'is_paid' => 1,
            'employment_no' => $row['registration_number'],
        ]);

        $address = Address::create([
            'user_id' => $user['id'],
            'state_id' => 1,
            'district_id' => $districtCode,
            'police_station_id' => $row['police_station_code'],
            'post_office_id' => $row['post_office_code'],
            'village' => $row['sub_locality'],
            'pin_code' => $row['pin_code'],
            'house_no' => $row['door_no'],
            'same_as_permanent' => 1,
            'type' => 'permanent',
        ]);
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}

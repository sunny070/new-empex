<?php

namespace App\Imports;

use App\Models\Archive;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Row;

class ArchiveImport implements OnEachRow, WithHeadingRow, WithChunkReading
{
    public function onRow(Row $row)
    {
        $row = $row->toArray();

        Archive::create([
            // 'avatar' => $row['avatar'],
            'dob' => $row['dob'],
            'name' => $row['name'],
            'gender' => $row['gender'],
            'phone_no' => $row['phone_no'],
            'parents_name' => $row['parents_name'],
            'religion' => $row['religion'],
            'caste' => $row['caste'],
            'marital_status' => $row['marital_status'],
            'society' => $row['society'],
            'aadhar_no' => $row['aadhar_no'],
            'employment_no' => $row['employment_no'],
            'card_valid_from' => $row['card_valid_from'],
            'card_valid_till' => $row['card_valid_till'],
            // 'ex_servicemen' => $row['ex_servicemen'],
            // 'physical_challenge' => $row['physical_challenge'],
            // 'languages' => $row['languages'],
            'address' => $row['address'],
            'education' => $row['education'],
            'experience' => $row['experience'],
        ]);
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}

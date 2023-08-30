<?php

namespace Database\Seeders;

use App\Models\Qualification;
use Illuminate\Database\Seeder;

class QualificationTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $qualifications = [
      [
        'name' => 'Unskill/Cl. I-V',
      ],
      [
        'name' => 'Cl. VI-IX',
      ],
      [
        'name' => 'HSLC',
      ],
      [
        'name' => 'HSSLC',
      ],
      [
        'name' => 'Graduate',
      ],
      [
        'name' => 'Post Graduate',
      ],
      [
        'name' => 'Diploma & Other Qualifications',
      ],
      [
        'name' => 'Hindi',
      ],
    ];

    Qualification::truncate();

    foreach ($qualifications as $qualification) {
      Qualification::create($qualification);
    }
  }
}

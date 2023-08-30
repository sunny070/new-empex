<?php

namespace Database\Seeders;

use App\Models\District;
use Illuminate\Database\Seeder;

class DistrictTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    District::truncate();
    $districts = [
      [
        'name' => 'Aizawl',
        'district_code' => '01',
        'state_id' => 1,
        'ncs_district_id' => '283',
      ],
      [
        'name' => 'Kolasib',
        'district_code' => '05',
        'state_id' => 1,
        'ncs_district_id' => '282',
      ],
      [
        'name' => 'Lawngtlai',
        'district_code' => '07',
        'state_id' => 1,
        'ncs_district_id' => '287',
      ],
      [
        'name' => 'Lunglei',
        'district_code' => '02',
        'state_id' => 1,
        'ncs_district_id' => '286',
      ],
      [
        'name' => 'Mamit',
        'district_code' => '08',
        'state_id' => 1,
        'ncs_district_id' => '281',
      ],
      [
        'name' => 'Siaha',
        'district_code' => '03',
        'state_id' => 1,
        'ncs_district_id' => '288',
      ],
      [
        'name' => 'Serchhip',
        'district_code' => '06',
        'state_id' => 1,
        'ncs_district_id' => '285',
      ],
      [
        'name' => 'Champhai',
        'district_code' => '04',
        'state_id' => 1,
        'ncs_district_id' => '284',
      ],
      [
        'name' => 'Hnahthial',
        'district_code' => '11',
        'state_id' => 1,
        'ncs_district_id' => null,
      ],
      [
        'name' => 'Khawzawl',
        'district_code' => '10',
        'state_id' => 1,
        'ncs_district_id' => null,
      ],
      [
        'name' => 'Saitual',
        'district_code' => '09',
        'state_id' => 1,
        'ncs_district_id' => null,
      ]
    ];
    foreach ($districts as $district) {
      District::create($district);
    }
  }
}

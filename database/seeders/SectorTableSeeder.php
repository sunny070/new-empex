<?php

namespace Database\Seeders;

use App\Models\Sector;
use Illuminate\Database\Seeder;

class SectorTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    Sector::truncate();
    $sectors = [
      ['name' => 'Water Supply'],
      ['name' => 'Waste Management'],
      ['name' => 'Transportation and Storage'],
      ['name' => 'Real Estate Activities'],
      ['name' => 'Public Administration and Devence'],
      ['name' => 'Specialized Professional Services'],
      ['name' => 'Other Service Activities'],
      ['name' => 'Mining And Quarrying'],
      ['name' => 'Manufacturing'],
      ['name' => 'IT and Communication'],
      ['name' => 'Health'],
      ['name' => 'Finance and Insurance'],
      ['name' => 'Power and Energy'],
      ['name' => 'Education'],
      ['name' => 'Civil and Construction Works'],
      ['name' => 'Ats and Entertainment'],
      ['name' => 'Agriculture and Related'],
      ['name' => 'Operations and Support'],
      ['name' => 'Household and Domestic Work'],
      ['name' => 'International Organizations'],
      ['name' => 'Hotels'],
      ['name' => 'Food Service and Catering'],
    ];
    foreach ($sectors as $sector) {
      Sector::create($sector);
    }
  }
}

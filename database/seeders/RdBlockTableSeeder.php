<?php

namespace Database\Seeders;

use App\Models\RdBlock;
use Illuminate\Database\Seeder;

class RdBlockTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    RdBlock::truncate();

    $blocks = [
      ['name' => 'Tlangnuam RD Block'],
      ['name' => 'Darlawn RD Block'],
      ['name' => 'Phullen RD Block'],
      ['name' => 'Aibawk RD Block'],
      ['name' => 'Thingsulthliah RD Block'],
      ['name' => 'Lunglei RD Block'],
      ['name' => 'Lungsen RD Block'],
      ['name' => 'Hnahthial RD Block'],
      ['name' => 'Bunghmun RD Block'],
      ['name' => 'Saiha RD Block'],
      ['name' => 'Tuipang RD Block'],
      ['name' => 'Thingdawl RD Block'],
      ['name' => 'Bilkhawthlir RD Block'],
      ['name' => 'Zawlnuam RD Block'],
      ['name' => 'West.Phaileng RD Block'],
      ['name' => 'Reiek RD Block'],
      ['name' => 'Champhai RD Block'],
      ['name' => 'Khawzawl RD Block'],
      ['name' => 'Ngopa RD Block'],
      ['name' => 'Khawbung RD Block'],
      ['name' => 'Serchhip RD Block'],
      ['name' => 'E.Lungdar RD Block'],
      ['name' => 'Lawngtlai RD Block'],
      ['name' => 'Bungtlang \'South\' RD Block'],
      ['name' => 'Chawngte RD Block'],
      ['name' => 'Sangau RD Block'],
    ];

    foreach ($blocks as $block) {
      RdBlock::create($block);
    }
  }
}

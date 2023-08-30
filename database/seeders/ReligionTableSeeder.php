<?php

namespace Database\Seeders;

use App\Models\Religion;
use Illuminate\Database\Seeder;

class ReligionTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    Religion::truncate();

    $religions = [
      ['name' => 'Buddhism'],
      ['name' => 'Christianity'],
      ['name' => 'Hinduism'],
      ['name' => 'Islam'],
      ['name' => 'Jainism'],
      ['name' => 'Sikhism'],
      ['name' => 'Others'],

    ];

    foreach ($religions as $religion) {
      Religion::create($religion);
    }
  }
}

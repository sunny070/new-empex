<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Seeder;

class TypeTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    Type::truncate();
    $types = [
      [
        'category_id' => 1,
        'name' => 'Company'
      ],
      [
        'category_id' => 1,
        'name' => 'Society (NGO)'
      ],
      [
        'category_id' => 1,
        'name' => 'Partnership'
      ],
      [
        'category_id' => 1,
        'name' => 'Proprietorship'
      ],
      [
        'category_id' => 1,
        'name' => 'Others'
      ],
      [
        'category_id' => 2,
        'name' => 'Central PSU'
      ],
      [
        'category_id' => 2,
        'name' => 'State PSU'
      ],
      [
        'category_id' => 2,
        'name' => 'Local Bodies'
      ],
      [
        'category_id' => 2,
        'name' => 'Society(Government)'
      ],
      [
        'category_id' => 3,
        'name' => 'Central Govt.'
      ],
      [
        'category_id' => 3,
        'name' => 'State Govt.'
      ],
      [
        'category_id' => 3,
        'name' => 'Autonomous'
      ],
    ];

    foreach ($types as $type) {
      Type::create($type);
    }
  }
}

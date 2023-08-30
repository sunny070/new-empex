<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Seeder;

class StateTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    State::truncate();
    $states = [
      [
        'name' => 'Mizoram',
        'ncs_state_id' => '15',
      ],
    ];

    foreach ($states as $state) {
      State::create($state);
    }
  }
}

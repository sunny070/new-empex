<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguageTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    Language::truncate();
    $languages = [
      ['name' => 'English'],
      ['name' => 'Hindi'],
      ['name' => 'Mizo'],
    ];
    foreach ($languages as $language) {
      Language::create($language);
    }
  }
}

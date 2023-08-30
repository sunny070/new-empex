<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $categories = [
      ['name' => 'Private Sector'],
      ['name' => 'Public Sector'],
      ['name' => 'Govt. Department'],
    ];
    Category::truncate();
    foreach ($categories as $category) {
      Category::create($category);
    }
  }
}

<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {

    Role::truncate();
    $roles = [
      'Superadmin',
      'Verifier',
      'Approver',
      'Department',
      'Admin'
    ];
    foreach ($roles as $role) {
      Role::create([
        'name' => $role,
      ]);
    }
  }
}

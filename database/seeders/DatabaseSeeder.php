<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
     $this->call(AdminTableSeeder::class);
     $this->call(DepartmentTableSeeder::class);
     $this->call(DistrictTableSeeder::class);
     $this->call(LanguageTableSeeder::class);
     $this->call(MajorCoreTableSeeder::class);
     $this->call(QualificationTableSeeder::class);
     $this->call(RoleTableSeeder::class);
     $this->call(StateTableSeeder::class);
     $this->call(SubjectTableSeeder::class);
     $this->call(ReligionTableSeeder::class);
     $this->call(PhysicalChallengesTableSeeder::class);
     $this->call(RdBlockTableSeeder::class);
     $this->call(PoliceStationTableSeeder::class);
     $this->call(PostOfficeTableSeeder::class);
     $this->call(CategoryTableSeeder::class);
     $this->call(SectorTableSeeder::class);
     $this->call(TypeTableSeeder::class);
     $this->call(DepartmentEmployerSeeder::class);
     $this->call(NcoDivisionsTableSeeder::class);
     $this->call(NcoSubDivisionsTableSeeder::class);
     $this->call(NcoGroupsTableSeeder::class);
     $this->call(NcoFamiliesTableSeeder::class);
     $this->call(NcoDetailsTableSeeder::class);
    //  $this->call(UsersTableSeeder::class);

  }
}

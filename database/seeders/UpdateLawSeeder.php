<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class UpdateLawSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $law = Admin::query()->firstWhere('email','law@empex.com');
        $law->password = 'empex@2022';
        $law->save();
    }
}

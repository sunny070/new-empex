<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UpdateAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rsb = Admin::query()->firstWhere('email','rsb_mzr@yahoo.in');
        // $rsb->password = Hash::make('chawisanga@02');
        $rsb->password = 'chawisanga@02';
        $rsb->save();
    }
}

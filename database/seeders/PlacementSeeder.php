<?php

namespace Database\Seeders;

use App\Models\Placement;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlacementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        Placement::truncate();
        Placement::query()->upsert([[
            'user_id' => 2,
            'employment_no' => 'W/2/11',
            'recruiter_name' => 'Intel Inc',
            'designation' => 'Consultant',
            'type' => 'Regular',
            'district_id' => 1,
            'address' =>'Tuikual North',
            'recruit_date' => today(),
        ], [
            'user_id' => 2,
            'recruiter_name' => 'LESDE',
            'employment_no' => 'W/2/20',
            'designation' => 'Director',
            'type' => 'Temporary',
            'district_id' => 3,
            'address' =>'Armed Veng',
            'recruit_date' => today()->subDay(),
        ]], 'user_id');
    }
}

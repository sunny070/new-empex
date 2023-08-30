<?php

namespace Database\Seeders;

use App\Models\BasicInfo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class ExpireEmpCardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = BasicInfo::query()->whereDate('card_valid_till', '>',now()->addMonths(3))->get();

        Log::info('expiry date: '.$data);
    }
}

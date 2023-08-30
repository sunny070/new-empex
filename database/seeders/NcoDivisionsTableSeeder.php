<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NcoDivisionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('nco_divisions')->delete();

        DB::table('nco_divisions')->insert(array(
            0 =>
            array(
                'code' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 1,
                'name' => 'Managers',
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            1 =>
            array(
                'code' => '2',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 2,
                'name' => 'Professionals',
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            2 =>
            array(
                'code' => '3',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 3,
                'name' => 'Technicians and Associate Professionals',
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            3 =>
            array(
                'code' => '4',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 4,
                'name' => 'Clerks/Clerical Support Workers',
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            4 =>
            array(
                'code' => '5',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 5,
                'name' => 'Service and Sales Workers',
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            5 =>
            array(
                'code' => '6',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 6,
                'name' => 'Skilled Agricultural, Forestry and Fishery Workers',
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            6 =>
            array(
                'code' => '7',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 7,
                'name' => 'Craft and Related Trades Workers',
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            7 =>
            array(
                'code' => '8',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 8,
                'name' => 'Plant and Machine Operators, and Assemblers',
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            8 =>
            array(
                'code' => '9',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 9,
                'name' => 'Elementary Occupations',
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            9 =>
            array(
                'code' => '10',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 10,
                'name' => 'Workers not Classified by Occupations',
                'updated_at' => date('Y-m-d H:i:s'),
            ),
        ));
    }
}

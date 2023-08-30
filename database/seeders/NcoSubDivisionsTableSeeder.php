<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NcoSubDivisionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('nco_sub_divisions')->delete();

        DB::table('nco_sub_divisions')->insert(array(
            0 =>
            array(
                'code' => '11',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 1,
                'name' => 'Chief Executives, Senior Officials and Legislators',
                'nco_division_id' => 1,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            1 =>
            array(
                'code' => '12',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 2,
                'name' => 'Administrative and Commercial Managers',
                'nco_division_id' => 1,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            2 =>
            array(
                'code' => '13',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 3,
                'name' => 'Production and Specialized Services Managers',
                'nco_division_id' => 1,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            3 =>
            array(
                'code' => '14',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 4,
                'name' => 'Hospitality, Retail and Other Services Managers',
                'nco_division_id' => 1,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            4 =>
            array(
                'code' => '21',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 5,
                'name' => 'Science and Engineering Professionals',
                'nco_division_id' => 2,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            5 =>
            array(
                'code' => '22',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 6,
                'name' => 'Health Professionals',
                'nco_division_id' => 2,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            6 =>
            array(
                'code' => '23',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 7,
                'name' => 'Teaching Professionals',
                'nco_division_id' => 2,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            7 =>
            array(
                'code' => '24',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 8,
                'name' => 'Business and Administrative Professionals',
                'nco_division_id' => 2,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            8 =>
            array(
                'code' => '25',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 9,
                'name' => 'Information and Communication Technology Professionals',
                'nco_division_id' => 2,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            9 =>
            array(
                'code' => '26',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 10,
                'name' => 'Legal, Social and Cultural Professionals',
                'nco_division_id' => 2,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            10 =>
            array(
                'code' => '31',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 11,
                'name' => 'Science and Engineering Associate Professionals',
                'nco_division_id' => 3,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            11 =>
            array(
                'code' => '32',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 12,
                'name' => 'Health Associate Professionals',
                'nco_division_id' => 3,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            12 =>
            array(
                'code' => '33',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 13,
                'name' => 'Business and Administration Associate Professionals',
                'nco_division_id' => 3,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            13 =>
            array(
                'code' => '34',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 14,
                'name' => 'Legal, Social, Cultural and Related Associate Professionals',
                'nco_division_id' => 3,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            14 =>
            array(
                'code' => '35',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 15,
                'name' => 'Information and Communications Technicians',
                'nco_division_id' => 3,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            15 =>
            array(
                'code' => '41',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 16,
                'name' => 'General and Keyboard Clerks',
                'nco_division_id' => 4,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            16 =>
            array(
                'code' => '42',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 17,
                'name' => 'Customer Services Clerks',
                'nco_division_id' => 4,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            17 =>
            array(
                'code' => '43',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 18,
                'name' => 'Numerical and Material Recording Clerks',
                'nco_division_id' => 4,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            18 =>
            array(
                'code' => '44',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 19,
                'name' => 'Other Clerical Support Workers',
                'nco_division_id' => 4,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            19 =>
            array(
                'code' => '51',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 20,
                'name' => 'Personal Service Workers',
                'nco_division_id' => 5,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            20 =>
            array(
                'code' => '52',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 21,
                'name' => 'Sales Workers',
                'nco_division_id' => 5,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            21 =>
            array(
                'code' => '53',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 22,
                'name' => 'Personal Care Workers',
                'nco_division_id' => 5,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            22 =>
            array(
                'code' => '54',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 23,
                'name' => 'Protective Service Workers',
                'nco_division_id' => 5,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            23 =>
            array(
                'code' => '61',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 24,
                'name' => 'Market-Oriented Skilled Agricultural Workers',
                'nco_division_id' => 6,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            24 =>
            array(
                'code' => '62',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 25,
                'name' => 'Market-Oriented Skilled Forestry, Fishery and Hunting Workers',
                'nco_division_id' => 6,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            25 =>
            array(
                'code' => '63',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 26,
                'name' => 'Subsistence Farmers, Fishers, Hunters and Gatherers',
                'nco_division_id' => 6,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            26 =>
            array(
                'code' => '71',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 27,
                'name' => 'Building and Related Trade Workers (Excluding Electricians)',
                'nco_division_id' => 7,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            27 =>
            array(
                'code' => '72',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 28,
                'name' => 'Metal, Machinery and Related Trades Workers',
                'nco_division_id' => 7,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            28 =>
            array(
                'code' => '73',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 29,
                'name' => 'Handicraft and Printing Workers',
                'nco_division_id' => 7,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            29 =>
            array(
                'code' => '74',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 30,
                'name' => 'Electrical and Electronics Trades Workers',
                'nco_division_id' => 7,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            30 =>
            array(
                'code' => '75',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 31,
                'name' => 'Food Processing, Woodworking, Garment and Other Craft and Related Trades Workers',
                'nco_division_id' => 7,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            31 =>
            array(
                'code' => '81',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 32,
                'name' => 'Stationary Plant and Machine Operators',
                'nco_division_id' => 8,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            32 =>
            array(
                'code' => '82',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 33,
                'name' => 'Assemblers',
                'nco_division_id' => 8,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            33 =>
            array(
                'code' => '83',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 34,
                'name' => 'Drivers and Mobile Plant Operators',
                'nco_division_id' => 8,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            34 =>
            array(
                'code' => '91',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 35,
                'name' => 'Cleaners and Helpers',
                'nco_division_id' => 9,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            35 =>
            array(
                'code' => '92',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 36,
                'name' => 'Agricultural, Forestry and Fishery Labourers',
                'nco_division_id' => 9,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            36 =>
            array(
                'code' => '93',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 37,
                'name' => 'Labourers in Mining, Construction, Manufacturing and Transport',
                'nco_division_id' => 9,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            37 =>
            array(
                'code' => '94',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 38,
                'name' => 'Food Preparation Assistants',
                'nco_division_id' => 9,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            38 =>
            array(
                'code' => '95',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 39,
                'name' => 'Street and Related Sales and Services Workers',
                'nco_division_id' => 9,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            39 =>
            array(
                'code' => '96',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 40,
                'name' => 'Refuse Workers and Other Elementary Workers',
                'nco_division_id' => 9,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
        ));
    }
}

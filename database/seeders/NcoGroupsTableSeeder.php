<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NcoGroupsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('nco_groups')->delete();

        DB::table('nco_groups')->insert(array(
            0 =>
            array(
                'code' => '111',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 1,
                'name' => 'Legislators and Senior Officials',
                'nco_division_id' => 1,
                'nco_sub_division_id' => 1,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            1 =>
            array(
                'code' => '112',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 2,
                'name' => 'Managing Directors and Chief Executives',
                'nco_division_id' => 1,
                'nco_sub_division_id' => 1,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            2 =>
            array(
                'code' => '112',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 3,
                'name' => 'Business Services and Administration Managers',
                'nco_division_id' => 1,
                'nco_sub_division_id' => 2,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            3 =>
            array(
                'code' => '113',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 4,
                'name' => 'Sales, Marketing and Development Managers',
                'nco_division_id' => 1,
                'nco_sub_division_id' => 2,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            4 =>
            array(
                'code' => '113',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 5,
                'name' => 'Production Managers in Agriculture, Forestry and Fisheries',
                'nco_division_id' => 1,
                'nco_sub_division_id' => 3,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            5 =>
            array(
                'code' => '114',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 6,
                'name' => 'Information and Communications Technology Services Manager',
                'nco_division_id' => 1,
                'nco_sub_division_id' => 3,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            6 =>
            array(
                'code' => '115',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 7,
                'name' => 'Professional Services Managers',
                'nco_division_id' => 1,
                'nco_sub_division_id' => 3,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            7 =>
            array(
                'code' => '115',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 8,
                'name' => 'Hotel and Restaurant Managers',
                'nco_division_id' => 1,
                'nco_sub_division_id' => 4,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            8 =>
            array(
                'code' => '116',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 9,
                'name' => 'Retail and Wholesale Trade Managers',
                'nco_division_id' => 1,
                'nco_sub_division_id' => 4,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            9 =>
            array(
                'code' => '117',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 10,
                'name' => 'Other Services Managers',
                'nco_division_id' => 1,
                'nco_sub_division_id' => 4,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            10 =>
            array(
                'code' => '117',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 11,
                'name' => 'Physical and Earth Science Professionals',
                'nco_division_id' => 2,
                'nco_sub_division_id' => 5,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            11 =>
            array(
                'code' => '118',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 12,
                'name' => 'Mathematicians, Actuaries and Statisticians',
                'nco_division_id' => 2,
                'nco_sub_division_id' => 5,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            12 =>
            array(
                'code' => '119',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 13,
                'name' => 'Life Sciences Professionals',
                'nco_division_id' => 2,
                'nco_sub_division_id' => 5,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            13 =>
            array(
                'code' => '120',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 14,
                'name' => 'Engineering Professionals (Excluding Electrotechnology)',
                'nco_division_id' => 2,
                'nco_sub_division_id' => 5,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            14 =>
            array(
                'code' => '121',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 15,
                'name' => 'Electrotechnology Engineers',
                'nco_division_id' => 2,
                'nco_sub_division_id' => 5,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            15 =>
            array(
                'code' => '122',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 16,
                'name' => 'Architects, Planners, Surveyors and Designers',
                'nco_division_id' => 2,
                'nco_sub_division_id' => 5,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            16 =>
            array(
                'code' => '122',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 17,
                'name' => 'Medical Doctors',
                'nco_division_id' => 2,
                'nco_sub_division_id' => 6,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            17 =>
            array(
                'code' => '123',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 18,
                'name' => 'Nursing and Midwifery Professionals',
                'nco_division_id' => 2,
                'nco_sub_division_id' => 6,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            18 =>
            array(
                'code' => '124',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 19,
                'name' => 'Traditional and Complementary Medicine Professionals',
                'nco_division_id' => 2,
                'nco_sub_division_id' => 6,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            19 =>
            array(
                'code' => '125',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 20,
                'name' => 'Paramedical Practitioners',
                'nco_division_id' => 2,
                'nco_sub_division_id' => 6,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            20 =>
            array(
                'code' => '126',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 21,
                'name' => 'Veterinarians',
                'nco_division_id' => 2,
                'nco_sub_division_id' => 6,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            21 =>
            array(
                'code' => '127',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 22,
                'name' => 'Other Health Professionals',
                'nco_division_id' => 2,
                'nco_sub_division_id' => 6,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            22 =>
            array(
                'code' => '127',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 23,
                'name' => 'University and Higher Education Teachers',
                'nco_division_id' => 2,
                'nco_sub_division_id' => 7,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            23 =>
            array(
                'code' => '128',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 24,
                'name' => 'Vocational Education Teachers',
                'nco_division_id' => 2,
                'nco_sub_division_id' => 7,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            24 =>
            array(
                'code' => '129',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 25,
                'name' => 'Secondary Education Teachers',
                'nco_division_id' => 2,
                'nco_sub_division_id' => 7,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            25 =>
            array(
                'code' => '130',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 26,
                'name' => 'Primary School and Early Childhood Teachers',
                'nco_division_id' => 2,
                'nco_sub_division_id' => 7,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            26 =>
            array(
                'code' => '131',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 27,
                'name' => 'Other Teaching Professionals',
                'nco_division_id' => 2,
                'nco_sub_division_id' => 7,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            27 =>
            array(
                'code' => '131',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 28,
                'name' => 'Finance Professionals',
                'nco_division_id' => 2,
                'nco_sub_division_id' => 8,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            28 =>
            array(
                'code' => '132',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 29,
                'name' => 'Administration Professionals',
                'nco_division_id' => 2,
                'nco_sub_division_id' => 8,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            29 =>
            array(
                'code' => '133',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 30,
                'name' => 'Sales, Marketing and Public Relations Professionals',
                'nco_division_id' => 2,
                'nco_sub_division_id' => 8,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            30 =>
            array(
                'code' => '133',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 31,
                'name' => 'Software and Application Developers, and Analysts',
                'nco_division_id' => 2,
                'nco_sub_division_id' => 9,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            31 =>
            array(
                'code' => '134',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 32,
                'name' => 'Database and Network Professionals',
                'nco_division_id' => 2,
                'nco_sub_division_id' => 9,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            32 =>
            array(
                'code' => '134',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 33,
                'name' => 'Legal Professionals',
                'nco_division_id' => 2,
                'nco_sub_division_id' => 10,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            33 =>
            array(
                'code' => '135',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 34,
                'name' => 'Librarians, Archivists and Curators',
                'nco_division_id' => 2,
                'nco_sub_division_id' => 10,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            34 =>
            array(
                'code' => '136',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 35,
                'name' => 'Social and Religious Professionals',
                'nco_division_id' => 2,
                'nco_sub_division_id' => 10,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            35 =>
            array(
                'code' => '137',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 36,
                'name' => 'Authors, Journalists and Linguists',
                'nco_division_id' => 2,
                'nco_sub_division_id' => 10,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            36 =>
            array(
                'code' => '138',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 37,
                'name' => 'Creative and Performing Artists',
                'nco_division_id' => 2,
                'nco_sub_division_id' => 10,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            37 =>
            array(
                'code' => '138',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 38,
                'name' => 'Physical and Engineering Science Technicians',
                'nco_division_id' => 3,
                'nco_sub_division_id' => 11,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            38 =>
            array(
                'code' => '139',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 39,
                'name' => 'Mining, Manufacturing and Construction Supervisors',
                'nco_division_id' => 3,
                'nco_sub_division_id' => 11,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            39 =>
            array(
                'code' => '140',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 40,
                'name' => 'Process Control Technicians',
                'nco_division_id' => 3,
                'nco_sub_division_id' => 11,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            40 =>
            array(
                'code' => '141',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 41,
                'name' => 'Life Science Technicians and Related Associate Professionals',
                'nco_division_id' => 3,
                'nco_sub_division_id' => 11,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            41 =>
            array(
                'code' => '142',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 42,
                'name' => 'Ship and Aircraft Controllers, and Technicians',
                'nco_division_id' => 3,
                'nco_sub_division_id' => 11,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            42 =>
            array(
                'code' => '142',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 43,
                'name' => 'Medical and Pharmaceutical Technicians',
                'nco_division_id' => 3,
                'nco_sub_division_id' => 12,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            43 =>
            array(
                'code' => '143',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 44,
                'name' => 'Nursing and Midwifery Associate Professionals',
                'nco_division_id' => 3,
                'nco_sub_division_id' => 12,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            44 =>
            array(
                'code' => '144',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 45,
                'name' => 'Traditional and Complementary Medicine Associate Professionals',
                'nco_division_id' => 3,
                'nco_sub_division_id' => 12,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            45 =>
            array(
                'code' => '145',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 46,
                'name' => 'Veterinary Technicians and Assistants',
                'nco_division_id' => 3,
                'nco_sub_division_id' => 12,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            46 =>
            array(
                'code' => '146',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 47,
                'name' => 'Other Health Associate Professionals',
                'nco_division_id' => 3,
                'nco_sub_division_id' => 12,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            47 =>
            array(
                'code' => '146',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 48,
                'name' => 'Financial and Mathematical Associate Professionals',
                'nco_division_id' => 3,
                'nco_sub_division_id' => 13,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            48 =>
            array(
                'code' => '147',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 49,
                'name' => 'Sales and Purchasing Agents and Brokers',
                'nco_division_id' => 3,
                'nco_sub_division_id' => 13,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            49 =>
            array(
                'code' => '148',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 50,
                'name' => 'Business Service Agents',
                'nco_division_id' => 3,
                'nco_sub_division_id' => 13,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            50 =>
            array(
                'code' => '149',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 51,
                'name' => 'Administrative and Specialized Secretaries',
                'nco_division_id' => 3,
                'nco_sub_division_id' => 13,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            51 =>
            array(
                'code' => '150',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 52,
                'name' => 'Government Regulatory Associate Professionals',
                'nco_division_id' => 3,
                'nco_sub_division_id' => 13,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            52 =>
            array(
                'code' => '150',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 53,
                'name' => 'Legal, Social and Religious Associate Professionals',
                'nco_division_id' => 3,
                'nco_sub_division_id' => 14,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            53 =>
            array(
                'code' => '151',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 54,
                'name' => 'Sports and Fitness Workers',
                'nco_division_id' => 3,
                'nco_sub_division_id' => 14,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            54 =>
            array(
                'code' => '152',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 55,
                'name' => 'Administrative Associate Professionals',
                'nco_division_id' => 3,
                'nco_sub_division_id' => 14,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            55 =>
            array(
                'code' => '152',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 56,
                'name' => 'Information and Communication Technology Operations and User Support Technicians',
                'nco_division_id' => 3,
                'nco_sub_division_id' => 15,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            56 =>
            array(
                'code' => '153',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 57,
                'name' => 'Telecommunication and Broadcasting Technicians',
                'nco_division_id' => 3,
                'nco_sub_division_id' => 15,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            57 =>
            array(
                'code' => '153',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 58,
                'name' => 'General Office Clerks',
                'nco_division_id' => 4,
                'nco_sub_division_id' => 16,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            58 =>
            array(
                'code' => '154',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 59,
                'name' => 'Secretaries (General)',
                'nco_division_id' => 4,
                'nco_sub_division_id' => 16,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            59 =>
            array(
                'code' => '155',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 60,
                'name' => 'Keyboard Operators',
                'nco_division_id' => 4,
                'nco_sub_division_id' => 16,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            60 =>
            array(
                'code' => '155',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 61,
                'name' => 'Tellers, Money Collectors and Related Clerks',
                'nco_division_id' => 4,
                'nco_sub_division_id' => 17,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            61 =>
            array(
                'code' => '156',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 62,
                'name' => 'Client Information Workers',
                'nco_division_id' => 4,
                'nco_sub_division_id' => 17,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            62 =>
            array(
                'code' => '156',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 63,
                'name' => 'Numerical Clerks',
                'nco_division_id' => 4,
                'nco_sub_division_id' => 18,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            63 =>
            array(
                'code' => '157',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 64,
                'name' => 'Material Recording and Transport Clerks',
                'nco_division_id' => 4,
                'nco_sub_division_id' => 18,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            64 =>
            array(
                'code' => '157',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 65,
                'name' => 'Other Clerical Support Workers',
                'nco_division_id' => 4,
                'nco_sub_division_id' => 19,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            65 =>
            array(
                'code' => '157',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 66,
                'name' => 'Travel Attendants, Conductors and Guides',
                'nco_division_id' => 5,
                'nco_sub_division_id' => 20,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            66 =>
            array(
                'code' => '158',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 67,
                'name' => 'Cooks',
                'nco_division_id' => 5,
                'nco_sub_division_id' => 20,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            67 =>
            array(
                'code' => '159',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 68,
                'name' => 'Waiters and Bartenders',
                'nco_division_id' => 5,
                'nco_sub_division_id' => 20,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            68 =>
            array(
                'code' => '160',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 69,
                'name' => 'Hairdressers, Beauticians and Related Workers',
                'nco_division_id' => 5,
                'nco_sub_division_id' => 20,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            69 =>
            array(
                'code' => '161',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 70,
                'name' => 'Building and Housekeeping Supervisors',
                'nco_division_id' => 5,
                'nco_sub_division_id' => 20,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            70 =>
            array(
                'code' => '162',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 71,
                'name' => 'Other Personal Services Workers',
                'nco_division_id' => 5,
                'nco_sub_division_id' => 20,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            71 =>
            array(
                'code' => '162',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 72,
                'name' => 'Street and Market Salespersons',
                'nco_division_id' => 5,
                'nco_sub_division_id' => 21,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            72 =>
            array(
                'code' => '163',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 73,
                'name' => 'Shop Salespersons',
                'nco_division_id' => 5,
                'nco_sub_division_id' => 21,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            73 =>
            array(
                'code' => '164',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 74,
                'name' => 'Cashiers and Ticket Clerks',
                'nco_division_id' => 5,
                'nco_sub_division_id' => 21,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            74 =>
            array(
                'code' => '165',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 75,
                'name' => 'Other Sales Workers',
                'nco_division_id' => 5,
                'nco_sub_division_id' => 21,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            75 =>
            array(
                'code' => '165',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 76,
                'name' => 'Child Care Workers and Teachers\' Aides',
                'nco_division_id' => 5,
                'nco_sub_division_id' => 22,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            76 =>
            array(
                'code' => '166',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 77,
                'name' => 'Personal Care Workers in Health Services',
                'nco_division_id' => 5,
                'nco_sub_division_id' => 22,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            77 =>
            array(
                'code' => '166',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 78,
                'name' => 'Protective Service Workers',
                'nco_division_id' => 5,
                'nco_sub_division_id' => 23,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            78 =>
            array(
                'code' => '166',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 79,
                'name' => 'Market Gardeners & Crop Growers',
                'nco_division_id' => 6,
                'nco_sub_division_id' => 24,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            79 =>
            array(
                'code' => '167',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 80,
                'name' => 'Animal Producers',
                'nco_division_id' => 6,
                'nco_sub_division_id' => 24,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            80 =>
            array(
                'code' => '168',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 81,
                'name' => 'Mixed Crop and Animal Workers',
                'nco_division_id' => 6,
                'nco_sub_division_id' => 24,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            81 =>
            array(
                'code' => '168',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 82,
                'name' => 'Forestry and Related Workers',
                'nco_division_id' => 6,
                'nco_sub_division_id' => 25,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            82 =>
            array(
                'code' => '169',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 83,
                'name' => 'Fishery Workers, Hunters and Trappers',
                'nco_division_id' => 6,
                'nco_sub_division_id' => 25,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            83 =>
            array(
                'code' => '169',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 84,
                'name' => 'Subsistence Crop Farmers',
                'nco_division_id' => 6,
                'nco_sub_division_id' => 26,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            84 =>
            array(
                'code' => '170',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 85,
                'name' => 'Subsistence Livestock Farmers',
                'nco_division_id' => 6,
                'nco_sub_division_id' => 26,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            85 =>
            array(
                'code' => '171',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 86,
                'name' => 'Subsistence Mixed Crop and Livestock Farmers',
                'nco_division_id' => 6,
                'nco_sub_division_id' => 26,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            86 =>
            array(
                'code' => '171',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 87,
                'name' => 'Building Frames and Related Trades Workers',
                'nco_division_id' => 7,
                'nco_sub_division_id' => 27,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            87 =>
            array(
                'code' => '172',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 88,
                'name' => 'Building Finishers and Related Trades Workers',
                'nco_division_id' => 7,
                'nco_sub_division_id' => 27,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            88 =>
            array(
                'code' => '173',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 89,
                'name' => 'Painters, Builders, Structure Cleaners and Related Trades Workers',
                'nco_division_id' => 7,
                'nco_sub_division_id' => 27,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            89 =>
            array(
                'code' => '173',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 90,
                'name' => 'Sheet and Structural Metal Workers, Moulders and Welders, and Related Workers',
                'nco_division_id' => 7,
                'nco_sub_division_id' => 28,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            90 =>
            array(
                'code' => '174',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 91,
                'name' => 'Blacksmiths, Tool Makers and Related Trades Workers',
                'nco_division_id' => 7,
                'nco_sub_division_id' => 28,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            91 =>
            array(
                'code' => '175',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 92,
                'name' => 'Machinery Mechanics and Repairers',
                'nco_division_id' => 7,
                'nco_sub_division_id' => 28,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            92 =>
            array(
                'code' => '175',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 93,
                'name' => 'Handicraft Workers',
                'nco_division_id' => 7,
                'nco_sub_division_id' => 29,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            93 =>
            array(
                'code' => '176',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 94,
                'name' => 'Printing Trades Workers',
                'nco_division_id' => 7,
                'nco_sub_division_id' => 29,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            94 =>
            array(
                'code' => '176',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 95,
                'name' => 'Electrical Equipment Installers and Repairers',
                'nco_division_id' => 7,
                'nco_sub_division_id' => 30,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            95 =>
            array(
                'code' => '177',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 96,
                'name' => 'Electronics and Telecommunication Installers and Repairers',
                'nco_division_id' => 7,
                'nco_sub_division_id' => 30,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            96 =>
            array(
                'code' => '177',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 97,
                'name' => 'Food Processing and Related Trade Workers',
                'nco_division_id' => 7,
                'nco_sub_division_id' => 31,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            97 =>
            array(
                'code' => '178',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 98,
                'name' => 'Wood Treaters, Cabinet Makers and Related Trades Workers',
                'nco_division_id' => 7,
                'nco_sub_division_id' => 31,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            98 =>
            array(
                'code' => '179',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 99,
                'name' => 'Garment and Related Trades Workers',
                'nco_division_id' => 7,
                'nco_sub_division_id' => 31,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            99 =>
            array(
                'code' => '180',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 100,
                'name' => 'Other Craft and Related Workers',
                'nco_division_id' => 7,
                'nco_sub_division_id' => 31,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            100 =>
            array(
                'code' => '180',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 101,
                'name' => 'Mining and Mineral Processing Plant Operators',
                'nco_division_id' => 8,
                'nco_sub_division_id' => 32,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            101 =>
            array(
                'code' => '181',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 102,
                'name' => 'Metal Processing and Finishing Plant Operators',
                'nco_division_id' => 8,
                'nco_sub_division_id' => 32,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            102 =>
            array(
                'code' => '182',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 103,
                'name' => 'Chemical and Photographic Products Plant and Machine Operators',
                'nco_division_id' => 8,
                'nco_sub_division_id' => 32,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            103 =>
            array(
                'code' => '183',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 104,
                'name' => 'Rubber, Plastic and Paper Products Machine Operators',
                'nco_division_id' => 8,
                'nco_sub_division_id' => 32,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            104 =>
            array(
                'code' => '184',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 105,
                'name' => 'Textile, Fur and Leather Products Machine Operators',
                'nco_division_id' => 8,
                'nco_sub_division_id' => 32,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            105 =>
            array(
                'code' => '185',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 106,
                'name' => 'Food and Related Products Machine Operators',
                'nco_division_id' => 8,
                'nco_sub_division_id' => 32,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            106 =>
            array(
                'code' => '186',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 107,
                'name' => 'Wood Processing and Papermaking Plant Operators',
                'nco_division_id' => 8,
                'nco_sub_division_id' => 32,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            107 =>
            array(
                'code' => '187',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 108,
                'name' => 'Other Stationary Plant and Machine Operators',
                'nco_division_id' => 8,
                'nco_sub_division_id' => 32,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            108 =>
            array(
                'code' => '187',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 109,
                'name' => 'Assemblers',
                'nco_division_id' => 8,
                'nco_sub_division_id' => 33,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            109 =>
            array(
                'code' => '187',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 110,
                'name' => 'Locomotive Engine Drivers and Related Workers',
                'nco_division_id' => 8,
                'nco_sub_division_id' => 34,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            110 =>
            array(
                'code' => '188',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 111,
                'name' => 'Car, Van and Motorcycle Drivers',
                'nco_division_id' => 8,
                'nco_sub_division_id' => 34,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            111 =>
            array(
                'code' => '189',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 112,
                'name' => 'Heavy Truck and Bus Drivers',
                'nco_division_id' => 8,
                'nco_sub_division_id' => 34,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            112 =>
            array(
                'code' => '190',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 113,
                'name' => 'Mobile Plant Operators',
                'nco_division_id' => 8,
                'nco_sub_division_id' => 34,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            113 =>
            array(
                'code' => '191',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 114,
                'name' => 'Ships’ Deck Crews and Related Workers',
                'nco_division_id' => 8,
                'nco_sub_division_id' => 34,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            114 =>
            array(
                'code' => '191',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 115,
                'name' => 'Domestic, Hotel and Office Cleaners and Helpers',
                'nco_division_id' => 9,
                'nco_sub_division_id' => 35,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            115 =>
            array(
                'code' => '192',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 116,
                'name' => 'Vehicle, Window, Laundry and Other Hand Cleaners',
                'nco_division_id' => 9,
                'nco_sub_division_id' => 35,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            116 =>
            array(
                'code' => '192',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 117,
                'name' => 'Agricultural, Forestry and Fishery Labourers',
                'nco_division_id' => 9,
                'nco_sub_division_id' => 36,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            117 =>
            array(
                'code' => '192',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 118,
                'name' => 'Mining and Construction Labourers',
                'nco_division_id' => 9,
                'nco_sub_division_id' => 37,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            118 =>
            array(
                'code' => '193',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 119,
                'name' => 'Manufacturing Labourers',
                'nco_division_id' => 9,
                'nco_sub_division_id' => 37,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            119 =>
            array(
                'code' => '194',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 120,
                'name' => 'Transport and Storage Labourers',
                'nco_division_id' => 9,
                'nco_sub_division_id' => 37,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            120 =>
            array(
                'code' => '194',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 121,
                'name' => 'Food Preparation Assistants',
                'nco_division_id' => 9,
                'nco_sub_division_id' => 38,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            121 =>
            array(
                'code' => '194',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 122,
                'name' => 'Street and Related Service Workers',
                'nco_division_id' => 9,
                'nco_sub_division_id' => 39,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            122 =>
            array(
                'code' => '195',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 123,
                'name' => 'Street Vendors (Excluding Food)',
                'nco_division_id' => 9,
                'nco_sub_division_id' => 39,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            123 =>
            array(
                'code' => '195',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 124,
                'name' => 'Refuse Workers',
                'nco_division_id' => 9,
                'nco_sub_division_id' => 40,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            124 =>
            array(
                'code' => '196',
                'created_at' => date('Y-m-d H:i:s'),
                'id' => 125,
                'name' => 'Other Elementary Workers',
                'nco_division_id' => 9,
                'nco_sub_division_id' => 40,
                'updated_at' => date('Y-m-d H:i:s'),
            ),
        ));
    }
}

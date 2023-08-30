<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class NcoFamiliesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('nco_families')->delete();
        
        \DB::table('nco_families')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nco_group_id' => 1,
                'name' => 'Legislators',
                'code' => '1111',
                'created_at' => '2022-04-22 12:03:40',
                'updated_at' => '2022-04-22 12:03:40',
            ),
            1 => 
            array (
                'id' => 2,
                'nco_group_id' => 1,
                'name' => 'Senior Government Officials',
                'code' => '1112',
                'created_at' => '2022-04-22 12:03:40',
                'updated_at' => '2022-04-22 12:03:40',
            ),
            2 => 
            array (
                'id' => 3,
                'nco_group_id' => 1,
                'name' => 'Traditional Chiefs and Heads of Villages',
                'code' => '1113',
                'created_at' => '2022-04-22 12:03:40',
                'updated_at' => '2022-04-22 12:03:40',
            ),
            3 => 
            array (
                'id' => 4,
                'nco_group_id' => 1,
                'name' => 'Senior Officials of Special Interest Organizations',
                'code' => '1114',
                'created_at' => '2022-04-22 12:03:40',
                'updated_at' => '2022-04-22 12:03:40',
            ),
            4 => 
            array (
                'id' => 5,
                'nco_group_id' => 2,
                'name' => 'Managing Directors and Chief Executives',
                'code' => '1115',
                'created_at' => '2022-04-22 12:04:03',
                'updated_at' => '2022-04-22 12:04:03',
            ),
            5 => 
            array (
                'id' => 6,
                'nco_group_id' => 3,
                'name' => 'Finance Managers',
                'code' => '1116',
                'created_at' => '2022-04-22 12:04:25',
                'updated_at' => '2022-04-22 12:04:25',
            ),
            6 => 
            array (
                'id' => 7,
                'nco_group_id' => 3,
                'name' => 'Human Resource Managers',
                'code' => '1117',
                'created_at' => '2022-04-22 12:04:25',
                'updated_at' => '2022-04-22 12:04:25',
            ),
            7 => 
            array (
                'id' => 8,
                'nco_group_id' => 3,
                'name' => 'Policy and Planning Managers',
                'code' => '1118',
                'created_at' => '2022-04-22 12:04:25',
                'updated_at' => '2022-04-22 12:04:25',
            ),
            8 => 
            array (
                'id' => 9,
                'nco_group_id' => 3,
                'name' => 'Business Services and Administration Managers Not Elsewhere Classified',
                'code' => '1119',
                'created_at' => '2022-04-22 12:04:25',
                'updated_at' => '2022-04-22 12:04:25',
            ),
            9 => 
            array (
                'id' => 10,
                'nco_group_id' => 4,
                'name' => 'Sales and Marketing Managers',
                'code' => '1119',
                'created_at' => '2022-04-22 12:06:36',
                'updated_at' => '2022-04-22 12:06:36',
            ),
            10 => 
            array (
                'id' => 11,
                'nco_group_id' => 4,
                'name' => 'Advertising and Public Relation Managers',
                'code' => '1120',
                'created_at' => '2022-04-22 12:06:36',
                'updated_at' => '2022-04-22 12:06:36',
            ),
            11 => 
            array (
                'id' => 12,
                'nco_group_id' => 4,
                'name' => 'Research and Development Managers',
                'code' => '1121',
                'created_at' => '2022-04-22 12:06:36',
                'updated_at' => '2022-04-22 12:06:36',
            ),
            12 => 
            array (
                'id' => 13,
                'nco_group_id' => 5,
                'name' => 'Agricultural and Forestry Production Managers',
                'code' => '1121',
                'created_at' => '2022-04-22 12:06:53',
                'updated_at' => '2022-04-22 12:06:53',
            ),
            13 => 
            array (
                'id' => 14,
                'nco_group_id' => 5,
                'name' => 'Aquaculture and Fisheries Production Managers',
                'code' => '1122',
                'created_at' => '2022-04-22 12:06:53',
                'updated_at' => '2022-04-22 12:06:53',
            ),
            14 => 
            array (
                'id' => 15,
                'nco_group_id' => 5,
                'name' => 'Manufacturing Managers',
                'code' => '1123',
                'created_at' => '2022-04-22 12:06:54',
                'updated_at' => '2022-04-22 12:06:54',
            ),
            15 => 
            array (
                'id' => 16,
                'nco_group_id' => 5,
                'name' => 'Mining Managers',
                'code' => '1124',
                'created_at' => '2022-04-22 12:06:54',
                'updated_at' => '2022-04-22 12:06:54',
            ),
            16 => 
            array (
                'id' => 17,
                'nco_group_id' => 5,
                'name' => 'Construction Managers',
                'code' => '1125',
                'created_at' => '2022-04-22 12:06:54',
                'updated_at' => '2022-04-22 12:06:54',
            ),
            17 => 
            array (
                'id' => 18,
                'nco_group_id' => 5,
                'name' => 'Supply, Distribution and Related Managers',
                'code' => '1126',
                'created_at' => '2022-04-22 12:06:54',
                'updated_at' => '2022-04-22 12:06:54',
            ),
            18 => 
            array (
                'id' => 19,
                'nco_group_id' => 6,
                'name' => 'Information and Communication Technology Services',
                'code' => '1126',
                'created_at' => '2022-04-22 12:07:01',
                'updated_at' => '2022-04-22 12:07:01',
            ),
            19 => 
            array (
                'id' => 20,
                'nco_group_id' => 7,
                'name' => 'Child Care Service Managers',
                'code' => '1126',
                'created_at' => '2022-04-22 12:07:13',
                'updated_at' => '2022-04-22 12:07:13',
            ),
            20 => 
            array (
                'id' => 21,
                'nco_group_id' => 7,
                'name' => 'Health Services Managers',
                'code' => '1127',
                'created_at' => '2022-04-22 12:07:13',
                'updated_at' => '2022-04-22 12:07:13',
            ),
            21 => 
            array (
                'id' => 22,
                'nco_group_id' => 7,
                'name' => 'Aged Care Services Managers',
                'code' => '1128',
                'created_at' => '2022-04-22 12:07:13',
                'updated_at' => '2022-04-22 12:07:13',
            ),
            22 => 
            array (
                'id' => 23,
                'nco_group_id' => 7,
                'name' => 'Social Welfare Managers',
                'code' => '1129',
                'created_at' => '2022-04-22 12:07:13',
                'updated_at' => '2022-04-22 12:07:13',
            ),
            23 => 
            array (
                'id' => 24,
                'nco_group_id' => 7,
                'name' => 'Education Managers',
                'code' => '1130',
                'created_at' => '2022-04-22 12:07:13',
                'updated_at' => '2022-04-22 12:07:13',
            ),
            24 => 
            array (
                'id' => 25,
                'nco_group_id' => 7,
                'name' => 'Financial and Insurance Service Branch',
                'code' => '1131',
                'created_at' => '2022-04-22 12:07:13',
                'updated_at' => '2022-04-22 12:07:13',
            ),
            25 => 
            array (
                'id' => 26,
                'nco_group_id' => 8,
                'name' => 'Hotel Managers',
                'code' => '1131',
                'created_at' => '2022-04-22 12:07:21',
                'updated_at' => '2022-04-22 12:07:21',
            ),
            26 => 
            array (
                'id' => 27,
                'nco_group_id' => 8,
                'name' => 'Restaurant Managers',
                'code' => '1132',
                'created_at' => '2022-04-22 12:07:21',
                'updated_at' => '2022-04-22 12:07:21',
            ),
            27 => 
            array (
                'id' => 28,
                'nco_group_id' => 9,
                'name' => 'Retail and Wholesale Trade Managers',
                'code' => '1132',
                'created_at' => '2022-04-22 12:07:30',
                'updated_at' => '2022-04-22 12:07:30',
            ),
            28 => 
            array (
                'id' => 29,
                'nco_group_id' => 10,
                'name' => 'Sports, Recreation and Cultural Centre Managers',
                'code' => '1132',
                'created_at' => '2022-04-22 12:07:38',
                'updated_at' => '2022-04-22 12:07:38',
            ),
            29 => 
            array (
                'id' => 30,
                'nco_group_id' => 10,
                'name' => 'Services Manager Not Elsewhere Classified',
                'code' => '1133',
                'created_at' => '2022-04-22 12:07:38',
                'updated_at' => '2022-04-22 12:07:38',
            ),
            30 => 
            array (
                'id' => 31,
                'nco_group_id' => 11,
                'name' => 'Physicists and Astronomers',
                'code' => '1133',
                'created_at' => '2022-04-22 12:07:52',
                'updated_at' => '2022-04-22 12:07:52',
            ),
            31 => 
            array (
                'id' => 32,
                'nco_group_id' => 11,
                'name' => 'Meteorologists',
                'code' => '1134',
                'created_at' => '2022-04-22 12:07:52',
                'updated_at' => '2022-04-22 12:07:52',
            ),
            32 => 
            array (
                'id' => 33,
                'nco_group_id' => 11,
                'name' => 'Chemists',
                'code' => '1135',
                'created_at' => '2022-04-22 12:07:52',
                'updated_at' => '2022-04-22 12:07:52',
            ),
            33 => 
            array (
                'id' => 34,
                'nco_group_id' => 11,
                'name' => 'Geologists and Geophysicists',
                'code' => '1136',
                'created_at' => '2022-04-22 12:07:52',
                'updated_at' => '2022-04-22 12:07:52',
            ),
            34 => 
            array (
                'id' => 35,
                'nco_group_id' => 12,
                'name' => 'Mathematicians, Actuaries and Statisticians',
                'code' => '1136',
                'created_at' => '2022-04-22 12:08:02',
                'updated_at' => '2022-04-22 12:08:02',
            ),
            35 => 
            array (
                'id' => 36,
                'nco_group_id' => 13,
                'name' => 'Biologists, Botanists, Zoologists and Related Professionals',
                'code' => '1136',
                'created_at' => '2022-04-22 12:08:14',
                'updated_at' => '2022-04-22 12:08:14',
            ),
            36 => 
            array (
                'id' => 37,
                'nco_group_id' => 13,
                'name' => 'Farming, Forestry and Fisheries Advisors',
                'code' => '1137',
                'created_at' => '2022-04-22 12:08:14',
                'updated_at' => '2022-04-22 12:08:14',
            ),
            37 => 
            array (
                'id' => 38,
                'nco_group_id' => 13,
                'name' => 'Environmental Protection Professionals',
                'code' => '1138',
                'created_at' => '2022-04-22 12:08:14',
                'updated_at' => '2022-04-22 12:08:14',
            ),
            38 => 
            array (
                'id' => 39,
                'nco_group_id' => 14,
                'name' => 'Industrial and Production Engineers',
                'code' => '1138',
                'created_at' => '2022-04-22 12:08:42',
                'updated_at' => '2022-04-22 12:08:42',
            ),
            39 => 
            array (
                'id' => 40,
                'nco_group_id' => 14,
                'name' => 'Civil Engineers',
                'code' => '1139',
                'created_at' => '2022-04-22 12:08:42',
                'updated_at' => '2022-04-22 12:08:42',
            ),
            40 => 
            array (
                'id' => 41,
                'nco_group_id' => 14,
                'name' => 'Environmental Engineers',
                'code' => '1140',
                'created_at' => '2022-04-22 12:08:42',
                'updated_at' => '2022-04-22 12:08:42',
            ),
            41 => 
            array (
                'id' => 42,
                'nco_group_id' => 14,
                'name' => 'Mechanical Engineers',
                'code' => '1141',
                'created_at' => '2022-04-22 12:08:42',
                'updated_at' => '2022-04-22 12:08:42',
            ),
            42 => 
            array (
                'id' => 43,
                'nco_group_id' => 14,
                'name' => 'Chemical Engineers',
                'code' => '1142',
                'created_at' => '2022-04-22 12:08:42',
                'updated_at' => '2022-04-22 12:08:42',
            ),
            43 => 
            array (
                'id' => 44,
                'nco_group_id' => 14,
                'name' => 'Mining Engineers, Metallurgists and Related Professionals',
                'code' => '1143',
                'created_at' => '2022-04-22 12:08:42',
                'updated_at' => '2022-04-22 12:08:42',
            ),
            44 => 
            array (
                'id' => 45,
                'nco_group_id' => 14,
                'name' => 'Engineering Professionals Not Elsewhere Classified',
                'code' => '1144',
                'created_at' => '2022-04-22 12:08:42',
                'updated_at' => '2022-04-22 12:08:42',
            ),
            45 => 
            array (
                'id' => 46,
                'nco_group_id' => 15,
                'name' => 'Electrical Engineers',
                'code' => '1144',
                'created_at' => '2022-04-22 12:08:54',
                'updated_at' => '2022-04-22 12:08:54',
            ),
            46 => 
            array (
                'id' => 47,
                'nco_group_id' => 15,
                'name' => 'Electronics Engineers',
                'code' => '1145',
                'created_at' => '2022-04-22 12:08:54',
                'updated_at' => '2022-04-22 12:08:54',
            ),
            47 => 
            array (
                'id' => 48,
                'nco_group_id' => 15,
                'name' => 'Telecommunication Engineers',
                'code' => '1146',
                'created_at' => '2022-04-22 12:08:54',
                'updated_at' => '2022-04-22 12:08:54',
            ),
            48 => 
            array (
                'id' => 49,
                'nco_group_id' => 16,
                'name' => 'Building Architects',
                'code' => '1146',
                'created_at' => '2022-04-22 12:09:27',
                'updated_at' => '2022-04-22 12:09:27',
            ),
            49 => 
            array (
                'id' => 50,
                'nco_group_id' => 16,
                'name' => 'Landscape Architects',
                'code' => '1147',
                'created_at' => '2022-04-22 12:09:27',
                'updated_at' => '2022-04-22 12:09:27',
            ),
            50 => 
            array (
                'id' => 51,
                'nco_group_id' => 16,
                'name' => 'Product and Garment Designers',
                'code' => '1148',
                'created_at' => '2022-04-22 12:09:27',
                'updated_at' => '2022-04-22 12:09:27',
            ),
            51 => 
            array (
                'id' => 52,
                'nco_group_id' => 16,
                'name' => 'Town and Traffic Planners',
                'code' => '1149',
                'created_at' => '2022-04-22 12:09:27',
                'updated_at' => '2022-04-22 12:09:27',
            ),
            52 => 
            array (
                'id' => 53,
                'nco_group_id' => 16,
                'name' => 'Cartographers and Surveyors',
                'code' => '1150',
                'created_at' => '2022-04-22 12:09:27',
                'updated_at' => '2022-04-22 12:09:27',
            ),
            53 => 
            array (
                'id' => 54,
                'nco_group_id' => 16,
                'name' => 'Graphic and Multimedia Designers',
                'code' => '1151',
                'created_at' => '2022-04-22 12:09:27',
                'updated_at' => '2022-04-22 12:09:27',
            ),
            54 => 
            array (
                'id' => 55,
                'nco_group_id' => 17,
                'name' => 'Generalist Medical Practitioners',
                'code' => '1151',
                'created_at' => '2022-04-22 12:10:07',
                'updated_at' => '2022-04-22 12:10:07',
            ),
            55 => 
            array (
                'id' => 56,
                'nco_group_id' => 17,
                'name' => 'Specialist Medical Practitioners',
                'code' => '1152',
                'created_at' => '2022-04-22 12:10:07',
                'updated_at' => '2022-04-22 12:10:07',
            ),
            56 => 
            array (
                'id' => 57,
                'nco_group_id' => 18,
                'name' => 'Nursing Professionals',
                'code' => '1152',
                'created_at' => '2022-04-22 12:10:16',
                'updated_at' => '2022-04-22 12:10:16',
            ),
            57 => 
            array (
                'id' => 58,
                'nco_group_id' => 18,
                'name' => 'Midwifery Professionals',
                'code' => '1153',
                'created_at' => '2022-04-22 12:10:16',
                'updated_at' => '2022-04-22 12:10:16',
            ),
            58 => 
            array (
                'id' => 59,
                'nco_group_id' => 19,
                'name' => 'Traditional and Complementary Medicine Professionals',
                'code' => '1153',
                'created_at' => '2022-04-22 12:10:24',
                'updated_at' => '2022-04-22 12:10:24',
            ),
            59 => 
            array (
                'id' => 60,
                'nco_group_id' => 20,
                'name' => 'Paramedical Practitioners',
                'code' => '1153',
                'created_at' => '2022-04-22 12:10:31',
                'updated_at' => '2022-04-22 12:10:31',
            ),
            60 => 
            array (
                'id' => 61,
                'nco_group_id' => 21,
                'name' => 'Veterinarians',
                'code' => '1153',
                'created_at' => '2022-04-22 12:10:41',
                'updated_at' => '2022-04-22 12:10:41',
            ),
            61 => 
            array (
                'id' => 62,
                'nco_group_id' => 22,
                'name' => 'Dentists',
                'code' => '1153',
                'created_at' => '2022-04-22 12:11:01',
                'updated_at' => '2022-04-22 12:11:01',
            ),
            62 => 
            array (
                'id' => 63,
                'nco_group_id' => 22,
                'name' => 'Pharmacists',
                'code' => '1154',
                'created_at' => '2022-04-22 12:11:01',
                'updated_at' => '2022-04-22 12:11:01',
            ),
            63 => 
            array (
                'id' => 64,
                'nco_group_id' => 22,
                'name' => 'Environmental and Occupational Health and Hygiene Professionals',
                'code' => '1155',
                'created_at' => '2022-04-22 12:11:01',
                'updated_at' => '2022-04-22 12:11:01',
            ),
            64 => 
            array (
                'id' => 65,
                'nco_group_id' => 22,
                'name' => 'Physiotherapists',
                'code' => '1156',
                'created_at' => '2022-04-22 12:11:01',
                'updated_at' => '2022-04-22 12:11:01',
            ),
            65 => 
            array (
                'id' => 66,
                'nco_group_id' => 22,
                'name' => 'Dieticians and Nutritionists',
                'code' => '1157',
                'created_at' => '2022-04-22 12:11:01',
                'updated_at' => '2022-04-22 12:11:01',
            ),
            66 => 
            array (
                'id' => 67,
                'nco_group_id' => 22,
                'name' => 'Audiologists and Speech Therapists',
                'code' => '1158',
                'created_at' => '2022-04-22 12:11:01',
                'updated_at' => '2022-04-22 12:11:01',
            ),
            67 => 
            array (
                'id' => 68,
                'nco_group_id' => 22,
                'name' => 'Optometrists and Ophthalmic Opticians',
                'code' => '1159',
                'created_at' => '2022-04-22 12:11:01',
                'updated_at' => '2022-04-22 12:11:01',
            ),
            68 => 
            array (
                'id' => 69,
                'nco_group_id' => 22,
                'name' => 'Health Professionals Not Elsewhere Classified',
                'code' => '1160',
                'created_at' => '2022-04-22 12:11:01',
                'updated_at' => '2022-04-22 12:11:01',
            ),
            69 => 
            array (
                'id' => 70,
                'nco_group_id' => 23,
                'name' => 'University and Higher Education Teachers',
                'code' => '1160',
                'created_at' => '2022-04-22 12:11:15',
                'updated_at' => '2022-04-22 12:11:15',
            ),
            70 => 
            array (
                'id' => 71,
                'nco_group_id' => 24,
                'name' => 'Vocational Education Teachers',
                'code' => '1160',
                'created_at' => '2022-04-22 12:11:24',
                'updated_at' => '2022-04-22 12:11:24',
            ),
            71 => 
            array (
                'id' => 72,
                'nco_group_id' => 25,
                'name' => 'Secondary Education Teachers',
                'code' => '1160',
                'created_at' => '2022-04-22 12:11:31',
                'updated_at' => '2022-04-22 12:11:31',
            ),
            72 => 
            array (
                'id' => 73,
                'nco_group_id' => 26,
                'name' => 'Primary School Teachers',
                'code' => '1160',
                'created_at' => '2022-04-22 12:11:44',
                'updated_at' => '2022-04-22 12:11:44',
            ),
            73 => 
            array (
                'id' => 74,
                'nco_group_id' => 26,
                'name' => 'Early Childhood Educators',
                'code' => '1161',
                'created_at' => '2022-04-22 12:11:44',
                'updated_at' => '2022-04-22 12:11:44',
            ),
            74 => 
            array (
                'id' => 75,
                'nco_group_id' => 27,
                'name' => 'Education Method Specialists',
                'code' => '1161',
                'created_at' => '2022-04-22 12:12:02',
                'updated_at' => '2022-04-22 12:12:02',
            ),
            75 => 
            array (
                'id' => 76,
                'nco_group_id' => 27,
                'name' => 'Other Language Professionals',
                'code' => '1162',
                'created_at' => '2022-04-22 12:12:02',
                'updated_at' => '2022-04-22 12:12:02',
            ),
            76 => 
            array (
                'id' => 77,
                'nco_group_id' => 27,
                'name' => 'Other Music Teachers',
                'code' => '1163',
                'created_at' => '2022-04-22 12:12:02',
                'updated_at' => '2022-04-22 12:12:02',
            ),
            77 => 
            array (
                'id' => 78,
                'nco_group_id' => 27,
                'name' => 'Other Arts Teachers',
                'code' => '1164',
                'created_at' => '2022-04-22 12:12:02',
                'updated_at' => '2022-04-22 12:12:02',
            ),
            78 => 
            array (
                'id' => 79,
                'nco_group_id' => 27,
                'name' => 'Information Technology Trainers',
                'code' => '1165',
                'created_at' => '2022-04-22 12:12:02',
                'updated_at' => '2022-04-22 12:12:02',
            ),
            79 => 
            array (
                'id' => 80,
                'nco_group_id' => 27,
                'name' => 'Teaching Professionals Not Elsewhere Classified',
                'code' => '1166',
                'created_at' => '2022-04-22 12:12:03',
                'updated_at' => '2022-04-22 12:12:03',
            ),
            80 => 
            array (
                'id' => 81,
                'nco_group_id' => 28,
                'name' => 'Accountants',
                'code' => '1166',
                'created_at' => '2022-04-22 12:12:21',
                'updated_at' => '2022-04-22 12:12:21',
            ),
            81 => 
            array (
                'id' => 82,
                'nco_group_id' => 28,
                'name' => 'Financial and Investment Advisors',
                'code' => '1167',
                'created_at' => '2022-04-22 12:12:21',
                'updated_at' => '2022-04-22 12:12:21',
            ),
            82 => 
            array (
                'id' => 83,
                'nco_group_id' => 28,
                'name' => 'Financial Analysts',
                'code' => '1168',
                'created_at' => '2022-04-22 12:12:21',
                'updated_at' => '2022-04-22 12:12:21',
            ),
            83 => 
            array (
                'id' => 84,
                'nco_group_id' => 29,
                'name' => 'Management and Organization Analysts',
                'code' => '1168',
                'created_at' => '2022-04-22 12:12:44',
                'updated_at' => '2022-04-22 12:12:44',
            ),
            84 => 
            array (
                'id' => 85,
                'nco_group_id' => 29,
                'name' => 'Policy Administration Professionals',
                'code' => '1169',
                'created_at' => '2022-04-22 12:12:44',
                'updated_at' => '2022-04-22 12:12:44',
            ),
            85 => 
            array (
                'id' => 86,
                'nco_group_id' => 29,
                'name' => 'Personal and Careers Professionals',
                'code' => '1170',
                'created_at' => '2022-04-22 12:12:44',
                'updated_at' => '2022-04-22 12:12:44',
            ),
            86 => 
            array (
                'id' => 87,
                'nco_group_id' => 29,
                'name' => 'Training and Staff Development Professionals',
                'code' => '1171',
                'created_at' => '2022-04-22 12:12:44',
                'updated_at' => '2022-04-22 12:12:44',
            ),
            87 => 
            array (
                'id' => 88,
                'nco_group_id' => 30,
                'name' => 'Advertising and Marketing Professionals',
                'code' => '1171',
                'created_at' => '2022-04-22 12:13:08',
                'updated_at' => '2022-04-22 12:13:08',
            ),
            88 => 
            array (
                'id' => 89,
                'nco_group_id' => 30,
                'name' => 'Public Relations Professionals',
                'code' => '1172',
                'created_at' => '2022-04-22 12:13:08',
                'updated_at' => '2022-04-22 12:13:08',
            ),
            89 => 
            array (
                'id' => 90,
                'nco_group_id' => 30,
            'name' => 'Technical and Medical Sales Professional (Excluding ICT)',
                'code' => '1173',
                'created_at' => '2022-04-22 12:13:08',
                'updated_at' => '2022-04-22 12:13:08',
            ),
            90 => 
            array (
                'id' => 91,
                'nco_group_id' => 30,
                'name' => 'Information and Communications Technology Sales Professionals',
                'code' => '1174',
                'created_at' => '2022-04-22 12:13:08',
                'updated_at' => '2022-04-22 12:13:08',
            ),
            91 => 
            array (
                'id' => 92,
                'nco_group_id' => 31,
                'name' => 'System Analysts',
                'code' => '1174',
                'created_at' => '2022-04-22 12:13:22',
                'updated_at' => '2022-04-22 12:13:22',
            ),
            92 => 
            array (
                'id' => 93,
                'nco_group_id' => 31,
                'name' => 'Software Developers',
                'code' => '1175',
                'created_at' => '2022-04-22 12:13:22',
                'updated_at' => '2022-04-22 12:13:22',
            ),
            93 => 
            array (
                'id' => 94,
                'nco_group_id' => 31,
                'name' => 'Web and Multimedia Developers',
                'code' => '1176',
                'created_at' => '2022-04-22 12:13:22',
                'updated_at' => '2022-04-22 12:13:22',
            ),
            94 => 
            array (
                'id' => 95,
                'nco_group_id' => 31,
                'name' => 'Applications Programmers',
                'code' => '1177',
                'created_at' => '2022-04-22 12:13:22',
                'updated_at' => '2022-04-22 12:13:22',
            ),
            95 => 
            array (
                'id' => 96,
                'nco_group_id' => 31,
                'name' => 'Software and Application Developers and Analysts Not Elsewhere Classified',
                'code' => '1178',
                'created_at' => '2022-04-22 12:13:22',
                'updated_at' => '2022-04-22 12:13:22',
            ),
            96 => 
            array (
                'id' => 97,
                'nco_group_id' => 32,
                'name' => 'Database designers and Administrators',
                'code' => '1178',
                'created_at' => '2022-04-22 12:13:35',
                'updated_at' => '2022-04-22 12:13:35',
            ),
            97 => 
            array (
                'id' => 98,
                'nco_group_id' => 32,
                'name' => 'Systems Administrators',
                'code' => '1179',
                'created_at' => '2022-04-22 12:13:35',
                'updated_at' => '2022-04-22 12:13:35',
            ),
            98 => 
            array (
                'id' => 99,
                'nco_group_id' => 32,
                'name' => 'Computer Network Professionals',
                'code' => '1180',
                'created_at' => '2022-04-22 12:13:35',
                'updated_at' => '2022-04-22 12:13:35',
            ),
            99 => 
            array (
                'id' => 100,
                'nco_group_id' => 32,
                'name' => 'Database and Network Professionals Not Elsewhere Classified',
                'code' => '1181',
                'created_at' => '2022-04-22 12:13:35',
                'updated_at' => '2022-04-22 12:13:35',
            ),
            100 => 
            array (
                'id' => 101,
                'nco_group_id' => 33,
                'name' => 'Lawyers',
                'code' => '1181',
                'created_at' => '2022-04-22 12:13:50',
                'updated_at' => '2022-04-22 12:13:50',
            ),
            101 => 
            array (
                'id' => 102,
                'nco_group_id' => 33,
                'name' => 'Judges',
                'code' => '1182',
                'created_at' => '2022-04-22 12:13:50',
                'updated_at' => '2022-04-22 12:13:50',
            ),
            102 => 
            array (
                'id' => 103,
                'nco_group_id' => 33,
                'name' => 'Legal Professionals, Not Elsewhere Classified',
                'code' => '1183',
                'created_at' => '2022-04-22 12:13:50',
                'updated_at' => '2022-04-22 12:13:50',
            ),
            103 => 
            array (
                'id' => 104,
                'nco_group_id' => 34,
                'name' => 'Archivists and Curators',
                'code' => '1183',
                'created_at' => '2022-04-22 12:14:01',
                'updated_at' => '2022-04-22 12:14:01',
            ),
            104 => 
            array (
                'id' => 105,
                'nco_group_id' => 34,
                'name' => 'Librarians and Related Information',
                'code' => '1184',
                'created_at' => '2022-04-22 12:14:01',
                'updated_at' => '2022-04-22 12:14:01',
            ),
            105 => 
            array (
                'id' => 106,
                'nco_group_id' => 35,
                'name' => 'Economists',
                'code' => '1184',
                'created_at' => '2022-04-22 12:14:22',
                'updated_at' => '2022-04-22 12:14:22',
            ),
            106 => 
            array (
                'id' => 107,
                'nco_group_id' => 35,
                'name' => 'Sociologists, Anthropologists and Related Professionals',
                'code' => '1185',
                'created_at' => '2022-04-22 12:14:22',
                'updated_at' => '2022-04-22 12:14:22',
            ),
            107 => 
            array (
                'id' => 108,
                'nco_group_id' => 35,
                'name' => 'Philosophers, Historians and Political Scientists',
                'code' => '1186',
                'created_at' => '2022-04-22 12:14:22',
                'updated_at' => '2022-04-22 12:14:22',
            ),
            108 => 
            array (
                'id' => 109,
                'nco_group_id' => 35,
                'name' => 'Psychologists',
                'code' => '1187',
                'created_at' => '2022-04-22 12:14:22',
                'updated_at' => '2022-04-22 12:14:22',
            ),
            109 => 
            array (
                'id' => 110,
                'nco_group_id' => 35,
                'name' => 'Social Work and Counselling Professionals',
                'code' => '1188',
                'created_at' => '2022-04-22 12:14:22',
                'updated_at' => '2022-04-22 12:14:22',
            ),
            110 => 
            array (
                'id' => 111,
                'nco_group_id' => 35,
                'name' => 'Religious Professionals',
                'code' => '1189',
                'created_at' => '2022-04-22 12:14:22',
                'updated_at' => '2022-04-22 12:14:22',
            ),
            111 => 
            array (
                'id' => 112,
                'nco_group_id' => 36,
                'name' => 'Authors and Related Writers',
                'code' => '1189',
                'created_at' => '2022-04-22 12:14:41',
                'updated_at' => '2022-04-22 12:14:41',
            ),
            112 => 
            array (
                'id' => 113,
                'nco_group_id' => 36,
                'name' => 'Journalists',
                'code' => '1190',
                'created_at' => '2022-04-22 12:14:41',
                'updated_at' => '2022-04-22 12:14:41',
            ),
            113 => 
            array (
                'id' => 114,
                'nco_group_id' => 36,
                'name' => 'Translators, Interpreters and Other Linguists',
                'code' => '1191',
                'created_at' => '2022-04-22 12:14:41',
                'updated_at' => '2022-04-22 12:14:41',
            ),
            114 => 
            array (
                'id' => 115,
                'nco_group_id' => 37,
                'name' => 'Visual Artists',
                'code' => '1191',
                'created_at' => '2022-04-22 12:15:00',
                'updated_at' => '2022-04-22 12:15:00',
            ),
            115 => 
            array (
                'id' => 116,
                'nco_group_id' => 37,
                'name' => 'Musicians, Singers and Composers',
                'code' => '1192',
                'created_at' => '2022-04-22 12:15:00',
                'updated_at' => '2022-04-22 12:15:00',
            ),
            116 => 
            array (
                'id' => 117,
                'nco_group_id' => 37,
                'name' => 'Dancers and Choreographers',
                'code' => '1193',
                'created_at' => '2022-04-22 12:15:00',
                'updated_at' => '2022-04-22 12:15:00',
            ),
            117 => 
            array (
                'id' => 118,
                'nco_group_id' => 37,
                'name' => 'Film, Stage and Related Directors and Producers',
                'code' => '1194',
                'created_at' => '2022-04-22 12:15:00',
                'updated_at' => '2022-04-22 12:15:00',
            ),
            118 => 
            array (
                'id' => 119,
                'nco_group_id' => 37,
                'name' => 'Actors',
                'code' => '1195',
                'created_at' => '2022-04-22 12:15:00',
                'updated_at' => '2022-04-22 12:15:00',
            ),
            119 => 
            array (
                'id' => 120,
                'nco_group_id' => 37,
                'name' => 'Announcers on Radio, Television and Other Media',
                'code' => '1196',
                'created_at' => '2022-04-22 12:15:00',
                'updated_at' => '2022-04-22 12:15:00',
            ),
            120 => 
            array (
                'id' => 121,
                'nco_group_id' => 37,
                'name' => 'Creative and Performing Artists Not Elsewhere Classified',
                'code' => '1197',
                'created_at' => '2022-04-22 12:15:00',
                'updated_at' => '2022-04-22 12:15:00',
            ),
            121 => 
            array (
                'id' => 122,
                'nco_group_id' => 38,
                'name' => 'Chemical and Physical Science Technicians',
                'code' => '1197',
                'created_at' => '2022-04-22 12:15:28',
                'updated_at' => '2022-04-22 12:15:28',
            ),
            122 => 
            array (
                'id' => 123,
                'nco_group_id' => 38,
                'name' => 'Civil Engineering Technicians',
                'code' => '1198',
                'created_at' => '2022-04-22 12:15:28',
                'updated_at' => '2022-04-22 12:15:28',
            ),
            123 => 
            array (
                'id' => 124,
                'nco_group_id' => 38,
                'name' => 'Electrical Engineering Technicians',
                'code' => '1199',
                'created_at' => '2022-04-22 12:15:28',
                'updated_at' => '2022-04-22 12:15:28',
            ),
            124 => 
            array (
                'id' => 125,
                'nco_group_id' => 38,
                'name' => 'Electronics Engineering Technicians',
                'code' => '1200',
                'created_at' => '2022-04-22 12:15:28',
                'updated_at' => '2022-04-22 12:15:28',
            ),
            125 => 
            array (
                'id' => 126,
                'nco_group_id' => 38,
                'name' => 'Mechanical Engineering Technicians',
                'code' => '1201',
                'created_at' => '2022-04-22 12:15:28',
                'updated_at' => '2022-04-22 12:15:28',
            ),
            126 => 
            array (
                'id' => 127,
                'nco_group_id' => 38,
                'name' => 'Chemical Engineering Technicians',
                'code' => '1202',
                'created_at' => '2022-04-22 12:15:28',
                'updated_at' => '2022-04-22 12:15:28',
            ),
            127 => 
            array (
                'id' => 128,
                'nco_group_id' => 38,
                'name' => 'Mining and Metallurgical Technicians',
                'code' => '1203',
                'created_at' => '2022-04-22 12:15:28',
                'updated_at' => '2022-04-22 12:15:28',
            ),
            128 => 
            array (
                'id' => 129,
                'nco_group_id' => 38,
                'name' => 'Draughtpersons',
                'code' => '1204',
                'created_at' => '2022-04-22 12:15:28',
                'updated_at' => '2022-04-22 12:15:28',
            ),
            129 => 
            array (
                'id' => 130,
                'nco_group_id' => 38,
                'name' => 'Physical and Engineering Science Technicians Not Elsewhere Classified',
                'code' => '1205',
                'created_at' => '2022-04-22 12:15:28',
                'updated_at' => '2022-04-22 12:15:28',
            ),
            130 => 
            array (
                'id' => 131,
                'nco_group_id' => 39,
                'name' => 'Mining Supervisors',
                'code' => '1205',
                'created_at' => '2022-04-22 12:15:47',
                'updated_at' => '2022-04-22 12:15:47',
            ),
            131 => 
            array (
                'id' => 132,
                'nco_group_id' => 39,
                'name' => 'Manufacturing Supervisors',
                'code' => '1206',
                'created_at' => '2022-04-22 12:15:47',
                'updated_at' => '2022-04-22 12:15:47',
            ),
            132 => 
            array (
                'id' => 133,
                'nco_group_id' => 39,
                'name' => 'Construction Supervisors',
                'code' => '1207',
                'created_at' => '2022-04-22 12:15:47',
                'updated_at' => '2022-04-22 12:15:47',
            ),
            133 => 
            array (
                'id' => 134,
                'nco_group_id' => 40,
                'name' => 'Power Production Plant Operators',
                'code' => '1207',
                'created_at' => '2022-04-22 12:16:08',
                'updated_at' => '2022-04-22 12:16:08',
            ),
            134 => 
            array (
                'id' => 135,
                'nco_group_id' => 40,
                'name' => 'Incinerator and Water Treatment Plant Operators',
                'code' => '1208',
                'created_at' => '2022-04-22 12:16:08',
                'updated_at' => '2022-04-22 12:16:08',
            ),
            135 => 
            array (
                'id' => 136,
                'nco_group_id' => 40,
                'name' => 'Chemical Processing Plant Controllers',
                'code' => '1209',
                'created_at' => '2022-04-22 12:16:08',
                'updated_at' => '2022-04-22 12:16:08',
            ),
            136 => 
            array (
                'id' => 137,
                'nco_group_id' => 40,
                'name' => 'Petroleum and Natural Gas Refining Plant Operators',
                'code' => '1210',
                'created_at' => '2022-04-22 12:16:08',
                'updated_at' => '2022-04-22 12:16:08',
            ),
            137 => 
            array (
                'id' => 138,
                'nco_group_id' => 40,
                'name' => 'Metal Production Process Controllers',
                'code' => '1211',
                'created_at' => '2022-04-22 12:16:08',
                'updated_at' => '2022-04-22 12:16:08',
            ),
            138 => 
            array (
                'id' => 139,
                'nco_group_id' => 40,
                'name' => 'Process Control Technicians Not Elsewhere Classified',
                'code' => '1212',
                'created_at' => '2022-04-22 12:16:08',
                'updated_at' => '2022-04-22 12:16:08',
            ),
            139 => 
            array (
                'id' => 140,
                'nco_group_id' => 41,
            'name' => 'Life Science Technicians (Excluding Medical)',
                'code' => '1212',
                'created_at' => '2022-04-22 12:16:26',
                'updated_at' => '2022-04-22 12:16:26',
            ),
            140 => 
            array (
                'id' => 141,
                'nco_group_id' => 41,
                'name' => 'Agricultural Technicians',
                'code' => '1213',
                'created_at' => '2022-04-22 12:16:26',
                'updated_at' => '2022-04-22 12:16:26',
            ),
            141 => 
            array (
                'id' => 142,
                'nco_group_id' => 41,
                'name' => 'Forestry Technicians',
                'code' => '1214',
                'created_at' => '2022-04-22 12:16:26',
                'updated_at' => '2022-04-22 12:16:26',
            ),
            142 => 
            array (
                'id' => 143,
                'nco_group_id' => 42,
                'name' => 'Ship’s Engineers',
                'code' => '1214',
                'created_at' => '2022-04-22 12:16:51',
                'updated_at' => '2022-04-22 12:16:51',
            ),
            143 => 
            array (
                'id' => 144,
                'nco_group_id' => 42,
                'name' => 'Ship’s Deck Officers and Pilots',
                'code' => '1215',
                'created_at' => '2022-04-22 12:16:51',
                'updated_at' => '2022-04-22 12:16:51',
            ),
            144 => 
            array (
                'id' => 145,
                'nco_group_id' => 42,
                'name' => 'Aircraft Pilots and Related Associate Professionals',
                'code' => '1216',
                'created_at' => '2022-04-22 12:16:51',
                'updated_at' => '2022-04-22 12:16:51',
            ),
            145 => 
            array (
                'id' => 146,
                'nco_group_id' => 42,
                'name' => 'Air Traffic Controllers',
                'code' => '1217',
                'created_at' => '2022-04-22 12:16:51',
                'updated_at' => '2022-04-22 12:16:51',
            ),
            146 => 
            array (
                'id' => 147,
                'nco_group_id' => 42,
                'name' => 'Air Traffic Safety Electronics Technicians',
                'code' => '1218',
                'created_at' => '2022-04-22 12:16:51',
                'updated_at' => '2022-04-22 12:16:51',
            ),
            147 => 
            array (
                'id' => 148,
                'nco_group_id' => 43,
                'name' => 'Medical Imaging and Therapeutic Equipment Technicians',
                'code' => '1218',
                'created_at' => '2022-04-22 12:17:09',
                'updated_at' => '2022-04-22 12:17:09',
            ),
            148 => 
            array (
                'id' => 149,
                'nco_group_id' => 43,
                'name' => 'Medical and Pathology Laboratory Technicians',
                'code' => '1219',
                'created_at' => '2022-04-22 12:17:09',
                'updated_at' => '2022-04-22 12:17:09',
            ),
            149 => 
            array (
                'id' => 150,
                'nco_group_id' => 43,
                'name' => 'Pharmaceutical Technicians and Assistants',
                'code' => '1220',
                'created_at' => '2022-04-22 12:17:09',
                'updated_at' => '2022-04-22 12:17:09',
            ),
            150 => 
            array (
                'id' => 151,
                'nco_group_id' => 43,
                'name' => 'Medical and Dental Prosthetic Technicians',
                'code' => '1221',
                'created_at' => '2022-04-22 12:17:09',
                'updated_at' => '2022-04-22 12:17:09',
            ),
            151 => 
            array (
                'id' => 152,
                'nco_group_id' => 44,
                'name' => 'Nursing Associate Professionals',
                'code' => '1221',
                'created_at' => '2022-04-22 12:17:53',
                'updated_at' => '2022-04-22 12:17:53',
            ),
            152 => 
            array (
                'id' => 153,
                'nco_group_id' => 44,
                'name' => 'Midwifery Associate Professionals',
                'code' => '1222',
                'created_at' => '2022-04-22 12:17:53',
                'updated_at' => '2022-04-22 12:17:53',
            ),
            153 => 
            array (
                'id' => 154,
                'nco_group_id' => 45,
                'name' => 'Traditional and Complementary Medicine Associate Professionals',
                'code' => '1222',
                'created_at' => '2022-04-22 12:18:11',
                'updated_at' => '2022-04-22 12:18:11',
            ),
            154 => 
            array (
                'id' => 155,
                'nco_group_id' => 46,
                'name' => 'Veterinary Technicians and Assistants',
                'code' => '1222',
                'created_at' => '2022-04-22 12:18:23',
                'updated_at' => '2022-04-22 12:18:23',
            ),
            155 => 
            array (
                'id' => 156,
                'nco_group_id' => 47,
                'name' => 'Dental Assistants and Therapists',
                'code' => '1222',
                'created_at' => '2022-04-22 12:19:16',
                'updated_at' => '2022-04-22 12:19:16',
            ),
            156 => 
            array (
                'id' => 157,
                'nco_group_id' => 47,
                'name' => 'Medical Records and Health Information Technicians',
                'code' => '1223',
                'created_at' => '2022-04-22 12:19:16',
                'updated_at' => '2022-04-22 12:19:16',
            ),
            157 => 
            array (
                'id' => 158,
                'nco_group_id' => 47,
                'name' => 'Community Health Workers',
                'code' => '1224',
                'created_at' => '2022-04-22 12:19:16',
                'updated_at' => '2022-04-22 12:19:16',
            ),
            158 => 
            array (
                'id' => 159,
                'nco_group_id' => 47,
                'name' => 'Dispensing Opticians',
                'code' => '1225',
                'created_at' => '2022-04-22 12:19:16',
                'updated_at' => '2022-04-22 12:19:16',
            ),
            159 => 
            array (
                'id' => 160,
                'nco_group_id' => 47,
                'name' => 'Physiotherapy Technicians and Assistants',
                'code' => '1226',
                'created_at' => '2022-04-22 12:19:16',
                'updated_at' => '2022-04-22 12:19:16',
            ),
            160 => 
            array (
                'id' => 161,
                'nco_group_id' => 47,
                'name' => 'Medical Assistants',
                'code' => '1227',
                'created_at' => '2022-04-22 12:19:16',
                'updated_at' => '2022-04-22 12:19:16',
            ),
            161 => 
            array (
                'id' => 162,
                'nco_group_id' => 47,
                'name' => 'Environmental and Occupational Health Inspectors and Associates',
                'code' => '1228',
                'created_at' => '2022-04-22 12:19:16',
                'updated_at' => '2022-04-22 12:19:16',
            ),
            162 => 
            array (
                'id' => 163,
                'nco_group_id' => 47,
                'name' => 'Ambulance Workers',
                'code' => '1229',
                'created_at' => '2022-04-22 12:19:16',
                'updated_at' => '2022-04-22 12:19:16',
            ),
            163 => 
            array (
                'id' => 164,
                'nco_group_id' => 47,
                'name' => 'Modern Health Associate Professionals Not Elsewhere Classified',
                'code' => '1230',
                'created_at' => '2022-04-22 12:19:16',
                'updated_at' => '2022-04-22 12:19:16',
            ),
            164 => 
            array (
                'id' => 165,
                'nco_group_id' => 48,
                'name' => 'Securities and Finance Dealers and Brokers',
                'code' => '1230',
                'created_at' => '2022-04-22 12:19:39',
                'updated_at' => '2022-04-22 12:19:39',
            ),
            165 => 
            array (
                'id' => 166,
                'nco_group_id' => 48,
                'name' => 'Credit and Loan Officers',
                'code' => '1231',
                'created_at' => '2022-04-22 12:19:39',
                'updated_at' => '2022-04-22 12:19:39',
            ),
            166 => 
            array (
                'id' => 167,
                'nco_group_id' => 48,
                'name' => 'Accounting Associate Professionals',
                'code' => '1232',
                'created_at' => '2022-04-22 12:19:39',
                'updated_at' => '2022-04-22 12:19:39',
            ),
            167 => 
            array (
                'id' => 168,
                'nco_group_id' => 48,
                'name' => 'Statistical, Mathematical and Related Associate Professionals',
                'code' => '1233',
                'created_at' => '2022-04-22 12:19:39',
                'updated_at' => '2022-04-22 12:19:39',
            ),
            168 => 
            array (
                'id' => 169,
                'nco_group_id' => 48,
                'name' => 'Valuers and Loss Assessors',
                'code' => '1234',
                'created_at' => '2022-04-22 12:19:39',
                'updated_at' => '2022-04-22 12:19:39',
            ),
            169 => 
            array (
                'id' => 170,
                'nco_group_id' => 49,
                'name' => 'Insurance Representatives',
                'code' => '1234',
                'created_at' => '2022-04-22 12:20:18',
                'updated_at' => '2022-04-22 12:20:18',
            ),
            170 => 
            array (
                'id' => 171,
                'nco_group_id' => 49,
                'name' => 'Commercial Sales Representatives',
                'code' => '1235',
                'created_at' => '2022-04-22 12:20:18',
                'updated_at' => '2022-04-22 12:20:18',
            ),
            171 => 
            array (
                'id' => 172,
                'nco_group_id' => 49,
                'name' => 'Buyers',
                'code' => '1236',
                'created_at' => '2022-04-22 12:20:18',
                'updated_at' => '2022-04-22 12:20:18',
            ),
            172 => 
            array (
                'id' => 173,
                'nco_group_id' => 49,
                'name' => 'Trade Brokers',
                'code' => '1237',
                'created_at' => '2022-04-22 12:20:18',
                'updated_at' => '2022-04-22 12:20:18',
            ),
            173 => 
            array (
                'id' => 174,
                'nco_group_id' => 50,
                'name' => 'Clearing and Forwarding Agents',
                'code' => '1237',
                'created_at' => '2022-04-22 12:20:40',
                'updated_at' => '2022-04-22 12:20:40',
            ),
            174 => 
            array (
                'id' => 175,
                'nco_group_id' => 50,
                'name' => 'Conference and Event Planners',
                'code' => '1238',
                'created_at' => '2022-04-22 12:20:40',
                'updated_at' => '2022-04-22 12:20:40',
            ),
            175 => 
            array (
                'id' => 176,
                'nco_group_id' => 50,
                'name' => 'Employment Agents and Contractors',
                'code' => '1239',
                'created_at' => '2022-04-22 12:20:40',
                'updated_at' => '2022-04-22 12:20:40',
            ),
            176 => 
            array (
                'id' => 177,
                'nco_group_id' => 50,
                'name' => 'Real Estate Agents and Property Managers',
                'code' => '1240',
                'created_at' => '2022-04-22 12:20:40',
                'updated_at' => '2022-04-22 12:20:40',
            ),
            177 => 
            array (
                'id' => 178,
                'nco_group_id' => 50,
                'name' => 'Business Service Agents Not Elsewhere Classified',
                'code' => '1241',
                'created_at' => '2022-04-22 12:20:40',
                'updated_at' => '2022-04-22 12:20:40',
            ),
            178 => 
            array (
                'id' => 179,
                'nco_group_id' => 51,
                'name' => 'Office Supervisors',
                'code' => '1241',
                'created_at' => '2022-04-22 12:21:03',
                'updated_at' => '2022-04-22 12:21:03',
            ),
            179 => 
            array (
                'id' => 180,
                'nco_group_id' => 51,
                'name' => 'Legal Secretaries',
                'code' => '1242',
                'created_at' => '2022-04-22 12:21:03',
                'updated_at' => '2022-04-22 12:21:03',
            ),
            180 => 
            array (
                'id' => 181,
                'nco_group_id' => 51,
                'name' => 'Administrative and Executive Secretaries',
                'code' => '1243',
                'created_at' => '2022-04-22 12:21:03',
                'updated_at' => '2022-04-22 12:21:03',
            ),
            181 => 
            array (
                'id' => 182,
                'nco_group_id' => 51,
                'name' => 'Medical Secretaries',
                'code' => '1244',
                'created_at' => '2022-04-22 12:21:03',
                'updated_at' => '2022-04-22 12:21:03',
            ),
            182 => 
            array (
                'id' => 183,
                'nco_group_id' => 52,
                'name' => 'Customs and Border Inspectors',
                'code' => '1244',
                'created_at' => '2022-04-22 12:21:27',
                'updated_at' => '2022-04-22 12:21:27',
            ),
            183 => 
            array (
                'id' => 184,
                'nco_group_id' => 52,
                'name' => 'Government Tax and Excise Officials',
                'code' => '1245',
                'created_at' => '2022-04-22 12:21:27',
                'updated_at' => '2022-04-22 12:21:27',
            ),
            184 => 
            array (
                'id' => 185,
                'nco_group_id' => 52,
                'name' => 'Government Social Benefits Officials',
                'code' => '1246',
                'created_at' => '2022-04-22 12:21:27',
                'updated_at' => '2022-04-22 12:21:27',
            ),
            185 => 
            array (
                'id' => 186,
                'nco_group_id' => 52,
                'name' => 'Government Licensing Officials',
                'code' => '1247',
                'created_at' => '2022-04-22 12:21:27',
                'updated_at' => '2022-04-22 12:21:27',
            ),
            186 => 
            array (
                'id' => 187,
                'nco_group_id' => 52,
                'name' => 'Police Inspectors and Detectives',
                'code' => '1248',
                'created_at' => '2022-04-22 12:21:27',
                'updated_at' => '2022-04-22 12:21:27',
            ),
            187 => 
            array (
                'id' => 188,
                'nco_group_id' => 52,
                'name' => 'Government Regulatory Associate Professionals Not Elsewhere Classified',
                'code' => '1249',
                'created_at' => '2022-04-22 12:21:27',
                'updated_at' => '2022-04-22 12:21:27',
            ),
            188 => 
            array (
                'id' => 189,
                'nco_group_id' => 53,
                'name' => 'Legal and Related Associate Professionals',
                'code' => '1249',
                'created_at' => '2022-04-22 12:21:44',
                'updated_at' => '2022-04-22 12:21:44',
            ),
            189 => 
            array (
                'id' => 190,
                'nco_group_id' => 53,
                'name' => 'Social Work Associate Professionals',
                'code' => '1250',
                'created_at' => '2022-04-22 12:21:44',
                'updated_at' => '2022-04-22 12:21:44',
            ),
            190 => 
            array (
                'id' => 191,
                'nco_group_id' => 53,
                'name' => 'Religious Associate Professionals',
                'code' => '1251',
                'created_at' => '2022-04-22 12:21:44',
                'updated_at' => '2022-04-22 12:21:44',
            ),
            191 => 
            array (
                'id' => 192,
                'nco_group_id' => 54,
                'name' => 'Athletes and Sports Players',
                'code' => '1251',
                'created_at' => '2022-04-22 12:21:58',
                'updated_at' => '2022-04-22 12:21:58',
            ),
            192 => 
            array (
                'id' => 193,
                'nco_group_id' => 54,
                'name' => 'Sports Coaches, Instructors and Officials',
                'code' => '1252',
                'created_at' => '2022-04-22 12:21:58',
                'updated_at' => '2022-04-22 12:21:58',
            ),
            193 => 
            array (
                'id' => 194,
                'nco_group_id' => 54,
                'name' => 'Fitness and Recreation Instructors, and Programme Leaders',
                'code' => '1253',
                'created_at' => '2022-04-22 12:21:58',
                'updated_at' => '2022-04-22 12:21:58',
            ),
            194 => 
            array (
                'id' => 195,
                'nco_group_id' => 55,
                'name' => 'Photographers',
                'code' => '1253',
                'created_at' => '2022-04-22 12:22:17',
                'updated_at' => '2022-04-22 12:22:17',
            ),
            195 => 
            array (
                'id' => 196,
                'nco_group_id' => 55,
                'name' => 'Interior Designers',
                'code' => '1254',
                'created_at' => '2022-04-22 12:22:17',
                'updated_at' => '2022-04-22 12:22:17',
            ),
            196 => 
            array (
                'id' => 197,
                'nco_group_id' => 55,
                'name' => 'Gallery, Museum and Library Technicians',
                'code' => '1255',
                'created_at' => '2022-04-22 12:22:17',
                'updated_at' => '2022-04-22 12:22:17',
            ),
            197 => 
            array (
                'id' => 198,
                'nco_group_id' => 55,
                'name' => 'Chefs',
                'code' => '1256',
                'created_at' => '2022-04-22 12:22:17',
                'updated_at' => '2022-04-22 12:22:17',
            ),
            198 => 
            array (
                'id' => 199,
                'nco_group_id' => 55,
                'name' => 'Other Artistic and Cultural Associate Professionals',
                'code' => '1257',
                'created_at' => '2022-04-22 12:22:17',
                'updated_at' => '2022-04-22 12:22:17',
            ),
            199 => 
            array (
                'id' => 200,
                'nco_group_id' => 56,
                'name' => 'Information and Communication Technology Operations Technicians',
                'code' => '1257',
                'created_at' => '2022-04-22 12:22:48',
                'updated_at' => '2022-04-22 12:22:48',
            ),
            200 => 
            array (
                'id' => 201,
                'nco_group_id' => 56,
                'name' => 'Information and Communication Technology User Support Technicians',
                'code' => '1258',
                'created_at' => '2022-04-22 12:22:48',
                'updated_at' => '2022-04-22 12:22:48',
            ),
            201 => 
            array (
                'id' => 202,
                'nco_group_id' => 56,
                'name' => 'Computer Network and Systems Technician',
                'code' => '1259',
                'created_at' => '2022-04-22 12:22:48',
                'updated_at' => '2022-04-22 12:22:48',
            ),
            202 => 
            array (
                'id' => 203,
                'nco_group_id' => 56,
                'name' => 'Web Technician',
                'code' => '1260',
                'created_at' => '2022-04-22 12:22:48',
                'updated_at' => '2022-04-22 12:22:48',
            ),
            203 => 
            array (
                'id' => 204,
                'nco_group_id' => 57,
                'name' => 'Broadcasting and Audiovisual Technicians',
                'code' => '1260',
                'created_at' => '2022-04-22 12:23:03',
                'updated_at' => '2022-04-22 12:23:03',
            ),
            204 => 
            array (
                'id' => 205,
                'nco_group_id' => 57,
                'name' => 'Telecommunication Engineering Technicians',
                'code' => '1261',
                'created_at' => '2022-04-22 12:23:03',
                'updated_at' => '2022-04-22 12:23:03',
            ),
            205 => 
            array (
                'id' => 206,
                'nco_group_id' => 58,
                'name' => 'General Office Clerks',
                'code' => '1261',
                'created_at' => '2022-04-22 12:23:12',
                'updated_at' => '2022-04-22 12:23:12',
            ),
            206 => 
            array (
                'id' => 207,
                'nco_group_id' => 59,
            'name' => 'Secretaries (General)',
                'code' => '1261',
                'created_at' => '2022-04-22 12:23:21',
                'updated_at' => '2022-04-22 12:23:21',
            ),
            207 => 
            array (
                'id' => 208,
                'nco_group_id' => 60,
                'name' => 'Typists and Word Processing Operators',
                'code' => '1261',
                'created_at' => '2022-04-22 12:23:34',
                'updated_at' => '2022-04-22 12:23:34',
            ),
            208 => 
            array (
                'id' => 209,
                'nco_group_id' => 60,
                'name' => 'Data Entry Clerks',
                'code' => '1262',
                'created_at' => '2022-04-22 12:23:34',
                'updated_at' => '2022-04-22 12:23:34',
            ),
            209 => 
            array (
                'id' => 210,
                'nco_group_id' => 61,
                'name' => 'Bank Tellers and Related Clerks',
                'code' => '1262',
                'created_at' => '2022-04-22 12:23:54',
                'updated_at' => '2022-04-22 12:23:54',
            ),
            210 => 
            array (
                'id' => 211,
                'nco_group_id' => 61,
                'name' => 'Bookmakers, Croupiers and Related Gaming Workers',
                'code' => '1263',
                'created_at' => '2022-04-22 12:23:54',
                'updated_at' => '2022-04-22 12:23:54',
            ),
            211 => 
            array (
                'id' => 212,
                'nco_group_id' => 61,
                'name' => 'Pawnbrokers and Moneylenders',
                'code' => '1264',
                'created_at' => '2022-04-22 12:23:54',
                'updated_at' => '2022-04-22 12:23:54',
            ),
            212 => 
            array (
                'id' => 213,
                'nco_group_id' => 61,
                'name' => 'Debt Collectors and Related Workers',
                'code' => '1265',
                'created_at' => '2022-04-22 12:23:54',
                'updated_at' => '2022-04-22 12:23:54',
            ),
            213 => 
            array (
                'id' => 214,
                'nco_group_id' => 62,
                'name' => 'Travel Consultants and Clerks',
                'code' => '1265',
                'created_at' => '2022-04-22 12:24:17',
                'updated_at' => '2022-04-22 12:24:17',
            ),
            214 => 
            array (
                'id' => 215,
                'nco_group_id' => 62,
                'name' => 'Contact Centre Information Clerks',
                'code' => '1266',
                'created_at' => '2022-04-22 12:24:17',
                'updated_at' => '2022-04-22 12:24:17',
            ),
            215 => 
            array (
                'id' => 216,
                'nco_group_id' => 62,
                'name' => 'Telephone Switchboard Operators',
                'code' => '1267',
                'created_at' => '2022-04-22 12:24:17',
                'updated_at' => '2022-04-22 12:24:17',
            ),
            216 => 
            array (
                'id' => 217,
                'nco_group_id' => 62,
                'name' => 'Hotel Receptionists',
                'code' => '1268',
                'created_at' => '2022-04-22 12:24:17',
                'updated_at' => '2022-04-22 12:24:17',
            ),
            217 => 
            array (
                'id' => 218,
                'nco_group_id' => 62,
                'name' => 'Inquiry Clerks',
                'code' => '1269',
                'created_at' => '2022-04-22 12:24:17',
                'updated_at' => '2022-04-22 12:24:17',
            ),
            218 => 
            array (
                'id' => 219,
                'nco_group_id' => 62,
            'name' => 'Receptionist (General)',
                'code' => '1270',
                'created_at' => '2022-04-22 12:24:17',
                'updated_at' => '2022-04-22 12:24:17',
            ),
            219 => 
            array (
                'id' => 220,
                'nco_group_id' => 62,
                'name' => 'Survey and Market Research Interviewers',
                'code' => '1271',
                'created_at' => '2022-04-22 12:24:17',
                'updated_at' => '2022-04-22 12:24:17',
            ),
            220 => 
            array (
                'id' => 221,
                'nco_group_id' => 62,
                'name' => 'Client Information Worker Not Elsewhere Classified',
                'code' => '1272',
                'created_at' => '2022-04-22 12:24:17',
                'updated_at' => '2022-04-22 12:24:17',
            ),
            221 => 
            array (
                'id' => 222,
                'nco_group_id' => 63,
                'name' => 'Accounting and Bookkeeping Clerks',
                'code' => '1272',
                'created_at' => '2022-04-22 12:24:31',
                'updated_at' => '2022-04-22 12:24:31',
            ),
            222 => 
            array (
                'id' => 223,
                'nco_group_id' => 63,
                'name' => 'Statistical Finance and Insurance Clerks',
                'code' => '1273',
                'created_at' => '2022-04-22 12:24:31',
                'updated_at' => '2022-04-22 12:24:31',
            ),
            223 => 
            array (
                'id' => 224,
                'nco_group_id' => 63,
                'name' => 'Payroll Clerks',
                'code' => '1274',
                'created_at' => '2022-04-22 12:24:31',
                'updated_at' => '2022-04-22 12:24:31',
            ),
            224 => 
            array (
                'id' => 225,
                'nco_group_id' => 64,
                'name' => 'Stock Clerks',
                'code' => '1274',
                'created_at' => '2022-04-22 12:24:52',
                'updated_at' => '2022-04-22 12:24:52',
            ),
            225 => 
            array (
                'id' => 226,
                'nco_group_id' => 64,
                'name' => 'Production Clerks',
                'code' => '1275',
                'created_at' => '2022-04-22 12:24:52',
                'updated_at' => '2022-04-22 12:24:52',
            ),
            226 => 
            array (
                'id' => 227,
                'nco_group_id' => 64,
                'name' => 'Transport Clerks',
                'code' => '1276',
                'created_at' => '2022-04-22 12:24:52',
                'updated_at' => '2022-04-22 12:24:52',
            ),
            227 => 
            array (
                'id' => 228,
                'nco_group_id' => 65,
                'name' => 'Library Clerks',
                'code' => '1276',
                'created_at' => '2022-04-22 12:25:30',
                'updated_at' => '2022-04-22 12:25:30',
            ),
            228 => 
            array (
                'id' => 229,
                'nco_group_id' => 65,
                'name' => 'Mail Carriers and Sorting Clerks',
                'code' => '1277',
                'created_at' => '2022-04-22 12:25:30',
                'updated_at' => '2022-04-22 12:25:30',
            ),
            229 => 
            array (
                'id' => 230,
                'nco_group_id' => 65,
                'name' => 'Coding, Proofreading and Related Clerks',
                'code' => '1278',
                'created_at' => '2022-04-22 12:25:30',
                'updated_at' => '2022-04-22 12:25:30',
            ),
            230 => 
            array (
                'id' => 231,
                'nco_group_id' => 65,
                'name' => 'Scribes and Related Clerks',
                'code' => '1279',
                'created_at' => '2022-04-22 12:25:30',
                'updated_at' => '2022-04-22 12:25:30',
            ),
            231 => 
            array (
                'id' => 232,
                'nco_group_id' => 65,
                'name' => 'Filing and Copying Clerks',
                'code' => '1280',
                'created_at' => '2022-04-22 12:25:30',
                'updated_at' => '2022-04-22 12:25:30',
            ),
            232 => 
            array (
                'id' => 233,
                'nco_group_id' => 65,
                'name' => 'Personnel Clerks',
                'code' => '1281',
                'created_at' => '2022-04-22 12:25:30',
                'updated_at' => '2022-04-22 12:25:30',
            ),
            233 => 
            array (
                'id' => 234,
                'nco_group_id' => 65,
                'name' => 'Clerical Support Workers Not Elsewhere Classified',
                'code' => '1282',
                'created_at' => '2022-04-22 12:25:30',
                'updated_at' => '2022-04-22 12:25:30',
            ),
            234 => 
            array (
                'id' => 235,
                'nco_group_id' => 66,
                'name' => 'Travel Attendants and Travel Stewards',
                'code' => '1282',
                'created_at' => '2022-04-22 12:25:57',
                'updated_at' => '2022-04-22 12:25:57',
            ),
            235 => 
            array (
                'id' => 236,
                'nco_group_id' => 66,
                'name' => 'Transport Conductors',
                'code' => '1283',
                'created_at' => '2022-04-22 12:25:57',
                'updated_at' => '2022-04-22 12:25:57',
            ),
            236 => 
            array (
                'id' => 237,
                'nco_group_id' => 66,
                'name' => 'Travel Guides',
                'code' => '1284',
                'created_at' => '2022-04-22 12:25:57',
                'updated_at' => '2022-04-22 12:25:57',
            ),
            237 => 
            array (
                'id' => 238,
                'nco_group_id' => 67,
                'name' => 'Cooks',
                'code' => '1284',
                'created_at' => '2022-04-22 12:26:05',
                'updated_at' => '2022-04-22 12:26:05',
            ),
            238 => 
            array (
                'id' => 239,
                'nco_group_id' => 68,
                'name' => 'Waiters',
                'code' => '1284',
                'created_at' => '2022-04-22 12:26:15',
                'updated_at' => '2022-04-22 12:26:15',
            ),
            239 => 
            array (
                'id' => 240,
                'nco_group_id' => 68,
                'name' => 'Bartenders',
                'code' => '1285',
                'created_at' => '2022-04-22 12:26:15',
                'updated_at' => '2022-04-22 12:26:15',
            ),
            240 => 
            array (
                'id' => 241,
                'nco_group_id' => 69,
                'name' => 'Hairdressers',
                'code' => '1285',
                'created_at' => '2022-04-22 12:26:26',
                'updated_at' => '2022-04-22 12:26:26',
            ),
            241 => 
            array (
                'id' => 242,
                'nco_group_id' => 69,
                'name' => 'Beauticians and Related Workers',
                'code' => '1286',
                'created_at' => '2022-04-22 12:26:26',
                'updated_at' => '2022-04-22 12:26:26',
            ),
            242 => 
            array (
                'id' => 243,
                'nco_group_id' => 70,
                'name' => 'Cleaning and Housekeeping Supervisors in Offices, Hotels and Other Establishments',
                'code' => '1286',
                'created_at' => '2022-04-22 12:26:39',
                'updated_at' => '2022-04-22 12:26:39',
            ),
            243 => 
            array (
                'id' => 244,
                'nco_group_id' => 70,
                'name' => 'Domestic Housekeepers',
                'code' => '1287',
                'created_at' => '2022-04-22 12:26:39',
                'updated_at' => '2022-04-22 12:26:39',
            ),
            244 => 
            array (
                'id' => 245,
                'nco_group_id' => 70,
                'name' => 'Building Caretakers',
                'code' => '1288',
                'created_at' => '2022-04-22 12:26:39',
                'updated_at' => '2022-04-22 12:26:39',
            ),
            245 => 
            array (
                'id' => 246,
                'nco_group_id' => 71,
                'name' => 'Astrologers, Fortune Tellers and Related Workers',
                'code' => '1288',
                'created_at' => '2022-04-22 12:27:02',
                'updated_at' => '2022-04-22 12:27:02',
            ),
            246 => 
            array (
                'id' => 247,
                'nco_group_id' => 71,
                'name' => 'Companions and Valets',
                'code' => '1289',
                'created_at' => '2022-04-22 12:27:02',
                'updated_at' => '2022-04-22 12:27:02',
            ),
            247 => 
            array (
                'id' => 248,
                'nco_group_id' => 71,
                'name' => 'Undertakers and Embalmers',
                'code' => '1290',
                'created_at' => '2022-04-22 12:27:02',
                'updated_at' => '2022-04-22 12:27:02',
            ),
            248 => 
            array (
                'id' => 249,
                'nco_group_id' => 71,
                'name' => 'Pet Groomers and Animal Care Workers',
                'code' => '1291',
                'created_at' => '2022-04-22 12:27:02',
                'updated_at' => '2022-04-22 12:27:02',
            ),
            249 => 
            array (
                'id' => 250,
                'nco_group_id' => 71,
                'name' => 'Driving Instructors',
                'code' => '1292',
                'created_at' => '2022-04-22 12:27:02',
                'updated_at' => '2022-04-22 12:27:02',
            ),
            250 => 
            array (
                'id' => 251,
                'nco_group_id' => 71,
                'name' => 'Personal Service Workers Not Elsewhere Classified',
                'code' => '1293',
                'created_at' => '2022-04-22 12:27:02',
                'updated_at' => '2022-04-22 12:27:02',
            ),
            251 => 
            array (
                'id' => 252,
                'nco_group_id' => 72,
                'name' => 'Stall and Market Salespersons',
                'code' => '1293',
                'created_at' => '2022-04-22 12:27:13',
                'updated_at' => '2022-04-22 12:27:13',
            ),
            252 => 
            array (
                'id' => 253,
                'nco_group_id' => 72,
                'name' => 'Street Food Salespersons',
                'code' => '1294',
                'created_at' => '2022-04-22 12:27:13',
                'updated_at' => '2022-04-22 12:27:13',
            ),
            253 => 
            array (
                'id' => 254,
                'nco_group_id' => 73,
                'name' => 'Shopkeepers',
                'code' => '1294',
                'created_at' => '2022-04-22 12:27:25',
                'updated_at' => '2022-04-22 12:27:25',
            ),
            254 => 
            array (
                'id' => 255,
                'nco_group_id' => 73,
                'name' => 'Shop Supervisors',
                'code' => '1295',
                'created_at' => '2022-04-22 12:27:25',
                'updated_at' => '2022-04-22 12:27:25',
            ),
            255 => 
            array (
                'id' => 256,
                'nco_group_id' => 73,
                'name' => 'Shop Sales Assistants',
                'code' => '1296',
                'created_at' => '2022-04-22 12:27:25',
                'updated_at' => '2022-04-22 12:27:25',
            ),
            256 => 
            array (
                'id' => 257,
                'nco_group_id' => 74,
                'name' => 'Cashiers and Ticket Clerks',
                'code' => '1296',
                'created_at' => '2022-04-22 12:27:35',
                'updated_at' => '2022-04-22 12:27:35',
            ),
            257 => 
            array (
                'id' => 258,
                'nco_group_id' => 75,
                'name' => 'Fashion and Other Models',
                'code' => '1296',
                'created_at' => '2022-04-22 12:27:53',
                'updated_at' => '2022-04-22 12:27:53',
            ),
            258 => 
            array (
                'id' => 259,
                'nco_group_id' => 75,
                'name' => 'Sales Demonstrators',
                'code' => '1297',
                'created_at' => '2022-04-22 12:27:53',
                'updated_at' => '2022-04-22 12:27:53',
            ),
            259 => 
            array (
                'id' => 260,
                'nco_group_id' => 75,
                'name' => 'Door-to-Door Salespersons',
                'code' => '1298',
                'created_at' => '2022-04-22 12:27:53',
                'updated_at' => '2022-04-22 12:27:53',
            ),
            260 => 
            array (
                'id' => 261,
                'nco_group_id' => 75,
                'name' => 'Contact Centre Salespersons',
                'code' => '1299',
                'created_at' => '2022-04-22 12:27:53',
                'updated_at' => '2022-04-22 12:27:53',
            ),
            261 => 
            array (
                'id' => 262,
                'nco_group_id' => 75,
                'name' => 'Service Station Attendants',
                'code' => '1300',
                'created_at' => '2022-04-22 12:27:53',
                'updated_at' => '2022-04-22 12:27:53',
            ),
            262 => 
            array (
                'id' => 263,
                'nco_group_id' => 75,
                'name' => 'Food Service Counter Attendants',
                'code' => '1301',
                'created_at' => '2022-04-22 12:27:53',
                'updated_at' => '2022-04-22 12:27:53',
            ),
            263 => 
            array (
                'id' => 264,
                'nco_group_id' => 75,
                'name' => 'Sales Workers Not Elsewhere Classified',
                'code' => '1302',
                'created_at' => '2022-04-22 12:27:53',
                'updated_at' => '2022-04-22 12:27:53',
            ),
            264 => 
            array (
                'id' => 265,
                'nco_group_id' => 76,
                'name' => 'Child Care Workers',
                'code' => '1302',
                'created_at' => '2022-04-22 12:28:09',
                'updated_at' => '2022-04-22 12:28:09',
            ),
            265 => 
            array (
                'id' => 266,
                'nco_group_id' => 76,
                'name' => 'Teachers\' Aides',
                'code' => '1303',
                'created_at' => '2022-04-22 12:28:09',
                'updated_at' => '2022-04-22 12:28:09',
            ),
            266 => 
            array (
                'id' => 267,
                'nco_group_id' => 77,
                'name' => 'Healthcare Assistants',
                'code' => '1303',
                'created_at' => '2022-04-22 12:28:25',
                'updated_at' => '2022-04-22 12:28:25',
            ),
            267 => 
            array (
                'id' => 268,
                'nco_group_id' => 77,
                'name' => 'Home-Based Personal Care Workers',
                'code' => '1304',
                'created_at' => '2022-04-22 12:28:25',
                'updated_at' => '2022-04-22 12:28:25',
            ),
            268 => 
            array (
                'id' => 269,
                'nco_group_id' => 77,
                'name' => 'Personal Care Workers in Health Services Not Elsewhere Classified',
                'code' => '1305',
                'created_at' => '2022-04-22 12:28:25',
                'updated_at' => '2022-04-22 12:28:25',
            ),
            269 => 
            array (
                'id' => 270,
                'nco_group_id' => 78,
                'name' => 'Fire Fighters',
                'code' => '1305',
                'created_at' => '2022-04-22 12:28:40',
                'updated_at' => '2022-04-22 12:28:40',
            ),
            270 => 
            array (
                'id' => 271,
                'nco_group_id' => 78,
                'name' => 'Police Officers',
                'code' => '1306',
                'created_at' => '2022-04-22 12:28:40',
                'updated_at' => '2022-04-22 12:28:40',
            ),
            271 => 
            array (
                'id' => 272,
                'nco_group_id' => 78,
                'name' => 'Prison Guards',
                'code' => '1307',
                'created_at' => '2022-04-22 12:28:40',
                'updated_at' => '2022-04-22 12:28:40',
            ),
            272 => 
            array (
                'id' => 273,
                'nco_group_id' => 78,
                'name' => 'Security Guards',
                'code' => '1308',
                'created_at' => '2022-04-22 12:28:40',
                'updated_at' => '2022-04-22 12:28:40',
            ),
            273 => 
            array (
                'id' => 274,
                'nco_group_id' => 78,
                'name' => 'Protective Services Workers Not Elsewhere Classified',
                'code' => '1309',
                'created_at' => '2022-04-22 12:28:40',
                'updated_at' => '2022-04-22 12:28:40',
            ),
            274 => 
            array (
                'id' => 275,
                'nco_group_id' => 79,
                'name' => 'Field Crop and Vegetable Growers',
                'code' => '1309',
                'created_at' => '2022-04-22 12:29:02',
                'updated_at' => '2022-04-22 12:29:02',
            ),
            275 => 
            array (
                'id' => 276,
                'nco_group_id' => 79,
                'name' => 'Tree and Shrub Crop Growers',
                'code' => '1310',
                'created_at' => '2022-04-22 12:29:02',
                'updated_at' => '2022-04-22 12:29:02',
            ),
            276 => 
            array (
                'id' => 277,
                'nco_group_id' => 79,
                'name' => 'Gardeners, Horticultural and Nursery Growers',
                'code' => '1311',
                'created_at' => '2022-04-22 12:29:02',
                'updated_at' => '2022-04-22 12:29:02',
            ),
            277 => 
            array (
                'id' => 278,
                'nco_group_id' => 79,
                'name' => 'Mixed Crop Growers',
                'code' => '1312',
                'created_at' => '2022-04-22 12:29:02',
                'updated_at' => '2022-04-22 12:29:02',
            ),
            278 => 
            array (
                'id' => 279,
                'nco_group_id' => 79,
                'name' => 'Medicinal and Aromatic Plant Cultivators',
                'code' => '1313',
                'created_at' => '2022-04-22 12:29:02',
                'updated_at' => '2022-04-22 12:29:02',
            ),
            279 => 
            array (
                'id' => 280,
                'nco_group_id' => 79,
                'name' => 'Agriculture Information Management',
                'code' => '1314',
                'created_at' => '2022-04-22 12:29:02',
                'updated_at' => '2022-04-22 12:29:02',
            ),
            280 => 
            array (
                'id' => 281,
                'nco_group_id' => 80,
                'name' => 'Livestock and Dairy Producers',
                'code' => '1314',
                'created_at' => '2022-04-22 12:29:15',
                'updated_at' => '2022-04-22 12:29:15',
            ),
            281 => 
            array (
                'id' => 282,
                'nco_group_id' => 80,
                'name' => 'Poultry Producers',
                'code' => '1315',
                'created_at' => '2022-04-22 12:29:15',
                'updated_at' => '2022-04-22 12:29:15',
            ),
            282 => 
            array (
                'id' => 283,
                'nco_group_id' => 80,
                'name' => 'Apiarists and Sericulturists',
                'code' => '1316',
                'created_at' => '2022-04-22 12:29:15',
                'updated_at' => '2022-04-22 12:29:15',
            ),
            283 => 
            array (
                'id' => 284,
                'nco_group_id' => 80,
                'name' => 'Animal Producers Not Elsewhere Classified',
                'code' => '1317',
                'created_at' => '2022-04-22 12:29:15',
                'updated_at' => '2022-04-22 12:29:15',
            ),
            284 => 
            array (
                'id' => 285,
                'nco_group_id' => 81,
                'name' => 'Mixed Crop and Animal Workers',
                'code' => '1317',
                'created_at' => '2022-04-22 12:29:24',
                'updated_at' => '2022-04-22 12:29:24',
            ),
            285 => 
            array (
                'id' => 286,
                'nco_group_id' => 82,
                'name' => 'Forestry and Related Workers',
                'code' => '1317',
                'created_at' => '2022-04-22 12:29:34',
                'updated_at' => '2022-04-22 12:29:34',
            ),
            286 => 
            array (
                'id' => 287,
                'nco_group_id' => 83,
                'name' => 'Aquaculture Workers',
                'code' => '1317',
                'created_at' => '2022-04-22 12:29:50',
                'updated_at' => '2022-04-22 12:29:50',
            ),
            287 => 
            array (
                'id' => 288,
                'nco_group_id' => 83,
                'name' => 'Inland and Coastal Waters Fishery Workers',
                'code' => '1318',
                'created_at' => '2022-04-22 12:29:50',
                'updated_at' => '2022-04-22 12:29:50',
            ),
            288 => 
            array (
                'id' => 289,
                'nco_group_id' => 83,
                'name' => 'Deep Sea Fishery Workers',
                'code' => '1319',
                'created_at' => '2022-04-22 12:29:50',
                'updated_at' => '2022-04-22 12:29:50',
            ),
            289 => 
            array (
                'id' => 290,
                'nco_group_id' => 83,
                'name' => 'Hunters and Trappers',
                'code' => '1320',
                'created_at' => '2022-04-22 12:29:50',
                'updated_at' => '2022-04-22 12:29:50',
            ),
            290 => 
            array (
                'id' => 291,
                'nco_group_id' => 84,
                'name' => 'Subsistence Crop Farmers',
                'code' => '1320',
                'created_at' => '2022-04-22 12:30:03',
                'updated_at' => '2022-04-22 12:30:03',
            ),
            291 => 
            array (
                'id' => 292,
                'nco_group_id' => 85,
                'name' => 'Subsistence Livestock Farmers',
                'code' => '1320',
                'created_at' => '2022-04-22 12:30:19',
                'updated_at' => '2022-04-22 12:30:19',
            ),
            292 => 
            array (
                'id' => 293,
                'nco_group_id' => 86,
                'name' => 'Subsistence Fishers, Hunters, Trappers and Gatherers',
                'code' => '1320',
                'created_at' => '2022-04-22 12:30:38',
                'updated_at' => '2022-04-22 12:30:38',
            ),
            293 => 
            array (
                'id' => 295,
                'nco_group_id' => 87,
                'name' => 'House Builders',
                'code' => '1321',
                'created_at' => '2022-04-22 12:31:06',
                'updated_at' => '2022-04-22 12:31:06',
            ),
            294 => 
            array (
                'id' => 296,
                'nco_group_id' => 87,
                'name' => 'Bricklayers and Related Workers',
                'code' => '1322',
                'created_at' => '2022-04-22 12:31:06',
                'updated_at' => '2022-04-22 12:31:06',
            ),
            295 => 
            array (
                'id' => 297,
                'nco_group_id' => 87,
                'name' => 'Stonemasons, Stone Cutters, Splitters and Carvers',
                'code' => '1323',
                'created_at' => '2022-04-22 12:31:06',
                'updated_at' => '2022-04-22 12:31:06',
            ),
            296 => 
            array (
                'id' => 298,
                'nco_group_id' => 87,
                'name' => 'Concrete Placers, Concrete Finishers and Related Workers',
                'code' => '1324',
                'created_at' => '2022-04-22 12:31:06',
                'updated_at' => '2022-04-22 12:31:06',
            ),
            297 => 
            array (
                'id' => 299,
                'nco_group_id' => 87,
                'name' => 'Carpenters and Joiners',
                'code' => '1325',
                'created_at' => '2022-04-22 12:31:06',
                'updated_at' => '2022-04-22 12:31:06',
            ),
            298 => 
            array (
                'id' => 300,
                'nco_group_id' => 87,
                'name' => 'Building Frame and Related Traders',
                'code' => '1326',
                'created_at' => '2022-04-22 12:31:06',
                'updated_at' => '2022-04-22 12:31:06',
            ),
            299 => 
            array (
                'id' => 301,
                'nco_group_id' => 88,
                'name' => 'Roofers',
                'code' => '1326',
                'created_at' => '2022-04-22 12:31:30',
                'updated_at' => '2022-04-22 12:31:30',
            ),
            300 => 
            array (
                'id' => 302,
                'nco_group_id' => 88,
                'name' => 'Floor Layers and Tile Setters',
                'code' => '1327',
                'created_at' => '2022-04-22 12:31:30',
                'updated_at' => '2022-04-22 12:31:30',
            ),
            301 => 
            array (
                'id' => 303,
                'nco_group_id' => 88,
                'name' => 'Plasterers',
                'code' => '1328',
                'created_at' => '2022-04-22 12:31:30',
                'updated_at' => '2022-04-22 12:31:30',
            ),
            302 => 
            array (
                'id' => 304,
                'nco_group_id' => 88,
                'name' => 'Insulation Workers',
                'code' => '1329',
                'created_at' => '2022-04-22 12:31:30',
                'updated_at' => '2022-04-22 12:31:30',
            ),
            303 => 
            array (
                'id' => 305,
                'nco_group_id' => 88,
                'name' => 'Glaziers',
                'code' => '1330',
                'created_at' => '2022-04-22 12:31:30',
                'updated_at' => '2022-04-22 12:31:30',
            ),
            304 => 
            array (
                'id' => 306,
                'nco_group_id' => 88,
                'name' => 'Plumbers and Pipe Fitters',
                'code' => '1331',
                'created_at' => '2022-04-22 12:31:30',
                'updated_at' => '2022-04-22 12:31:30',
            ),
            305 => 
            array (
                'id' => 307,
                'nco_group_id' => 88,
                'name' => 'Air-Conditioning and Refrigeration Mechanics',
                'code' => '1332',
                'created_at' => '2022-04-22 12:31:30',
                'updated_at' => '2022-04-22 12:31:30',
            ),
            306 => 
            array (
                'id' => 308,
                'nco_group_id' => 89,
                'name' => 'Painters and Related Workers',
                'code' => '1332',
                'created_at' => '2022-04-22 12:31:45',
                'updated_at' => '2022-04-22 12:31:45',
            ),
            307 => 
            array (
                'id' => 309,
                'nco_group_id' => 89,
                'name' => 'Spray Painters and Varnishers',
                'code' => '1333',
                'created_at' => '2022-04-22 12:31:45',
                'updated_at' => '2022-04-22 12:31:45',
            ),
            308 => 
            array (
                'id' => 310,
                'nco_group_id' => 89,
                'name' => 'Building Structure Cleaners',
                'code' => '1334',
                'created_at' => '2022-04-22 12:31:45',
                'updated_at' => '2022-04-22 12:31:45',
            ),
            309 => 
            array (
                'id' => 311,
                'nco_group_id' => 90,
                'name' => 'Metal Moulders and Core Makers',
                'code' => '1334',
                'created_at' => '2022-04-22 12:32:02',
                'updated_at' => '2022-04-22 12:32:02',
            ),
            310 => 
            array (
                'id' => 312,
                'nco_group_id' => 90,
                'name' => 'Welders and Flame Cutters',
                'code' => '1335',
                'created_at' => '2022-04-22 12:32:02',
                'updated_at' => '2022-04-22 12:32:02',
            ),
            311 => 
            array (
                'id' => 313,
                'nco_group_id' => 90,
                'name' => 'Sheet Metal Workers',
                'code' => '1336',
                'created_at' => '2022-04-22 12:32:02',
                'updated_at' => '2022-04-22 12:32:02',
            ),
            312 => 
            array (
                'id' => 314,
                'nco_group_id' => 90,
                'name' => 'Structural Metal Preparers and Erectors',
                'code' => '1337',
                'created_at' => '2022-04-22 12:32:02',
                'updated_at' => '2022-04-22 12:32:02',
            ),
            313 => 
            array (
                'id' => 315,
                'nco_group_id' => 90,
                'name' => 'Riggers and Cable Splicers',
                'code' => '1338',
                'created_at' => '2022-04-22 12:32:02',
                'updated_at' => '2022-04-22 12:32:02',
            ),
            314 => 
            array (
                'id' => 316,
                'nco_group_id' => 91,
                'name' => 'Blacksmiths, Hammersmith and Forging Press Workers',
                'code' => '1338',
                'created_at' => '2022-04-22 12:32:24',
                'updated_at' => '2022-04-22 12:32:24',
            ),
            315 => 
            array (
                'id' => 317,
                'nco_group_id' => 91,
                'name' => 'Marker, Metal',
                'code' => '1339',
                'created_at' => '2022-04-22 12:32:24',
                'updated_at' => '2022-04-22 12:32:24',
            ),
            316 => 
            array (
                'id' => 318,
                'nco_group_id' => 91,
                'name' => 'Metal Working Machine Tool Setters and Operators',
                'code' => '1340',
                'created_at' => '2022-04-22 12:32:24',
                'updated_at' => '2022-04-22 12:32:24',
            ),
            317 => 
            array (
                'id' => 319,
                'nco_group_id' => 91,
                'name' => 'Metal Polishers, Wheel Grinders and Tool Sharpeners',
                'code' => '1341',
                'created_at' => '2022-04-22 12:32:24',
                'updated_at' => '2022-04-22 12:32:24',
            ),
            318 => 
            array (
                'id' => 320,
                'nco_group_id' => 92,
                'name' => 'Motor Vehicle Mechanics and Repairers',
                'code' => '1341',
                'created_at' => '2022-04-22 12:32:50',
                'updated_at' => '2022-04-22 12:32:50',
            ),
            319 => 
            array (
                'id' => 321,
                'nco_group_id' => 92,
                'name' => 'Aircraft Engine Mechanics and Repairers',
                'code' => '1342',
                'created_at' => '2022-04-22 12:32:50',
                'updated_at' => '2022-04-22 12:32:50',
            ),
            320 => 
            array (
                'id' => 322,
                'nco_group_id' => 92,
                'name' => 'Agricultural and Industrial Machinery Mechanics and Repairers',
                'code' => '1343',
                'created_at' => '2022-04-22 12:32:50',
                'updated_at' => '2022-04-22 12:32:50',
            ),
            321 => 
            array (
                'id' => 323,
                'nco_group_id' => 92,
                'name' => 'Bicycle and Related Repairers',
                'code' => '1344',
                'created_at' => '2022-04-22 12:32:50',
                'updated_at' => '2022-04-22 12:32:50',
            ),
            322 => 
            array (
                'id' => 324,
                'nco_group_id' => 93,
                'name' => 'Precision Instrument Makers and Repairers',
                'code' => '1344',
                'created_at' => '2022-04-22 12:33:21',
                'updated_at' => '2022-04-22 12:33:21',
            ),
            323 => 
            array (
                'id' => 325,
                'nco_group_id' => 93,
                'name' => 'Musical Instrument Makers and Tuners',
                'code' => '1345',
                'created_at' => '2022-04-22 12:33:21',
                'updated_at' => '2022-04-22 12:33:21',
            ),
            324 => 
            array (
                'id' => 326,
                'nco_group_id' => 93,
                'name' => 'Jewellery and Precision Metal Workers',
                'code' => '1346',
                'created_at' => '2022-04-22 12:33:21',
                'updated_at' => '2022-04-22 12:33:21',
            ),
            325 => 
            array (
                'id' => 327,
                'nco_group_id' => 93,
                'name' => 'Potters and Related Workers',
                'code' => '1347',
                'created_at' => '2022-04-22 12:33:21',
                'updated_at' => '2022-04-22 12:33:21',
            ),
            326 => 
            array (
                'id' => 328,
                'nco_group_id' => 93,
                'name' => 'Glass Makers, Cutters, Grinders and Finishers',
                'code' => '1348',
                'created_at' => '2022-04-22 12:33:21',
                'updated_at' => '2022-04-22 12:33:21',
            ),
            327 => 
            array (
                'id' => 329,
                'nco_group_id' => 93,
                'name' => 'Signwriter, Decorative Painters, Engravers and Etchers',
                'code' => '1349',
                'created_at' => '2022-04-22 12:33:21',
                'updated_at' => '2022-04-22 12:33:21',
            ),
            328 => 
            array (
                'id' => 330,
                'nco_group_id' => 93,
                'name' => 'Handicraft Workers in Wood, Basketry and Related Materials',
                'code' => '1350',
                'created_at' => '2022-04-22 12:33:21',
                'updated_at' => '2022-04-22 12:33:21',
            ),
            329 => 
            array (
                'id' => 331,
                'nco_group_id' => 93,
                'name' => 'Handicraft Workers in Textiles, Leather and Related Materials',
                'code' => '1351',
                'created_at' => '2022-04-22 12:33:21',
                'updated_at' => '2022-04-22 12:33:21',
            ),
            330 => 
            array (
                'id' => 332,
                'nco_group_id' => 93,
                'name' => 'Handicrafts Workers Not Elsewhere Classified',
                'code' => '1352',
                'created_at' => '2022-04-22 12:33:21',
                'updated_at' => '2022-04-22 12:33:21',
            ),
            331 => 
            array (
                'id' => 333,
                'nco_group_id' => 94,
                'name' => 'Pre-Press Technicians',
                'code' => '1352',
                'created_at' => '2022-04-22 12:33:35',
                'updated_at' => '2022-04-22 12:33:35',
            ),
            332 => 
            array (
                'id' => 334,
                'nco_group_id' => 94,
                'name' => 'Printers',
                'code' => '1353',
                'created_at' => '2022-04-22 12:33:35',
                'updated_at' => '2022-04-22 12:33:35',
            ),
            333 => 
            array (
                'id' => 335,
                'nco_group_id' => 94,
                'name' => 'Print Finishing and Binding Workers',
                'code' => '1354',
                'created_at' => '2022-04-22 12:33:35',
                'updated_at' => '2022-04-22 12:33:35',
            ),
            334 => 
            array (
                'id' => 336,
                'nco_group_id' => 95,
                'name' => 'Building and Related Electricians',
                'code' => '1354',
                'created_at' => '2022-04-22 12:33:56',
                'updated_at' => '2022-04-22 12:33:56',
            ),
            335 => 
            array (
                'id' => 337,
                'nco_group_id' => 95,
                'name' => 'Electrical Mechanics and Fitters',
                'code' => '1355',
                'created_at' => '2022-04-22 12:33:56',
                'updated_at' => '2022-04-22 12:33:56',
            ),
            336 => 
            array (
                'id' => 338,
                'nco_group_id' => 95,
                'name' => 'Electrical Line Installers and Repairers',
                'code' => '1356',
                'created_at' => '2022-04-22 12:33:56',
                'updated_at' => '2022-04-22 12:33:56',
            ),
            337 => 
            array (
                'id' => 339,
                'nco_group_id' => 95,
                'name' => 'Electrical and Electronic Equipment Mechanics and Fitters and Related Workers Not Elsewhere Classified',
                'code' => '1357',
                'created_at' => '2022-04-22 12:33:56',
                'updated_at' => '2022-04-22 12:33:56',
            ),
            338 => 
            array (
                'id' => 340,
                'nco_group_id' => 96,
                'name' => 'Electronic Mechanics and Servicers',
                'code' => '1357',
                'created_at' => '2022-04-22 12:34:26',
                'updated_at' => '2022-04-22 12:34:26',
            ),
            339 => 
            array (
                'id' => 341,
                'nco_group_id' => 96,
                'name' => 'Information and Communications Technology Installers and Servicers',
                'code' => '1358',
                'created_at' => '2022-04-22 12:34:26',
                'updated_at' => '2022-04-22 12:34:26',
            ),
            340 => 
            array (
                'id' => 342,
                'nco_group_id' => 97,
                'name' => 'Butchers, Fishmongers and Related Food Preparers',
                'code' => '1358',
                'created_at' => '2022-04-22 12:34:43',
                'updated_at' => '2022-04-22 12:34:43',
            ),
            341 => 
            array (
                'id' => 343,
                'nco_group_id' => 97,
                'name' => 'Bakers, Pastry Cooks and Confectionery Makers',
                'code' => '1359',
                'created_at' => '2022-04-22 12:34:43',
                'updated_at' => '2022-04-22 12:34:43',
            ),
            342 => 
            array (
                'id' => 344,
                'nco_group_id' => 97,
                'name' => 'Dairy Products Makers',
                'code' => '1360',
                'created_at' => '2022-04-22 12:34:43',
                'updated_at' => '2022-04-22 12:34:43',
            ),
            343 => 
            array (
                'id' => 345,
                'nco_group_id' => 97,
                'name' => 'Fruits, Vegetables and Related Preservers',
                'code' => '1361',
                'created_at' => '2022-04-22 12:34:43',
                'updated_at' => '2022-04-22 12:34:43',
            ),
            344 => 
            array (
                'id' => 346,
                'nco_group_id' => 97,
                'name' => 'Food and Beverage Tasters and Graders',
                'code' => '1362',
                'created_at' => '2022-04-22 12:34:43',
                'updated_at' => '2022-04-22 12:34:43',
            ),
            345 => 
            array (
                'id' => 347,
                'nco_group_id' => 97,
                'name' => 'Tobacco Preparers and Tobacco Products',
                'code' => '1363',
                'created_at' => '2022-04-22 12:34:43',
                'updated_at' => '2022-04-22 12:34:43',
            ),
            346 => 
            array (
                'id' => 348,
                'nco_group_id' => 98,
                'name' => 'Wood Treaters',
                'code' => '1363',
                'created_at' => '2022-04-22 12:34:58',
                'updated_at' => '2022-04-22 12:34:58',
            ),
            347 => 
            array (
                'id' => 349,
                'nco_group_id' => 98,
                'name' => 'Cabinet Makers and Related Workers',
                'code' => '1364',
                'created_at' => '2022-04-22 12:34:58',
                'updated_at' => '2022-04-22 12:34:58',
            ),
            348 => 
            array (
                'id' => 350,
                'nco_group_id' => 98,
                'name' => 'Wood Working Machine Tool Setters and Operators',
                'code' => '1365',
                'created_at' => '2022-04-22 12:34:58',
                'updated_at' => '2022-04-22 12:34:58',
            ),
            349 => 
            array (
                'id' => 351,
                'nco_group_id' => 99,
                'name' => 'Tailors, Dressmakers, Furriers and Hatters',
                'code' => '1365',
                'created_at' => '2022-04-22 12:35:29',
                'updated_at' => '2022-04-22 12:35:29',
            ),
            350 => 
            array (
                'id' => 352,
                'nco_group_id' => 99,
                'name' => 'Garment and Related Pattern Makers and Cutters',
                'code' => '1366',
                'created_at' => '2022-04-22 12:35:29',
                'updated_at' => '2022-04-22 12:35:29',
            ),
            351 => 
            array (
                'id' => 353,
                'nco_group_id' => 99,
                'name' => 'Sewing, Embroiderers and Related Workers',
                'code' => '1367',
                'created_at' => '2022-04-22 12:35:29',
                'updated_at' => '2022-04-22 12:35:29',
            ),
            352 => 
            array (
                'id' => 354,
                'nco_group_id' => 99,
                'name' => 'Upholsterers and Related Workers',
                'code' => '1368',
                'created_at' => '2022-04-22 12:35:29',
                'updated_at' => '2022-04-22 12:35:29',
            ),
            353 => 
            array (
                'id' => 355,
                'nco_group_id' => 99,
                'name' => 'Pelt Dressers, Tanners and Fellmongers',
                'code' => '1369',
                'created_at' => '2022-04-22 12:35:29',
                'updated_at' => '2022-04-22 12:35:29',
            ),
            354 => 
            array (
                'id' => 356,
                'nco_group_id' => 99,
                'name' => 'Shoemakers and Related Workers',
                'code' => '1370',
                'created_at' => '2022-04-22 12:35:29',
                'updated_at' => '2022-04-22 12:35:29',
            ),
            355 => 
            array (
                'id' => 357,
                'nco_group_id' => 100,
                'name' => 'Underwater Divers',
                'code' => '1370',
                'created_at' => '2022-04-22 12:36:31',
                'updated_at' => '2022-04-22 12:36:31',
            ),
            356 => 
            array (
                'id' => 358,
                'nco_group_id' => 100,
                'name' => 'Shotfirers and Blasters',
                'code' => '1371',
                'created_at' => '2022-04-22 12:36:31',
                'updated_at' => '2022-04-22 12:36:31',
            ),
            357 => 
            array (
                'id' => 359,
                'nco_group_id' => 100,
            'name' => 'Product Graders and Testers (Excluding Food and Beverages)',
                'code' => '1372',
                'created_at' => '2022-04-22 12:36:31',
                'updated_at' => '2022-04-22 12:36:31',
            ),
            358 => 
            array (
                'id' => 360,
                'nco_group_id' => 100,
                'name' => 'Fumigators and Other Pest and Weed Controllers',
                'code' => '1373',
                'created_at' => '2022-04-22 12:36:31',
                'updated_at' => '2022-04-22 12:36:31',
            ),
            359 => 
            array (
                'id' => 361,
                'nco_group_id' => 100,
                'name' => 'Craft and Related Workers Not Elsewhere Classified',
                'code' => '1374',
                'created_at' => '2022-04-22 12:36:31',
                'updated_at' => '2022-04-22 12:36:31',
            ),
            360 => 
            array (
                'id' => 362,
                'nco_group_id' => 101,
                'name' => 'Miners and Quarriers',
                'code' => '1374',
                'created_at' => '2022-04-22 12:37:04',
                'updated_at' => '2022-04-22 12:37:04',
            ),
            361 => 
            array (
                'id' => 363,
                'nco_group_id' => 101,
                'name' => 'Crusher Operator, Mineral',
                'code' => '1375',
                'created_at' => '2022-04-22 12:37:04',
                'updated_at' => '2022-04-22 12:37:04',
            ),
            362 => 
            array (
                'id' => 364,
                'nco_group_id' => 101,
                'name' => 'Well Drillers and Borers and Related Workers',
                'code' => '1376',
                'created_at' => '2022-04-22 12:37:04',
                'updated_at' => '2022-04-22 12:37:04',
            ),
            363 => 
            array (
                'id' => 365,
                'nco_group_id' => 101,
                'name' => 'Cement, Stone and Other Mineral Products Machine Operators',
                'code' => '1377',
                'created_at' => '2022-04-22 12:37:04',
                'updated_at' => '2022-04-22 12:37:04',
            ),
            364 => 
            array (
                'id' => 366,
                'nco_group_id' => 102,
                'name' => 'Metal Processing Plant Operators',
                'code' => '1377',
                'created_at' => '2022-04-22 12:37:18',
                'updated_at' => '2022-04-22 12:37:18',
            ),
            365 => 
            array (
                'id' => 367,
                'nco_group_id' => 102,
                'name' => 'Metal Finishing, Plating and Coating Machine Operators',
                'code' => '1378',
                'created_at' => '2022-04-22 12:37:18',
                'updated_at' => '2022-04-22 12:37:18',
            ),
            366 => 
            array (
                'id' => 368,
                'nco_group_id' => 103,
                'name' => 'Chemical Products Plant and Machine Operators',
                'code' => '1378',
                'created_at' => '2022-04-22 12:37:35',
                'updated_at' => '2022-04-22 12:37:35',
            ),
            367 => 
            array (
                'id' => 369,
                'nco_group_id' => 103,
                'name' => 'Photographic Products Machine Operators',
                'code' => '1379',
                'created_at' => '2022-04-22 12:37:35',
                'updated_at' => '2022-04-22 12:37:35',
            ),
            368 => 
            array (
                'id' => 370,
                'nco_group_id' => 104,
                'name' => 'Rubber Products Machine Operators',
                'code' => '1379',
                'created_at' => '2022-04-22 12:37:48',
                'updated_at' => '2022-04-22 12:37:48',
            ),
            369 => 
            array (
                'id' => 371,
                'nco_group_id' => 104,
                'name' => 'Plastic Products Machine Operators',
                'code' => '1380',
                'created_at' => '2022-04-22 12:37:48',
                'updated_at' => '2022-04-22 12:37:48',
            ),
            370 => 
            array (
                'id' => 372,
                'nco_group_id' => 104,
                'name' => 'Paper Products Machine Operators',
                'code' => '1381',
                'created_at' => '2022-04-22 12:37:48',
                'updated_at' => '2022-04-22 12:37:48',
            ),
            371 => 
            array (
                'id' => 373,
                'nco_group_id' => 105,
                'name' => 'Fibre Preparing, Spinning and Winding Machine Operators',
                'code' => '1381',
                'created_at' => '2022-04-22 12:38:17',
                'updated_at' => '2022-04-22 12:38:17',
            ),
            372 => 
            array (
                'id' => 374,
                'nco_group_id' => 105,
                'name' => 'Weaving and Knitting Machine Operators',
                'code' => '1382',
                'created_at' => '2022-04-22 12:38:17',
                'updated_at' => '2022-04-22 12:38:17',
            ),
            373 => 
            array (
                'id' => 375,
                'nco_group_id' => 105,
                'name' => 'Sewing Machine Operators',
                'code' => '1383',
                'created_at' => '2022-04-22 12:38:17',
                'updated_at' => '2022-04-22 12:38:17',
            ),
            374 => 
            array (
                'id' => 376,
                'nco_group_id' => 105,
                'name' => 'Bleaching, Dyeing and Cleaning Machine Operators',
                'code' => '1384',
                'created_at' => '2022-04-22 12:38:17',
                'updated_at' => '2022-04-22 12:38:17',
            ),
            375 => 
            array (
                'id' => 377,
                'nco_group_id' => 105,
                'name' => 'Fur and Leather Preparing Machine Operators',
                'code' => '1385',
                'created_at' => '2022-04-22 12:38:17',
                'updated_at' => '2022-04-22 12:38:17',
            ),
            376 => 
            array (
                'id' => 378,
                'nco_group_id' => 105,
                'name' => 'Shoe Making and Related Machine Operators',
                'code' => '1386',
                'created_at' => '2022-04-22 12:38:17',
                'updated_at' => '2022-04-22 12:38:17',
            ),
            377 => 
            array (
                'id' => 379,
                'nco_group_id' => 105,
                'name' => 'Laundry Machine Operators',
                'code' => '1387',
                'created_at' => '2022-04-22 12:38:17',
                'updated_at' => '2022-04-22 12:38:17',
            ),
            378 => 
            array (
                'id' => 380,
                'nco_group_id' => 105,
                'name' => 'Textile, Fur and Leather Products Machine Operators Not Elsewhere Classified',
                'code' => '1388',
                'created_at' => '2022-04-22 12:38:17',
                'updated_at' => '2022-04-22 12:38:17',
            ),
            379 => 
            array (
                'id' => 381,
                'nco_group_id' => 106,
                'name' => 'Food and Related Products Machine Operators',
                'code' => '1388',
                'created_at' => '2022-04-22 12:38:48',
                'updated_at' => '2022-04-22 12:38:48',
            ),
            380 => 
            array (
                'id' => 382,
                'nco_group_id' => 107,
                'name' => 'Pulp and Papermaking Plant Operators',
                'code' => '1388',
                'created_at' => '2022-04-22 12:39:09',
                'updated_at' => '2022-04-22 12:39:09',
            ),
            381 => 
            array (
                'id' => 383,
                'nco_group_id' => 107,
                'name' => 'Wood Processing Plant Operators',
                'code' => '1389',
                'created_at' => '2022-04-22 12:39:09',
                'updated_at' => '2022-04-22 12:39:09',
            ),
            382 => 
            array (
                'id' => 384,
                'nco_group_id' => 108,
                'name' => 'Glass and Ceramics Plant Operators',
                'code' => '1389',
                'created_at' => '2022-04-22 12:39:26',
                'updated_at' => '2022-04-22 12:39:26',
            ),
            383 => 
            array (
                'id' => 385,
                'nco_group_id' => 108,
                'name' => 'Steam Engine and Boiler Operators',
                'code' => '1390',
                'created_at' => '2022-04-22 12:39:26',
                'updated_at' => '2022-04-22 12:39:26',
            ),
            384 => 
            array (
                'id' => 386,
                'nco_group_id' => 108,
                'name' => 'Packing, Bottling and Labelling Machine Operators',
                'code' => '1391',
                'created_at' => '2022-04-22 12:39:26',
                'updated_at' => '2022-04-22 12:39:26',
            ),
            385 => 
            array (
                'id' => 387,
                'nco_group_id' => 108,
                'name' => 'Gem and Jewellery Machine Operators',
                'code' => '1392',
                'created_at' => '2022-04-22 12:39:26',
                'updated_at' => '2022-04-22 12:39:26',
            ),
            386 => 
            array (
                'id' => 388,
                'nco_group_id' => 109,
                'name' => 'Mechanical Machinery Assemblers',
                'code' => '1392',
                'created_at' => '2022-04-22 12:39:40',
                'updated_at' => '2022-04-22 12:39:40',
            ),
            387 => 
            array (
                'id' => 389,
                'nco_group_id' => 109,
                'name' => 'Electrical and Electronic Equipment Assemblers',
                'code' => '1393',
                'created_at' => '2022-04-22 12:39:40',
                'updated_at' => '2022-04-22 12:39:40',
            ),
            388 => 
            array (
                'id' => 390,
                'nco_group_id' => 109,
                'name' => 'Assemblers Not Elsewhere Classified',
                'code' => '1394',
                'created_at' => '2022-04-22 12:39:40',
                'updated_at' => '2022-04-22 12:39:40',
            ),
            389 => 
            array (
                'id' => 391,
                'nco_group_id' => 110,
                'name' => 'Locomotive Engine Drivers',
                'code' => '1394',
                'created_at' => '2022-04-22 12:39:50',
                'updated_at' => '2022-04-22 12:39:50',
            ),
            390 => 
            array (
                'id' => 392,
                'nco_group_id' => 110,
                'name' => 'Railway Braker, Signal and Switch Operators',
                'code' => '1395',
                'created_at' => '2022-04-22 12:39:50',
                'updated_at' => '2022-04-22 12:39:50',
            ),
            391 => 
            array (
                'id' => 393,
                'nco_group_id' => 111,
                'name' => 'Motorcycle Drivers',
                'code' => '1395',
                'created_at' => '2022-04-22 12:40:00',
                'updated_at' => '2022-04-22 12:40:00',
            ),
            392 => 
            array (
                'id' => 394,
                'nco_group_id' => 111,
                'name' => 'Car, Taxi and Van Drivers',
                'code' => '1396',
                'created_at' => '2022-04-22 12:40:00',
                'updated_at' => '2022-04-22 12:40:00',
            ),
            393 => 
            array (
                'id' => 395,
                'nco_group_id' => 112,
                'name' => 'Bus and Tram Drivers',
                'code' => '1396',
                'created_at' => '2022-04-22 12:40:12',
                'updated_at' => '2022-04-22 12:40:12',
            ),
            394 => 
            array (
                'id' => 396,
                'nco_group_id' => 112,
                'name' => 'Heavy Truck and Lorry Drivers',
                'code' => '1397',
                'created_at' => '2022-04-22 12:40:12',
                'updated_at' => '2022-04-22 12:40:12',
            ),
            395 => 
            array (
                'id' => 397,
                'nco_group_id' => 113,
                'name' => 'Mobile Farm and Forestry Plant Operators',
                'code' => '1397',
                'created_at' => '2022-04-22 12:40:25',
                'updated_at' => '2022-04-22 12:40:25',
            ),
            396 => 
            array (
                'id' => 398,
                'nco_group_id' => 113,
                'name' => 'Earth Moving and Related Plant Operators',
                'code' => '1398',
                'created_at' => '2022-04-22 12:40:25',
                'updated_at' => '2022-04-22 12:40:25',
            ),
            397 => 
            array (
                'id' => 399,
                'nco_group_id' => 113,
                'name' => 'Crane, Hoist and Related Plant Operators',
                'code' => '1399',
                'created_at' => '2022-04-22 12:40:25',
                'updated_at' => '2022-04-22 12:40:25',
            ),
            398 => 
            array (
                'id' => 400,
                'nco_group_id' => 113,
                'name' => 'Lifting Truck Operators',
                'code' => '1400',
                'created_at' => '2022-04-22 12:40:25',
                'updated_at' => '2022-04-22 12:40:25',
            ),
            399 => 
            array (
                'id' => 401,
                'nco_group_id' => 114,
                'name' => 'Ships’ Deck Crews and Related Workers',
                'code' => '1400',
                'created_at' => '2022-04-22 12:40:39',
                'updated_at' => '2022-04-22 12:40:39',
            ),
            400 => 
            array (
                'id' => 402,
                'nco_group_id' => 115,
                'name' => 'Domestic Cleaners and Helpers',
                'code' => '1400',
                'created_at' => '2022-04-22 12:40:50',
                'updated_at' => '2022-04-22 12:40:50',
            ),
            401 => 
            array (
                'id' => 403,
                'nco_group_id' => 115,
                'name' => 'Cleaners and Helpers in Offices, Hotels and Other Establishments',
                'code' => '1401',
                'created_at' => '2022-04-22 12:40:50',
                'updated_at' => '2022-04-22 12:40:50',
            ),
            402 => 
            array (
                'id' => 404,
                'nco_group_id' => 116,
                'name' => 'Hand Launderers and Pressers',
                'code' => '1401',
                'created_at' => '2022-04-22 12:41:04',
                'updated_at' => '2022-04-22 12:41:04',
            ),
            403 => 
            array (
                'id' => 405,
                'nco_group_id' => 116,
                'name' => 'Vehicle Cleaners',
                'code' => '1402',
                'created_at' => '2022-04-22 12:41:04',
                'updated_at' => '2022-04-22 12:41:04',
            ),
            404 => 
            array (
                'id' => 406,
                'nco_group_id' => 116,
                'name' => 'Window Cleaners',
                'code' => '1403',
                'created_at' => '2022-04-22 12:41:04',
                'updated_at' => '2022-04-22 12:41:04',
            ),
            405 => 
            array (
                'id' => 407,
                'nco_group_id' => 116,
                'name' => 'Other Cleaning Workers',
                'code' => '1404',
                'created_at' => '2022-04-22 12:41:04',
                'updated_at' => '2022-04-22 12:41:04',
            ),
            406 => 
            array (
                'id' => 408,
                'nco_group_id' => 117,
                'name' => 'Crop Farm Labourers',
                'code' => '1404',
                'created_at' => '2022-04-22 12:41:29',
                'updated_at' => '2022-04-22 12:41:29',
            ),
            407 => 
            array (
                'id' => 409,
                'nco_group_id' => 117,
                'name' => 'Livestock Farm Labourers',
                'code' => '1405',
                'created_at' => '2022-04-22 12:41:29',
                'updated_at' => '2022-04-22 12:41:29',
            ),
            408 => 
            array (
                'id' => 410,
                'nco_group_id' => 117,
                'name' => 'Mixed Crop and Livestock Farm Labourers',
                'code' => '1406',
                'created_at' => '2022-04-22 12:41:29',
                'updated_at' => '2022-04-22 12:41:29',
            ),
            409 => 
            array (
                'id' => 411,
                'nco_group_id' => 117,
                'name' => 'Garden and Horticultural Labourers',
                'code' => '1407',
                'created_at' => '2022-04-22 12:41:29',
                'updated_at' => '2022-04-22 12:41:29',
            ),
            410 => 
            array (
                'id' => 412,
                'nco_group_id' => 117,
                'name' => 'Forestry Labourers',
                'code' => '1408',
                'created_at' => '2022-04-22 12:41:29',
                'updated_at' => '2022-04-22 12:41:29',
            ),
            411 => 
            array (
                'id' => 413,
                'nco_group_id' => 117,
                'name' => 'Fishery and Aquaculture Labourers',
                'code' => '1409',
                'created_at' => '2022-04-22 12:41:29',
                'updated_at' => '2022-04-22 12:41:29',
            ),
            412 => 
            array (
                'id' => 414,
                'nco_group_id' => 118,
                'name' => 'Mining and Quarrying Labourers',
                'code' => '1409',
                'created_at' => '2022-04-22 12:41:51',
                'updated_at' => '2022-04-22 12:41:51',
            ),
            413 => 
            array (
                'id' => 415,
                'nco_group_id' => 118,
                'name' => 'Civil Engineering Labourers',
                'code' => '1410',
                'created_at' => '2022-04-22 12:41:51',
                'updated_at' => '2022-04-22 12:41:51',
            ),
            414 => 
            array (
                'id' => 416,
                'nco_group_id' => 118,
                'name' => 'Building Construction Labourers',
                'code' => '1411',
                'created_at' => '2022-04-22 12:41:51',
                'updated_at' => '2022-04-22 12:41:51',
            ),
            415 => 
            array (
                'id' => 417,
                'nco_group_id' => 119,
                'name' => 'Hand Packers',
                'code' => '1411',
                'created_at' => '2022-04-22 12:42:02',
                'updated_at' => '2022-04-22 12:42:02',
            ),
            416 => 
            array (
                'id' => 418,
                'nco_group_id' => 119,
                'name' => 'Manufacturing Labourers Not Elsewhere',
                'code' => '1412',
                'created_at' => '2022-04-22 12:42:02',
                'updated_at' => '2022-04-22 12:42:02',
            ),
            417 => 
            array (
                'id' => 419,
                'nco_group_id' => 120,
                'name' => 'Hand and Pedal Vehicle Drivers',
                'code' => '1412',
                'created_at' => '2022-04-22 12:42:14',
                'updated_at' => '2022-04-22 12:42:14',
            ),
            418 => 
            array (
                'id' => 420,
                'nco_group_id' => 120,
                'name' => 'Drivers of Animal-Drawn Vehicles and Machinery',
                'code' => '1413',
                'created_at' => '2022-04-22 12:42:14',
                'updated_at' => '2022-04-22 12:42:14',
            ),
            419 => 
            array (
                'id' => 421,
                'nco_group_id' => 120,
                'name' => 'Freight Handlers',
                'code' => '1414',
                'created_at' => '2022-04-22 12:42:14',
                'updated_at' => '2022-04-22 12:42:14',
            ),
            420 => 
            array (
                'id' => 422,
                'nco_group_id' => 120,
                'name' => 'Shelf Fillers',
                'code' => '1415',
                'created_at' => '2022-04-22 12:42:14',
                'updated_at' => '2022-04-22 12:42:14',
            ),
            421 => 
            array (
                'id' => 423,
                'nco_group_id' => 121,
                'name' => 'Fast Food Preparers',
                'code' => '1415',
                'created_at' => '2022-04-22 12:42:28',
                'updated_at' => '2022-04-22 12:42:28',
            ),
            422 => 
            array (
                'id' => 424,
                'nco_group_id' => 121,
                'name' => 'Kitchen Helpers',
                'code' => '1416',
                'created_at' => '2022-04-22 12:42:28',
                'updated_at' => '2022-04-22 12:42:28',
            ),
            423 => 
            array (
                'id' => 425,
                'nco_group_id' => 122,
                'name' => 'Street and Related Service Workers',
                'code' => '1416',
                'created_at' => '2022-04-22 12:42:38',
                'updated_at' => '2022-04-22 12:42:38',
            ),
            424 => 
            array (
                'id' => 426,
                'nco_group_id' => 123,
            'name' => 'Street Vendors (Excluding Food)',
                'code' => '1416',
                'created_at' => '2022-04-22 12:42:48',
                'updated_at' => '2022-04-22 12:42:48',
            ),
            425 => 
            array (
                'id' => 427,
                'nco_group_id' => 124,
                'name' => 'Garbage and Recycling Collectors',
                'code' => '1416',
                'created_at' => '2022-04-22 12:43:00',
                'updated_at' => '2022-04-22 12:43:00',
            ),
            426 => 
            array (
                'id' => 428,
                'nco_group_id' => 124,
                'name' => 'Refuse Sorters',
                'code' => '1417',
                'created_at' => '2022-04-22 12:43:00',
                'updated_at' => '2022-04-22 12:43:00',
            ),
            427 => 
            array (
                'id' => 429,
                'nco_group_id' => 124,
                'name' => 'Sweepers and Related Labourers',
                'code' => '1418',
                'created_at' => '2022-04-22 12:43:00',
                'updated_at' => '2022-04-22 12:43:00',
            ),
            428 => 
            array (
                'id' => 430,
                'nco_group_id' => 125,
                'name' => 'Messengers, Package Deliverers and Luggage Porters',
                'code' => '1418',
                'created_at' => '2022-04-22 12:43:17',
                'updated_at' => '2022-04-22 12:43:17',
            ),
            429 => 
            array (
                'id' => 431,
                'nco_group_id' => 125,
                'name' => 'Odd Job Persons',
                'code' => '1419',
                'created_at' => '2022-04-22 12:43:17',
                'updated_at' => '2022-04-22 12:43:17',
            ),
            430 => 
            array (
                'id' => 432,
                'nco_group_id' => 125,
                'name' => 'Meter Readers and Vending Machine Collectors',
                'code' => '1420',
                'created_at' => '2022-04-22 12:43:17',
                'updated_at' => '2022-04-22 12:43:17',
            ),
            431 => 
            array (
                'id' => 433,
                'nco_group_id' => 125,
                'name' => 'Water and Firewood Collectors',
                'code' => '1421',
                'created_at' => '2022-04-22 12:43:17',
                'updated_at' => '2022-04-22 12:43:17',
            ),
            432 => 
            array (
                'id' => 434,
                'nco_group_id' => 125,
                'name' => 'Elementary Workers Not Elsewhere Classified',
                'code' => '1422',
                'created_at' => '2022-04-22 12:43:17',
                'updated_at' => '2022-04-22 12:43:17',
            ),
        ));
        
        
    }
}
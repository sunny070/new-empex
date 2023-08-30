<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;

class SubjectTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    Subject::truncate();
    $subjects = [
      [
        'qualification_id' => 4,
        'name' => 'ARTS',
      ],
      [
        'qualification_id' => 4,
        'name' => 'SCIENCE',
      ],
      [
        'qualification_id' => 4,
        'name' => 'COMMERCE',
      ],
      [
        'qualification_id' => 4,
        'name' => 'VOCATIONAL',
      ],
      [
        'qualification_id' => 5,
        'name' => 'B.ARCH.'
      ],
      [
        'qualification_id' => 5,
        'name' => 'BBA'
      ],
      [
        'qualification_id' => 5,
        'name' => 'B.COM'
      ],
      [
        'qualification_id' => 5,
        'name' => 'BD(THEOLOGY)'
      ],
      [
        'qualification_id' => 5,
        'name' => 'BDS'
      ],
      [
        'qualification_id' => 5,
        'name' => 'B.ED '
      ],
      [
        'qualification_id' => 5,
        'name' => 'BFA'
      ],
      [
        'qualification_id' => 5,
        'name' => 'BFS'
      ],
      [
        'qualification_id' => 5,
        'name' => 'BHMS'
      ],
      [
        'qualification_id' => 5,
        'name' => 'B.LIB'
      ],
      [
        'qualification_id' => 5,
        'name' => 'B.PHARM'
      ],
      [
        'qualification_id' => 5,
        'name' => 'B.TH'
      ],
      [
        'qualification_id' => 5,
        'name' => 'B.V.SC'
      ],
      [
        'qualification_id' => 5,
        'name' => 'BACHELOR IN PLANNING'
      ],
      [
        'qualification_id' => 5,
        'name' => 'BACHELOR IN TRAUMA EMERGENCY CARE & DISASTER MANAGEMENT'
      ],
      [
        'qualification_id' => 5,
        'name' => 'BACHELOR OF DESIGN'
      ],
      [
        'qualification_id' => 5,
        'name' => 'BACHELOR OF OCCUPATIONAL THERAPY'
      ],
      [
        'qualification_id' => 5,
        'name' => 'BACHELOR OF PHYSIOTHERAPY'
      ],
      [
        'qualification_id' => 5,
        'name' => 'BAMS (AYURVEDIC)'
      ],
      [
        'qualification_id' => 5,
        'name' => 'BBM'
      ],
      [
        'qualification_id' => 5,
        'name' => 'BCA'
      ],
      [
        'qualification_id' => 5,
        'name' => 'BSW'
      ],
      [
        'qualification_id' => 5,
        'name' => 'BVS & AH'
      ],
      [
        'qualification_id' => 5,
        'name' => 'Dr. of pharmacy'
      ],
      [
        'qualification_id' => 5,
        'name' => 'GRADUATES (BHTM)'
      ],
      [
        'qualification_id' => 5,
        'name' => 'LLB'
      ],
      [
        'qualification_id' => 5,
        'name' => 'MBBS'
      ],
      [
        'qualification_id' => 5,
        'name' => 'BA'
      ],
      [
        'qualification_id' => 5,
        'name' => 'BE/B.TECH'
      ],
      [
        'qualification_id' => 5,
        'name' => 'B.SC'
      ],
      [
        'qualification_id' => 5,
        'name' => 'B.Ed'
      ],
      [
        'qualification_id' => 5,
        'name' => 'BLIS'
      ],
      [
        'qualification_id' => 6,
        'name' => 'Doctor of Medicine (M.D)',
      ],
      [
        'qualification_id' => 6,
        'name' => 'LLM',
      ],
      [
        'qualification_id' => 6,
        'name' => 'M.A',
      ],
      [
        'qualification_id' => 6,
        'name' => 'MBA',
      ],
      [
        'qualification_id' => 6,
        'name' => 'M.COM',
      ],
      [
        'qualification_id' => 6,
        'name' => 'M.E/M.Tech',
      ],
      [
        'qualification_id' => 6,
        'name' => 'M.Ed',
      ],
      [
        'qualification_id' => 6,
        'name' => 'M.F.Sc. (Fisheries)',
      ],
      [
        'qualification_id' => 6,
        'name' => 'M.L.M',
      ],
      [
        'qualification_id' => 6,
        'name' => 'M.Lib.Science',
      ],
      [
        'qualification_id' => 6,
        'name' => 'M.Pharm',
      ],
      [
        'qualification_id' => 6,
        'name' => 'M.Phil',
      ],
      [
        'qualification_id' => 6,
        'name' => 'M.Sc',
      ],
      [
        'qualification_id' => 6,
        'name' => 'M.V.Sc',
      ],
      [
        'qualification_id' => 6,
        'name' => 'Master of Design (Design Space)',
      ],
      [
        'qualification_id' => 6,
        'name' => 'Master of Fashion Management',
      ],
      [
        'qualification_id' => 6,
        'name' => 'Master of Occupational Therapy',
      ],
      [
        'qualification_id' => 6,
        'name' => 'Master of Physiotherapy',
      ],
      [
        'qualification_id' => 6,
        'name' => 'Master of Planning',
      ],
      [
        'qualification_id' => 6,
        'name' => 'Master of Surgery (M.S)',
      ],
      [
        'qualification_id' => 6,
        'name' => 'Master of Tourism Administration (MTA)',
      ],
      [
        'qualification_id' => 6,
        'name' => 'MCA',
      ],
      [
        'qualification_id' => 6,
        'name' => 'MCM',
      ],
      [
        'qualification_id' => 6,
        'name' => 'MDS',
      ],
      [
        'qualification_id' => 6,
        'name' => 'MHA',
      ],
      [
        'qualification_id' => 6,
        'name' => 'MSW',
      ],
      [
        'qualification_id' => 7,
        'name' => 'ANM'
      ],
      [
        'qualification_id' => 7,
        'name' => 'ARTISIAN'
      ],
      [
        'qualification_id' => 7,
        'name' => 'AUTOMOBILE MECHANIC'
      ],
      [
        'qualification_id' => 7,
        'name' => 'BACHELOR IN AUDIO & SPEECH LANGUANGE PATHOLOGY'
      ],
      [
        'qualification_id' => 7,
        'name' => 'BAKERY & CONFECTIONNARY'
      ],
      [
        'qualification_id' => 7,
        'name' => 'BASIC AGRI TRAINER'
      ],
      [
        'qualification_id' => 7,
        'name' => 'BEAUTICIAN'
      ],
      [
        'qualification_id' => 7,
        'name' => 'BT'
      ],
      [
        'qualification_id' => 7,
        'name' => 'C.A.ED'
      ],
      [
        'qualification_id' => 7,
        'name' => 'CAMERAMEN'
      ],
      [
        'qualification_id' => 7,
        'name' => 'CARPENTER'
      ],
      [
        'qualification_id' => 7,
        'name' => 'CEMENT OLISTIN'
      ],
      [
        'qualification_id' => 7,
        'name' => 'CERTIFICATE COURSE IN LAB TECHNOLOGY'
      ],
      [
        'qualification_id' => 7,
        'name' => 'CERTIFICATE COURSE IN COMPUTER APPLICATION (CCA)'
      ],
      [
        'qualification_id' => 7,
        'name' => 'CINEMA OPERATOR'
      ],
      [
        'qualification_id' => 7,
        'name' => 'DIPLOMA IN ARCHITECTURAL ASSISTANT'
      ],
      [
        'qualification_id' => 7,
        'name' => 'COMPUTER OPERATOR'
      ],
      [
        'qualification_id' => 7,
        'name' => 'COMPUTER SOFTWARE'
      ],
      [
        'qualification_id' => 7,
        'name' => 'CONDUCTOR'
      ],
      [
        'qualification_id' => 7,
        'name' => 'COPA'
      ],
      [
        'qualification_id' => 7,
        'name' => 'DANCE INSTRUCTOR'
      ],
      [
        'qualification_id' => 7,
        'name' => 'DEMONSTRATOR'
      ],
      [
        'qualification_id' => 7,
        'name' => 'DENTAL LABORATORY TECHNICIAN'
      ],
      [
        'qualification_id' => 7,
        'name' => 'DESIGNER GARMENTS'
      ],
      [
        'qualification_id' => 7,
        'name' => 'DESKTOP PUBLISHING'
      ],
      [
        'qualification_id' => 7,
        'name' => 'DESPATCH RIDER'
      ],
      [
        'qualification_id' => 7,
        'name' => 'DIALYSIS TECHNICIAN'
      ],
      [
        'qualification_id' => 7,
        'name' => 'DIESEL MECHANIC'
      ],
      [
        'qualification_id' => 7,
        'name' => 'DIETTICIAN'
      ],
      [
        'qualification_id' => 7,
        'name' => 'DIPLOMA IN AGRICULTURAL ENGINEERING'
      ],
      [
        'qualification_id' => 7,
        'name' => 'DIPLOMA IN ARCHITECH'
      ],
      [
        'qualification_id' => 7,
        'name' => 'DIPLOMA IN ARCHITECTURAL ASSISTANSHIP'
      ],
      [
        'qualification_id' => 7,
        'name' => 'DIPLOMA IN GARMENT TECH.'
      ],
      [
        'qualification_id' => 7,
        'name' => 'DIPLOMA IN AVIATION & HOSPITALITY MANAGEMENT'
      ],
      [
        'qualification_id' => 7,
        'name' => 'DIPLOMA IN BUSINESS MANAGEMENT'
      ],
      [
        'qualification_id' => 7,
        'name' => 'DIPLOMA IN CIVIL ENGINEERING'
      ],
      [
        'qualification_id' => 7,
        'name' => 'DIPLOMA IN COMMERCIAL PRACTISE'
      ],
      [
        'qualification_id' => 7,
        'name' => 'DIPLOMA IN COMPUTER APPLICATION (DCA)'
      ],
      [
        'qualification_id' => 7,
        'name' => 'DIPLOMA IN  COMPUTER SCIENCE'
      ],
      [
        'qualification_id' => 7,
        'name' => 'DIPLOMA IN COMPUTER SCIENCE & ENGINEERING'
      ],
      [
        'qualification_id' => 7,
        'name' => 'DIPLOMA IN CRAFTMANSHIP (FOOD PRODUCTION)'
      ],
      [
        'qualification_id' => 7,
        'name' => 'DIPLOMA IN DIETETIC HEALTH NUTRITION'
      ],
      [
        'qualification_id' => 7,
        'name' => 'DIPLOMA IN ELECTRICAL & ELECTRONICS'
      ],
      [
        'qualification_id' => 7,
        'name' => 'DIPLOMA IN ELECTRICAL ENGINEERING'
      ],
      [
        'qualification_id' => 7,
        'name' => 'DIPLOMA IN ELECTRONIC & TELECOMMUNICATION ENGINEER'
      ],
      [
        'qualification_id' => 7,
        'name' => 'DIPLOMA IN ELEMENTARY COURSE OF AH & VETERINARY SCIENCE'
      ],
      [
        'qualification_id' => 7,
        'name' => 'DIPLOMA IN ELEMENTARY EDUCATION'
      ],
      [
        'qualification_id' => 7,
        'name' => 'DIPLOMA IN FILM & TV PRODUCTION'
      ],
      [
        'qualification_id' => 7,
        'name' => 'ELECTRICAL ENGINEERING'
      ],
      [
        'qualification_id' => 7,
        'name' => 'DIPLOMA IN HANDLOOM ENGINEERING'
      ],
      [
        'qualification_id' => 7,
        'name' => 'DIPLOMA IN INFORMATION TECHNOLOGY'
      ],
      [
        'qualification_id' => 7,
        'name' => 'DIPLOMA IN LABORATORY TECHNOLOGY'
      ],
      [
        'qualification_id' => 7,
        'name' => 'DIPLOMA IN MECHANICAL ENGINEERING'
      ],
      [
        'qualification_id' => 7,
        'name' => 'DIPLOMA IN PHARMACY'
      ],
      [
        'qualification_id' => 7,
        'name' => 'DIPLOMA IN RADIO DIAGNOSTIC TECHNOLOGY'
      ],
      [
        'qualification_id' => 7,
        'name' => 'DIPLOMA IN SANITARY INSPECTOR'
      ],
      [
        'qualification_id' => 7,
        'name' => 'DIPLOMA IN TEACHERS EDUCATION (PRIMARY SCHOOL TEACHER)'
      ],
      [
        'qualification_id' => 7,
        'name' => 'DIPLOMA IN TOURISM (INTERNATIONAL AIRLINES & TRAVEL)'
      ],
      [
        'qualification_id' => 7,
        'name' => 'DOCTOR OF PHARMACISIS'
      ],
      [
        'qualification_id' => 7,
        'name' => 'DRAMA INSTRUCTOR'
      ],
      [
        'qualification_id' => 7,
        'name' => 'DRAUGHTSMAN (ITI)'
      ],
      [
        'qualification_id' => 7,
        'name' => 'DRIVER (HEAVY & LIGHT)'
      ],
      [
        'qualification_id' => 7,
        'name' => 'DRIVER (HEAVY)'
      ],
      [
        'qualification_id' => 7,
        'name' => 'DRIVER (LIGHT)'
      ],
      [
        'qualification_id' => 7,
        'name' => 'ECG TECHNICIAN'
      ],
      [
        'qualification_id' => 7,
        'name' => 'LABORATORY ASSISTANT'
      ],
      [
        'qualification_id' => 7,
        'name' => 'ELECTRICIAN'
      ],
      [
        'qualification_id' => 7,
        'name' => 'ELECTRONIC TECHNICIAN'
      ],
      [
        'qualification_id' => 7,
        'name' => 'ELECTRONICS MECHANIC'
      ],
      [
        'qualification_id' => 7,
        'name' => 'FASHION DESIGNER'
      ],
      [
        'qualification_id' => 7,
        'name' => 'FITTER'
      ],
      [
        'qualification_id' => 7,
        'name' => 'GNM'
      ],
      [
        'qualification_id' => 7,
        'name' => 'GRAM SEVAK'
      ],
      [
        'qualification_id' => 7,
        'name' => 'GRAPHIC DESIGNER'
      ],
      [
        'qualification_id' => 7,
        'name' => 'HAIR & SKIN CARE'
      ],
      [
        'qualification_id' => 7,
        'name' => 'HEALTH WORKER'
      ],
      [
        'qualification_id' => 7,
        'name' => 'HOSPITALITY & TOURISM MANAGEMENT'
      ],
      [
        'qualification_id' => 7,
        'name' => 'HOTEL MANAGEMENT CATERING'
      ],
      [
        'qualification_id' => 7,
        'name' => 'INFORMATION TECHNOLOGY & ELECTRONICS'
      ],
      [
        'qualification_id' => 7,
        'name' => 'INTERIOR DESIGNER'
      ],
      [
        'qualification_id' => 7,
        'name' => 'IT & ELECTRONIC SYSTEM MAINTENANCE'
      ],
      [
        'qualification_id' => 7,
        'name' => 'PLUMBER'
      ],
      [
        'qualification_id' => 7,
        'name' => 'MEDICAL RECORD TECHNOLOGY'
      ],
      [
        'qualification_id' => 7,
        'name' => 'MODERN OFFICE PRACTICE (MOP)'
      ],
      [
        'qualification_id' => 7,
        'name' => 'MOTOR MECHANIC'
      ],
      [
        'qualification_id' => 7,
        'name' => 'NIS DIPLOMA (BADMINTON)'
      ],
      [
        'qualification_id' => 7,
        'name' => 'NIS COACHING'
      ],
      [
        'qualification_id' => 7,
        'name' => 'OPTHALMIC ASSISTANT'
      ],
      [
        'qualification_id' => 7,
        'name' => 'ORIENTAL OF MOBILITY'
      ],
      [
        'qualification_id' => 7,
        'name' => 'PG DIPLOMA ADVERTISING & PR'
      ],
      [
        'qualification_id' => 7,
        'name' => 'PG DIPLOMA IN E-ACCOUNTING AND FINANCING MANAGEMENT'
      ],
      [
        'qualification_id' => 7,
        'name' => 'PG DIPLOMA IN HUMAN RESOURCE MANAGEMENT'
      ],
      [
        'qualification_id' => 7,
        'name' => 'PG DIPLOMA IN TOURISM MANAGEMENT'
      ],
      [
        'qualification_id' => 7,
        'name' => 'PG DIPLOMA IN URBAN PLANNING AND DEVELOPMENT'
      ],
      [
        'qualification_id' => 7,
        'name' => 'PGDCA'
      ],
      [
        'qualification_id' => 7,
        'name' => 'PHOTOGRAPHY'
      ],
      [
        'qualification_id' => 7,
        'name' => 'PHYSICAL TRAINING INSTRUCTOR'
      ],
      [
        'qualification_id' => 7,
        'name' => 'PILOT (AIRLINES)'
      ],
      [
        'qualification_id' => 7,
        'name' => 'TOURISM MANAGEMENT'
      ],
      [
        'qualification_id' => 7,
        'name' => 'PRE SERVICE TRAINING'
      ],
      [
        'qualification_id' => 7,
        'name' => 'PRINTER'
      ],
      [
        'qualification_id' => 7,
        'name' => 'PRINTING TECHNOLOGY'
      ],
      [
        'qualification_id' => 7,
        'name' => 'RADIO & TV MECHANIC/ELECTRONICS'
      ],
      [
        'qualification_id' => 7,
        'name' => 'RADIOTHERAPY TECHNOLOGY'
      ],
      [
        'qualification_id' => 7,
        'name' => 'REFRIGERATOR & AIR CONDITIONING MECHANIC'
      ],
      [
        'qualification_id' => 7,
        'name' => 'REHABILITATION THERAPIST'
      ],
      [
        'qualification_id' => 7,
        'name' => 'RICIT'
      ],
      [
        'qualification_id' => 7,
        'name' => 'SANITARY INSPECTOR'
      ],
      [
        'qualification_id' => 7,
        'name' => 'SPORTS COACH'
      ],
      [
        'qualification_id' => 7,
        'name' => 'STENOGRAPHER'
      ],
      [
        'qualification_id' => 7,
        'name' => 'STERILIZE SERVICE'
      ],
      [
        'qualification_id' => 7,
        'name' => 'SURVEYOR'
      ],
      [
        'qualification_id' => 7,
        'name' => 'TAILORING'
      ],
      [
        'qualification_id' => 7,
        'name' => 'TEXTILE TECHNOLOGY'
      ],
      [
        'qualification_id' => 7,
        'name' => 'TINSMITHY'
      ],
      [
        'qualification_id' => 7,
        'name' => 'X RAY TECHNICIAN'
      ],
      [
        'qualification_id' => 7,
        'name' => 'TURNER'
      ],
      [
        'qualification_id' => 7,
        'name' => 'TYPING'
      ],
      [
        'qualification_id' => 7,
        'name' => 'TYRE TUBE REPAIRING'
      ],
      [
        'qualification_id' => 7,
        'name' => 'UMPIRE'
      ],
      [
        'qualification_id' => 7,
        'name' => 'VFA'
      ],
      [
        'qualification_id' => 7,
        'name' => 'VFA, VACCINATOR, VETERINARY'
      ],
      [
        'qualification_id' => 7,
        'name' => 'WEAVING'
      ],
      [
        'qualification_id' => 7,
        'name' => 'WELDER'
      ],
      [
        'qualification_id' => 7,
        'name' => 'WELDER ELECTRIC'
      ],
      [
        'qualification_id' => 7,
        'name' => 'WIREMAN'
      ],
      [
        'qualification_id' => 8,
        'name' => 'MATRIC'
      ],
      [
        'qualification_id' => 8,
        'name' => 'PU'
      ],
      [
        'qualification_id' => 8,
        'name' => 'BA'
      ],
      [
        'qualification_id' => 8,
        'name' => 'MA'
      ],
      [
        'qualification_id' => 8,
        'name' => 'B.ed'
      ],
      [
        'qualification_id' => 8,
        'name' => 'M.ed'
      ],
      [
        'qualification_id' => 8,
        'name' => 'Diploma in Hindi ShikShak'
      ],
    ];

    foreach ($subjects as $subject) {
      Subject::create($subject);
    }
  }
}

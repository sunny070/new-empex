<?php

namespace Database\Seeders;

use App\Models\PhysicalChallenge;
use Illuminate\Database\Seeder;

class PhysicalChallengesTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    PhysicalChallenge::truncate();

    $challenges = [
      ['name' => 'Leprosy Cured Person'],
      ['name' => 'Cerebral Palsy'],
      ['name' => 'Dwarfism'],
      ['name' => 'Muscular Dystrophy'],
      ['name' => 'Acid Attack Victims'],
      ['name' => 'Blindness'],
      ['name' => 'Low Vission'],
      ['name' => 'Deaf'],
      ['name' => 'Hard of Hearing'],
      ['name' => 'Speech and Language Disability'],
      ['name' => 'Specific Learning Disabilities'],
      ['name' => 'Autism Spectrum Disorder'],
      ['name' => 'Mental Behaviour (Mental Illness)'],
      ['name' => 'Multiple Sclerosis'],
      ['name' => 'Parkinson’s Disease'],
      ['name' => 'Haemophilia'],
      ['name' => 'Thalassemia'],
      ['name' => 'Sickle Cell Disease'],
    ];

    foreach ($challenges as $challenge) {
      PhysicalChallenge::create($challenge);
    }
  }
}

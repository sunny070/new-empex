<?php

namespace App\Console\Commands;

use App\Models\Address;
use App\Models\Archive;
use App\Models\BasicInfo;
use App\Models\EducationQualification;
use App\Models\Experience;
use App\Models\UserCanRead;
use App\Models\UserCanSpeak;
use App\Models\UserCanWrite;
use App\Models\UserPhysicalChallenge;
use Illuminate\Console\Command;

class ArchiveEmployee extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'archive:employee';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Put employee to archive whose card expiry date is greater than today + 2 months.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return int
	 */
	public function handle()
	{
		$toArchiveEmployee = BasicInfo::where('card_valid_till', '<', now()->addMonths(2))
			->with('religion')
			->where('is_archive', 0)
			// ->where('canEdit', 0)
			->get();

		if (count($toArchiveEmployee) > 0) {
			foreach ($toArchiveEmployee as $emp) {
				// save employee information to archive table
				$arch = new Archive();
				$arch->dob = $emp->dob;
				$arch->caste = $emp->caste;
				$arch->avatar = $emp->avatar;
				$arch->gender = $emp->gender;
				$arch->name = $emp->full_name;
				$arch->society = $emp->society;
				$arch->phone_no = $emp->phone_no;
				$arch->aadhar_no = $emp->aadhar_no;
				$arch->religion = $emp->religion->name;
				$arch->parents_name = $emp->parents_name;
				$arch->ex_servicemen = $emp->ex_servicemen;
				$arch->employment_no = $emp->employment_no;
				$arch->marital_status = $emp->marital_status;
				$arch->card_valid_from = $emp->card_valid_from;
				$arch->card_valid_till = $emp->card_valid_till;

				// physical challenge
				$allPhysicalChallenges = [];
				$challenges = UserPhysicalChallenge::where('user_id', $emp->user_id)->with('physicalChallenge')->get();
				foreach ($challenges as $chal) {
					$allPhysicalChallenges[] = $chal->physicalChallenge->name;
				}
				$arch->physical_challenge = json_encode($allPhysicalChallenges);
				// end physical challenge

				// language
				$allUserLanguages = [];
				$userRead = UserCanRead::where('user_id', $emp->user_id)->with('language')->get();
				foreach ($userRead as $read) {
					$allUserLanguages['read'] = $read->language->name;
				}
				$userWrite = UserCanWrite::where('user_id', $emp->user_id)->with('language')->get();
				foreach ($userWrite as $write) {
					$allUserLanguages['write'] = $write->language->name;
				}
				$userSpeak = UserCanSpeak::where('user_id', $emp->user_id)->with('language')->get();
				foreach ($userSpeak as $speak) {
					$allUserLanguages['speak'] = $speak->language->name;
				}
				$arch->languages = json_encode($allUserLanguages);
				// end language

				$addresses = Address::where('user_id', $emp->user_id)->get()->toArray();
				$arch->address = json_encode($addresses);

				$edu = EducationQualification::where('user_id', $emp->user_id)->get()->toArray();
				$arch->education = json_encode($edu);

				$exp = Experience::where('user_id', $emp->user_id)->get()->toArray();
				$arch->experience = json_encode($exp);

				$arch->save();

				// put employee details to default
				$employee = BasicInfo::where('id', $emp->id)->first();
				$employee->qr = null;
				$employee->step = 1;
				$employee->notes = 0;
				$employee->is_paid = 0;
				$employee->canEdit = 1;
				$employee->is_placed = 0;
				$employee->is_archive = 1;
				$employee->employment_no = null;
				$employee->sponsorship_count = 0;
				$employee->percent_complete = '0';
				$employee->physically_challenge = 0;
				$employee->card_valid_from = null;
				$employee->card_valid_till = null;
				$employee->status = 'Pending';
				$employee->save();
			}
		}
	}
}

<?php

namespace App\Jobs;

use App\Http\Livewire\Admin\ChangeRequest\Verify\BasicInfo;
use App\Models\Address;
use App\Models\BasicInfo as ModelsBasicInfo;
use App\Models\UserNco;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use phpseclib3\Crypt\TripleDES;

class RegisterJobseekerToNcs implements ShouldQueue
{
	use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	protected $employeeNo, $basicInfo;
	/**
	 * Create a new job instance.
	 *
	 * @return void
	 */
	public function __construct($employeeNo, $basicInfo)
	{
		$this->employeeNo = $employeeNo;
        // dd($this->employeeNo);
		$this->basicInfo = $basicInfo;
	}

	/**
	 * Execute the job.
	 *
	 * @return void
	 */
	public function handle()
	{
        if(env('APP_ENV') == 'local') {
            return;
        }
        // $this->employeeNo = ModelsBasicInfo::query()->firstWhere('status','Approved')->employee_no;
        // dd($this->employeeNo);
		$tripleDes = new TripleDES('ecb');
		$tripleDes->setKey(md5('DGET_8D1087A1D4BF', true));
		$tripleDes->enablePadding();


        $authResponse = Http::post('https://www.ncs.gov.in/_vti_bin/NCSPartners/NCSPServiceExternal.svc/AuthenticateUser', [
			// 'strUserName' => base64_encode($tripleDes->encrypt(env('NCS_USERNAME'))),
			'strUserName' => env('NCS_USERNAME'),
			// 'strPassword' => base64_encode($tripleDes->encrypt(env('NCS_PASSWORD'))),
			'strPassword' => env('NCS_PASSWORD'),
		]);

		if ($authResponse->ok()) {
			$ncsAuthUser = json_decode($authResponse->body(), true);
			$skills = UserNco::where('user_id', $this->basicInfo->user_id)->with('detail')->first();
			$addresses = Address::where('user_id', $this->basicInfo->user_id)
				->with('state', 'district')
				->first();

			Http::withHeaders([
				'Cookie' => $ncsAuthUser['AuthenticateUserResult']['Cookie']
			])->post('https://www.ncs.gov.in/_vti_bin/NCSPartners/NCSPServiceExternal.svc/RegisterJobseekers', [
				[
					'ApplicationFormID' => 'EMPEX-' . $this->employeeNo,
					'FirstName' => $this->basicInfo->full_name,
					'DOB' => date('d/m/Y', strtotime($this->basicInfo->dob)),
					'MaritalStatus' => $this->basicInfo->marital_status == 'Single' ? 1 : 2,
					'GuardianName' => $this->basicInfo->parents_name,
					'MobileNo' => $this->basicInfo->phone_no,
					'Gender' => $this->basicInfo->gender == 'Male' ? 'M' : ($this->basicInfo->gender == 'Female' ? 'F' : 'T'),
					'ReligionID' => $this->basicInfo->religion_id,
					'Caste' => $this->basicInfo->caste == 'General' ? 'GEN' : $this->basicInfo->caste,
					'EmploymentStatus' => '3',
					'PrimaryLanguage' => '99',
					'AvailableToJoinInDays' => '0',
					'ExperienceYears' => '0',
					'ExperienceMonths' => '0',
					'CurrentEmployerSector' => '1',
					'HighestEducation' => '2',
					'Skills' => [
						[
							'SkillName' => $skills->detail->name,
						]
					],
					'UIDs' => [
						[
							'UIDType' => '11',
							'UIDNumber' => $this->employeeNo
						]
					],
					'Addresses'  => [
						[
							'AddressType' => 'R',
							'AddressSubType' => 'P',
							'TerritoryType' => 'R',
							'Address1' => $addresses->house_no,
							'State' => $addresses->state->ncs_state_id != null ? $addresses->state->ncs_state_id : '15',
							'District' => $addresses->district->ncs_district_id != null ? $addresses->district->ncs_district_id : '283',
							'SubDistrictTaluka' => null,
							'CityVillage' => null,
							'Pincode' => $addresses->pin_code,
						],
						[
							'AddressType' => 'R',
							'AddressSubType' => 'C',
							'TerritoryType' => 'R',
							'Address1' => $addresses->house_no,
							'State' => $addresses->state->ncs_state_id != null ? $addresses->state->ncs_state_id : '15',
							'District' => $addresses->district->ncs_district_id != null ? $addresses->district->ncs_district_id : '283',
							'SubDistrictTaluka' => null,
							'CityVillage' => null,
							'Pincode' => $addresses->pin_code,
						]
					],
				]
			]);
		}
	}
}

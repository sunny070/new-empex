<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class NCSJobPost implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if (env('APP_ENV') == 'local') {
            return;
        }



        $authResponse = Http::post('https://www.ncs.gov.in/_vti_bin/NCSPartners/NCSPServiceExternal.svc/AuthenticateUser', [
            // 'strUserName' => base64_encode($tripleDes->encrypt(env('NCS_USERNAME'))),
            'strUserName' => env('NCS_USERNAME'),
            // 'strPassword' => base64_encode($tripleDes->encrypt(env('NCS_PASSWORD'))),
            'strPassword' => env('NCS_PASSWORD'),
        ]);

        if ($authResponse->ok()) {
            $ncsAuthUser = json_decode($authResponse->body(), true);
            Http::withHeaders([
                'Cookie' => $ncsAuthUser['AuthenticateUserResult']['Cookie']
            ])->post('https://www.ncs.gov.in/_vti_bin/NCSPartners/NCSPServiceExternal.svc/RegisterJobseekers', [
                [
                    "JobReferenceID" => "345678ii",
                    "JobTitle" => "SALES PROMOTER ONE",
                    "JobDescription" => "We are looking for Senior developers onWordpress",
                    "SectorID" => "13",
                    "IndustryID" => "16",
                    "MinExperienceYear" => "15",
                    "MaxExperienceYear" => "15",
                    "MinExpectedSalary" => "10000",
                    "MaxExpectedSalary" => "100000",
                    "SalaryType" => "Y",
                    "JobNatureCode" => "C",
                    "MinAge" => "28",
                    "MaxAge" => "35",
                    "GenderCode" => "A",
                    "NumberofOpenings" => 150,
                    "MinQualificationID" => 9,
                    "ContactPersonName" => "Amit Kumar",
                    "ContactMobile" => 8130132255,
                    "ContactEmail" => "amit.k@abc.com",
                    "IsToDisplayContactInformation" => true,
                    "IsToDisplayMobileOfEmployer" => true,
                    "IsToDisplayEmailIdOfEmployer" => true,
                    "Keyskills" => [["Skill" => "Sales"], ["Skill" => "Go to Market"]],
                    "JobPostExpiryDate" => "2022-06-30",
                    "UGQualificationID" => "7",
                    "UGSpecializationID" => "24",
                    "UGYearFrom" => "1999",
                    "UGYearTo" => "2001",
                    "PGQualificationID" => "8",
                    "PGSpecializationID" => "25",
                    "PGYearFrom" => "2000",

                    "PGYearTo" => "2003",
                    "PHDQualificationID" => "17",
                    "PHDSpecializationID" => "108",
                    "PHDYearFrom" => "2001",
                    "PHDYearTo" => "2005",
                    "PostedForEmployer" => "VXRF Technologies",
                    "JobLocations" => [["CityID" => 66468], ["StateID" => 9]],

                    "ApplyJobUrl" => "https://dev.abc.co.in:8090/jobs/wiseyatra-right-holiday-technologies-pvt-ltd-content-writer-jobs-for-freshers-in-new-delhi-4958?from=ncs",

                    "FunctionalAreaID" => 33,
                    "FunctionalRoleID" => 679
                ]
            ]);
        }
    }
}

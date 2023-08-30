<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use phpseclib3\Crypt\TripleDES;

class NCSStagingJobPostController extends Controller
{

    public function __construct()
    {
        // dd(auth()->guard('admin')->user()?->role_id);
        // if (auth()->guard('admin')->user()?->role_id != 1) {
        //     abort(401);
        // }
    }
    public function handle()
    {

        // if (env('APP_ENV') == 'local') {
        //     return;
        // }

        $tripleDes = new TripleDES('ecb');
        $tripleDes->setKey(md5('DGET_8D1087A1D4BF', true));
        $tripleDes->enablePadding();

        $authResponse = Http::post('https://spstaging.ncs.gov.in/_vti_bin/NCSPartners/NCSPServiceExternal.svc/AuthenticateUser', [
            'strUserName' => base64_encode($tripleDes->encrypt(env('NCS_USERNAME'))),
            // 'strUserName' => env('NCS_USERNAME'),
            'strPassword' => base64_encode($tripleDes->encrypt(env('NCS_PASSWORD'))),
            // 'strPassword' => env('NCS_PASSWORD'),
        ]);

        // return $authResponse;

        $ncsAuthUser = json_decode($authResponse->body(), true);

        // return $ncsAuthUser['AuthenticateUserResult']['Cookie'];

        if ($authResponse->ok()) {
            $ncsAuthUser = json_decode($authResponse->body(), true);


            $response =  Http::withHeaders([
                'Cookie' => $ncsAuthUser['AuthenticateUserResult']['Cookie']
            ])->post('https://spstaging.ncs.gov.in/_vti_bin/NCSPartners/NCSPServiceExternal.svc/PostNewJobs', [
                [
                    "JobReferenceID" => "uniqueID",
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
                    "JobPostExpiryDate" => "2023-06-30",
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
                    "ApplyJobUrl" => "https://dev.abc.co.in:8090/jobs/wiseyatra-rdight-holiday-technologies-pvt-ltd-content-writer-jobs-for-freshers-in-new-delhi-4958?from=ncs",
                    "FunctionalAreaID" => 33,
                    "FunctionalRoleID" => 679
                ]
            ]);

            return $response->body();
        }
    }
}

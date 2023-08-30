<?php

use App\Http\Controllers\Api\AddressChangeController;
use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BasicInfoChangeController;
use App\Http\Controllers\Api\BasicInfoController;
use App\Http\Controllers\Api\DigilockerController;
use App\Http\Controllers\Api\EducationChangeController;
use App\Http\Controllers\Api\EducationQualificationController;
use App\Http\Controllers\Api\ExperienceChangeController;
use App\Http\Controllers\Api\ExperienceController;
use App\Http\Controllers\Api\MobilePdfController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\TransferController;
use App\Http\Controllers\Api\UserFetchDataController;
use App\Http\Controllers\Api\UserFetchNcoController;
use App\Http\Controllers\Api\UserLanguageController;
use App\Http\Controllers\SurrenderCardController;
use App\Http\Controllers\NcsJobPostController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  return $request->user();
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/verify-otp', [AuthController::class, 'verifyOtp']);
Route::get('/get-percent-complete', [BasicInfoController::class, 'getPercentCompleted']);
Route::get('/get-card-status', [BasicInfoController::class, 'getCardStatus']);
Route::get('/get-check-can-edit', [BasicInfoController::class, 'checkCanEdit']);
Route::get('/get-check-ongoing-application',[BasicInfoController::class,'checkOnGoing']);
Route::get('/my-profile',[\App\Http\Controllers\MyAccountController::class,'myProfile']);
Route::middleware('auth:sanctum')->group(function () {

  Route::get('/get-user-details', [BasicInfoController::class, 'getUsetDetails']);

  Route::post('/create-basic-info', [BasicInfoController::class, 'createBasicInfo']);
  Route::get('/get-basic-info', [BasicInfoController::class, 'getBasicInfo']);
  Route::get('/get-register-basic-info',[BasicInfoController::class,'getRegisterBasicInfo']);

  //CREATE AND GET ADDRESS
  Route::post('/create-address', [AddressController::class, 'createAddress']);
  Route::get('/get-my-address', [AddressController::class, 'getMyAddress']);
  //----------------------------------------------------------------
  Route::post('/create-education-qualification', [EducationQualificationController::class, 'createQualification']);
  Route::get('/get-my-qualifications', [EducationQualificationController::class, 'getMyQualifications']);

  Route::post('/create-user-languages', [UserLanguageController::class, 'createLanguages']);
  Route::get('/get-my-languages', [UserLanguageController::class, 'getMyLanguages']);

  Route::post('/create-experience', [ExperienceController::class, 'createExperience']);
  Route::get('/get-my-experience', [ExperienceController::class, 'getMyExperience']);

  Route::get('/languages', [UserFetchDataController::class, 'getLanguages']);
  Route::get('/physical-challenges', [UserFetchDataController::class, 'getChallenges']);
  Route::get('/qualification', [UserFetchDataController::class, 'getQualification']);
  Route::get('/stream', [UserFetchDataController::class, 'getStream']);
  Route::get('/core', [UserFetchDataController::class, 'getCore']);

  // Address
  Route::get('/state', [UserFetchDataController::class, 'getState']);
  Route::get('/district', [UserFetchDataController::class, 'getDistrict']);
  Route::get('/village', [UserFetchDataController::class, 'getVillage']);
  Route::get('/rdBlocks', [UserFetchDataController::class, 'getRdBlock']);
  Route::get('/policeStation', [UserFetchDataController::class, 'getPoliceStation']);
  Route::get('/postOffice', [UserFetchDataController::class, 'getPostOffice']);
  Route::get('/address-data', [UserFetchDataController::class, 'getAddressData']);

  // jobs & news
  Route::get('/get-religion', [UserFetchDataController::class, 'getReligion']);

  Route::get('/on-going-application', [UserFetchDataController::class, 'getOnGoing']);

  // change request
  Route::get('/check-change-basic-info/{id}', [BasicInfoChangeController::class, 'checkChangeBasicInfo']);
  Route::post('/change-basic-info', [BasicInfoChangeController::class, 'updateBasicInfo']);
  Route::get('/check-change-address/{id}', [AddressChangeController::class, 'checkChangeAddress']);
  Route::post('/change-address', [AddressChangeController::class, 'changeAddress']);
  Route::get('/check-change-education/{id}', [EducationChangeController::class, 'checkChangeAddress']);
  Route::post('/change-education', [EducationChangeController::class, 'changeEducation']);
  Route::get('/check-change-experience/{id}', [ExperienceChangeController::class, 'checkChangeExperience']);
  Route::post('/change-experience', [ExperienceChangeController::class, 'changeExperience']);
  Route::post('/change-languages', [BasicInfoChangeController::class, 'changeLanguages']);

  // user get NCO Details
  Route::get('/get-nco-division', [UserFetchNcoController::class, 'getDivision']);
  Route::get('/get-nco-group/{id}', [UserFetchNcoController::class, 'getGroup']);
  Route::get('/get-nco-family/{id}', [UserFetchNcoController::class, 'getFamily']);
  Route::get('/get-nco-details', [UserFetchNcoController::class, 'getDetails']);

  Route::post('/user-add-nco', [UserFetchNcoController::class, 'userAddNco']);
  Route::get('/get-user-nco/{id}', [UserFetchNcoController::class, 'getMyNco']);
  Route::get('/get-nco-code', [BasicInfoController::class, 'getUserNco']);
  Route::post('/user-set-nco-display', [UserFetchNcoController::class, 'setDisplayNco']);

  // download cards
  Route::get('/download-a4', [MobilePdfController::class, 'downloadA4']);
  Route::get('/download-card', [MobilePdfController::class, 'downloadCard']);

  // surrender card
  Route::post('/surrender-card', [SurrenderCardController::class, 'surrenderCard']);

  Route::get('/get-present-address', [AddressController::class, 'getPresentAddress']);
  Route::post('/submit-transfer', [TransferController::class, 'submitTransfer']);

  // job search
  Route::get('/jobs-search', [UserFetchDataController::class, 'searchJob']);
});
// job filter
Route::get('/get-job-type-by-category/{id}', [UserFetchDataController::class, 'getAllTypeBaseOnCategory']);
Route::get('/get-job-nco', [UserFetchDataController::class, 'getAllNco']);
Route::get('/get-job-sector', [UserFetchDataController::class, 'getAllSector']);
//JOBS
Route::get('/get-all-jobs', [UserFetchDataController::class, 'getAllJobPost']);
Route::get('/count-jobs', [UserFetchDataController::class, 'countAllJobs']);


Route::get('/jobs-post', [UserFetchDataController::class, 'getJobsPost']);
Route::get('/download-job-file', [UserFetchDataController::class, 'getDownloadJobFile']);
Route::get('/employee-news', [UserFetchDataController::class, 'getEmployeeNews']);

Route::get('/make-payment', [PaymentController::class, 'makePayment']);
Route::get('/response-handler', [PaymentController::class, 'responseHandler']);

Route::post('/employment-card', [DigilockerController::class, 'index']);
Route::post('/doc-employment-card', [DigilockerController::class, 'document']);


//NCS
Route::group(['middleware' => 'auth:sanctum'], function(){
  //All secure URL's

  Route::apiResource('job-posts', NcsJobPostController::class);
  });

// Route::get('ncs',[NcsJobPostController::class,'show']);
Route::post("login",[NcsJobPostController::class,'login']);
<?php

use App\Http\Controllers\Admin\Verification\VerificationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\NCSController;
use App\Http\Controllers\NcsJobPostController;
use App\Http\Controllers\PaymentTermsController;
use App\Http\Controllers\PrivacyController;
use App\Http\Controllers\TermsController;
use App\Http\Controllers\Web\Auth\ChangeRequestController;
use App\Http\Controllers\Web\Auth\DashboardController;
use App\Http\Controllers\Web\JobController;
use App\Http\Controllers\Web\LoginRegisterController;
use App\Http\Controllers\Web\NewsController;
use App\Http\Controllers\Web\NoticeBoardController;
use App\Http\Controllers\Web\PdfController;
use App\Http\Controllers\Web\PlacementController;
use App\Http\Controllers\Web\QrController;
use App\Jobs\NCSBeforeApiSMS;
use App\Jobs\RegisterJobseekerToNcs;
use App\Models\Address;
use App\Models\BasicInfo;
use App\Models\NcoDetail;
use App\Models\OnGoingApplication;
use App\Models\RegisteringAuthority;
use App\Models\RegisteringAuthorityDistrict;
use App\Models\User;
use App\Models\UserNco;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\NcsJobPostController;





use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Laravel\Jetstream\Http\Controllers\Inertia\PrivacyPolicyController;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
// use PDF;

Route::get('/', [AppController::class, 'index'])->name('web.home');
Route::get('/nco-stat', [AppController::class, 'getNCS'])->name('web.ncs');

Route::get('/login', [LoginRegisterController::class, 'login'])->name('login');
Route::get('/signup', [LoginRegisterController::class, 'signup'])->name('signup');
Route::post('/logout', [LoginRegisterController::class, 'logout'])->name('logout');
Route::post('/employer-register', [LoginRegisterController::class, 'registration'])->name('employer.register');
Route::view('/register', 'web.employer-register')->name('register');
Route::view('/change-number', 'web.change-number')->name('change-number');

// QR URL
Route::get('/employee/{phone}/{empNo}', [QrController::class, 'index'])->name('qr-code');

// job & news
Route::get('/employment-news', [JobController::class, 'index'])->name('web.jobs');
Route::get('/employment-news/{slug}', [JobController::class, 'detail']);

// JOB NCS Added by Sunny
Route::get('/employment-newsNcs', [NcsJobPostController::class, 'show'])->name('web.jobsNcs');
Route::get('/employment-newsNcs/{slug}', [NcsJobPostController::class, 'detail']);




Route::get('/career-guidance', [NewsController::class, 'index'])->name('web.news');
Route::get('/career-guidance/{slug}', [NewsController::class, 'detail']);



// Web Placement
Route::get('{district}/placement', [PlacementController::class, 'index'])->name('web.placement');
Route::get('/career-guidance/{slug}', [NewsController::class, 'detail']);
// Web Placement


Route::get('/notice', [NoticeBoardController::class, 'index'])->name('web.notice-board');
Route::get('/notice/{slug}', [NoticeBoardController::class, 'detail']);

//Privacy & Terms

Route::get('/privacy-policy', [PrivacyController::class, 'index'])->name('web.privacy');
Route::get('/terms', [TermsController::class, 'index'])->name('web.terms');
Route::get('/payment-terms', [PaymentTermsController::class, 'index'])->name('web.payment-terms');

// web login
Route::group(['prefix' => 'auth', 'middleware' => 'auth'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('auth.dashboard');
    Route::get('/employee/enrollment-card', [DashboardController::class, 'enrollmentCard'])->name('auth.enrollment.card');
    Route::get('/employee/ongoing-application', [DashboardController::class, 'ongoingApplication'])->name('auth.enrollment.status');
    Route::get('/employee/enrollment-renew', [DashboardController::class, 'renewEnrollment'])->name('auth.enrollment.renew');
    Route::get('/employee/enrollment-surrender', [DashboardController::class, 'surrender'])->name('auth.enrollment.surrender');

    Route::post('/surrender-employee', [DashboardController::class, 'employeeSurrender'])->name('surrender.employee');
    Route::post('/employee/ongoing-remove/{id}', [DashboardController::class, 'removeOngoing'])->name('auth.enrollment.status.remove');

    Route::view('/profile', 'web.auth.profile')->name('auth.profile');

    // pdf
    Route::get('/employee/pdf-a4', [PdfController::class, 'downloadA4'])->name('auth.employee.pdf.a4');
    Route::get('/employee/pdf-card', [PdfController::class, 'downloadCard'])->name('auth.employee.pdf.card');

    // employee new registration
    Route::view('/employee/new-registration', 'web.auth.employee.new-registration.index')->name('auth.employee.newregistration');
    Route::view('/employee/new-registration/confirmation', 'web.auth.employee.new-registration.confirmation')->name('auth.employee.confirmation');
    Route::view('/employee/new-registration/failed-payment', 'web.auth.employee.new-registration.failedPayment')->name('auth.employee.failed.payment');

    // employee change request and inner
    Route::view('/employee/change-request', 'web.auth.employee.change-request.index')->name('auth.employee.changerequest');
    Route::get('/employee/change-request/nco', [ChangeRequestController::class, 'nco'])->name('auth.employee.changerequest.nco');
    Route::get('/employee/change-request/basic-info', [ChangeRequestController::class, 'basicInfo'])->name('auth.employee.changerequest.basicinfo');
    Route::get('/employee/change-request/address', [ChangeRequestController::class, 'address'])->name('auth.employee.changerequest.address');
    Route::get('/employee/change-request/educational', [ChangeRequestController::class, 'education'])->name('auth.employee.changerequest.educational');
    Route::get('/employee/change-request/experience', [ChangeRequestController::class, 'experience'])->name('auth.employee.changerequest.experience');
    Route::get('/employee/change-request/transfer', [ChangeRequestController::class, 'transfer'])->name('auth.employee.changerequest.transfer');

    // Payment Redirect
    Route::get('/employee/response-handler', [PaymentController::class, 'responseHandler'])->name('auth.employee.response.handler');
    Route::get('/employee/renew-response-handler', [PaymentController::class, 'renewResponseHandler'])->name('auth.employee.renew.response.handler');

    // Sponsored Notification
    Route::view('/notification', 'web.auth.notification')->name('auth.notification');
    Route::get('/notification/{id}', [DashboardController::class, 'notiDetail'])->name('auth.notification.detail');
    Route::get('ncs-register', [NCSController::class, 'handle']);
});



Route::get('/check-duplicate', function () {

    // return 'test';


    $results = DB::table('basic_infos')
        ->where('status', 'Approved')
        ->select('full_name', 'employment_no', 'id', 'card_valid_till', DB::raw('COUNT(*) as `count`'))
        ->groupBy('employment_no')
        ->havingRaw('COUNT(*) > 1')
        ->get()->pluck('employment_no');

    $duplicate =  BasicInfo::query()->whereIn('employment_no', $results)->orderBy('employment_no')->get(['id', 'full_name', 'employment_no', 'phone_no', 'card_valid_till', 'card_valid_till', 'notify_sms', 'status']);


    return response()->json(
        [

            'count' =>  count($duplicate),
            'data' =>  $duplicate,
        ]
    );
});


Route::get('/before-ncs-api', function () {



    dispatch(new NCSBeforeApiSMS());

    // $date = date('Y-m-d','2023-03-18');


    return response()->json([
        'data' => 'Notifed'
    ]);

    // return response()->json([
    //     'count' => BasicInfo::query()->where('notify_sms', 'yes')->count()
    // ]);
    // $results = DB::table('basic_infos')
    //     ->where('status', 'Pending')
    //     ->select('full_name', 'employment_no', 'id', 'card_valid_till', DB::raw('COUNT(*) as `count`'))
    //     ->groupBy('employment_no')
    //     ->havingRaw('COUNT(*) > 1')
    //     ->get()->pluck('employment_no');

    // $duplicate =  BasicInfo::query()->whereIn('employment_no', $results)->orderBy('employment_no')->get(['id', 'full_name', 'employment_no', 'phone_no', 'card_valid_till', 'card_valid_till', 'notify_sms']);


    // return response()->json(
    //     [

    //         'count' =>  count($duplicate),
    //         'data' =>  $duplicate,
    //     ]
    // );
});


// Route::get('/regenerate-empno', [VerificationController::class, 'regenerateEmpNo']);
// Route::get('/regenerate-empno', [VerificationController::class,'regenerateEmpNo']);

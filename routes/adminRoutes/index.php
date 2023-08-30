<?php

use App\Http\Controllers\Admin\Accounts\OfficialAccountsController;
use App\Http\Controllers\Admin\Accounts\UserAccountsController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\EmployeeNewsController;
use App\Http\Controllers\Admin\EmployerController;
use App\Http\Controllers\Admin\JobsPostController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\PlacementController;
use App\Http\Controllers\Web\PlacementController as WebPlacementController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\Verification\ApprovalController;
use App\Http\Controllers\Admin\Verification\ChangeRequestController;
use App\Http\Controllers\Admin\Verification\VerificationController;
use App\Http\Controllers\Admin\Verification\VerifyChangeRequestController;
use App\Http\Controllers\NCSStagingJobPostController;
use App\Http\Livewire\Admin\Placement\Create;
use Illuminate\Support\Facades\Route;

// Non authenticated Routes
Route::middleware(['auth:admin', 'verified'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'adminIndex'])->name('dashboard');
    Route::post('/logout', [LoginController::class, 'logout'])->name('admin.logout');

    //   Route::get('/job-post', [JobsPostController::class, 'getJobsPost'])->name('jobsPost');
    //   Route::get('/job-post/create-job', [JobsPostController::class, 'createJobsPost'])->name('create.jobs.post');
    //   Route::get('/job-post/{id}/edit', [JobsPostController::class, 'editJob'])->name('edit.job');
    //   Route::get('/job-post/unpublished', [JobsPostController::class, 'unpublished'])->name('unpublished.job');
    //   Route::get('/job-post/{id}/view', [JobsPostController::class, 'viewJob'])->name('view.job');




    //replaced
    Route::get('/employee-news', [JobsPostController::class, 'getJobsPost'])->name('jobsPost');
    Route::get('/employee-news/create-news', [JobsPostController::class, 'createJobsPost'])->name('create.jobs.post');
    Route::get('/employee-news/{id}/edit', [JobsPostController::class, 'editJob'])->name('edit.job');
    Route::get('/employee-news/unpublished', [JobsPostController::class, 'unpublished'])->name('unpublished.job');
    Route::get('/employee-news/{id}/view', [JobsPostController::class, 'viewJob'])->name('view.job');
    //replaced


    //placment
    Route::get('/{district}/placement', [PlacementController::class, 'index'])->name('admin.placement');
    // Route::get('/placement/create', [Create::cl])->name('placement');
    Route::get('/placement/create-placement', [PlacementController::class, 'createPlacement'])->name('create.placement');
    Route::get('/placement/{id}/edit', [PlacementController::class, 'editJob'])->name('edit.job');
    Route::get('/placement/{id}/view', [PlacementController::class, 'viewJob'])->name('view.job');
    //placment




    // Route::get('/employee-news', [EmployeeNewsController::class, 'getEmployeeNews'])->name('employeeNews');
    // Route::get('/employee-news/create-job', [EmployeeNewsController::class, 'createNews'])->name('create.news');
    // Route::post('/employee-news/save-job', [EmployeeNewsController::class, 'saveNews'])->name('save.news');
    // Route::get('/employee-news/{id}/edit', [EmployeeNewsController::class, 'editEmployeeNews'])->name('edit.employee.news');
    // Route::post('/employee-news/{id}/update', [EmployeeNewsController::class, 'updateEmployeeNews'])->name('update.employee.news');


    //replaced
    Route::get('/career-guidance', [EmployeeNewsController::class, 'getEmployeeNews'])->name('employeeNews');
    Route::get('/career-guidance/create-article', [EmployeeNewsController::class, 'createNews'])->name('create.news');
    Route::post('/career-guidance/save-job', [EmployeeNewsController::class, 'saveNews'])->name('save.news');
    Route::get('/career-guidance/{id}/edit', [EmployeeNewsController::class, 'editEmployeeNews'])->name('edit.employee.news');
    Route::post('/career-guidance/{id}/update', [EmployeeNewsController::class, 'updateEmployeeNews'])->name('update.employee.news');
    //replaced



    // Employer
    Route::get('/employer', [EmployerController::class, 'index'])->name('admin.employer');
    Route::get('/employer/{id}', [EmployerController::class, 'detail'])->name('admin.employer.detail');
    Route::post('/employer/{id}/reject', [EmployerController::class, 'reject'])->name('admin.employer.reject');
    Route::post('/employer/{id}/approve', [EmployerController::class, 'approve'])->name('admin.employer.approve');

    // Verification
    Route::get('/verify/new-application', [VerificationController::class, 'getVerifyNewApplication'])->name('admin.verify.new.application');
    Route::get('/verify/new-application/view/{id}', [VerificationController::class, 'getVerifyView'])->name('admin.view.verify.application');
    Route::post('/verify/new-application/{id}/{status}/{router?}', [VerificationController::class, 'postVerify'])->name('admin.post.verify.application');
    Route::get('/verify/renewal', [VerificationController::class, 'getVerifyRenewal'])->name('admin.verify.renewal');
    Route::get('/verify/change-request', [VerificationController::class, 'getVerifyChangeRequest'])->name('admin.verify.change.request');

    // verify change request
    Route::get('/verify/change-basic-info/{id}', [VerifyChangeRequestController::class, 'basicInfo'])->name('admin.verify.info.change.request');
    Route::get('/verify/change-address/{id}', [VerifyChangeRequestController::class, 'address'])->name('admin.verify.address.change.request');
    Route::get('/verify/change-education/{id}', [VerifyChangeRequestController::class, 'education'])->name('admin.verify.education.change.request');
    Route::get('/verify/change-experience/{id}', [VerifyChangeRequestController::class, 'experience'])->name('admin.verify.experience.change.request');
    Route::get('/verify/transfer/{id}', [VerifyChangeRequestController::class, 'transfer'])->name('admin.verify.transfer');

    // Approval
    Route::get('/approve/new-application', [ApprovalController::class, 'getApprovalNewApplication'])->name('admin.approve.new.application');
    Route::get('/approve/new-id', [ApprovalController::class, 'getNewIdApplication'])->name('admin.approve.new.id');
    Route::get('/approve/new-application/view/{id}', [ApprovalController::class, 'getApproveView'])->name('admin.view.new.application');

    Route::get('/approve/renewal', [ApprovalController::class, 'getApprovalRenewal'])->name('admin.approve.renewal');

    // Approve Change Request
    Route::get('/approve/change-request', [ApprovalController::class, 'getApprovalChangeRequest'])->name('admin.approve.change.request');
    Route::get('/approve/change-basic-info/{id}', [ChangeRequestController::class, 'basicInfo'])->name('admin.info.change.request');
    Route::get('/approve/change-address/{id}', [ChangeRequestController::class, 'address'])->name('admin.address.change.request');
    Route::get('/approve/change-education/{id}', [ChangeRequestController::class, 'education'])->name('admin.education.change.request');
    Route::get('/approve/change-experience/{id}', [ChangeRequestController::class, 'experience'])->name('admin.experience.change.request');
    Route::get('/approve/transfer/{id}', [ChangeRequestController::class, 'transfer'])->name('admin.approve.transfer');

    // Accounts
    Route::get('/account/user-accounts', [UserAccountsController::class, 'getUserAccounts'])->name('admin.user.accounts');
    Route::get('/account/expired-accounts', [UserAccountsController::class, 'getExpiredAccounts'])->name('admin.expired.accounts');
    Route::get('/account/user-accounts/{id}', [UserAccountsController::class, 'getUserDetail'])->name('admin.user.detail');
    Route::get('/account/official-accounts', [OfficialAccountsController::class, 'getOfficialAccounts'])->name('admin.official.accounts');
    Route::post('/account/create/official-accounts', [OfficialAccountsController::class, 'addOfficialAccount'])->name('admin.add.official.account');
    Route::post('/account/update/official-accounts', [OfficialAccountsController::class, 'updateOfficialAccount'])->name('admin.update.official.account');

    // Report
    Route::get('/report/total-registration', [ReportController::class, 'getTotalRegistration'])->name('admin.report.total.registration');
    Route::get('/report/registered-user', [ReportController::class, 'getRegisteredUser'])->name('admin.report.registered.user');
    Route::get('/report/edistrict-user', [ReportController::class, 'getEdistrictUser'])->name('admin.report.edistrict.user');
    Route::get('/report/sponsorship', [ReportController::class, 'getSponsorship'])->name('admin.report.sponsorship');
    Route::get('/report/sponsorship/list', [ReportController::class, 'getSponsorshipList'])->name('admin.report.sponsorship.list');

    // Controls
    Route::get('/admin-controls/address', [AdminController::class, 'adminControls'])->name('admin.controls.address');
    Route::get('/admin-controls/departments', [AdminController::class, 'adminDepartments'])->name('admin.controls.departments');
    Route::get('/admin-controls/languages', [AdminController::class, 'adminLanguages'])->name('admin.controls.languages');
    Route::get('/admin-controls/physical-challenge', [AdminController::class, 'adminChallenges'])->name('admin.controls.challenges');
    Route::get('/admin-controls/education', [AdminController::class, 'adminEducation'])->name('admin.controls.education');
    Route::get('/admin-controls/nco', [AdminController::class, 'adminNco'])->name('admin.controls.nco');
    Route::get('/admin-controls/organization', [AdminController::class, 'adminOrganization'])->name('admin.controls.organization');
    Route::get('/admin-controls/terms', [AdminController::class, 'adminTerms'])->name('admin.controls.terms');
    Route::get('/admin-controls/registering-authority', [AdminController::class, 'registeringAuthority'])->name('admin.controls.authority');
    Route::get('/send-notification', [AdminController::class, 'sendNewRegistrationSMS'])->name('admin.new.sms');

    // Notice Board
    Route::get('/notice-board', [AdminController::class, 'getNotice'])->name('admin.notice.board');

    // archive
    // Route::get('/archive', Archive::class)->name('admin.archive');
    Route::view('/archive', 'admin.archive')->name('admin.archive');
});

// admin
Route::get('/admin', [LoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [LoginController::class, 'login'])->name('admin.post.login');



//staging server
Route::get('/admin/ncs-job/store', [NCSStagingJobPostController::class, 'handle'])->middleware(['auth:admin']);

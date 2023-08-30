<?php

use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\District\ChangeController;
use App\Http\Controllers\District\DashboardController;
use App\Http\Controllers\District\DistrictReportController;
use App\Http\Controllers\District\PlacementController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:admin', 'verified'])->prefix('district-admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('district-admin.dashboard');
    Route::get('/new-application', [DashboardController::class, 'newApplication'])->name('district-admin.new-application');
    Route::get('/new-application/{id}/pending', [DashboardController::class, 'pendingApplication'])->name('district-admin.pending-application');
    Route::get('/new-application/{id}/verify', [DashboardController::class, 'verifyApplication'])->name('district-admin.verify-application');
    Route::get('/employee', [DashboardController::class, 'employee'])->name('district-admin.employee');
    Route::get('/employee/{id}', [DashboardController::class, 'employeeDetail'])->name('district-admin.employee-detail');
    Route::get('/account', [DashboardController::class, 'account'])->name('district-admin.account');
    Route::get('/renew', [DashboardController::class, 'renew'])->name('district-admin.renew');

    Route::get('/change/verification', [ChangeController::class, 'verification'])->name('district-admin.change.verification');
    Route::get('/change/verification/{type}/{id}', [ChangeController::class, 'verificationDetail'])->name('district-admin.change.verification.detail');

    Route::get('/change/approval', [ChangeController::class, 'approval'])->name('district-admin.change.approval');
    Route::get('/change/approval/{type}/{id}', [ChangeController::class, 'approvalDetail'])->name('district-admin.change.approval.detail');


    Route::get('/report/total-registration', [DistrictReportController::class, 'getTotalRegistration'])->name('district-admin.report.total.registration');
    Route::get('/report/registered-user', [DistrictReportController::class, 'getRegisteredUser'])->name('district-admin.report.registered.user');



    Route::get('/report/sponsorship', [ReportController::class, 'getSponsorship'])->name('district-admin.report.sponsorship');
    Route::get('/report/sponsorship/list', [ReportController::class, 'getSponsorshipList'])->name('district-admin.report.sponsorship.list');





    //placment
    Route::get('/{district}/placement', [PlacementController::class, 'index'])->name('district-admin.placement');
    Route::get('/placement/create-placement', [PlacementController::class, 'createPlacement'])->name('district-admin.create.placement');
    //placment
});

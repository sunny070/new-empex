<?php

use App\Http\Controllers\Approver\ChangeController;
use App\Http\Controllers\Approver\DashboardController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:admin', 'verified'])->prefix('approver')->group(function () {
  Route::get('/dashboard', [DashboardController::class, 'index'])->name('approver.dashboard');
  Route::get('/application/{id}', [DashboardController::class, 'view'])->name('approver.application');
  Route::get('/employment', [DashboardController::class, 'employment'])->name('approver.employment');
  Route::get('/employment/{id}', [DashboardController::class, 'employmentDetail'])->name('approver.employment-detail');

  // change request
  Route::get('/change', [ChangeController::class, 'index'])->name('approver.change');
  Route::get('/change/{type}/{id}', [ChangeController::class, 'detail'])->name('approver.change.detail');
});

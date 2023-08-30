<?php

use App\Http\Controllers\Verifier\ChangeController;
use App\Http\Controllers\Verifier\DashboardController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:admin', 'verified'])->prefix('verifier')->group(function () {
  Route::get('/dashboard', [DashboardController::class, 'index'])->name('verifier.dashboard');
  Route::get('/application/{id}', [DashboardController::class, 'view'])->name('verifier.application');
  Route::get('/employment', [DashboardController::class, 'employment'])->name('verifier.employment');
  Route::get('/employment/{id}', [DashboardController::class, 'employmentDetail'])->name('verifier.employment-detail');

  Route::post('/application/{id}/{status}/{type}', [DashboardController::class, 'verify'])->name('verifier.verify');

  // change request
  Route::get('/change', [ChangeController::class, 'index'])->name('verifier.change');
  Route::get('/change/{type}/{id}', [ChangeController::class, 'detail'])->name('verifier.change.detail');
});

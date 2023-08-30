<?php

use App\Http\Controllers\Employer\DashboardController;
use Illuminate\Support\Facades\Route;

// Non authenticated Routes
Route::middleware(['auth:admin', 'verified'])->prefix('employer')->group(function () {
  Route::get('/dashboard', [DashboardController::class, 'index'])->name('employer.dashboard');
  Route::get('/job-create', [DashboardController::class, 'jobCreate'])->name('employer.job.create');
  Route::get('/job-edit/{id}', [DashboardController::class, 'jobEdit'])->name('employer.job.edit');
  Route::post('/job-delete/{id}', [DashboardController::class, 'jobDelete'])->name('employer.job.delete');
});

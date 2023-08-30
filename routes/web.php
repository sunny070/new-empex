<?php

use App\Http\Controllers\ForgotPasswordController;
use App\Http\Livewire\ForgotPassword;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware'=> 'visitor'], function () {
  require base_path('routes/adminRoutes/index.php');
  require base_path('routes/employerRoutes/index.php');
  require base_path('routes/userRoutes/index.php');
  require base_path('routes/approver/index.php');
  require base_path('routes/verifier/index.php');
  require base_path('routes/districtAdmin/index.php');
});

Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password');
Route::post('update-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('update.password');

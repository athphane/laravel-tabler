<?php

use App\Http\Controllers\Admin\BulkSmsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\UsersController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Admin\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Admin\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Admin\Auth\NewPasswordController;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\Auth\VerifyEmailController;

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

Route::group([
    'middleware' => ['guest']
], function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
    Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
    Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('/reset-password', [NewPasswordController::class, 'store'])->name('password.update');
    Route::group([
        'middleware' => ['throttle:6,1']
    ], function () {
        Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
            ->middleware(['signed'])
            ->name('verification.verify');
    });
});


Route::group([
    'middleware' => ['auth:web_admin']
], function () {
    Route::get('/verify-email', [EmailVerificationPromptController::class, '__invoke'])->name('verification.notice');

    Route::group([
        'middleware' => ['throttle:6,1']
    ], function () {
        Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
            ->middleware(['signed'])
            ->name('verification.verify');

        Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
            ->name('verification.send');
    });

    Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])->name('password.confirm');
    Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store']);
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    Route::group([
        'middleware' => ['verified:admin.verification.notice']
    ], function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/bulk-sms', [BulkSmsController::class, 'index'])->name('bulk-sms');
        Route::post('/bulk-sms', [BulkSmsController::class, 'sendSms'])->name('bulk-sms.send');

        Route::match(['PUT', 'PATCH'], 'users', [UsersController::class, 'bulk'])->name('users.bulk');
        Route::resource('users', UsersController::class);

        Route::match(['PUT', 'PATCH'], 'roles', [RolesController::class, 'bulk'])->name('roles.bulk');
        Route::resource('roles', RolesController::class);
    });
});




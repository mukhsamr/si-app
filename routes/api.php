<?php

use App\Http\Controllers\Sdt\AuthController as SdtAuthController;
use App\Http\Controllers\Sdt\DeviceController as SdtDeviceController;
use App\Http\Controllers\Sdt\LoanController as SdtLoanController;
use App\Http\Controllers\Sdt\RakController as SdtRakController;
use App\Http\Controllers\Sdt\StudentController as SdtStudentController;
use App\Http\Controllers\Sdt\UserController as SdtUserController;
use Illuminate\Support\Facades\Route;

Route::prefix('sdt')->middleware('connection:sdt')->group(function () {

    // Auth
    Route::controller(SdtAuthController::class)->prefix('auth')->group(function () {
        Route::post('login', 'login');
        Route::post('logout', 'logout')->middleware('auth:sdt');
        Route::get('user', 'user')->middleware('auth:sdt');
    });

    // User
    Route::apiResource('users', SdtUserController::class)->middleware('auth:sdt');

    // Student
    Route::controller(SdtStudentController::class)->prefix('students')->middleware('auth:sdt')->group(function () {
        Route::get('/', 'index');
        Route::put('update', 'update');
    });

    // Rak
    Route::apiResource('raks', SdtRakController::class)->middleware('auth:sdt');

    // Device
    Route::apiResource('devices', SdtDeviceController::class)->middleware('auth:sdt');
    Route::put('devices/assign/{device}', [SdtDeviceController::class, 'assign'])->middleware('auth:sdt');

    // Loan
    Route::controller(SdtLoanController::class)->prefix('loans')->name('loans')->middleware('auth:sdt')->group(function () {
        Route::get('/', 'index')->name('.index');
        Route::get('{uid}', 'find')->name('.find');
        Route::post('/', 'store')->name('.store');
        Route::put('{loan}', 'update')->name('.update');
    });
});

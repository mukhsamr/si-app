<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Sbt\AuthController as SbtAuthController;
use App\Http\Controllers\Sbt\NoteController as SbtNoteController;
use App\Http\Controllers\Sbt\StudentController as SbtStudentController;
use App\Http\Controllers\Sdt\AuthController as SdtAuthController;
use App\Http\Controllers\Sdt\DeviceController as SdtDeviceController;
use App\Http\Controllers\Sdt\LoanController as SdtLoanController;
use App\Http\Controllers\Sdt\RakController as SdtRakController;
use App\Http\Controllers\Sdt\StudentController as SdtStudentController;
use App\Http\Controllers\Sdt\UserController as SdtUserController;
use App\Http\Controllers\Santri\AuthController as SantriAuthController;
use App\Http\Controllers\Santri\PlanController as SantriPlanController;
use App\Http\Controllers\Santri\UserController as SantriUserController;
use App\Http\Controllers\Sbt\SbtController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;



// APP
Route::prefix('app')->middleware('connection:app')->group(function () {

    // Auth
    Route::controller(AuthController::class)->prefix('auth')->group(function () {
        Route::post('login', 'login');
        Route::post('logout', 'logout')->middleware('auth:app');
    });

    // User
    // Route::apiResource('users', UserController::class)->middleware('auth:app');

    // Student
    Route::apiResource('students', StudentController::class)->middleware('auth:app')
        ->scoped(['student' => 'nis']);
});











// SDT
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
        Route::get('{uid}', 'show');
        Route::get('name-only', 'nameOnly');
        Route::put('update', 'update');
    });

    // Rak
    Route::apiResource('raks', SdtRakController::class)->middleware('auth:sdt');

    // Device
    Route::apiResource('devices', SdtDeviceController::class)->middleware('auth:sdt');
    Route::get('devices/upload/template', [SdtDeviceController::class, 'templateDevice'])->middleware('auth:sdt')->name('devices.template');
    Route::put('devices/assign/{device}', [SdtDeviceController::class, 'assign'])->middleware('auth:sdt')->name('devices.assign');

    // Loan
    Route::controller(SdtLoanController::class)->prefix('loans')->name('loans')->middleware('auth:sdt')->group(function () {
        Route::get('/', 'index')->name('.index');
        Route::get('{uid}', 'find')->name('.find');
        Route::post('/', 'store')->name('.store');
        Route::put('{loan}', 'update')->name('.update');
    });
});






// SBT
Route::prefix('sbt')->middleware('connection:sbt')->name('sbt.')->group(function () {

    // Home
    Route::get('/', [SbtController::class, 'index']);

    // Auth
    Route::controller(SbtAuthController::class)->prefix('auth')->group(function () {
        Route::post('login', 'login');
        Route::post('logout', 'logout')->middleware('auth:sbt');
        Route::get('user', 'user')->middleware('auth:sbt');
    });

    // User
    Route::put('users/{user}', [SdtUserController::class, 'update'])->middleware('auth:sbt');

    // Note
    Route::apiResource('notes', SbtNoteController::class)->except('update')->middleware('auth:sbt');
    Route::post('notes/{note}/update', [SbtNoteController::class, 'update'])->name('notes.update')->middleware('auth:sbt');

    // Student
    Route::controller(SbtStudentController::class)->middleware('auth:sbt')->prefix('students')->name('students.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('list', 'list')->name('list');
        Route::get('{student:nis}', 'show')->name('show');
        Route::get('{student}/notes', 'notes')->name('notes');
        Route::get('{student}/latest-note', 'latestNote')->name('latest-note');
        Route::get('{student}/plans', 'plans')->name('plans');
        Route::get('{student}/plans/{planId}', 'plan')->name('plan');
        Route::get('{student}/latest-plan', 'latestPlan')->name('latest-plan');
    });
});






// SANTRI
Route::prefix('santri')->middleware('connection:santri')->name('santri.')->group(function () {

    // Auth
    Route::controller(SantriAuthController::class)->prefix('auth')->name('auth.')->group(function () {
        Route::post('login', 'login')->name('login');
        Route::post('logout', 'logout')->middleware('auth:santri')->name('logout');
        Route::get('profile', 'profile')->middleware('auth:santri')->name('profile');
    });

    // User
    Route::controller(SantriUserController::class)->middleware('auth:santri')->prefix('users')->name('users.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('{student:nis}', 'show')->name('show');
    });

    // Plan
    Route::apiResource('plans', SantriPlanController::class)->middleware('auth:santri');
    Route::controller(SantriPlanController::class)->middleware('auth:santri')->name('plans.')->group(function () {
        Route::get('plans-latest', 'getLatestPlan')->name('latest');
        Route::get('plans-count', 'getCountPlan')->name('count');
        Route::post('plans/{plan}/upload', 'upload')->name('upload');
    });
});

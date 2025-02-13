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
use App\Http\Controllers\Student\AuthController as StudentAuthController;
use App\Http\Controllers\Student\PlanController as StudentPlanController;
use App\Http\Controllers\Student\UserController as StudentUserController;
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
Route::prefix('sbt')->middleware('connection:sbt')->group(function () {

    // Auth
    Route::controller(SbtAuthController::class)->prefix('auth')->group(function () {
        Route::post('login', 'login');
        Route::post('logout', 'logout')->middleware('auth:sbt');
        Route::get('user', 'user')->middleware('auth:sbt');
    });

    // // User
    // Route::apiResource('users', SdtUserController::class)->middleware('auth:sdt');

    // Note
    Route::apiResource('notes', SbtNoteController::class)->middleware('auth:sbt');

    // Student
    Route::controller(SbtStudentController::class)->prefix('students')->group(function () {
        Route::get('/', 'index')->name('students.index');
        Route::get('{student}', 'show')->name('students.show');
        Route::get('{student}/notes', 'notes')->name('students.notes');
        Route::get('{student}/latest-note', 'latestNote')->name('students.latest-note');

        // STUDENT-API
        Route::get('{student}/plans', 'getPlans')->name('students.plans');
        Route::get('{student}/plans/{planId}', 'getPlan')->name('students.plan');
        Route::get('{student}/latest-plan', 'getLatestPlan')->name('students.latest-plan');

        // APP-API
        Route::get('{student}/bio', 'getBio')->name('students.bio');
    });

    // Plan
    // Route::apiResource('plans', SbtPlanController::class)->middleware('auth:sbt');
    // Route::get('/plans-latest', [SbtPlanController::class, 'latest'])->middleware('auth:sbt')->name('plans.latest');
});






// STUDENT
Route::prefix('student')->middleware('connection:student')->name('student.')->group(function () {

    // Auth
    Route::controller(StudentAuthController::class)->prefix('auth')->name('auth.')->group(function () {
        Route::post('login', 'login')->name('login');
        Route::post('logout', 'logout')->middleware('auth:student')->name('logout');
        Route::get('profile', 'profile')->middleware('auth:student')->name('profile');
    });

    // User
    // Route::apiResource('users', StudentUserController::class)->middleware('auth:student');

    // Plan
    Route::apiResource('plans', StudentPlanController::class)->middleware('auth:student');
    Route::controller(StudentPlanController::class)->middleware('auth:student')->name('plans.')->group(function () {
        Route::get('plans-latest', 'getLatestPlan')->name('latest');
        Route::get('plans-count', 'getCountPlan')->name('count');
        Route::post('plans/{plan}/upload', 'upload')->name('upload');
    });
});

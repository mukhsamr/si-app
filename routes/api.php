<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Sbt\AuthController as SbtAuthController;
use App\Http\Controllers\Sbt\NoteController as SbtNoteController;
use App\Http\Controllers\Sbt\StudentController as SbtStudentController;
use App\Http\Controllers\Sbt\UserController as SbtUserController;
use App\Http\Controllers\Sdt\AuthController as SdtAuthController;
use App\Http\Controllers\Sdt\DeviceController as SdtDeviceController;
use App\Http\Controllers\Sdt\LoanController as SdtLoanController;
use App\Http\Controllers\Sdt\RakController as SdtRakController;
use App\Http\Controllers\Sdt\StudentController as SdtStudentController;
use App\Http\Controllers\Sdt\UserController as SdtUserController;
use App\Http\Controllers\Santri\AuthController as SantriAuthController;
use App\Http\Controllers\Santri\PlanController as SantriPlanController;
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
    Route::controller(SdtStudentController::class)->prefix('student')->middleware('auth:sdt')->name('student')->group(function () {
        Route::get('/', 'index')->name('.index');
        Route::get('name-only', 'nameOnly')->name('.nameOnly');
        Route::get('import-template', 'import_template')->name('.template');
        Route::get('{student:uid}', 'show')->name('.show');

        Route::post('generate', 'generate')->name('.generate');
        Route::post('upload', 'upload')->name('.upload');

        Route::put('update/{student}', 'update')->name('.update');
    });

    // Rak
    Route::put('raks/assign/{rak}', [SdtRakController::class, 'assign'])->middleware('auth:sdt')->name('rak.assign');
    Route::apiResource('raks', SdtRakController::class)->middleware('auth:sdt');

    // Device
    Route::controller(SdtDeviceController::class)->prefix('device')->name('device')->middleware('auth:sdt')->group(function () {
        Route::get('/', 'index')->name('.index');
        Route::get('summary', 'summary')->name('.summary');
        Route::get('import-template', 'import_template')->name('.template');
        Route::get('{device:uid}', 'show')->name('.show');

        Route::post('/', 'store')->name('.store');
        Route::post('upload', 'upload')->name('.upload');

        Route::put('{device}', 'update')->name('.update');
        Route::put('{device}/assign', 'assign')->name('.assign');

        Route::delete('{device}', 'destroy')->name('.destroy');
    });

    // Loan
    Route::controller(SdtLoanController::class)->prefix('loans')->name('loans')->middleware('auth:sdt')->group(function () {
        Route::get('/', 'index')->name('.index');
        Route::get('{uid}', 'find')->name('.find');

        Route::post('/', 'store')->name('.store');

        Route::put('/', 'update')->name('.update');
    });
});






// SBT
Route::prefix('sbt')->middleware('connection:sbt')->name('sbt.')->group(function () {

    // Home
    Route::get('/', [SbtController::class, 'index']);

    // Auth
    Route::controller(SbtAuthController::class)->prefix('auth')->group(function () {
        Route::post('login', 'login');
        Route::get('user', 'user')->middleware('auth:sbt');
    });

    // User
    Route::put('users/{user}', [SbtUserController::class, 'update'])->middleware('auth:sbt');

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
        Route::get('user', 'user')->middleware('auth:santri')->name('user');
    });

    // Plan
    Route::controller(SantriPlanController::class)->middleware('auth:santri')->prefix('plans')->name('plans.')->group(function () {
        Route::get('latest', 'latestPlan')->name('latest');
        Route::post('{plan}/upload', 'upload')->name('upload');
        Route::post('{plan}/clone', 'clone')->name('clone');
        Route::put('{plan}/detail', 'updateDetail')->name('updateDetail');
    });
    Route::apiResource('plans', SantriPlanController::class)->middleware('auth:santri');
});

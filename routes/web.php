<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\CobaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->middleware('role_redirect');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/students', [StudentController::class, 'index']);
    Route::get('/students/{id}', [StudentController::class, 'show']);
    Route::post('/students', [StudentController::class, 'store']);
    Route::get('/students/{id}/edit', [StudentController::class, 'edit']);
    Route::put('/students/{id}', [StudentController::class, 'update']);
    Route::delete('/students/{id}', [StudentController::class, 'destroy']);
});

Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/home', [AccountController::class, 'index']);
    Route::put('/home', [AccountController::class, 'update']);
    // criteria 3
    // route for change password
    Route::get('/change-password', [AccountController::class, 'changePassword']);
    Route::put('/change-password', [AccountController::class, 'updatePassword']);

});



// Route::resource('/students', StudentController::class);

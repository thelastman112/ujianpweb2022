<?php

use App\Http\Controllers\CobaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/home', [HomeController::class, 'index']);

Route::middleware(['role_redirect', 'auth', 'role:admin|user'])->group(function () {
    Route::get('/', [StudentController::class, 'index']);
    Route::get('/students/{id}', [StudentController::class, 'show']);
    Route::post('/students', [StudentController::class, 'store']);
    Route::get('/students/{id}/edit', [StudentController::class, 'edit']);
    Route::put('/students/{id}', [StudentController::class, 'update']);
    Route::delete('/students/{id}', [StudentController::class, 'destroy']);
});



// Route::resource('/students', StudentController::class);

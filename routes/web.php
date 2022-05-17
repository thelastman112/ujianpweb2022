<?php

use App\Http\Controllers\CobaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/coba', [CobaController::class, 'index'])->name('coba.index');
    Route::post('/coba', [CobaController::class, 'store'])->name('coba.store');
    Route::get('/coba/{coba}/edit', [CobaController::class, 'edit'])->name('coba.edit');
    Route::put('/coba/{coba}', [CobaController::class, 'update'])->name('coba.update');
    Route::delete('/coba/{coba}', [CobaController::class, 'destroy'])->name('coba.destroy');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

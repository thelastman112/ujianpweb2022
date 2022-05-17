<?php

use App\Http\Controllers\CobaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/coba', [CobaController::class, 'index'])->name('coba.index');

Route::post('/coba', [CobaController::class, 'store'])->name('coba.store');

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarDataController;

// Home route
Route::get('/', function () {
    return view('welcome');
});

// Authentication routes
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::get('/car', [CarDataController::class, 'car'])->name('car');
Route::post('/carstore', [CarDataController::class, 'carstore'])->name('cars.store');

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Auth;

// AUTH
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'processLogin']);
Route::get('/register', [AuthController::class, 'register']);
Route::post('/register', [AuthController::class, 'processRegister']);

// ADMIN
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
    // Route::get('/reservasi', [ReservasiController::class, 'index'])->name('reservasi'); 
    //bikin model sama controller reservasi dulu
});

//LOGOUT
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

// USER
Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/user/dashboard', [UsersController::class, 'dashboard']);
});
<?php

use App\Http\Controllers\AdminDashboard\UsersAdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminDashboard\AdminController;
use App\Http\Controllers\AdminDashboard\MenuController;
use App\Http\Controllers\AdminDashboard\MejaController;
use App\Http\Controllers\AdminDashboard\ReservasiController;
use App\Http\Controllers\UserPage\UsersController;
use Illuminate\Support\Facades\Auth;

// AUTH
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'processLogin']);
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'processRegister'])->name('register.process');



// prefix itu menambahkan "/admin" didepan semua route, jdi kia ga perlu nulis /admin misalnya di depannya /dashboard -> Route::get('/dashboard',
// ================= ADMIN =================
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () { 

    // dashboard utama
    Route::get('/dashboard', [AdminController::class, 'dashboard'])
        ->name('admin.dashboard');

    //reservasi
    Route::get('/reservasi', [ReservasiController::class, 'index']) // -> index yg di sini itu harus sesuai sama public function yg di controllernya
        ->name('admin.reservasi.index'); //trus ini itu tujuan halamannya mau kemana
    Route::get('/reservasi/{id}', [ReservasiController::class, 'show'])
    ->name('admin.reservasi.show');
    Route::patch('/admin/reservasi/{id}/status', 
    [ReservasiController::class, 'updateStatus']
    )->name('admin.reservasi.status');

    Route::delete('/admin/reservasi/{id}', [ReservasiController::class, 'destroy'])
    ->name('admin.reservasi.destroy');

    
    //menu
    Route::resource('menu', MenuController::class)->names('admin.menu');

    //meja
    Route::resource('meja', MejaController::class)->names('admin.meja');
    
    //users
    // Route::get('/users', [UsersAdminController::class, 'index']) 
    //     ->name('admin.users.index'); 
    // Route::get('/users/{id}', [UsersAdminController::class, 'show'])
    // ->name('admin.users.show');
    // Route::delete('/users/{id}', [UsersAdminController::class, 'destroy'])
    //     ->name('admin.users.destroy');
    Route::resource('users', UsersAdminController::class)->names('admin.users');
});


// ================= USER =================
Route::middleware(['auth', 'user'])->prefix('user')->group(function () {

    Route::get('/dashboard', [UsersController::class, 'userMenu'])
        ->name('user.dashboard');

    Route::delete('/user/{id}', [UsersController::class, 'destroy'])
        ->name('user.destroy');

    Route::get('/profile', [UsersController::class, 'profile'])
        ->name('user.profile');

    //reservasi

Route::get('/reservasi', [UsersController::class, 'reservasiForm'])->name('reservasi.form');

Route::post('/reservasi/menu', [UsersController::class, 'reservasiMenu'])->name('reservasi.menu');

Route::match(['get','post'], '/reservasi/checkout', 
    [UsersController::class, 'reservasiCheckout']
)->name('reservasi.checkout');

Route::post('/reservasi/store', [UsersController::class, 'reservasiStore'])->name('reservasi.store');

Route::get('/riwayat', [UsersController::class, 'riwayat'])->name('user.riwayat');

Route::delete('/user/reservasi/{id}', 
    [UsersController::class, 'destroyReservasi']
)->name('user.reservasi.delete');
});




// LOGOUT
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');
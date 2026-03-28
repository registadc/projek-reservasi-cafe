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
Route::get('/register', [AuthController::class, 'register']);
Route::post('/register', [AuthController::class, 'processRegister']);


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
    
    //menu
    Route::resource('menu', MenuController::class)->names('admin.menu');

    //meja
    Route::resource('meja', MejaController::class)->names('admin.meja');
    
    //users
    Route::get('/users', [UsersAdminController::class, 'index']) 
        ->name('admin.users.index'); 
    Route::get('/users/create', [UsersAdminController::class, 'create']) 
        ->name('admin.users.create'); 
    Route::post('/users', [UsersAdminController::class, 'store']) 
        ->name('admin.users.store'); 
    Route::delete('/users/{id}', [UsersAdminController::class, 'destroy'])
        ->name('admin.users.destroy');
});


// ================= USER =================
Route::middleware(['auth', 'user'])->prefix('user')->group(function () {

    Route::get('/dashboard', [UsersController::class, 'dashboard'])
        ->name('user.dashboard');

});


// LOGOUT
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');
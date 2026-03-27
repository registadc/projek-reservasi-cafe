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
    
    //menu
    Route::get('/menu', [MenuController::class, 'index']) 
        ->name('admin.menu.index'); 
    Route::get('/menu/create', [MenuController::class, 'create']) 
        ->name('admin.menu.create'); 
    Route::post('/menu', [MenuController::class, 'store']) 
        ->name('admin.menu.store'); 
    Route::get('/menu/{id}/edit', [MenuController::class, 'edit']) 
        ->name('admin.menu.edit'); 
    Route::put('/menu/{id}', [MenuController::class, 'update']) 
        ->name('admin.menu.update'); 
    Route::get('/menu/{id}', [MenuController::class, 'show']) 
        ->name('admin.menu.show');
    Route::delete('/menu/{id}', [MenuController::class, 'destroy'])
        ->name('admin.menu.destroy');

    //meja
    Route::get('/meja', [MejaController::class, 'index']) 
        ->name('admin.meja.index'); 
    Route::get('/meja/create', [MejaController::class, 'create']) 
        ->name('admin.meja.create'); 
    Route::post('/meja', [MejaController::class, 'store']) 
        ->name('admin.meja.store'); 
    Route::get('/meja/{id}/edit', [MejaController::class, 'edit']) 
        ->name('admin.meja.edit'); 
    Route::put('/meja/{id}', [MejaController::class, 'update']) 
        ->name('admin.meja.update'); 
    Route::get('/meja/{id}', [MejaController::class, 'show']) 
        ->name('admin.meja.show');
    Route::delete('/meja/{id}', [MejaController::class, 'destroy'])
        ->name('admin.meja.destroy');
    
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
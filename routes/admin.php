<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::prefix('admin')->group(function () {
    Route::get('login', [LoginController::class, 'index'])->name('admin.login.index');
    Route::post('login', [LoginController::class, 'login'])->name('admin.login.login');
    Route::get('logout', [LoginController::class, 'logout'])->name('admin.login.logout');
  
    Route::get('/', [HomeController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('create', [HomeController::class, 'create'])->name('admin.create');
    Route::post('article', [HomeController::class, 'store'])->name('admin.store');
  });
  

Route::prefix('admin')->middleware('auth:admins')->group(function () {
    Route::get('/', [HomeController::class, 'dashboard'])->name('admin.dashboard');
  });

require __DIR__.'/auth.php';

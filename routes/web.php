<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ArticleController;

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
require __DIR__ . '/admin.php';


Route::get('/', function () {
    return view('top');
});

Route::get('profile', [PortfolioController::class, 'showProfile'])->name('profile');
Route::get('work', [PortfolioController::class, 'showWork'])->name('work');

Route::get('article', [ArticleController::class, 'index'])->name('article');

Route::get('show1', [ArticleController::class, 'show1'])->name('article.show1');
Route::get('show2', [ArticleController::class, 'show2'])->name('article.show2');
Route::get('show3', [ArticleController::class, 'show3'])->name('article.show3');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    //Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    //Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    //Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

<?php
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\MailController;

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
require __DIR__ . '/auth.php';

Route::get('/', function () {
    return view('top');
});

Route::get('myprofile', [PortfolioController::class, 'showProfile'])->name('profile');
Route::get('work', [PortfolioController::class, 'showWork'])->name('work');

Route::get('article', [ArticleController::class, 'index'])->name('article');

Route::get('show/{id}', [ArticleController::class, 'show'])->name('article.show');
Route::get('contact', [MailController::class, 'create'])->name('mail.index');
Route::post('contact', [MailController::class, 'confirm'])->name('mail.confirm');
Route::post('send', [MailController::class, 'send'])->name('mail.send');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

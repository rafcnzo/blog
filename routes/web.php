<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\KomentarController;
use App\Http\Controllers\BeritaPopulerController;

// Home route untuk halaman utama
// Ubah route welcome menjadi
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::get('/detail/{id}', [WelcomeController::class, 'show'])->name('detail');

Route::get('/berita-populer', [BeritaPopulerController::class, 'index'])
    ->name('berita.populer');

Route::middleware(['auth', 'role:owner'])->group(function () {
    Route::get('/news/create', [NewsController::class, 'create'])->name('news.create');
    Route::post('/news/store', [NewsController::class, 'store'])->name('news.store');
    Route::get('/news/{id}/edit', [NewsController::class, 'edit'])->name('news.edit');
    Route::put('/news/update/{id}', [NewsController::class, 'update'])->name('news.update');
    Route::delete('/news/{id}', [NewsController::class, 'destroy'])->name('news.destroy');
});

// Rute untuk komentar
Route::middleware(['auth'])->group(function() {
    Route::post('/komentar/{beritaId}', [KomentarController::class, 'store'])
        ->name('komentar.store');
    
    Route::delete('/komentar/{komentarId}', [KomentarController::class, 'delete'])
        ->name('komentar.delete');
});



// Login dan Logout routes
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Register routes
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

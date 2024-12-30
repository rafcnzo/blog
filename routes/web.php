<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\NewsController;

// Home route untuk halaman utama
Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/home', function () {
        return view('member.member');
    })->name('home');

    Route::get('/berita', function () {
        return view('Admin.newsread');})->name('news');
    Route::get('/tambahberita', function () {
        return view('Admin.newscreate');})->name('createnews');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', function () {return view('Admin.dashboard');})->name('dashboard');

    Route::get('/userread', [UserController::class, 'index'])->name('user.index');
    Route::get('/usercreate', [UserController::class, 'create'])->name('user.create');
    Route::post('/userstore', [UserController::class, 'store'])->name('user.store');
    Route::get('/useredit/{email}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/userupdate/{email}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/userdelete/{email}', [UserController::class, 'delete'])->name('user.delete');

    Route::get('/news', [NewsController::class, 'index'])->name('news.index');
    Route::get('/news/create', [NewsController::class, 'create'])->name('news.create');
    Route::post('/news/store', [NewsController::class, 'store'])->name('news.store');
    Route::get('/news/edit/{id}', [NewsController::class, 'edit'])->name('news.edit');
    Route::put('/news/update/{id}', [NewsController::class, 'update'])->name('news.update');
    Route::delete('/news/delete/{id}', [NewsController::class, 'delete'])->name('news.delete');
});



// Login dan Logout routes
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Register routes
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

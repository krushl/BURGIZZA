<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home.index');
})->name('home');

Route::get('/menu',[MainController::class,'menu'])->name('menu');
Route::get('/article')->name('article');

Route::get('/delivery', function () {
    return view('delivery.index');
})->name('delivery');


Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('showLoginForm');


Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('showRegisterForm');

Route::middleware('auth')->group(function () {
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::post('/profile/change', [ProfileController::class, 'changeOptional'])->name('changeOptional');
    Route::get('/basket')->name('basket');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('can:admin')->group(function () {
        Route::get('/index', [AdminController::class, 'adminIndex'])->name('index');

        Route::prefix('burger')->name('burger.')->group(function () {
            Route::get('/add', [AdminController::class, 'burgerAddForm'])->name('burger-addForm');
            Route::post('/add', [AdminController::class, 'burgerAdd'])->name('burger-add');

            Route::get('/edit/', [AdminController::class, 'burgerEditForm'])->name('burger-editForm');
            Route::post('/edit', [AdminController::class, 'burgerEdit'])->name('burger-edit');

            Route::post('/destroy', [AdminController::class, 'burgerDestroy'])->name('burger-destroy');
        });

        Route::prefix('category')->name('category.')->group(function () {
            Route::post('/add', [AdminController::class, 'categoryAdd'])->name('add');
            Route::post('/edit', [AdminController::class, 'categoryEdit'])->name('edit');
            Route::post('/destroy', [AdminController::class, 'categoryDestroy'])->name('destroy');
        });

        Route::prefix('status')->name('status.')->group(function () {
            Route::post('/add', [AdminController::class, 'statusAdd'])->name('add');
            Route::post('/edit', [AdminController::class, 'statusEdit'])->name('edit');
            Route::post('/destroy', [AdminController::class, 'statusDestroy'])->name('destroy');
            Route::post('/index', [AdminController::class, 'statusIndex'])->name('index');
        });

        Route::prefix('articles')->name('articles.')->group(function () {
            Route::post('/add', [AdminController::class, 'articlesAdd'])->name('add');
            Route::post('/edit', [AdminController::class, 'articlesEdit'])->name('edit');
            Route::post('/destroy', [AdminController::class, 'articlesDestroy'])->name('destroy');
            Route::post('/index', [AdminController::class, 'articlesIndex'])->name('index');
        });

    });
});

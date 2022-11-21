<?php

use App\Http\Controllers\News\NewsCategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\Main\MainController;
use App\Http\Controllers\News\NewsController;
use App\Http\Controllers\UserController;
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
    return view('welcome');
});

Route::prefix('admin')->middleware('auth', 'isAdmin')->group(function(){
    Route::get('/dashboard/', function () {
        return view('admin.layout.index');
    })->name('index');

    Route::controller(UserController::class)->group(function () {
        Route::get('/user/', 'index')->name('u-index');
        Route::get('/user/create', 'create')->name('u-create');
        Route::post('/user/create', 'store')->name('u-store');
        Route::get('/user/edit/{id}', 'edit')->name('u-edit');
        Route::put('/user/edit', 'update')->name('u-update');
        Route::get('/user/destroy', 'destroy')->name('u-destroy');
        Route::post('/user/isactive/{id}', 'is_active');

    });

    Route::controller(NewsCategoryController::class)->group(function () {
        Route::get('/news_cat/', 'index')->name('c-index');
        Route::get('/news_cat/create', 'create')->name('c-create');
        Route::post('/news_cat/create', 'store')->name('c-store');
        Route::get('/news_cat/edit/{id}', 'edit')->name('c-edit');
        Route::put('/news_cat/edit', 'update')->name('c-update');
        Route::get('/news_cat/delete', 'delete')->name('c-delete');
        Route::post('/news_cat/isactive/{id}', 'is_active');
    });

    Route::controller(NewsController::class)->group(function () {
        Route::get('/news/', 'index')->name('n-index');
        Route::get('/news/create', 'create')->name('n-create');
        Route::post('/news/create', 'store')->name('n-store');
        Route::get('/news/edit/{id}', 'edit')->name('n-edit');
        Route::put('/news/edit', 'update')->name('n-update');
        Route::get('/news/delete', 'delete')->name('n-delete');
        Route::post('/news/isactive/{id}', 'is_active');
    });

    Route::controller(MainController::class)->group(function () {
        Route::get('/main/', 'index')->name('m-index');
        Route::get('/main/create', 'create')->name('m-create');
        Route::post('/main/create', 'store')->name('m-store');
        Route::get('/main/edit/{id}', 'edit')->name('m-edit');
        Route::put('/main/edit', 'update')->name('m-update');
        Route::get('/main/delete', 'delete')->name('m-delete');
        Route::post('/main/isactive/{id}', 'is_active');
    });

});


Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

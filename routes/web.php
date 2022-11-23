<?php

use App\Http\Controllers\About\AboutController;
use App\Http\Controllers\Contact\ContactController;
use App\Http\Controllers\Gallery\GalleryController;
use App\Http\Controllers\News\NewsCategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\Main\MainController;
use App\Http\Controllers\News\NewsController;
use App\Http\Controllers\Partner\PartnerController;
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

    Route::controller(AboutController::class)->group(function () {
        Route::get('/about/', 'index')->name('a-index');
        Route::get('/about/create', 'create')->name('a-create');
        Route::post('/about/create', 'store')->name('a-store');
        Route::get('/about/edit/{id}', 'edit')->name('a-edit');
        Route::put('/about/edit', 'update')->name('a-update');
        Route::get('/about/delete', 'delete')->name('a-delete');
        Route::post('/about/isactive/{id}', 'is_active');
    });

    Route::controller(PartnerController::class)->group(function () {
        Route::get('/partner/', 'index')->name('p-index');
        Route::get('/partner/create', 'create')->name('p-create');
        Route::post('/partner/create', 'store')->name('p-store');
        Route::get('/partner/edit/{id}', 'edit')->name('p-edit');
        Route::put('/partner/edit', 'update')->name('p-update');
        Route::get('/partner/delete', 'delete')->name('p-delete');
        Route::post('/partner/isactive/{id}', 'is_active');
    });

    Route::controller(ContactController::class)->group(function () {
        Route::get('/contact/', 'index')->name('ct-index');
        Route::get('/contact/create', 'create')->name('ct-create');
        Route::post('/contact/create', 'store')->name('ct-store');
        Route::get('/contact/edit/{id}', 'edit')->name('ct-edit');
        Route::put('/contact/edit', 'update')->name('ct-update');
        // Route::get('/partner/delete', 'delete')->name('p-delete');
        Route::post('/contact/isactive/{id}', 'is_active');
    });

    Route::controller(GalleryController::class)->group(function () {
        Route::get('/gallery/', 'index')->name('g-index');
        Route::get('/gallery/create', 'create')->name('g-create');
        Route::post('/gallery/create', 'store')->name('g-store');
        Route::get('/gallery/edit/{id}', 'edit')->name('g-edit');
        Route::put('/gallery/edit', 'update')->name('g-update');
        Route::get('/gallery/delete', 'delete')->name('g-delete');
        Route::post('/gallery/isactive/{id}', 'is_active');
    });

});


Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

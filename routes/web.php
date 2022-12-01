<?php

use App\Http\Controllers\About\AboutController;
use App\Http\Controllers\Administration\AdministrationController;
use App\Http\Controllers\Contact\ContactController;
use App\Http\Controllers\Departament\DepartamentController;
use App\Http\Controllers\Employee\EmployeeController;
use App\Http\Controllers\Gallery\GalleryController;
use App\Http\Controllers\News\NewsCategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\Main\MainController;
use App\Http\Controllers\News\NewsController;
use App\Http\Controllers\Partner\PartnerController;
use App\Http\Controllers\Position\PositionController;
use App\Http\Controllers\Specialist\SpecialistController;
use App\Http\Controllers\UserController;
use App\Models\Position\Position;
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
        Route::delete('/user/delete/{id}', 'delete')->name('u-delete');
        Route::post('/user/isactive/{id}', 'is_active');

    });

    Route::controller(NewsCategoryController::class)->group(function () {
        Route::get('/news_cat/', 'index')->name('c-index');
        Route::get('/news_cat/create', 'create')->name('c-create');
        Route::post('/news_cat/create', 'store')->name('c-store');
        Route::get('/news_cat/edit/{id}', 'edit')->name('c-edit');
        Route::put('/news_cat/edit', 'update')->name('c-update');
        Route::delete('/news_cat/delete/{id}', 'delete')->name('c-delete');
        Route::post('/news_cat/isactive/{id}', 'is_active');
    });

    Route::controller(NewsController::class)->group(function () {
        Route::get('/news/', 'index')->name('n-index');
        Route::get('/news/create', 'create')->name('n-create');
        Route::post('/news/create', 'store')->name('n-store');
        Route::get('/news/edit/{id}', 'edit')->name('n-edit');
        Route::put('/news/edit', 'update')->name('n-update');
        Route::delete('/news/delete/{id}', 'delete')->name('n-delete');
        Route::post('/news/isactive/{id}', 'is_active');
    });

    Route::controller(MainController::class)->group(function () {
        Route::get('/main/', 'index')->name('m-index');
        Route::get('/main/create', 'create')->name('m-create');
        Route::post('/main/create', 'store')->name('m-store');
        Route::get('/main/edit/{id}', 'edit')->name('m-edit');
        Route::put('/main/edit', 'update')->name('m-update');
        Route::delete('/main/delete/{id}', 'delete')->name('m-delete');
        Route::post('/main/isactive/{id}', 'is_active');
    });

    Route::controller(AboutController::class)->group(function () {
        Route::get('/about/', 'index')->name('a-index');
        Route::get('/about/create', 'create')->name('a-create');
        Route::post('/about/create', 'store')->name('a-store');
        Route::get('/about/edit/{id}', 'edit')->name('a-edit');
        Route::put('/about/edit', 'update')->name('a-update');
        Route::delete('/about/delete/{id}', 'delete')->name('a-delete');
        Route::post('/about/isactive/{id}', 'is_active');
    });

    Route::controller(PartnerController::class)->group(function () {
        Route::get('/partner/', 'index')->name('p-index');
        Route::get('/partner/create', 'create')->name('p-create');
        Route::post('/partner/create', 'store')->name('p-store');
        Route::get('/partner/edit/{id}', 'edit')->name('p-edit');
        Route::put('/partner/edit', 'update')->name('p-update');
        Route::delete('/partner/delete/{id}', 'delete')->name('p-delete');
        Route::post('/partner/isactive/{id}', 'is_active');
    });

    Route::controller(ContactController::class)->group(function () {
        Route::get('/contact/', 'index')->name('ct-index');
        Route::get('/contact/create', 'create')->name('ct-create');
        Route::post('/contact/create', 'store')->name('ct-store');
        Route::get('/contact/edit/{id}', 'edit')->name('ct-edit');
        Route::put('/contact/edit', 'update')->name('ct-update');
        Route::delete('/partner/delete/{id}', 'delete')->name('p-delete');
        Route::post('/contact/isactive/{id}', 'is_active');
    });

    Route::controller(GalleryController::class)->group(function () {
        Route::get('/gallery/', 'index')->name('g-index');
        Route::get('/gallery/create', 'create')->name('g-create');
        Route::post('/gallery/create', 'store')->name('g-store');
        Route::get('/gallery/edit/{id}', 'edit')->name('g-edit');
        Route::put('/gallery/edit', 'update')->name('g-update');
        Route::delete('/gallery/delete/{id}', 'delete')->name('g-delete');
        Route::post('/gallery/isactive/{id}', 'is_active');
    });

    Route::controller(DepartamentController::class)->group(function () {
        Route::get('/departament/', 'index')->name('d-index');
        Route::get('/departament/create', 'create')->name('d-create');
        Route::post('/departament/create', 'store')->name('d-store');
        Route::get('/departament/edit/{id}', 'edit')->name('d-edit');
        Route::put('/departament/edit', 'update')->name('d-update');
        Route::delete('/departament/delete/{id}', 'delete')->name('d-delete');
        Route::post('/departament/isactive/{id}', 'is_active');
    });

    Route::controller(PositionController::class)->group(function () {
        Route::get('/position/', 'index')->name('po-index');
        Route::get('/position/create', 'create')->name('po-create');
        Route::post('/position/create', 'store')->name('po-store');
        Route::get('/position/edit/{id}', 'edit')->name('po-edit');
        Route::put('/position/edit', 'update')->name('po-update');
        Route::delete('/position/delete/{id}', 'delete')->name('po-delete');
        Route::post('/position/isactive/{id}', 'is_active');
    });

    Route::controller(EmployeeController::class)->group(function () {
        Route::get('/employee/', 'index')->name('emp-index');
        Route::get('/employee/create', 'create')->name('emp-create');
        Route::get('/employee/create_division', 'create_division')->name('emp-create_division');
        Route::get('/employee/create_employee', 'create_employee')->name('emp-create_employee');
        Route::post('/employee/create', 'store')->name('emp-store');
        Route::post('/employee/create_division', 'store_division')->name('emp-store_division');
        Route::post('/employee/create_employee', 'store_employee')->name('emp-store_employee');
        Route::get('/employee/edit/{id}', 'edit')->name('emp-edit');
        Route::get('/employee/edit_division/{id}', 'edit_division')->name('emp-edit_division'); 
        Route::get('/employee/edit_employee/{id}', 'edit_employee')->name('emp-edit_employee');
        Route::put('/employee/edit', 'update')->name('emp-update');
        Route::put('/employee/edit_division', 'update_division')->name('emp-update_division');
        Route::put('/employee/edit_employee', 'update_employee')->name('emp-update_employee');
        // Route::get('/employee/delete', 'delete')->name('ad-delete');
        // Route::post('/employee/isactive/{id}', 'is_active');
    });


});


Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

<?php

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

    return view('auth.login');
});

Auth::routes();

Route::prefix('admin')->middleware("admin")->group(function () {
    Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');
    Route::prefix("users")->group(function () {
        Route::get('/', [App\Http\Controllers\AdminController::class, 'users'])->name('users');
        Route::get('delete/{id}', [App\Http\Controllers\AdminController::class, 'delete_user'])->name('delete_user');
        Route::get('update/{id}', [App\Http\Controllers\AdminController::class, 'update_user_page'])->name('update_user_page');
        Route::post('update', [App\Http\Controllers\AdminController::class, 'update_user'])->name('update_user');
        Route::get('search', [App\Http\Controllers\AdminController::class, 'search_user'])->name('search_user');
        Route::get('/{id}', [App\Http\Controllers\AdminController::class, 'get_user'])->name('get_user');
        Route::get('/{id}/all_estates', [App\Http\Controllers\AdminController::class, 'all_estate_for_user'])->name('all_estate_for_user');
    });
    Route::get('customer_info_form', [\App\Http\Controllers\AdminController::class, 'customer_info_form_page'])->name('customer_info_form_page');
    Route::post('customer_info_form', [\App\Http\Controllers\AdminController::class, 'customer_info_form'])->name('customer_info_form');
    Route::get('customers_info', [\App\Http\Controllers\AdminController::class, 'customers_info'])->name('customers_info');
    Route::get('{id}/get_customer_info', [\App\Http\Controllers\AdminController::class, 'get_customer_info'])->name('get_customer_info');
    Route::get('search_customers_info', [\App\Http\Controllers\AdminController::class, 'search_customers_info'])->name('search_customers_info');
    Route::get('posters_report', [\App\Http\Controllers\AdminController::class, 'posters_report'])->name('posters_report');
    Route::get('search_posters_report', [\App\Http\Controllers\AdminController::class, 'search_posters_report'])->name('search_posters_report');


});


Route::prefix("circulation")->middleware("circulation")->group(function () {
    Route::get('', [App\Http\Controllers\circulationController::class, 'index'])->name('circulation');
    Route::get('add_estate', [App\Http\Controllers\circulationController::class, 'add_estate_page'])->name('add_estate_page');
    Route::post('add_estate', [App\Http\Controllers\circulationController::class, 'add_estate'])->name('add_estate');
    Route::get('estates', [App\Http\Controllers\circulationController::class, 'estates'])->name('estates');
    Route::get('update/{id}/', [App\Http\Controllers\circulationController::class, 'update_estate_page'])->name('update_estate_page');
    Route::post('update', [App\Http\Controllers\circulationController::class, 'update_estate'])->name('update_estate');
    Route::get('delete', [App\Http\Controllers\circulationController::class, 'delete_estate'])->name('delete_estate');
    Route::get('get/{id}', [App\Http\Controllers\circulationController::class, 'get_estate'])->name('get_estate');
    Route::get('search_estate', [App\Http\Controllers\circulationController::class, 'search_estate'])->name('search_estate');
    Route::get('all_estate', [App\Http\Controllers\circulationController::class, 'all_estates'])->name('all_estates');
    Route::get('today/{id?}', [App\Http\Controllers\circulationController::class, 'estates_of_day'])->name('estates_of_day');
    Route::get('week/{id?}', [App\Http\Controllers\circulationController::class, 'estates_of_week'])->name('estates_of_week');
    Route::get('month/{id?}', [App\Http\Controllers\circulationController::class, 'estates_of_month'])->name('estates_of_month');
    Route::get('year/{id?}', [App\Http\Controllers\circulationController::class, 'estates_of_year'])->name('estates_of_year');
});


Route::prefix("attract")->middleware("attract")->group(function () {
    Route::get('/', [App\Http\Controllers\AttractController::class, 'index'])->name('attract');
    Route::get('/poster_form', [App\Http\Controllers\AttractController::class, 'poster_form_page'])->name('poster_form_page');
    Route::get('/form_2', [App\Http\Controllers\AttractController::class, 'form_2_page'])->name('form_2_page');
    Route::post('/poster_form', [App\Http\Controllers\AttractController::class, 'poster_form'])->name('poster_form');
    Route::post('/form_2', [App\Http\Controllers\AttractController::class, 'form_2'])->name('form_2');
    Route::get('/posters/{user_id?}', [App\Http\Controllers\AttractController::class, 'posters'])->name('posters');
    Route::get('/get_poster/{id}', [App\Http\Controllers\AttractController::class, 'get_poster'])->name('get_poster');
    Route::get('/update_poster/{id}', [App\Http\Controllers\AttractController::class, 'update_poster_page'])->name('update_poster_page');
    Route::post('/update_poster', [App\Http\Controllers\AttractController::class, 'update_poster'])->name('update_poster');
    Route::get('/search_posters', [App\Http\Controllers\AttractController::class, 'search_posters'])->name('search_posters');

});


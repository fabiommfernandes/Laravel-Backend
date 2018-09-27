<?php

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

Auth::routes();


Route::group(
    [],
    function () {
        Route::prefix('admin')->group(function () {
            Route::get('/', 'backoffice\DashboardController@index')->name('dashboard.admin');

            Route::get('/services', 'backoffice\ServicesController@index')->name('services.admin');
            Route::get('/services/create', 'backoffice\ServicesController@create')->name('services.admin.create');
            Route::get('/services/delete/{id}', 'backoffice\ServicesController@destroy')->name('services.admin.delete');
            Route::get('/services/edit/{id}', 'backoffice\ServicesController@edit')->name('services.admin.edit');
            Route::post('/admin/services/edit', 'backoffice\ServicesController@update')->name('services.admin.update');

            Route::get(' / portfolio ', ' backoffice\PortfolioController @index ')->name(' portfolio . admin ');
            Route::get(' / contacts ', ' backoffice\ContactsController @index ')->name(' contacts . admin ');

        });
    }
);



Route::get(' / home ', ' HomeController @index ')->name(' home');

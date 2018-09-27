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


/*
    ADMIN AUTH ROUTES 
*/





Route::group(
    [],
    function () {
        Route::prefix('admin')->group(function () {
            /* --- Services --- */
            Route::get('/services', 'backoffice\ServicesController@index')->name('services.admin');
            Route::get('/services/create', 'backoffice\ServicesController@create')->name('services.admin.create');
            Route::get('/portfolio', 'backoffice\PortfolioController@index')->name('portfolio.admin');
            Route::get('/contacts', 'backoffice\ContactsController@index')->name('contacts.admin');
            
            /* ---  Login  --- */
            Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
            Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');

            /* --- Logout --- */
            Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

            /* --- Dashboard --- */
            Route::get('/', 'backoffice\DashboardController@index')->name('admin.dashboard');
        });
    }
);




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

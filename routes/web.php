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
            Route::get('/services', 'backoffice\ServicesController@index')->name('admin.services');
            Route::get('/services/create', 'backoffice\ServicesController@create')->name('admin.services.create');
            Route::post('/services/create', 'backoffice\ServicesController@store')->name('admin.services.create.submit');
            Route::get('/services/delete/{id}', 'backoffice\ServicesController@destroy')->name('admin.services.delete');
            Route::get('/services/edit/{id}', 'backoffice\ServicesController@edit')->name('admin.services.edit');
            Route::post('/admin/services/edit', 'backoffice\ServicesController@update')->name('admin.services.update');

            Route::get('/portfolio', 'backoffice\PortfolioController@index')->name('admin.portfolio');
            Route::get('/portfolio/create', 'backoffice\PortfolioController@create')->name('admin.portfolio.create');
            Route::post('/portfolio/create', 'backoffice\PortfolioController@store')->name('admin.portfolio.create.submit');
            Route::get('/portfolio/delete/{id}', 'backoffice\PortfolioController@destroy')->name('admin.portfolio.delete');
            /* --- Contacts --- */
            Route::get('/contacts', 'backoffice\ContactsController@index')->name('admin.contacts');
            Route::get('/contacts/edit/', 'backoffice\ContactsController@edit')->name('admin.contacts.edit');
            Route::post('/contacts', 'backoffice\ContactsController@update')->name('admin.contacts.update');

            /* --- Privacy --- */
            Route::get('/privacy', 'backoffice\PrivacyController@index')->name('admin.privacy');

            /* --- Users --- */
            Route::get('/users', 'backoffice\UsersController@index')->name('admin.users');
            Route::get('/users/create', 'backoffice\UsersController@create')->name('admin.users.create');
            Route::post('/users/create', 'backoffice\UsersController@store')->name('admin.users.create.submit');
            Route::get('/users/my-profile/{id}', 'backoffice\UsersController@myProfile')->name('admin.users.my-profile');
            Route::post('/users/my-profile/{id}', 'backoffice\UsersController@storeMyProfile')->name('admin.users.store.my-profile');


            /* ---  Login  --- */
            Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
            Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');

            /* --- Logout --- */
            Route::post('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

            /* --- Dashboard --- */
            Route::get('/', 'backoffice\DashboardController@index')->name('admin.dashboard');
        });
    }
);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

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
    return view('landing');
})->name('landing');

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/logout', "Auth\LoginController@logout");

Route::get('/email/confim/{token}', "Auth\RegisterController@verifyEmail")->name('registerEmailConfirmation');

Route::prefix('admin')->group(function () {
    Route::get('/', 'AdminController@index')->name('admin.home');

    Route::get('/login', 'AuthAdmin\LoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'AuthAdmin\LoginController@login')->name('admin.login.submit');
    Route::post('/logout', 'AuthAdmin\LoginController@logout')->name('admin.logout');
    Route::get('/password/reset', 'AuthAdmin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/email', 'AuthAdmin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset/{token}', 'AuthAdmin\ResetPasswordController@showResetForm')->name('admin.password.reset');
    Route::post('/password/reset', 'AuthAdmin\ResetPasswordController@reset');

    // user management
    Route::post('user/edit', 'AdminController@editUser')->name('admin.user.edit');
    Route::prefix('user/{id}')->group(function () {
        Route::post('delete', 'AdminController@deleteUser')->name('admin.user.delete');
    });

    // messages management
    Route::get('/mails', 'AdminController@showMessages')->name('admin.mails.show');
    Route::prefix('mail/{id}')->group(function () {
        Route::post('delete', 'AdminController@deleteMail')->name('admin.mail.delete');
        Route::post('reply', 'AdminController@replyMail')->name('admin.mail.reply');
    });
});

Route::get('terms-of-service', function () {
    return view('tos');
})->name('termsOfService');

// Contact
Route::post('datoscontacto', 'HomeController@datoscontacto')->name('contact');

//alcances
Route::get('alcancesView/{id}', 'StudiesController@alcancesView')->name('alcancesView');
Route::get('alcancesCreate/{id}', 'StudiesController@alcancesCreate')->name('alcancesCreate');
Route::post('alcances', 'StudiesController@alcances')->name('alcances');

// building routes
Route::prefix('building')->group(function () {
    Route::get('/', 'BuildingController@showBuildings')->name('building');
    Route::get('stats/{type}/{id?}', 'BuildingController@showStats')->name('building.stats');

    // building management
    Route::post('add', 'BuildingController@addBuilding')->name('building.add');
    Route::post('edit', 'BuildingController@editBuilding')->name('building.edit');
    Route::prefix('building/{id}')->group(function () {
        Route::post('delete', 'BuildingController@deleteBuilding')->name('building.delete');
    });
});

Route::prefix('profile')->group(function () {
    Route::get('/', 'HomeController@showProfile')->name('user.profile');
    Route::post('/', 'HomeController@saveProfile')->name('user.profile');

    Route::get('/password', 'HomeController@showChangePassword')->name('user.profile.changePassword');
    Route::post('/password', 'HomeController@changePassword')->name('user.profile.changePassword');
});

Route::get('/tutorial', 'BuildingController@showTutorial')->name('user.tutorial');

Route::post('gitPull', 'GithubWebhoockController@pull');

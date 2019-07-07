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



Route::get('/home', 'HomeController@index')->name('home');



// Admin Access Routes
Route::group(['prefix' => 'admin'], function () {

    // Authentication
    Route::get('login', 'Web\Admin\Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'Web\Admin\Auth\LoginController@login');
    Route::get('logout', 'Web\Admin\Auth\LoginController@logout')->name('admin.logout');

    // Registration Routes
    Route::get('register', 'Web\Admin\Auth\RegisterController@showRegistrationForm')->name('admin.register');
    Route::post('register', 'Web\Admin\Auth\RegisterController@register');

    // Password Reset
    Route::get('password/reset', 'Web\Admin\Auth\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('password/email', 'Web\Admin\Auth\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('password/reset/{token}', 'Web\Admin\Auth\ResetPasswordController@showResetForm')->name('admin.password.reset');
    Route::post('password/reset', 'Web\Admin\Auth\ResetPasswordController@reset')->name('admin.password.update');

    // Email Verification
    Route::get('email/verify', 'Web\Admin\Auth\VerificationController@show')->name('admin.verification.notice');
    Route::get('email/verify/{id}', 'Web\Admin\Auth\VerificationController@verify')->name('admin.verification.verify');
    Route::get('email/resend', 'Web\Admin\Auth\VerificationController@resend')->name('admin.verification.resend');
});


// Admin System Routes
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'permission']], function () {

    //Home Admin
    Route::get('/home', 'Web\Admin\AdminController@index')->name('admin.home');

    //Roles Admin
    Route::group(['prefix' => 'roles'], function () {
        Route::get('/',                 'Web\Admin\RolesController@index')->name('roles.index');
        Route::get('/create',           'Web\Admin\RolesController@create')->name('roles.create');
        Route::post('/',                'Web\Admin\RolesController@store')->name('roles.store');
        Route::get('/{id}',             'Web\Admin\RolesController@show')->name('roles.show');
        Route::get('/{id}/edit',        'Web\Admin\RolesController@edit')->name('roles.edit');
        Route::put('/{id}',             'Web\Admin\RolesController@update')->name('roles.update');
        Route::delete('/{id}',          'Web\Admin\RolesController@destroy')->name('roles.destroy');
        Route::put('/status/{id}',      'Web\Admin\RolesController@status')->name('roles.status');
        Route::get('/permission/{id}',  'Web\Admin\RolesController@permission')->name('roles.permission');
        Route::put('/permission/{id}',  'Web\Admin\RolesController@save_permission')->name('roles.savePermission');
    });
});

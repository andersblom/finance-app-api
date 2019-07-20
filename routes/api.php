<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => ['cors', 'json.response']], function () {
    /**
     * Public routes
     */
    Route::post('/login', 'Api\AuthController@login')->name('login');
    Route::post('/register', 'Api\AuthController@register')->name('register');

    /**
     * Private routes
     */
    Route::middleware('auth:api')->group(function () {
        Route::get('/user', 'Api\UserController@get')->name('user.get');
        Route::get('/logout', 'Api\AuthController@logout')->name('logout');
        Route::resource('/budgets', 'BudgetController');
    });
});

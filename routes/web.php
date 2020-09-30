<?php

use App\Providers\Route;

/**
 * This method initializes the router
 */
Route::start();

Route::get('home', function (){
    return redirect()->route('bakidzola')->send();
});
Route::match(['GET', 'POST'], 'login', 'App\Controllers\Auth\LoginController@login')->name('login');
Route::post('logout', 'App\Controllers\Auth\LoginController@logout')->name('logout');
Route::prefix('admin')->group(function () {
    Route::group(['middleware' => 'App\Middleware\Authenticate'], function()
    {
        Route::get('bakidzola', function (){
            return view('bakidzola');
        })->name('bakidzola');
        Route::get('mirko', function (){
            dd('Mirko');
        })->name('mirko');
    });
});

/**
 * this group of methods defines the routes for the required uri
 */
Route::get('', 'App\Controllers\IndexController@index')->name('home');
Route::get('about', 'App\Controllers\IndexController@about')->name('about');
Route::get('single-news/{slug}/{id}', 'App\Controllers\IndexController@singleNews')->name('singleNews');
Route::match(['GET', 'POST'], 'form', 'App\Controllers\IndexController@form')->name('form');
Route::resource('news', 'App\Controllers\NewsController');

Route::post('api/get-all-news', 'App\Controllers\IndexController@getAllNews');
/**
 * This method starts the router
 */
Route::dispatch();
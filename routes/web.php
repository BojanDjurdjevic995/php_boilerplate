<?php

use App\Providers\Route;

/**
 * This method initializes the router
 */
Route::start();

/**
 * this group of methods defines the routes for the required uri
 */
Route::get('', 'App\Controllers\IndexController@index')->name('home');
Route::get('about', 'App\Controllers\IndexController@about')->name('about');
Route::get('single-news/{slug}/{id}', 'App\Controllers\IndexController@singleNews')->name('singleNews');
Route::match(['GET', 'POST'], 'form', 'App\Controllers\IndexController@form')->name('form');
Route::resource('news', 'App\Controllers\NewsController');

/**
 * This method starts the router
 */
Route::dispatch();
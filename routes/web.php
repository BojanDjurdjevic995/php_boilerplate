<?php

use App\Controllers\Router;

$router = new Router();
$router->get('', 'App\Controllers\IndexController@index')->name('home');
$router->match(['GET', 'POST'], 'baki', 'App\Controllers\IndexController@index')->name('baki');
$router->resource('news', 'App\Controllers\NewsController');
$router->getRoutes()->refreshNameLookups();
$_ENV['routes'] = $router->getRoutes();
$router->dispatch(request());

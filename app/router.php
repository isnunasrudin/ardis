<?php

use Libraries\Route;
use Middlewares\AuthMiddleware;
use Middlewares\GuestMiddleware;

Route::get('about_us', "AboutController@us");

Route::middleware([GuestMiddleware::class], function(){
    Route::get('/', "WelcomeController@index");
    Route::post('/', "WelcomeController@nisn");

    Route::get('login', "LoginController@index");
    Route::post('login', "LoginController@login_run");
});

Route::middleware([AuthMiddleware::class], function(){
    Route::get('auth.home', "Auth\\HomeController@index");
    Route::get('logout', "LoginController@logout");
});
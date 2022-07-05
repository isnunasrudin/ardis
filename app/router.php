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

    Route::get('auth.siswa', "Auth\\SiswaController@index");
    Route::post('auth.siswa', "Auth\\SiswaController@delete");

    Route::get('auth.siswa.tambah', "Auth\\SiswaController@tambah");
    Route::post('auth.siswa.tambah', "Auth\\SiswaController@tambah_post");

    Route::get('auth.siswa.view', "Auth\\SiswaController@view");
    
    Route::get('auth.siswa.edit', "Auth\\SiswaController@edit");
    Route::post('auth.siswa.edit', "Auth\\SiswaController@edit_run");

    Route::get('auth.operator', "Auth\\OperatorController@index");
    Route::post('auth.operator', "Auth\\OperatorController@action");

    Route::get('auth.rombel', "Auth\\RombelController@index");
    Route::post('auth.rombel', "Auth\\RombelController@action");

    Route::get('logout', "LoginController@logout");
});
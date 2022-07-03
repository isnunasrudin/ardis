<?php

use Libraries\Route;

Route::get('/', "WelcomeController@index");
Route::post('/', "WelcomeController@nisn");

Route::get('elly', "WelcomeController@elly");
Route::post('elly', "WelcomeController@login_run");

Route::get('about', "AboutController@us");
Route::get('zhen', "WelcomeController@zhen");
<?php

use Libraries\Route;

Route::get('/', "Welcome@index");
Route::post('/', "Welcome@nisn");

Route::get('elly', "Welcome@elly");
Route::post('elly', "Welcome@login_run");

Route::get('about', "AboutController@us");
Route::get('zhen', "Welcome@zhen");
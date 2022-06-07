<?php

//App Const Variable
define('ROOT_DIR', preg_replace("/(core(\\|\/)?)$/", '', __DIR__));
define('CORE_DIR', ROOT_DIR . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR);
define('APP_DIR', ROOT_DIR . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR);
define('VIEW_DIR', APP_DIR . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR);

//Init PHP System
session_start();
// error_reporting(0);

$modules = [
    Library\DB::class,
    Library\Route::class,
    Library\URL::class,
    Library\View::class,
];

//Load All Module
require_once(CORE_DIR . 'Aplikasi.php');
foreach($modules as $module) try {
    require_once(CORE_DIR . "$module.php");
} catch (\Throwable $th) {
    die("Tidak dapat memuat <b>$module</b>");
}
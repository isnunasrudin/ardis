<?php

//App Const Variable
define('ROOT_DIR', preg_replace("/(core(\\|\/)?)$/", '', __DIR__));
define('CORE_DIR', ROOT_DIR . 'core' . DIRECTORY_SEPARATOR);
define('APP_DIR', ROOT_DIR . 'app' . DIRECTORY_SEPARATOR);
define('VIEW_DIR', APP_DIR . 'views' . DIRECTORY_SEPARATOR);

//Init PHP System
session_start();
// error_reporting(0);

$modules = array_diff(scandir(CORE_DIR . "Library"), ['.', '..']);

//Load All Module
foreach($modules as $module) try {
    require_once(CORE_DIR . "Library" . DIRECTORY_SEPARATOR . "$module");
} catch (\Throwable $th) {
    die("Tidak dapat memuat <b>$module</b>");
}

//Load Router
require_once(APP_DIR . 'router.php');

//Load Apps
require_once(CORE_DIR . 'Aplikasi.php');
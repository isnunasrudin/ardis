<?php

//App Const Variable
define('ROOT_DIR', preg_replace("/(core(\\|\/)?)$/", '', __DIR__));
define('CORE_DIR', ROOT_DIR . 'core' . DIRECTORY_SEPARATOR);
define('APP_DIR', ROOT_DIR . 'app' . DIRECTORY_SEPARATOR);
define('VIEW_DIR', APP_DIR . 'views' . DIRECTORY_SEPARATOR);
define('MIGRATION_DIR', ROOT_DIR . 'migrations' . DIRECTORY_SEPARATOR);
define('STORAGE_DIR', ROOT_DIR . 'storage' . DIRECTORY_SEPARATOR);

//Init PHP System
session_name("YEN_NING_TAWANG_ONO_LINTANG");
session_start();

// === Autoloader ===

//Module
spl_autoload_register(function($class){
    $path = CORE_DIR . str_replace("\\", DIRECTORY_SEPARATOR, $class) . ".php";
    if(file_exists($path))  require $path;
});

//Models
spl_autoload_register(function($class){
    $path = APP_DIR . 'models' . DIRECTORY_SEPARATOR . str_replace("\\", DIRECTORY_SEPARATOR, $class) . ".php";
    if(file_exists($path)) require $path;
});

spl_autoload_register(function($class)){
    if($class == "Aplikasi") require 
}

require_once(CORE_DIR . '_helper.php');
require_once(APP_DIR . 'router.php');

require_once(CORE_DIR . '');
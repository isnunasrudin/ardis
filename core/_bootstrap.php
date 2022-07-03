<?php

declare(strict_types=1);

//App Const Variable
define('ROOT_DIR', preg_replace("/(core(\\|\/)?)$/", '', __DIR__));
define('CORE_DIR', ROOT_DIR . 'core' . DIRECTORY_SEPARATOR);
define('APP_DIR', ROOT_DIR . 'app' . DIRECTORY_SEPARATOR);
define('VIEW_DIR', APP_DIR . 'views' . DIRECTORY_SEPARATOR);
define('MIGRATION_DIR', ROOT_DIR . 'migrations' . DIRECTORY_SEPARATOR);
define('STORAGE_DIR', ROOT_DIR . 'storage' . DIRECTORY_SEPARATOR);

// === Autoloader ===

//Module
spl_autoload_register(function($class){
    if(preg_match('/^Libraries\\\/', $class))
    {
        $path = CORE_DIR . str_replace("\\", DIRECTORY_SEPARATOR, $class) . ".php";
        if(file_exists($path)) require $path;
    }
});

//Models
spl_autoload_register(function($class){
    if(preg_match('/^Models\\\/', $class))
    {
        $path = APP_DIR . str_replace("\\", DIRECTORY_SEPARATOR, $class) . ".php";
        if(file_exists($path)) require $path;
    }
});

//Middlewares
spl_autoload_register(function($class){
    if(preg_match('/^Middlewares\\\/', $class))
    {
        $path = APP_DIR . str_replace("\\", DIRECTORY_SEPARATOR, $class) . ".php";
        if(file_exists($path)) require $path;
    }
});

//Controllers
spl_autoload_register(function($class){
    if(preg_match('/^Controllers\\\/', $class))
    {
        $path = APP_DIR . str_replace("\\", DIRECTORY_SEPARATOR, $class) . ".php";
        if(file_exists($path)) require $path;
    }
});

require_once(CORE_DIR . '_helper.php');
require_once(APP_DIR . 'router.php');

require_once(CORE_DIR . 'Aplikasi.php');
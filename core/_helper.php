<?php

use Library\View;

if(!function_exists('view'))
{
    function view($name, $params){
        return View::render($name, $params);
    }
}

if(!function_exists('config'))
{
    function config($key)
    {
        return require(APP_DIR . 'config.php')[$key];
    }
}

if(!function_exists('session'))
{
    function session(&$key)
    {
        return $_SESSION[$key];
    }
}
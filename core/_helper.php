<?php

use Library\Config;
use Library\URL;
use Library\View;

if(!function_exists('view'))
{
    function view($name, $params = array()){
        return View::render($name, $params);
    }
}

if(!function_exists('config'))
{
    function config($key)
    {
        return Config::get($key);
    }
}

if(!function_exists('session'))
{
    function session(&$key)
    {
        return $_SESSION[$key];
    }
}

if(!function_exists('load_time'))
{
    function load_time() : float
    {
        return microtime(true) - $GLOBALS['startime'];
    }
}

if(!function_exists('e'))
{
    function e(string $content)
    {
        return htmlentities($content);
    }
}

if(!function_exists('asset'))
{
    function asset($file)
    {
        return URL::asset_url($file);
    }
}

if(!function_exists('dd'))
{
    function dd(...$vars)
    {
        ob_flush();
        echo "<pre>";
        foreach($vars as $var)
        {
            var_dump($var);
            echo "<br />";
        }
        echo "</pre>";
    }
}
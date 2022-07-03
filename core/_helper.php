<?php

use Libraries\Config;
use Libraries\DotEnv;
use Libraries\Response;
use Libraries\Route;
use Libraries\URL;
use Libraries\View;

if(!function_exists('view'))
{
    function view(...$params){
        return View::render(...$params);
    }
}

if(!function_exists('response'))
{
    function response()
    {
        return new Response;
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

if(!function_exists('url_make'))
{
    function url_make($link)
    {
        return URL::make($link);
    }
}

if(!function_exists('url_active'))
{
    function url_active($url)
    {
        return Route::_isActive($url);
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

if(!function_exists('bcrypt'))
{
    function bcrypt($val) : string
    {
        return password_hash($val, PASSWORD_BCRYPT);
    }
}

if(!function_exists('env'))
{
    function env($key, $default = null)
    {
        return DotEnv::get($key, $default);
    }
}

if(!function_exists('dump'))
{
    function dump(...$vars)
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

if(!function_exists('dd'))
{
    function dd(...$vars)
    {
        dump(...$vars);
        exit;
    }
}

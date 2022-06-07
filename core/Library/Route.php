<?php

namespace Library;

class Route
{
    private static $routes = array();

    private static function _add($url, $method, $callback)
    {
        if(!isset(self::$routes[$method][$url]))
        {
            self::$routes[$method][$url] = $callback;
        }
    }

    public static function get($url, $callback)
    {
        self::_add($url, 'GET', $callback);
    }

    public static function post($url, $callback)
    {
        self::_add($url, 'POST', $callback);
    }
}
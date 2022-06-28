<?php

namespace Libraries;

class Route
{
    protected static $routes = array();

    private static $current = null;

    public static function _setCurrent($url_hashed)
    {
        self::$current = $url_hashed;
    }

    public static function _isActive($url)
    {
        return sha1($url) === self::$current;
    }

    private static function _add($url, $method, $callback)
    {
        if(!isset(self::$routes[$method][$url]))
        {
            self::$routes[$method][sha1($url)] = $callback;
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
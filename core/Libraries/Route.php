<?php

namespace Libraries;

class Route
{
    protected static $routes = array();
    public static $current = null;

    private static $active_middlewares = array();

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
            self::$routes[$method][sha1($url)] = [
                'callback' => $callback,
                'middlewares' => self::$active_middlewares
            ];
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

    public static function middleware(array $middlewares, callable $callback)
    {
        self::$active_middlewares = $middlewares;
        $callback();
        self::$active_middlewares = array();
    }
}
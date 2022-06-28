<?php

namespace Libraries;

class Session
{
    public static function set($key, $val)
    {
        return $_SESSION[$key] = $val;
    }

    public static function get($key)
    {
        return $_SESSION[$key] ?? null;
    }
}
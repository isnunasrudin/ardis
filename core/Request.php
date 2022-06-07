<?php

class Request
{
    public static function get($key) : string
    {
        return $_SESSION['url']['current']['params'][$key] ?? null;
    }

    public static function post($key)
    {
        return $_POST[$key] ?? null;
    }

    public static function has($key) : bool
    {
        return isset($_POST[$key]) || isset($_FILES[$key]) || isset($_POST['url']['current']['params'][$key]);
    }

}
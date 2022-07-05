<?php

namespace Libraries;

class URL
{
    public const GLUE = "78yh2u3r8734yh2";
    public static function current_url()
    {
        return $_SESSION['url']['current']['link'];
    }

    public static function base_url()
    {
        return config('base_url');
    }

    public static function asset_url($name)
    {
        return self::base_url() . 'assets/' . $name;
    }

    public static function make($url_name, $params = array())
    {
        return $_SESSION['id'] . "=" . sha1($url_name) . self::GLUE . base64_encode(serialize($params));
    }
    
}
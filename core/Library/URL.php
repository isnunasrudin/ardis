<?php

namespace Library;

class URL
{
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

    public static function redirect($url, array $params = [])
    {
        $_SESSION['url'] = [
            'before' => $_SESSION['url']['current'],
            'current' => [
                'link' => $url,
                'params' => $params
            ]
        ];

        header(self::base_url() .'?'. http_build_query([$_SESSION['csrf_key'] => $_SESSION['csrf_val']]));
    }

    public static function redirect_back()
    {
        $_SESSION['url'] = [
            'current' => $_SESSION['url']['before'] ?? ['link' => '/', 'params' => array()]
        ];

        header(self::base_url() .'?'. http_build_query([$_SESSION['csrf_key'] => $_SESSION['csrf_val']]));
    }
    
}
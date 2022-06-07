<?php

namespace Library;

use Exception;

class View
{
    public static function render($name, array $params)
    {
        $name .= '.php';
        if(!file_exists(VIEW_DIR . $name)) throw new Exception("Berkas view <b>$name</b> tidak ditemukan");

        //Render View
        ob_start();
        (function() use($name, $params){
            extract($params);
            include_once(VIEW_DIR . $name);
        })();
        return ob_get_flush(); 
    }
}
<?php

namespace Library;

use Exception;

class View
{
    public static function render($file, array $params, $title = 'Tidak Ditemukan')
    {
        $file .= '.php';
        if(!file_exists(VIEW_DIR . $file)) throw new Exception("Berkas view <b>$file</b> tidak ditemukan");

        //Render View
        ob_start();
        (function() use($file, $params){
            $params;
            extract($params);
            include_once(VIEW_DIR . $file);
        })();
        $content = ob_get_clean();

        //Template
        ob_start();
        (function() use($title, $content){
            [$title, $content];
            include_once(VIEW_DIR . "_template.php");
        })();
        return ob_get_clean();
        
    }
}
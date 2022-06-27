<?php

namespace Libraries;

use Exception;

class View
{
    public static function render($file, $params = array(), $title = null, $template = null)
    {
        if($template == null) $template = 'umum';

        if($title === null) $title = 'Tidak Ditemukan';
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
        (function() use($title, $content, $template){
            [$title, $content];
            include_once(VIEW_DIR . "templates" . DIRECTORY_SEPARATOR . "$template.php");
        })();
        return ob_get_clean();
        
    }
}
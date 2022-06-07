<?php

use Library\Request;
use Library\Route;
use Library\URL;

class Aplikasi extends Route {

    public function run()
    {
        //Navigator
        $this->navigate();

        //Is csrf_valid?
        $csrf_valid = $this->validate();
        Request::$csrf_valid = $csrf_valid;

        //Check is isset the routes
        $method = Request::method();
        $current_url = URL::current_url();

        if(isset(Route::$routes[$method][$current_url]))
        {
            $response = Route::$routes[$method][$current_url];
            if(is_callable($response)) echo $response();
            else
            {
                try {
                    $file = explode('::', $response)[0];
                    include_once(APP_DIR . DIRECTORY_SEPARATOR . "controller" . DIRECTORY_SEPARATOR . "$file.php");
                    echo call_user_func("Controller\\$response", new Request());
                } catch (\Throwable $th) {
                    throw new Exception("Kontroller/method tidak ditemukan!");
                }
            }
        }
        else
        {
            die('Halaman Tidak Ditemukan');
        }
    }

    private function validate() : bool
    {
        if(isset($_SESSION['csrf_key']) || isset($_SESSION['csrf_val']))
        {
            if(isset($_GET[$_SESSION['csrf_key']]) && $_GET[$_SESSION['csrf_key']] === $_SESSION['csrf_val'])
            {
                return true;
            }   
        }

        $this->csrf_generate();
        return false;
        
    }

    public static function csrf_generate()
    {
        $str = str_split("abcdefghijklmnopqrstuvwxyz", 1);
        $_SESSION['csrf_key'] = $str[array_rand($str)];
        $_SESSION['csrf_val'] = sha1(time());
    }

    private function navigate()
    {
        if(!isset($_SESSION['url']))
        {
            $_SESSION['url'] = [
                'current' => [
                    'link' => '/',
                    'params' => array()
                ]
            ];
        }
        
    }

}
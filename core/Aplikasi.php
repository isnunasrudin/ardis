<?php

use Library\Request;
use Library\Route;
use Library\Storage;
use Library\URL;

class Aplikasi extends Route {

    public function run()
    {
        //Navigator
        $this->navigate();

        //DB Migration
        $this->dbMigrate();

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
                $context = explode('@', $response);
                $file = $context[0];
                include_once(APP_DIR . DIRECTORY_SEPARATOR . "controllers" . DIRECTORY_SEPARATOR . "$file.php");
                
                $class = "Controllers\\" . $context[0];
                echo call_user_func([new $class(), $context[1]], new Request());
            }
        }
        else
        {
            $_SESSION['url']['current'] = $_SESSION['url']['before'] = [
                'link' => '/',
                'params' => array()
            ];
            http_response_code(404);
            die('Halaman Tidak Ditemukan');
        }
    }

    private function dbMigrate()
    {
        if(!Storage::disk('system')->has('HAS_MIGRATE'))
        {
            $migrates = array_diff(scandir(MIGRATION_DIR), ['.', '..']);
            foreach($migrates as $file)
            {
                require_once(MIGRATION_DIR . $file);
                $name = preg_replace("/^(\d*_)(.*)(\.php)/", "$2", $file);
                $name = "Migrations\\" . $name;
                $migrate = new $name();
                $migrate->execute();
            }
            Storage::disk('system')->put('HAS_MIGRATE', time());
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
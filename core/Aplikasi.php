<?php

use Libraries\Request;
use Libraries\Response;
use Libraries\Route;
use Libraries\URL;

class Aplikasi extends Route {

    public function run()
    {
        //Init PHP System
        session_name("YEN_NING_TAWANG_ONO_LINTANG");
        session_start();

        //Navigator
        $this->navigate();

        $this->validate();

        //Check is isset the routes
        $method = Request::method();
        $current_url = URL::current_url();

        if(isset(Route::$routes[$method][$current_url]))
        {
            Route::_setCurrent($current_url);
            $response = Route::$routes[$method][$current_url];
            if(is_callable($response)) echo $response();
            else
            {
                $context = explode('@', $response);
                $class = "Controllers\\" . $context[0];
                
                $result = call_user_func([new $class(), $context[1]], new Request());
                if($result instanceof Response)
                {
                    ob_clean();

                    foreach($result->getHeaders() as $k => $v) header("$k: $v");
                    http_response_code($result->getHttpCode());
                    echo $result->getBody();
                }
                else
                {
                    echo $result;
                }
            }
        }
        else
        {
            $_SESSION['url']['current'] = $_SESSION['url']['before'] = [
                'link' => sha1('/'),
                'params' => array()
            ];
            http_response_code(404);
            die('Halaman Tidak Ditemukan');
        }
    }

    private function validate()
    {
        if(!isset($_SESSION['id']))
        {
              $_SESSION['id'] = sha1(microtime(true));
        }
        
    }

    private function navigate()
    {
        if(!isset($_SESSION['url']))
        {
            $_SESSION['url'] = [
                'current' => [
                    'link' => sha1('/'),
                    'params' => array()
                ],
                'before' => [
                    'link' => sha1('/'),
                    'params' => array()
                ]
            ];
        }
        else
        {
            if(isset($_COOKIE[$_SESSION['id']]))
            {
                $_SESSION['url']['before'] = $_SESSION['url']['current'];

                $_SESSION['url']['current'] = [
                    'link' => $_COOKIE[$_SESSION['id']],
                    'params' => $_GET
                ];

                setcookie($_SESSION['id'], "", 1);
            }
        }
        
    }

}
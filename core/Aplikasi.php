<?php

use Libraries\Authenticable\Auth;
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

        //Set DateTime
        date_default_timezone_set("Asia/Jakarta");

        //Navigator
        $this->navigate();

        $this->validate();

        //Request
        $request = new Request($_POST, $_GET, $_FILES);

        //Check is isset the routes
        $current_url = URL::current_url();

        //Auth Validation
        Auth::validate();

        if(isset(Route::$routes[$request->method()][$current_url]))
        {
            Route::_setCurrent($current_url);
            $response = Route::$routes[$request->method()][$current_url]['callback'];

            $middlewares = Route::$routes[$request->method()][$current_url]['middlewares'];

            foreach($middlewares as $middleware)
            {
                $mid_result = (new $middleware())->run($request);
                if($mid_result instanceof Request) $request = $mid_result;
                else
                {
                    return $this->responseExec($mid_result);
                }
            }

            if(is_callable($response)) echo $response();
            else
            {
                $context = explode('@', $response);
                $class = "Controllers\\" . $context[0];
                
                $result = call_user_func_array([new $class(), $context[1]], [$request]);
                if($result instanceof Response) $this->responseExec($result);
                else echo $result;
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

    private function responseExec(Response $response)
    {
        ob_clean();

        foreach($response->getHeaders() as $k => $v) header("$k: $v");
        http_response_code($response->getHttpCode());
        echo $response->getBody();
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
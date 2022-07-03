<?php

namespace Middlewares;

use Libraries\Authenticable\Auth;
use Libraries\Interfaces\MiddlewareInterface;
use Libraries\Request;
use Libraries\Response;

class AuthMiddleware implements MiddlewareInterface
{
    public function run(Request $request) : Response|Request
    {
        if(!Auth::check()) return response()->redirect('/');

        return $request;
    }
}
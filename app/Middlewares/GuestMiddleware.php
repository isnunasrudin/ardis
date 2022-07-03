<?php

namespace Middlewares;

use Libraries\Authenticable\Auth;
use Libraries\Interfaces\MiddlewareInterface;
use Libraries\Request;
use Libraries\Response;

class GuestMiddleware implements MiddlewareInterface
{
    public function run(Request $request): Response|Request
    {
        if(Auth::check()) return response()->redirect('auth.home');

        return $request;
    }
}
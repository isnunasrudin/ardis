<?php

namespace Libraries\Interfaces;

use Libraries\Request;
use Libraries\Response;

interface MiddlewareInterface
{
    public function run(Request $request) : Response|Request;
}
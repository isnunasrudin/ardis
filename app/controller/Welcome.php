<?php

namespace Controller;

use Library\Request;

class Welcome
{
    public function index(Request $request)
    {
        return view('welcome');
    }
}
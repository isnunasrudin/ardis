<?php

namespace Controllers;

use Library\Request;
use Models\User;

class Welcome
{
    public function index(Request $request)
    {
        dd(load_time());
        return view('welcome');
    }
}
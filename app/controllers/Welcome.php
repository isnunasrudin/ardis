<?php

namespace Controllers;

use Library\Request;
use Models\Role;

class Welcome
{
    public function index(Request $request)
    {
        Role::where('a', 'b');
        return view('welcome');
    }
}
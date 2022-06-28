<?php

namespace Controllers;

use Libraries\Request;

class Welcome
{
    public function index(Request $request)
    {
        return view('welcome');
    }

    public function nurul(Request $request)
    {
        return view('nurul');
    }

    public function elly(Request $request)
    {
        return view('fyea');
    }

    public function zhen(Request $request)
    {
        return view('zhendi');
    }
}
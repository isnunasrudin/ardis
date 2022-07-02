<?php

namespace Controllers;

use Libraries\Request;

class AboutController
{
    public function us(Request $request)
    {
        return response()->view("nurul", title: "Tentang Kami");
    }
}
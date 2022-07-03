<?php

namespace Controllers;

class AboutController
{
    public function us()
    {
        return response()->view("about_us", title: "Tentang Kami");
    }
}
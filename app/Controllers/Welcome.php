<?php

namespace Controllers;

use Libraries\Request;
use Models\User;
use PDO;

class Welcome
{
    public function index(Request $request)
    {
        User::get()->each(function(User $data){
            echo "$data->id<br>";
        });
        echo load_time();
    }
}
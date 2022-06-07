<?php

class Aplikasi {

    public function __construct()
    {
        $this->router = require_once(APP_DIR . 'router.php');
    }

    public function run()
    {
        //Navigator
        $this->navigate();

        //Is trusted?
        $trusted = $this->validate();

        
    }

    private function validate() : bool
    {
        if(isset($_SESSION['csrf_key']) || isset($_SESSION['csrf_val']))
        {
            if(isset($_GET[$_SESSION['csrf_key']]) && $_GET[$_SESSION['csrf_key']] === $_SESSION['csrf_val'])
            {
                return true;
            }   
        }

        $this->csrf_generate();
        return false;
        
    }

    private function csrf_generate()
    {
        $str = str_split("abcdefghijklmnopqrstuvwxyz", 1);
        $_SESSION['csrf_key'] = $str[array_rand($str)];
        $_SESSION['csrf_val'] = sha1(time());
    }

    private function navigate()
    {
        if(!isset($_SESSION['url']))
        {
            $_SESSION['url'] = [
                'current' => [
                    'link' => '/',
                    'params' => array()
                ]
            ];
        }
        
    }

}
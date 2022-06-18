<?php

namespace Library;

class Config
{
    private static $instance = null;
    private $config = null;

    public function __construct()
    {
        $this->config = require_once(APP_DIR . 'config.php');
    }

    public static function getInstance()
    {
        if(self::$instance === null) self::$instance = new Config();

        return self::$instance;
    }

    public static function get($key)
    {
        return self::getInstance()->config[$key] ?? null;
    }
}
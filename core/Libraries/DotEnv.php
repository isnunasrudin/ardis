<?php

namespace Libraries;

class DotEnv
{
    public static $instance = null;
    private $envs = array();

    public function __construct()
    {
        self::init();

        $env = Storage::root()->get('.env');
        foreach(explode(PHP_EOL, $env) as $val)
        {
            $val = trim($val);
            if($val == "" || $val[0] == "#") continue;

            preg_replace_callback("/^(\w*)(\s*=\s*)(.*)$/", function($s) {
                
                $this->envs[$s[1]] = trim($s[3], "\t\n\r\0\x0B\"");

            }, $val);
        }
    }

    public function _get($key, $default = null)
    {
        return $this->envs[$key] ?? $default;
    }

    public function _all() : array
    {
        return $this->envs;
    }

    public static function init()
    {
        if(!Storage::root()->has('.env')) 
        {
            $default_value = <<<EOD
            APP_ENV = "development"

            # Tambahkan slash dibelakang (Jika Directory)
            BASE_URL = "http://localhost/uas/public/"
            
            # Konfigurasi Database
            DB_HOST = "localhost"
            DB_USER = "root"
            DB_PASS = ""
            DB_NAME = "kuliah"
            EOD;

            Storage::root()->put('.env', $default_value);
        }
    }

    public static function __callStatic($name, $arguments)
    {
        if(self::$instance === null) self::$instance = new self();

        return call_user_func_array([self::$instance, "_$name"], $arguments);
    }


}
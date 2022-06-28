<?php

namespace Libraries;

class DotEnv
{
    public static $instance = null;
    private $envs = array();

    public function __construct()
    {
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

    public static function __callStatic($name, $arguments)
    {
        if(self::$instance === null) self::$instance = new self();

        return call_user_func_array([self::$instance, "_$name"], $arguments);
    }


}
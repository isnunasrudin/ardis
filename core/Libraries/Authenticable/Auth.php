<?php

namespace Libraries\Authenticable;

use Models\User;

class Auth
{
    private static $user_id = null;
    private const SESSION_KEY = "auth";

    public static function validate()
    {
        if(isset($_SESSION[self::SESSION_KEY]))
        {
            $user = User::find($_SESSION[self::SESSION_KEY]);
            if(is_null($user)) self::logout();
            else self::$user_id = $_SESSION[self::SESSION_KEY];
        }
    }

    public static function user() : User|null
    {
        return is_null(self::$user_id) ? null : User::find(self::$user_id);
    }

    public static function check() : bool
    {
        return !is_null(self::user()); 
    }

    public static function login($id) : bool
    {
        $user = User::find($id);
        if(is_null($user)) return false;

        $_SESSION[self::SESSION_KEY] = self::$user_id = $user->id;
        return true;
    }

    public static function logout() : void
    {
        self::$user_id = null;
        unset($_SESSION[self::SESSION_KEY]);
    }
}
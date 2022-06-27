<?php

namespace Libraries;

class Stringable {

    public static function toPascalCase($string)
    {
        return str_replace('_', '', ucwords($string, '_'));
    }

    public static function to_snake_case(string $string)
    {
        return ltrim(preg_replace_callback("/[A-Z]/", fn($matches) => '_' . strtolower($matches[0]), $string), "_");
    }

    public static function classToTable($string)
    {
        return self::to_snake_case(preg_replace('/(.*\\\)(\w*)$/', "$2", $string));
    }

    public static function uuid() : string
    {
        return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            // 32 bits for "time_low"
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
    
            // 16 bits for "time_mid"
            mt_rand( 0, 0xffff ),
    
            // 16 bits for "time_hi_and_version",
            // four most significant bits holds version number 4
            mt_rand( 0, 0x0fff ) | 0x4000,
    
            // 16 bits, 8 bits for "clk_seq_hi_res",
            // 8 bits for "clk_seq_low",
            // two most significant bits holds zero and one for variant DCE1.1
            mt_rand( 0, 0x3fff ) | 0x8000,
    
            // 48 bits for "node"
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
        );
    }

}
<?php

namespace Library;

class Stringable {

    public static function toPascalCase($string)
    {
        return str_replace('_', '', ucwords($string, '_'));
    }

    public static function to_snake_case($string)
    {
        return ltrim(preg_replace_callback('/[A-Z]/', fn($matches) => '_' . strtolower($matches[0]), $string), "_");
    }

}
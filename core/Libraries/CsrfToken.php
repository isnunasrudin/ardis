<?php

namespace Libraries;

class CsrfToken {

    public static function key()
    {
        return $_SESSION['csrf_key'];
    }

    public static function val()
    {
        return $_SESSION['csrf_val'];
    }

}
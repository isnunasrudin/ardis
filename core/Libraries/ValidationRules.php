<?php

namespace Libraries;

trait ValidationRules
{
    public function rule_required($input, $value) : string|bool
    {
        if($value == '') return "Kolom $input harus diisi";

        return TRUE;
    }
}
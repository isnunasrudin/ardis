<?php

namespace Libraries;

use Libraries\Database\DB;

trait ValidationRules
{
    public function rule_required($input, $value) : string|bool
    {
        if($value == '') return "Kolom $input harus diisi";

        return TRUE;
    }

    public function rule_unique($input, $value, $table, $kolom = null, $except_id = null) : bool
    {
        $sql = DB::table($table)->where($kolom ?? $input, $value);

        if(is_null($except_id)) $sql = $sql->where('id', $except_id);

        if($sql->count() <= 0) return TRUE;

        return "Data $input sudah digunakan";
    }

    public function rule_in($input, $value, ...$cocok)
    {
        if(in_array($value, $cocok)) return TRUE;

        return "Data $input tidak valid";
    }

}
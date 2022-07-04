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

    public function rule_unique($input, $value, $table, $kolom = 'id', $except_id = null)
    {
        $sql = DB::table($table)->where($kolom, $value);

        // if(is_null($except_id)) $sql = $sql->where($kolom, $except_id);

        if($sql->count() <= 0) return TRUE;

        return "Data $input sudah digunakan";
    }

    public function rule_in($input, $value, ...$cocok)
    {
        if(in_array($value, $cocok)) return TRUE;

        return "Data $input tidak valid";
    }

    public function rule_digits($input, $value, $length)
    {
        if(preg_match("/^[0-9]{{$length}}$/", $value)) return TRUE;

        return "Panjang $input harus $length angka";
    }

    public function rule_exists($input, $value, $table, $kolom = 'id', $except_id = null)
    {
        if($this->rule_unique($input, $value, $table, $kolom, $except_id) === TRUE) return "Data $input tidak tersedia";

        return TRUE;
    }

    public function rule_date($input, $value)
    {
        if((bool)strtotime($value)) return TRUE;

        return "Kolom $input harus diisi tanggal yang valid";
    }

    public function rule_email($input, $value)
    {
        
        if(filter_var($value, FILTER_VALIDATE_EMAIL)) return TRUE;

        return "Kolom $input harus diisi email yang valid";
    }

    public function rule_numeric($input, $value, $length)
    {
        if(preg_match("/^[0-9]*$/", $value)) return TRUE;

        return "Kolom $input harus diisi angka";
    }

}
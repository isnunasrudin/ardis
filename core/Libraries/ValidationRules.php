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

    public function rule_unique($input, $value, $table, $kolom = 'id', $soft_delete = "false", $except_id = null)
    {
        if($value == '') return TRUE;
        
        $sql = DB::table($table)->where($kolom, $value);

        if($soft_delete === "true") $sql->soft_delete = TRUE;

        if($sql->count() <= 0) return TRUE;

        return "Data $input sudah digunakan";
    }

    public function rule_in($input, $value, ...$cocok)
    {
        if($value == '') return TRUE;
        
        if(in_array($value, $cocok)) return TRUE;

        return "Data $input tidak valid";
    }

    public function rule_digits($input, $value, $length)
    {
        if($value == '') return TRUE;
        
        if(preg_match("/^[0-9]{{$length}}$/", $value)) return TRUE;

        return "Panjang $input harus $length angka";
    }

    public function rule_exists($input, $value, $table, $kolom = 'id', $soft_delete = "false", $except_id = null)
    {
        if($value == '') return TRUE;
        
        if($this->rule_unique($input, $value, $table, $kolom, $soft_delete, $except_id) === TRUE) return "Data $input tidak tersedia";

        return TRUE;
    }

    public function rule_date($input, $value)
    {
        if($value == '') return TRUE;
        
        if((bool)strtotime($value)) return TRUE;

        return "Kolom $input harus diisi tanggal yang valid";
    }

    public function rule_email($input, $value)
    {
        if($value == '') return TRUE;
        
        if(filter_var($value, FILTER_VALIDATE_EMAIL)) return TRUE;

        return "Kolom $input harus diisi email yang valid";
    }

    public function rule_numeric($input, $value, $length)
    {
        if($value == '') return TRUE;
        
        if(preg_match("/^[0-9]*$/", $value)) return TRUE;

        return "Kolom $input harus diisi angka";
    }

    public function rule_name($input, $value)
    {
        if($value == '') return TRUE;
        
        if(preg_match("/^[a-z ,.'-]+$/i", $value)) return TRUE;

        return "Kolom $input harus berisi nama yang valid";
    }

}
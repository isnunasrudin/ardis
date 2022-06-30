<?php

namespace Models;

use Libraries\Database\Model;

class SiswaInfo extends Model
{
    public function akun()
    {
        return $this->belongsTo('user');
    }
}
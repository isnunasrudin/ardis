<?php

namespace Models;

use Libraries\Database\Model;

class Rombel extends Model
{
    public $timestamps = false;

    public function siswa()
    {
        return $this->hasMany(SiswaInfo::class);
    }
}
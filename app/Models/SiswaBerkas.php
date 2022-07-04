<?php

namespace Models;

use Libraries\Database\Model;

class SiswaBerkas extends Model
{
    public function siswa_info()
    {
        return $this->belongsTo(SiswaInfo::class);
    }
}
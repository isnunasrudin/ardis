<?php

namespace Models;

use Libraries\Database\Model;

class SiswaInfo extends Model
{
    public function akun()
    {
        return $this->belongsTo(User::class);
    }

    public function berkas()
    {
        return $this->hasMany(SiswaBerkas::class);
    }

    public function rombel()
    {
        return $this->belongsTo(Rombel::class);
    }
}
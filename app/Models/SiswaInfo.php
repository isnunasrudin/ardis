<?php

namespace Models;

use Libraries\Database\Model;
use Libraries\Database\SoftDelete;

class SiswaInfo extends Model
{
    use SoftDelete;
    
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

    public function desa()
    {
        return $this->address_code;
    }

    public function kecamatan()
    {
        return substr($this->address_code, 0, 7);
    }

    public function kota()
    {
        return substr($this->address_code, 0, 4);
    }

    public function provinsi()
    {
        return substr($this->address_code, 0, 2);
    }
}
<?php

namespace Models;

use Libraries\Database\Model;
use Libraries\Database\SoftDelete;

class User extends Model {

    use SoftDelete;

    public $uuidPrimaryKey = true;

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function siswa()
    {
        return $this->hasOne(SiswaInfo::class);
    }

    public function isRole(...$role) : bool
    {
        return in_array($this->role->name, $role);
    }

    public function avatar_link()
    {
        return asset('img/user.png');
    }

    public function nick_name()
    {
        return preg_replace("/^(\w)(.*)/", "$1", $this->full_name);
    }

}
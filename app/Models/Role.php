<?php

namespace Models;

use Libraries\Database\Model;

class Role extends Model {

    public $timestamps = false;

    public function users()
    {
        return $this->hasMany(User::class);
    }

}
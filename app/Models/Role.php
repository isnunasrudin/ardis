<?php

namespace Models;

use Library\DB;

class Role extends DB {

    public function users()
    {
        return $this->hasMany(User::class);
    }

}
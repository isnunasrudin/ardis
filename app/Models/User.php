<?php

namespace Models;

use Library\DB;

class User extends DB {

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

}
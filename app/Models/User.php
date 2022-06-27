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

}